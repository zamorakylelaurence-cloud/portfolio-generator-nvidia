
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
            Fill in what you can. Optional sections can be left blank.
            For list fields, enter one item per line.
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
                        value="{{ old('full_name', $portfolio->full_name) }}"
                        placeholder="e.g. Zamora Gwapo"
                    >
                </div>

                <div class="field">
                    <label for="email">Email *</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        required
                        value="{{ old('email', $portfolio->email) }}"
                        placeholder="zamora@example.com"
                    >
                </div>

                <div class="field">
                    <label for="contact_number">Contact number</label>
                    <input
                        id="contact_number"
                        name="contact_number"
                        type="text"
                        value="{{ old('contact_number', $portfolio->contact_number) }}"
                        placeholder="+63 9XX XXX XXXX"
                    >
                </div>

                <div class="field">
                    <label for="address">Address</label>
                    <input
                        id="address"
                        name="address"
                        type="text"
                        value="{{ old('address', $portfolio->address) }}"
                        placeholder="Langtad, Naga City, Cebu"
                    >
                </div>

            </div>

            <div class="field">
                <label for="profile_picture">Profile picture</label>
                <input
                    id="profile_picture"
                    type="file"
                    name="profile_picture"
                    accept="image/*"
                >

                <small>
                    Maximum 4 MB. Use a JPG, PNG, or WebP image.
                </small>

                @if ($portfolio->profile_picture)
                    <p class="muted">
                        Current image:
                        <a
                            href="{{ asset('storage/' . $portfolio->profile_picture) }}"
                            target="_blank"
                            rel="noopener"
                        >
                            View profile picture
                        </a>
                    </p>
                @endif
            </div>

            <div class="field">
                <label for="about_me">About me</label>
                <textarea
                    id="about_me"
                    name="about_me"
                    maxlength="5000"
                    placeholder="Write a short introduction..."
                >{{ old('about_me', $portfolio->about_me) }}</textarea>
            </div>

            <hr style="border: 0; border-top: 1px solid var(--line); margin: 25px 0">

            <h2>Background and work</h2>

            <div class="field">
                <label for="education_text">Educational background</label>
                <textarea
                    id="education_text"
                    name="education_text"
                    placeholder="One entry per line, e.g. BS Information Technology — ABC University (2022–2026)"
                >{{ old('education_text', implode("\n", $portfolio->education ?? [])) }}</textarea>
            </div>

            <div class="field">
                <label for="skills_text">Skills</label>
                <textarea
                    id="skills_text"
                    name="skills_text"
                    placeholder="HTML and CSS&#10;Laravel&#10;Database design"
                >{{ old('skills_text', implode("\n", $portfolio->skills ?? [])) }}</textarea>
            </div>

            <div class="field">
                <label for="projects_text">Projects</label>
                <textarea
                    id="projects_text"
                    name="projects_text"
                    placeholder="Project name — short description — URL (if any)"
                >{{ old('projects_text', implode("\n", $portfolio->projects ?? [])) }}</textarea>
            </div>

            <div class="field">
                <label for="experience_text">Work experience</label>
                <textarea
                    id="experience_text"
                    name="experience_text"
                    placeholder="Role — Company — dates — responsibilities"
                >{{ old('experience_text', implode("\n", $portfolio->work_experience ?? [])) }}</textarea>
            </div>

            <div class="field">
                <label for="links_text">Social media / website links</label>
                <textarea
                    id="links_text"
                    name="links_text"
                    placeholder="GitHub: https://github.com/username&#10;LinkedIn: https://linkedin.com/in/username"
                >{{ old('links_text', implode("\n", $portfolio->links ?? [])) }}</textarea>
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

