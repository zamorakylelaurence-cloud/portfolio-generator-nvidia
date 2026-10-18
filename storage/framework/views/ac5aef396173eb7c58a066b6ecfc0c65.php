<?php $__env->startSection('title', $editing ? 'Edit Portfolio' : 'Create Portfolio'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 850px; margin: auto">

        <div class="eyebrow">
            <?php echo e($editing ? 'Update your details' : 'Let’s get started'); ?>

        </div>

        <h1 style="font-size: 2.5rem">
            <?php echo e($editing ? 'Edit portfolio' : 'Create your portfolio'); ?>

        </h1>

        <p class="muted">
            Fill in what you can. Optional sections can be left blank.
            For list fields, enter one item per line.
        </p>

        <form
            class="card"
            method="POST"
            action="<?php echo e($editing
                ? route('portfolios.update', $portfolio)
                : route('portfolios.store')); ?>"
            enctype="multipart/form-data"
        >
            <?php echo csrf_field(); ?>

            <?php if($editing): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

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
                        value="<?php echo e(old('full_name', $portfolio->full_name)); ?>"
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
                        value="<?php echo e(old('email', $portfolio->email)); ?>"
                        placeholder="zamora@example.com"
                    >
                </div>

                <div class="field">
                    <label for="contact_number">Contact number</label>
                    <input
                        id="contact_number"
                        name="contact_number"
                        type="text"
                        value="<?php echo e(old('contact_number', $portfolio->contact_number)); ?>"
                        placeholder="+63 9XX XXX XXXX"
                    >
                </div>

                <div class="field">
                    <label for="address">Address</label>
                    <input
                        id="address"
                        name="address"
                        type="text"
                        value="<?php echo e(old('address', $portfolio->address)); ?>"
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

                <?php if($portfolio->profile_picture): ?>
                    <p class="muted">
                        Current image:
                        <a
                            href="<?php echo e(asset('storage/' . $portfolio->profile_picture)); ?>"
                            target="_blank"
                            rel="noopener"
                        >
                            View profile picture
                        </a>
                    </p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="about_me">About me</label>
                <textarea
                    id="about_me"
                    name="about_me"
                    maxlength="5000"
                    placeholder="Write a short introduction..."
                ><?php echo e(old('about_me', $portfolio->about_me)); ?></textarea>
            </div>

            <hr style="border: 0; border-top: 1px solid var(--line); margin: 25px 0">

            <h2>Background and work</h2>

            <div class="field">
                <label for="education_text">Educational background</label>
                <textarea
                    id="education_text"
                    name="education_text"
                    placeholder="One entry per line, e.g. BS Information Technology — ABC University (2022–2026)"
                ><?php echo e(old('education_text', implode("\n", $portfolio->education ?? []))); ?></textarea>
            </div>

            <div class="field">
                <label for="skills_text">Skills</label>
                <textarea
                    id="skills_text"
                    name="skills_text"
                    placeholder="HTML and CSS&#10;Laravel&#10;Database design"
                ><?php echo e(old('skills_text', implode("\n", $portfolio->skills ?? []))); ?></textarea>
            </div>

            <div class="field">
                <label for="projects_text">Projects</label>
                <textarea
                    id="projects_text"
                    name="projects_text"
                    placeholder="Project name — short description — URL (if any)"
                ><?php echo e(old('projects_text', implode("\n", $portfolio->projects ?? []))); ?></textarea>
            </div>

            <div class="field">
                <label for="experience_text">Work experience</label>
                <textarea
                    id="experience_text"
                    name="experience_text"
                    placeholder="Role — Company — dates — responsibilities"
                ><?php echo e(old('experience_text', implode("\n", $portfolio->work_experience ?? []))); ?></textarea>
            </div>

            <div class="field">
                <label for="links_text">Social media / website links</label>
                <textarea
                    id="links_text"
                    name="links_text"
                    placeholder="GitHub: https://github.com/username&#10;LinkedIn: https://linkedin.com/in/username"
                ><?php echo e(old('links_text', implode("\n", $portfolio->links ?? []))); ?></textarea>
            </div>

            <div class="actions">
                <button class="btn" type="submit">
                    <?php echo e($editing ? 'Save changes' : 'Save and choose template'); ?>

                </button>

                <a class="btn outline" href="<?php echo e(route('portfolios.index')); ?>">
                    Cancel
                </a>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\KYLE\portfolio-generator-nvidia\portfolio-generator-nvidia\resources\views/portfolios/form.blade.php ENDPATH**/ ?>