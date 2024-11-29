<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fast Finance Cars</title>
    <style>
               /* Add your custom styles here */
               body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: rgba(255, 0, 0, 0.8); /* Red with reduced opacity */
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: rgba(0, 0, 255, 0.8); /* Blue with reduced opacity */
            color: white;
            padding: 10px;
            text-align: center;
        }
        .button {
            background-color: rgba(255, 0, 0, 0.8); /* Red with reduced opacity */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fast Finance Cars</h1>
    </div>

    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <div class="footer">
        <p>© <?php echo e(date('Y')); ?> Fast Finance Cars. All rights reserved.</p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/vendor/mail/html/layout.blade.php ENDPATH**/ ?>