<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        // Assign the portfolio to the currently logged-in user.
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
            Storage::disk('public')->delete($portfolio->profile_picture);
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
            Storage::disk('public')->delete($portfolio->profile_picture);
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
            Storage::disk('public')->exists($portfolio->profile_picture)
        ) {
            $image = Storage::disk('public')->get(
                $portfolio->profile_picture
            );

            $mime = Storage::disk('public')->mimeType(
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
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'contact_number' => ['nullable', 'string', 'max:40'],
            'address' => ['nullable', 'string', 'max:255'],
            'about_me' => ['nullable', 'string', 'max:5000'],
            'profile_picture' => ['nullable', 'image', 'max:4096'],
            'education_text' => ['nullable', 'string', 'max:5000'],
            'skills_text' => ['nullable', 'string', 'max:3000'],
            'projects_text' => ['nullable', 'string', 'max:6000'],
            'experience_text' => ['nullable', 'string', 'max:6000'],
            'links_text' => ['nullable', 'string', 'max:3000'],
        ]);

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
                ->store('portfolio-profiles', 'public');
        } else {
            unset($data['profile_picture']);
        }

        return $data;
    }
}
