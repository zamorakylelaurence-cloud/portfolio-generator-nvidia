@extends('layouts.app')

@section('title', $editing ? 'Edit Portfolio' : 'Create Portfolio')

@section('content')
    <div style="max-width: 850px; margin: auto">

        <div class="eyebrow">
            {{ $editing ? 'Update your details' : 'Let’s get started' }}
        </div>

        <h1 style="font-size: 2.5rem">
            {{ $editing ? 'Edit portfolio' : 'Create your portfolio' }}
        </h1>

        <p class="muted">
            Fill in all fields. For list fields, enter at least one item,
            one item per line.
        </p>

        <form
            class="card"
            method="POST"
            action="{{ $editing
                ? route('portfolios.update', $portfolio)
                : route('portfolios.store') }}"
            enctype="multipart/form-data"
        >
            @csrf

            @if ($editing)
                @method('PUT')
            @endif

            <h2>Personal information</h2>

            <div class="two-col">

                <div class="field">
                    <label for="full_name">Full name *</label>
                    <input
                        id="full_name"
                        name="full_name"
                        type="text"
                        required
                        maxlength="120"
                        pattern="[^\d]*"
                        oninput="this.value = this.value.replace(/\p{N}/gu, '')"
                        title="Use letters and name punctuation only; numbers are not allowed."
                        value="{{ old('full_name', $portfolio->full_name) }}"
                        placeholder="e.g. Zamora Gwapo"
                    >
                    @error('full_name')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="email">Email *</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        required
                        maxlength="190"
                        value="{{ old('email', $portfolio->email) }}"
                        placeholder="zamora@example.com"
                    >
                    @error('email')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="contact_number">Contact number *</label>
                    <input
                        id="contact_number"
                        name="contact_number"
                        type="tel"
                        inputmode="tel"
                        required
                        maxlength="40"
                        pattern="(?=.*[0-9])[0-9+\s().-]+"
                        oninput="this.value = this.value.replace(/[^0-9+\s().-]/g, '')"
                        value="{{ old('contact_number', $portfolio->contact_number) }}"
                        placeholder="+63 9XX XXX XXXX"
>
                    @error('contact_number')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field">
                    <label for="address">Address *</label>
                    <input
                        id="address"
                        name="address"
                        type="text"
                        required
                        maxlength="255"
                        value="{{ old('address', $portfolio->address) }}"
                        placeholder="Langtad, Naga City, Cebu"
                    >
                    @error('address')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="field">
                <label for="profile_picture">
                    Profile picture {{ $editing ? '' : '*' }}
                </label>
                <input
                    id="profile_picture"
                    type="file"
                    name="profile_picture"
                    accept=".jpg,.jpeg,.png,.webp"
                    {{ !$editing ? 'required' : '' }}
                >

                <small>Maximum 7 MB. Use a JPG, PNG, or WebP image.</small>

                @error('profile_picture')
                    <small class="error">{{ $message }}</small>
                @enderror

                @if ($portfolio->profile_picture)
                    <p class="muted">
                        Current image:
                        <a
                            href="{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($portfolio->profile_picture) }}"
                            target="_blank"
                            rel="noopener"
                    >
                            View profile picture
                        </a>
                    </p>
                @endif
            </div>

            <div class="field">
                <label for="about_me">About me *</label>
                <textarea
                    id="about_me"
                    name="about_me"
                    required
                    maxlength="5000"
                    placeholder="Write a short introduction..."
                >{{ old('about_me', $portfolio->about_me) }}</textarea>
                @error('about_me')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <hr style="border: 0; border-top: 1px solid var(--line); margin: 25px 0">

            <h2>Background and work</h2>

            <div class="field">
                <label for="education_text">Educational background *</label>
                <textarea
                    id="education_text"
                    name="education_text"
                    required
                    placeholder="One entry per line, e.g. BS Information Technology — ABC University (2022–2026)"
                >{{ old('education_text', implode("\n", $portfolio->education ?? [])) }}</textarea>
                @error('education_text')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="field">
                <label for="skills_text">Skills *</label>
                <textarea
                    id="skills_text"
                    name="skills_text"
                    required
                    placeholder="HTML and CSS&#10;Laravel&#10;Database design"
                >{{ old('skills_text', implode("\n", $portfolio->skills ?? [])) }}</textarea>
                @error('skills_text')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="field">
                <label for="projects_text">Projects *</label>
                <textarea
                    id="projects_text"
                    name="projects_text"
                    required
                    placeholder="Project name — short description — URL (if any)"
                >{{ old('projects_text', implode("\n", $portfolio->projects ?? [])) }}</textarea>
                @error('projects_text')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="field">
                <label for="experience_text">Work experience *</label>
                <textarea
                    id="experience_text"
                    name="experience_text"
                    required
                    placeholder="Role — Company — dates — responsibilities"
                >{{ old('experience_text', implode("\n", $portfolio->work_experience ?? [])) }}</textarea>
                @error('experience_text')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="field">
                <label for="links_text">Social media / website links *</label>
                <textarea
                    id="links_text"
                    name="links_text"
                    required
                    placeholder="GitHub: https://github.com/username&#10;LinkedIn: https://linkedin.com/in/username"
                >{{ old('links_text', implode("\n", $portfolio->links ?? [])) }}</textarea>
                @error('links_text')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="actions">
                <button class="btn" type="submit">
                    {{ $editing ? 'Save changes' : 'Save and choose template' }}
                </button>

                <a class="btn outline" href="{{ route('portfolios.index') }}">
                    Cancel
                </a>
            </div>

        </form>
    </div>
@endsection
