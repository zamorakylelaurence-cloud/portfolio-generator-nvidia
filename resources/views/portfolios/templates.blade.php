
@extends('layouts.app')

@section('title', 'Choose Template')

@section('content')
    <div style="max-width: 1000px; margin: auto">

        <div class="eyebrow">
            Make it yours
        </div>

        <h1 style="font-size: 2.7rem">
            Choose your template
        </h1>

        <p class="muted">
            Select one of the three designs. You can switch templates
            later without losing your information.
            Select one the designs below, then click "Use this template" to continue.
        </p>

        <form
            method="POST"
            action="{{ route('portfolios.template', $portfolio) }}"
        >
            @csrf

            <div class="grid" style="margin: 26px 0">

                {{-- Simple Template --}}
                <label class="template-card">
                    <input
                        type="radio"
                        name="template"
                        value="simple"
                        {{ $portfolio->template === 'simple' ? 'checked' : '' }}
                    >

                    <strong>Simple</strong>

                    <p class="muted">
                        Clean, calm, professional.
                    </p>

                    <div class="mock simple">
                        <div style="font-weight: 850; font-size: 1.2rem">
                            Your Name
                        </div>

                        <div style="font-size: 0.8rem">
                            About · Skills · Projects
                        </div>

                        <hr>

                        <div
                            style="width: 80%; height: 7px; background: #d9deea; border-radius: 4px"
                        ></div>

                        <div
                            style="width: 60%; height: 7px; background: #d9deea; border-radius: 4px; margin-top: 8px"
                        ></div>
                    </div>

                    <small>
                        Minimal typography and clear sections
                    </small>
                </label>

                {{-- Modern Template --}}
                <label class="template-card">
                    <input
                        type="radio"
                        name="template"
                        value="modern"
                        {{ $portfolio->template === 'modern' ? 'checked' : '' }}
                    >

                    <strong>Modern</strong>

                    <p class="muted">
                        Polished, card-based, bold.
                    </p>

                    <div class="mock modern">
                        <div style="font-weight: 850; font-size: 1.2rem">
                            Your Name
                        </div>

                        <div style="font-size: 0.8rem">
                            Developer / Designer
                        </div>

                        <div style="display: flex; gap: 5px; margin-top: 13px">
                            <div
                                style="height: 28px; flex: 1; background: #ffffff24; border-radius: 5px"
                            ></div>

                            <div
                                style="height: 28px; flex: 1; background: #ffffff24; border-radius: 5px"
                            ></div>
                        </div>
                    </div>

                    <small>
                        Dark colors, cards, visual hierarchy
                    </small>
                </label>

                {{-- Creative Template --}}
                <label class="template-card">
                    <input
                        type="radio"
                        name="template"
                        value="creative"
                        {{ $portfolio->template === 'creative' ? 'checked' : '' }}
                    >

                    <strong>Creative</strong>

                    <p class="muted">
                        Expressive, energetic, distinct.
                    </p>

                    <div class="mock creative">
                        <div style="font-weight: 950; font-size: 1.35rem; line-height: 1">
                            YOUR<br>
                            NAME!
                        </div>

                        <div style="font-size: 0.8rem; margin-top: 6px">
                            Selected work ↗
                        </div>
                    </div>

                    <small>
                        Bold headline and warm accent colors
                    </small>
                </label>

            </div>

            <div class="actions">
                <button class="btn" type="submit">
                    Use this template →
                </button>

                <a
                    class="btn outline"
                    href="{{ route('portfolios.preview', $portfolio) }}"
                >
                    Preview current
                </a>

                <a
                    class="btn outline"
                    href="{{ route('portfolios.edit', $portfolio) }}"
                >
                    Edit details
                </a>
            </div>

        </form>
    </div>
@endsection

