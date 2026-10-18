<?php $__env->startSection('title', $portfolio->full_name . ' · Preview'); ?>

<?php $__env->startSection('content'); ?>

    
    <div
        class="actions"
        style="justify-content: space-between; margin-bottom: 20px"
    >
        <div>
            <span class="pill">
                <?php echo e(ucfirst($portfolio->template)); ?> template
            </span>

            <span class="muted" style="margin-left: 8px">
                Portfolio preview
            </span>
        </div>

        <div class="actions">
            <a
                class="btn secondary"
                href="<?php echo e(route('portfolios.edit', $portfolio)); ?>"
            >
                Edit information
            </a>

            <a
                class="btn outline"
                href="<?php echo e(route('portfolios.templates', $portfolio)); ?>"
            >
                Change template
            </a>
            
<a
    class="btn"
    href="<?php echo e(route('portfolios.download', $portfolio)); ?>"
>
    Download HTML
</a>

           
        </div>
    </div>

    
    <?php
        $items = [
            'Education' => $portfolio->education ?? [],
            'Skills' => $portfolio->skills ?? [],
            'Projects' => $portfolio->projects ?? [],
            'Work Experience' => $portfolio->work_experience ?? [],
            'Links' => $portfolio->links ?? [],
        ];
    ?>

    
    <p>Current template: <?php echo e($portfolio->template); ?></p>
    <article class="portfolio <?php echo e($portfolio->template); ?>">

        
        <header class="portfolio-head">
            <div
                style="display: flex; gap: 24px; align-items: center; flex-wrap: wrap"
            >
                <?php if($portfolio->profile_picture): ?>
                    <img
                        class="profile-img"
                        src="<?php echo e(asset('storage/' . $portfolio->profile_picture)); ?>"
                        alt="Profile picture of <?php echo e($portfolio->full_name); ?>"
                    >
                <?php else: ?>
                    <div
                        class="profile-img"
                        style="display: grid; place-items: center; font-size: 3rem; font-weight: 850; color: var(--primary)"
                    >
                        <?php echo e(strtoupper(substr($portfolio->full_name, 0, 1))); ?>

                    </div>
                <?php endif; ?>

                <div style="flex: 1; min-width: 220px">
                    <div
                        class="eyebrow"
                        style="color: <?php echo e($portfolio->template === 'creative' ? '#6c4a00' : 'var(--primary)'); ?>"
                    >
                        PERSONAL PORTFOLIO
                    </div>

                    <h1 style="margin: 8px 0 10px">
                        <?php echo e($portfolio->full_name); ?>

                    </h1>

                    <p class="muted" style="margin: 0">
                        <?php echo e($portfolio->address); ?>

                    </p>

                    <p style="margin: 7px 0 0">
                        <?php echo e($portfolio->email); ?>


                        <?php if($portfolio->contact_number): ?>
                            · <?php echo e($portfolio->contact_number); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </header>

        
        <div class="portfolio-body">

            
            <?php if($portfolio->about_me): ?>
                <section class="section-block">
                    <h2>About me</h2>

                    <p style="white-space: pre-line; margin-bottom: 0">
                        <?php echo e($portfolio->about_me); ?>

                    </p>
                </section>
            <?php endif; ?>

            
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $heading => $entries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($entries)): ?>
                    <section class="section-block">
                        <h2><?php echo e($heading); ?></h2>

                        <?php if($heading === 'Skills'): ?>
                            <div
                                style="display: flex; gap: 8px; flex-wrap: wrap"
                            >
                                <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="pill">
                                        <?php echo e($entry); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <ul class="item-list">
                                <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <?php if(
                                            $heading === 'Links'
                                            && preg_match('/https?:\/\/\S+/i', $entry, $match)
                                        ): ?>
                                            <?php
                                                $url = rtrim($match[0], '.,)');
                                            ?>

                                            <?php echo e(trim(str_replace($match[0], '', $entry))); ?>


                                            <a
                                                href="<?php echo e($url); ?>"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                style="color: var(--primary); text-decoration: underline"
                                            >
                                                <?php echo e($url); ?>

                                            </a>
                                        <?php else: ?>
                                            <?php echo e($entry); ?>

                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <section class="section-block">
                <h2>Get in touch</h2>

                <p style="margin: 0">
                    <a
                        href="mailto:<?php echo e($portfolio->email); ?>"
                        style="color: var(--primary); text-decoration: underline"
                    >
                        <?php echo e($portfolio->email); ?>

                    </a>
                </p>
            </section>

        </div>
    </article>

    
    <div
        class="actions"
        style="justify-content: center; margin-top: 22px"
    >
        <a
            class="btn outline"
            href="<?php echo e(route('portfolios.index')); ?>"
        >
            ← Manage portfolios
        </a>

        <a
            class="btn"
            href="<?php echo e(route('portfolios.templates', $portfolio)); ?>"
        >
            Generate with another template
        </a>
    </div>

   

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\KYLE\portfolio-generator-nvidia\portfolio-generator-nvidia\resources\views/portfolios/preview.blade.php ENDPATH**/ ?>