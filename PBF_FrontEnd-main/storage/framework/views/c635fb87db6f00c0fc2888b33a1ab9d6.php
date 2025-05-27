<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if($errors->any()): ?>
        <div style="color:red;">
            <?php echo e($errors->first()); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(url('/login')); ?>">
        <?php echo csrf_field(); ?>
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\PBF-SBTA-Kelompok3\PBF_FrontEnd-main\resources\views/login.blade.php ENDPATH**/ ?>