
@extends('layouts.app')

@section('title', 'Manage Portfolios')

@section('content')

    {{-- Page heading and create button --}}
    <div
        style="display: flex; justify-content: space-between; align-items: end; gap: 16px; flex-wrap: wrap; margin-bottom: 22px"
    >
        <div>
            <div class="eyebrow">
                Your saved work
            </div>

            <h1 style="font-size: 2.6rem; margin-bottom: 8px">
                Manage portfolios
            </h1>

            <p class="muted" style="margin: 0">
                Your portfolios stay saved in the configured database.
            </p>
        </div>

        <a class="btn" href="{{ route('portfolios.create') }}">
            + New portfolio
        </a>
    </div>

    {{-- Empty state --}}
    @if ($portfolios->isEmpty())
        <div class="card" style="text-align: center; padding: 50px 22px">
            <h2>No portfolios yet</h2>

            <p class="muted">
                Create your first portfolio to get started.
            </p>

            <a class="btn" href="{{ route('portfolios.create') }}">
                Create portfolio
            </a>
        </div>
    @else

        {{-- Portfolio cards --}}
        <div class="grid">

            @foreach ($portfolios as $portfolio)
                <article class="card">

                    {{-- Profile picture and basic information --}}
                    <div
                        style="display: flex; align-items: center; gap: 13px; margin-bottom: 16px"
                    >
                        @if ($portfolio->profile_picture)
                            <img
                                class="profile-img"
                                style="width: 58px; height: 58px"
                                src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                                alt="Profile picture"
                            >
                        @else
                            <div
                                style="width: 58px; height: 58px; border-radius: 50%; background: #eeecff; display: grid; place-items: center; color: var(--primary); font-weight: 850; font-size: 1.2rem"
                            >
                                {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                            </div>
                        @endif

                        <div>
                            <h3 style="margin: 0">
                                {{ $portfolio->full_name }}
                            </h3>

                            <div class="muted" style="font-size: 0.86rem">
                                {{ $portfolio->email }}
                            </div>
                        </div>
                    </div>

                    {{-- Template information --}}
                    <p>
                        <span class="pill">
                            {{ ucfirst($portfolio->template) }} template
                        </span>
                    </p>

                    <p class="muted" style="font-size: 0.88rem">
                        Updated {{ $portfolio->updated_at->format('M j, Y') }}
                    </p>

                    {{-- Portfolio actions --}}
                    <div class="actions">
                        <a
                            class="btn small"
                            href="{{ route('portfolios.preview', $portfolio) }}"
                        >
                            View
                        </a>

                        <a
                            class="btn secondary small"
                            href="{{ route('portfolios.edit', $portfolio) }}"
                        >
                            Edit
                        </a>

                        <a
                            class="btn outline small"
                            href="{{ route('portfolios.templates', $portfolio) }}"
                        >
                            Change template
                        </a>
                    </div>

                    {{-- Delete portfolio --}}
                    <form
                        method="POST"
                        action="{{ route('portfolios.destroy', $portfolio) }}"
                        style="margin-top: 12px"
                        onsubmit="return confirm('Delete this portfolio permanently?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button class="btn danger small" type="submit">
                            Delete
                        </button>
                    </form>

                </article>
            @endforeach

        </div>

    @endif

@endsection

