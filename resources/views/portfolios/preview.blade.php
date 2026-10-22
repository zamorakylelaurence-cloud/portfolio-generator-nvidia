
@extends('layouts.app')

@section('title', $portfolio->full_name . ' · Preview')

@section('content')

    {{-- Preview toolbar --}}
    <div
        class="actions"
        style="justify-content: space-between; margin-bottom: 20px"
    >
        <div>
            <span class="pill">
                {{ ucfirst($portfolio->template) }} template
            </span>

            <span class="muted" style="margin-left: 8px">
                Portfolio preview
            </span>
        </div>

        <div class="actions">
            <a
                class="btn secondary"
                href="{{ route('portfolios.edit', $portfolio) }}"
            >
                Edit information
            </a>

            <a
                class="btn outline"
                href="{{ route('portfolios.templates', $portfolio) }}"
            >
                Change template
            </a>
            
<a
    class="btn"
    href="{{ route('portfolios.download', $portfolio) }}"
>
    Download HTML
</a>

           
        </div>
    </div>

    {{-- Portfolio section data --}}
    @php
        $items = [
            'Education' => $portfolio->education ?? [],
            'Skills' => $portfolio->skills ?? [],
            'Projects' => $portfolio->projects ?? [],
            'Work Experience' => $portfolio->work_experience ?? [],
            'Links' => $portfolio->links ?? [],
        ];
    @endphp

    {{-- Portfolio preview --}}
    <p>Current template: {{ $portfolio->template }}</p>
    <article class="portfolio {{ $portfolio->template }}">

        {{-- Portfolio header --}}
        <header class="portfolio-head">
            <div
                style="display: flex; gap: 24px; align-items: center; flex-wrap: wrap"
            >
                @if ($portfolio->profile_picture)
                    <img
                        class="profile-img"
                        src="{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($portfolio->profile_picture) }}"
                        alt="Profile picture of {{ $portfolio->full_name }}"
                    >
                @else
                    <div
                        class="profile-img"
                        style="display: grid; place-items: center; font-size: 3rem; font-weight: 850; color: var(--primary)"
                    >
                        {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                    </div>
                @endif

                <div style="flex: 1; min-width: 220px">
                    <div
                        class="eyebrow"
                        style="color: {{ $portfolio->template === 'creative' ? '#6c4a00' : 'var(--primary)' }}"
                    >
                        PERSONAL PORTFOLIO
                    </div>

                    <h1 style="margin: 8px 0 10px">
                        {{ $portfolio->full_name }}
                    </h1>

                    <p class="muted" style="margin: 0">
                        {{ $portfolio->address }}
                    </p>

                    <p style="margin: 7px 0 0">
                        {{ $portfolio->email }}

                        @if ($portfolio->contact_number)
                            · {{ $portfolio->contact_number }}
                        @endif
                    </p>
                </div>
            </div>
        </header>

        {{-- Portfolio content --}}
        <div class="portfolio-body">

            {{-- About me --}}
            @if ($portfolio->about_me)
                <section class="section-block">
                    <h2>About me</h2>

                    <p style="white-space: pre-line; margin-bottom: 0">
                        {{ $portfolio->about_me }}
                    </p>
                </section>
            @endif

            {{-- Education, skills, projects, experience, and links --}}
            @foreach ($items as $heading => $entries)
                @if (count($entries))
                    <section class="section-block">
                        <h2>{{ $heading }}</h2>

                        @if ($heading === 'Skills')
                            <div
                                style="display: flex; gap: 8px; flex-wrap: wrap"
                            >
                                @foreach ($entries as $entry)
                                    <span class="pill">
                                        {{ $entry }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <ul class="item-list">
                                @foreach ($entries as $entry)
                                    <li>
                                        @if (
                                            $heading === 'Links'
                                            && preg_match('/https?:\/\/\S+/i', $entry, $match)
                                        )
                                            @php
                                                $url = rtrim($match[0], '.,)');
                                            @endphp

                                            {{ trim(str_replace($match[0], '', $entry)) }}

                                            <a
                                                href="{{ $url }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                style="color: var(--primary); text-decoration: underline"
                                            >
                                                {{ $url }}
                                            </a>
                                        @else
                                            {{ $entry }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </section>
                @endif
            @endforeach

            {{-- Contact information --}}
            <section class="section-block">
                <h2>Get in touch</h2>

                <p style="margin: 0">
                    <a
                        href="mailto:{{ $portfolio->email }}"
                        style="color: var(--primary); text-decoration: underline"
                    >
                        {{ $portfolio->email }}
                    </a>
                </p>
            </section>

        </div>
    </article>

    {{-- Bottom navigation --}}
    <div
        class="actions"
        style="justify-content: center; margin-top: 22px"
    >
        <a
            class="btn outline"
            href="{{ route('portfolios.index') }}"
        >
            ← Manage portfolios
        </a>

        <a
            class="btn"
            href="{{ route('portfolios.create') }}"
        >
            Create another portfolio
        </a>
    </div>

   

@endsection

