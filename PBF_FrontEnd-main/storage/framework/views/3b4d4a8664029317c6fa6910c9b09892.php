<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <!-- Import Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Sidebar width */
        .content-wrapper {
            margin-left: 250px; /* space for sidebar */
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center; /* vertical center */
            align-items: center;     /* horizontal center */
            padding: 20px;
            text-align: center;
            background: #f0f4ff; /* soft light blue background */
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #1e3a8a; /* dark blue */
            margin-bottom: 0.5rem;
            animation: fadeInDown 1s ease;
            text-shadow: 1px 1px 3px rgba(30, 58, 138, 0.4);
        }

        p {
            font-size: 1.5rem;
            color: #2563eb; /* bright blue */
            animation: fadeInUp 1s ease;
            font-weight: 600;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive for smaller screens */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
            }

            h1 {
                font-size: 2.5rem;
            }

            p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <?php echo $__env->make('sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="content-wrapper">
        <?php if(session()->has('username')): ?>
            <h1>Selamat datang, <?php echo e(session('username')); ?>!</h1>
            <p>Anda berhasil login sebagai <strong><?php echo e(session('role')); ?></strong>.</p>
        <?php else: ?>
            <p>Silakan login terlebih dahulu.</p>
        <?php endif; ?>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\PBF-SBTA-Kelompok3\PBF_FrontEnd-main\resources\views/home.blade.php ENDPATH**/ ?>