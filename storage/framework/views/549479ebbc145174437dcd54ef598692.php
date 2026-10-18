
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($portfolio->full_name); ?> - Portfolio</title>

    <style>
        :root {
            --green: #76b900;
            --green-light: #a8e04a;
            --bg: #101010;
            --panel: #1f1f1f;
            --text: #f5f5f5;
            --muted: #b8b8b8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font: 16px/1.7 Arial, Helvetica, sans-serif;
        }

        a {
            color: var(--green-light);
            overflow-wrap: anywhere;
        }

        .portfolio {
            max-width: 1100px;
            margin: 0 auto;
            padding: 36px 24px 64px;
        }

        .hero {
            display: flex;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
            padding: 42px 34px;
            border: 1px solid #405b19;
            border-left: 7px solid var(--green);
            border-radius: 24px;
            background:
                radial-gradient(circle at top right, #304416, transparent 48%),
                linear-gradient(135deg, #1f1f1f, #151515);
        }

        .avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid var(--green);
            border-radius: 24px;
        }

        .hero-content {
            flex: 1;
            min-width: 220px;
        }

        .eyebrow {
            margin: 0 0 18px;
            color: var(--green-light);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0 0 14px;
            color: var(--green-light);
            font-size: clamp(2.2rem, 7vw, 4.8rem);
            line-height: 1.08;
            overflow-wrap: anywhere;
        }

        .address,
        .contact {
            margin: 5px 0;
            color: var(--muted);
            overflow-wrap: anywhere;
        }

        .about {
            margin-top: 26px;
        }

        .sections {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-top: 26px;
        }

        .section {
            min-width: 0;
            padding: 26px;
            border: 1px solid #405b19;
            border-top: 3px solid var(--green);
            border-radius: 20px;
            background: linear-gradient(145deg, #1f1f1f, #151515);
            overflow-wrap: anywhere;
        }

        h2 {
            margin: 0 0 18px;
            color: var(--green-light);
            font-size: 1.4rem;
        }

        .section p {
            margin-bottom: 0;
            white-space: pre-line;
        }

        ul {
            margin: 0;
            padding-left: 22px;
        }

        li {
            margin: 7px 0;
        }

        .empty {
            color: var(--muted);
            font-style: italic;
        }

       
/* SIMPLE: dark, clean, professional portfolio */
.portfolio.simple {
    background: #101010;
    color: #f5f5f5;
}

.portfolio.simple .hero {
    display: flex;
    align-items: center;
    gap: 24px;
    padding: 32px;
    background: #171717;
    color: #f5f5f5;
    border: 1px solid #383838;
    border-left: 5px solid #76b900;
    border-radius: 8px;
}

.portfolio.simple .hero-content {
    margin-top: 0;
}

.portfolio.simple .avatar {
    width: 110px;
    height: 110px;
    border: 2px solid #76b900;
    border-radius: 8px;
}

.portfolio.simple h1 {
    color: #f5f5f5;
    font-size: clamp(2rem, 5vw, 3rem);
}

.portfolio.simple .eyebrow,
.portfolio.simple h2 {
    color: #76b900;
}

.portfolio.simple .address,
.portfolio.simple .contact {
    color: #b8b8b8;
}

.portfolio.simple .sections {
    grid-template-columns: 1fr;
}

.portfolio.simple .section {
    color: #f5f5f5;
    background: transparent;
    border: 0;
    border-bottom: 1px solid #383838;
    border-radius: 0;
    box-shadow: none;
    padding: 22px 8px;
}

.portfolio.simple h2 {
    padding-bottom: 8px;
    border-bottom: 1px solid #383838;
}

.portfolio.simple a {
    color: #a8e04a;
}


        /* MODERN: dark, polished, green-accented cards */
        .portfolio.modern .hero {
            box-shadow: 0 16px 40px #0006;
        }

        .portfolio.modern .section {
            box-shadow: 0 8px 26px #0005;
            border-radius: 18px;
        }

        .portfolio.modern .section:nth-child(3n + 1) {
            border-top-width: 5px;
        }

        .portfolio.modern .avatar {
            border-radius: 30px;
            box-shadow: 0 8px 22px #0006;
        }

        /* CREATIVE: oversized type, asymmetric shapes and layout */
        .portfolio.creative .hero {
            padding: 52px 38px;
            background: linear-gradient(120deg, #19220f, #101010 65%, #302018);
            border: 2px solid var(--green);
            border-left: 12px solid var(--green-light);
            border-radius: 42px 10px 42px 10px;
        }

        .portfolio.creative .hero h1 {
            font-size: clamp(2.5rem, 8vw, 5.5rem);
            letter-spacing: -0.06em;
            text-transform: lowercase;
        }

        .portfolio.creative .avatar {
            width: 170px;
            height: 190px;
            border-radius: 48% 18% 42% 18%;
            transform: rotate(-3deg);
        }

        .portfolio.creative .sections {
            gap: 24px;
        }

        .portfolio.creative .section {
            padding: 30px;
            background: #1b1b1b;
            border: 1px solid #566d2c;
            border-top: 5px solid var(--green-light);
            border-radius: 4px 24px 4px 24px;
        }

        .portfolio.creative .section:nth-child(odd) {
            transform: translateY(8px);
        }

        .portfolio.creative h2 {
            font-size: 1.55rem;
        }

        @media (max-width: 650px) {
            .portfolio {
                padding: 18px 14px 40px;
            }

            .hero {
                padding: 26px 20px;
            }

            .avatar {
                width: 110px;
                height: 110px;
            }

            .sections,
            .portfolio.creative .sections {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 20px;
            }

            .portfolio.creative .section:nth-child(odd) {
                transform: none;
            }
        }
    </style>
</head>

<body>
<?php
    $template = in_array(
        $portfolio->template,
        ['simple', 'modern', 'creative'],
        true
    ) ? $portfolio->template : 'simple';

    $education = is_array($portfolio->education)
        ? $portfolio->education : [];

    $skills = is_array($portfolio->skills)
        ? $portfolio->skills : [];

    $projects = is_array($portfolio->projects)
        ? $portfolio->projects : [];

    $experience = is_array($portfolio->work_experience)
        ? $portfolio->work_experience : [];

    $links = is_array($portfolio->links)
        ? $portfolio->links : [];
?>

<main class="portfolio <?php echo e($template); ?>">
    <header class="hero">
        <?php if($profileImageData): ?>
            <img
                class="avatar"
                src="<?php echo e($profileImageData); ?>"
                alt="Profile photo"
            >
        <?php endif; ?>

        <div class="hero-content">
            <p class="eyebrow">Personal Portfolio</p>
            <h1><?php echo e($portfolio->full_name); ?></h1>

            <?php if($portfolio->address): ?>
                <p class="address"><?php echo e($portfolio->address); ?></p>
            <?php endif; ?>

            <p class="contact">
                <?php echo e($portfolio->email); ?>

                <?php if($portfolio->contact_number): ?>
                    · <?php echo e($portfolio->contact_number); ?>

                <?php endif; ?>
            </p>
        </div>
    </header>

    <?php if($portfolio->about_me): ?>
        <section class="section about">
            <h2>About Me</h2>
            <p><?php echo e($portfolio->about_me); ?></p>
        </section>
    <?php endif; ?>

    <div class="sections">
        <?php if(count($education)): ?>
            <section class="section">
                <h2>Educational Background</h2>
                <ul>
                    <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if(count($skills)): ?>
            <section class="section">
                <h2>Skills</h2>
                <ul>
                    <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if(count($projects)): ?>
            <section class="section">
                <h2>Projects</h2>
                <ul>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if(count($experience)): ?>
            <section class="section">
                <h2>Work Experience</h2>
                <ul>
                    <?php $__currentLoopData = $experience; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if(count($links)): ?>
            <section class="section">
                <h2>Links</h2>
                <ul>
                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <?php if(filter_var($item, FILTER_VALIDATE_URL)): ?>
                                <a
                                    href="<?php echo e($item); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                ><?php echo e($item); ?></a>
                            <?php else: ?>
                                <?php echo e($item); ?>

                            <?php endif; ?>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </section>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
<?php /**PATH C:\Users\KYLE\portfolio-generator-nvidia\portfolio-generator-nvidia\resources\views/portfolios/download.blade.php ENDPATH**/ ?>