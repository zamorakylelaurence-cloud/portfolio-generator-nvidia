<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
{
    public function home()
    {
        $portfolioCount = Portfolio::where('user_id', Auth::id())->count();

        return view('home', compact('portfolioCount'));
    }

    public function index()
    {
        $portfolios = Portfolio::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('portfolios.form', [
            'portfolio' => new Portfolio(),
            'editing' => false,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $portfolio = new Portfolio($data);
        $portfolio->user_id = Auth::id();
        $portfolio->save();

        return redirect()
            ->route('portfolios.templates', $portfolio)
            ->with('success', 'Portfolio saved. Choose a template to continue.');
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        return view('portfolios.form', [
            'portfolio' => $portfolio,
            'editing' => true,
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        $data = $this->validatedData($request);

        if (!empty($data['profile_picture']) && $portfolio->profile_picture) {
            Storage::disk('s3')->delete($portfolio->profile_picture);
        }

        $portfolio->update($data);

        return redirect()
            ->route('portfolios.preview', $portfolio)
            ->with('success', 'Portfolio updated.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        if ($portfolio->profile_picture) {
            Storage::disk('s3')->delete($portfolio->profile_picture);
        }

        $portfolio->delete();

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Portfolio deleted.');
    }

    public function templates(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        return view('portfolios.templates', compact('portfolio'));
    }

    public function updateTemplate(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        $request->validate([
            'template' => [
                'required',
                Rule::in(['simple', 'modern', 'creative']),
            ],
        ]);

        $portfolio->update([
            'template' => $request->template,
        ]);

        return redirect()
            ->route('portfolios.preview', $portfolio)
            ->with('success', 'Template selected.');
    }

    public function preview(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        return view('portfolios.preview', compact('portfolio'));
    }

    public function downloadHtml(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        $profileImageData = null;

        if (
            $portfolio->profile_picture &&
            Storage::disk('s3')->exists($portfolio->profile_picture)
        ) {
            $image = Storage::disk('s3')->get(
                $portfolio->profile_picture
            );

            $mime = Storage::disk('s3')->mimeType(
                $portfolio->profile_picture
            );

            if ($mime && str_starts_with($mime, 'image/')) {
                $profileImageData = 'data:' . $mime . ';base64,' .
                    base64_encode($image);
            }
        }

        $html = view('portfolios.download', [
            'portfolio' => $portfolio,
            'profileImageData' => $profileImageData,
        ])->render();

        if (trim($html) === '') {
            abort(500, 'The portfolio HTML output is empty.');
        }

        $filename = Str::slug(
            $portfolio->full_name ?: 'portfolio'
        ) . '-portfolio.html';

        return response()->streamDownload(
            function () use ($html) {
                echo $html;
            },
            $filename,
            [
                'Content-Type' => 'text/html; charset=UTF-8',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    private function authorizePortfolio(Portfolio $portfolio): void
    {
        abort_unless(
            Auth::check() &&
            (int) $portfolio->user_id === (int) Auth::id(),
            403,
            'You do not have permission to access this portfolio.'
        );
    }

    private function validatedData(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'full_name' => [
                'required',
                'string',
                'max:120',
                'regex:/^[\p{L}\p{M}][\p{L}\p{M}\s.\x{27}\x{2019}-]*$/u',
            ],
            'email' => ['required', 'email', 'max:190'],
            'contact_number' => [
                'required',
                'string',
                'max:40',
                'regex:/^(?=.*[0-9])[0-9+\s().-]+$/',
            ],
            'address' => ['required', 'string', 'max:255'],
            'about_me' => ['required', 'string', 'max:5000'],
            'profile_picture' => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:7168',
            ],
            'education_text' => ['required', 'string', 'max:5000'],
            'skills_text' => ['required', 'string', 'max:3000'],
            'projects_text' => ['required', 'string', 'max:6000'],
            'experience_text' => ['required', 'string', 'max:6000'],
            'links_text' => ['required', 'string', 'max:3000'],
        ]);

        $listFields = [
            'education_text',
            'skills_text',
            'projects_text',
            'experience_text',
            'links_text',
        ];

        $validator->after(function ($validator) use ($request, $listFields) {
            foreach ($listFields as $field) {
                $value = $request->input($field, '');

                if (!is_string($value)) {
                    continue;
                }

                $items = preg_split('/\r\n|\r|\n/', $value);
                $hasItem = collect($items)->contains(
                    fn ($item) => trim($item) !== ''
                );

                if (!$hasItem) {
                    $validator->errors()->add(
                        $field,
                        'Please provide at least one item.'
                    );
                }
            }
        });

        $data = $validator->validate();

        foreach ([
            'education_text' => 'education',
            'skills_text' => 'skills',
            'projects_text' => 'projects',
            'experience_text' => 'work_experience',
            'links_text' => 'links',
        ] as $input => $column) {
            $data[$column] = collect(
                preg_split('/\r\n|\r|\n/', $data[$input] ?? '')
            )
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values()
                ->all();

            unset($data[$input]);
        }

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('portfolio-profiles', 's3');
        } else {
            unset($data['profile_picture']);
        }

        return $data;
    }
}