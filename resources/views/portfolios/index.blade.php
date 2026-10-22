@extends('layouts.app')

@section('title', 'Manage Portfolios')

@section('content')
    <style>
        .portfolio-card {
            position: relative;
        }

        .portfolio-menu {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 10;
        }

        .portfolio-menu summary {
            display: grid;
            width: 40px;
            height: 40px;
            place-items: center;
            border: 1px solid #484848;
            border-radius: 10px;
            background: #171717;
            color: #f5f5f5;
            cursor: pointer;
            font-size: 1.5rem;
            line-height: 1;
            list-style: none;
        }

        .portfolio-menu summary::-webkit-details-marker {
            display: none;
        }

        .portfolio-menu summary:hover,
        .portfolio-menu summary:focus-visible {
            border-color: #76b900;
            outline: none;
        }

        .portfolio-menu-panel {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 190px;
            padding: 6px;
            border: 1px solid #484848;
            border-radius: 12px;
            background: #242424;
            box-shadow: 0 12px 30px #0008;
        }

        .portfolio-menu-panel a,
        .portfolio-menu-panel button {
            display: block;
            width: 100%;
            padding: 10px 12px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #f5f5f5;
            cursor: pointer;
            font: inherit;
            text-align: left;
            text-decoration: none;
        }

        .portfolio-menu-panel a:hover,
        .portfolio-menu-panel button:hover,
        .portfolio-menu-panel a:focus-visible,
        .portfolio-menu-panel button:focus-visible {
            background: #353535;
            outline: none;
        }

        .portfolio-menu-panel .delete-action {
            color: #ff9a9a;
        }

        .portfolio-menu-panel .delete-action:hover,
        .portfolio-menu-panel .delete-action:focus-visible {
            background: #3a1919;
        }

        .portfolio-menu-panel form {
            margin: 0;
        }
    </style>

    <div
        style="display: flex; justify-content: space-between; align-items: end; gap: 16px; flex-wrap: wrap; margin-bottom: 22px"
    >
        <div>
            <div class="eyebrow">Your saved work</div>

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
        <div class="grid">
            @foreach ($portfolios as $portfolio)
                <article class="card portfolio-card">
                    <details class="portfolio-menu">
                        <summary aria-label="Portfolio actions" title="Portfolio actions">
                            <span aria-hidden="true">⋮</span>
                        </summary>

                        <div class="portfolio-menu-panel">
                            <a href="{{ route('portfolios.preview', $portfolio) }}">
                                View
                            </a>

                            <a href="{{ route('portfolios.edit', $portfolio) }}">
                                Edit
                            </a>

                            <a href="{{ route('portfolios.templates', $portfolio) }}">
                                Change template
                            </a>

                            <form
                                method="POST"
                                action="{{ route('portfolios.destroy', $portfolio) }}"
                                onsubmit="return confirm('Delete this portfolio permanently?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button class="delete-action" type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </details>

                    <div
                        style="display: flex; align-items: center; gap: 13px; margin-bottom: 16px; padding-right: 42px"
                    >
                        @if ($portfolio->profile_picture)
                            <img
                                class="profile-img"
                                style="width: 58px; height: 58px"
                                src="{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($portfolio->profile_picture) }}"
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

                    <p>
                        <span class="pill">
                            {{ ucfirst($portfolio->template) }} template
                        </span>
                    </p>

                    <p class="muted" style="font-size: 0.88rem">
                        Updated {{ $portfolio->updated_at->format('M j, Y') }}
                    </p>
                </article>
            @endforeach
        </div>
    @endif
@endsection