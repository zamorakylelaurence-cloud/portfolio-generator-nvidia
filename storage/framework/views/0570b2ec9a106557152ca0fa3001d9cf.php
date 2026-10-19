<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>

    <!-- ==============================
         HERO SECTION
    ============================== -->
    <section class="hero">

        <!-- Hero Text -->
        <div>
            
            <h1>
                Make your Portfolio
                <br>
                <span style="color: var(--primary)">
                    with Style.
                </span>
            </h1>

            <p
                class="muted"
                style="font-size: 1.12rem; max-width: 570px;"
            >
                Create your professional portfolio for free in minutes.
                Add your details, There are three design templates to choose from,
                and preview your personal website in one place.
            </p>

            <!-- Action Buttons -->
            <div class="actions">

                <a
                    class="btn"
                    href="<?php echo e(route('portfolios.create')); ?>"
                >
                    Create portfolio →
                </a>

                <a
                    class="btn outline"
                    href="<?php echo e(route('portfolios.index')); ?>"
                >
                    Manage portfolios
                </a>

            </div>

          
        </div>

        <!-- Hero Information Panel -->
        <div class="hero-panel">

            <span
                class="pill"
                style="
                    background: #ffffff25;
                    color: white;
                    width: max-content;
                "
            >
                PORTFOLIO GENERATOR
            </span>

            <div>

                <div
                    style="
                        font-size: 2rem;
                        font-weight: 850;
                        line-height: 1.1;
                    "
                >
                    Good Luck,
                    <br>
                    You can do it.
                </div>

               

            </div>

            <!-- Portfolio Categories -->
            <div
                style="
                    display: flex;
                    gap: 8px;
                    flex-wrap: wrap;
                "
            >
                <span class="pill">Personal</span>
                <span class="pill">Projects</span>
                <span class="pill">Experience</span>
            </div>

        </div>

    </section>

    <!-- ==============================
         THREE-STEP FEATURE SECTION
    ============================== -->
    <div class="grid">

        <!-- Step 1: Add Information -->
        <div class="card">

            <div class="eyebrow">
                01 / Add
            </div>

            <h3>Enter your information</h3>

            <p class="muted">
                Personal details, education, skills,
                projects, work experience, and links.
            </p>

        </div>

        <!-- Step 2: Choose a Template -->
        <div class="card">

            <div class="eyebrow">
                02 / Design
            </div>

            <h3>Choose a template</h3>

            <p class="muted">
                Pick Simple, Modern, or Creative,
                each with a distinct visual identity.
            </p>

        </div>

        <!-- Step 3: Manage Portfolio -->
        <div class="card">

            <div class="eyebrow">
                03 / Publish
            </div>

            <h3>Preview and manage</h3>

            <p class="muted">
                Save your portfolio, revisit it,
                make changes, or remove it.
            </p>

        </div>

    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\KYLE\portfolio-generator-nvidia\portfolio-generator-nvidia\resources\views/home.blade.php ENDPATH**/ ?>