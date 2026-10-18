<?php $__env->startSection('title', 'Manage Portfolios'); ?>

<?php $__env->startSection('content'); ?>

    
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

        <a class="btn" href="<?php echo e(route('portfolios.create')); ?>">
            + New portfolio
        </a>
    </div>

    
    <?php if($portfolios->isEmpty()): ?>
        <div class="card" style="text-align: center; padding: 50px 22px">
            <h2>No portfolios yet</h2>

            <p class="muted">
                Create your first portfolio to get started.
            </p>

            <a class="btn" href="<?php echo e(route('portfolios.create')); ?>">
                Create portfolio
            </a>
        </div>
    <?php else: ?>

        
        <div class="grid">

            <?php $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="card">

                    
                    <div
                        style="display: flex; align-items: center; gap: 13px; margin-bottom: 16px"
                    >
                        <?php if($portfolio->profile_picture): ?>
                            <img
                                class="profile-img"
                                style="width: 58px; height: 58px"
                                src="<?php echo e(asset('storage/' . $portfolio->profile_picture)); ?>"
                                alt="Profile picture"
                            >
                        <?php else: ?>
                            <div
                                style="width: 58px; height: 58px; border-radius: 50%; background: #eeecff; display: grid; place-items: center; color: var(--primary); font-weight: 850; font-size: 1.2rem"
                            >
                                <?php echo e(strtoupper(substr($portfolio->full_name, 0, 1))); ?>

                            </div>
                        <?php endif; ?>

                        <div>
                            <h3 style="margin: 0">
                                <?php echo e($portfolio->full_name); ?>

                            </h3>

                            <div class="muted" style="font-size: 0.86rem">
                                <?php echo e($portfolio->email); ?>

                            </div>
                        </div>
                    </div>

                    
                    <p>
                        <span class="pill">
                            <?php echo e(ucfirst($portfolio->template)); ?> template
                        </span>
                    </p>

                    <p class="muted" style="font-size: 0.88rem">
                        Updated <?php echo e($portfolio->updated_at->format('M j, Y')); ?>

                    </p>

                    
                    <div class="actions">
                        <a
                            class="btn small"
                            href="<?php echo e(route('portfolios.preview', $portfolio)); ?>"
                        >
                            View
                        </a>

                        <a
                            class="btn secondary small"
                            href="<?php echo e(route('portfolios.edit', $portfolio)); ?>"
                        >
                            Edit
                        </a>

                        <a
                            class="btn outline small"
                            href="<?php echo e(route('portfolios.templates', $portfolio)); ?>"
                        >
                            Change template
                        </a>
                    </div>

                    
                    <form
                        method="POST"
                        action="<?php echo e(route('portfolios.destroy', $portfolio)); ?>"
                        style="margin-top: 12px"
                        onsubmit="return confirm('Delete this portfolio permanently?')"
                    >
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button class="btn danger small" type="submit">
                            Delete
                        </button>
                    </form>

                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    <?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\KYLE\portfolio-generator-nvidia\portfolio-generator-nvidia\resources\views/portfolios/index.blade.php ENDPATH**/ ?>