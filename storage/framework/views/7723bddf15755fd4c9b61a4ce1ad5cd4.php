


<?php $__env->startSection('title', 'Log In'); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-page">
    <div class="auth-card">
        <p class="auth-eyebrow">MYPORTFOLIO</p>
        <h1>Welcome back</h1>
        <p class="auth-description">Log in to manage your portfolios.</p>

        <?php if($errors->any()): ?>
            <div class="auth-errors">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        
<form method="POST" action="<?php echo e(route('login.store')); ?>">
    <?php echo csrf_field(); ?>

    <label for="email">Email address</label>
    <input
        id="email"
        name="email"
        type="email"
        value="<?php echo e(old('email')); ?>"
        autocomplete="email"
        required
    >

    <label for="password">Password</label>
    <input
        id="password"
        name="password"
        type="password"
        autocomplete="current-password"
        required
    >

    <label>
        <input type="checkbox" name="remember" value="1">
        Remember me
    </label>

    <?php if($errors->any()): ?>
        <div class="auth-errors">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <button type="submit" class="auth-button">Log In</button>
</form>

<p class="auth-switch">
    Don't have an account?
    <a href="<?php echo e(route('register')); ?>">Sign up</a>
</p>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\KYLE\portfolio-generator-nvidia\portfolio-generator-nvidia\resources\views/auth/login.blade.php ENDPATH**/ ?>