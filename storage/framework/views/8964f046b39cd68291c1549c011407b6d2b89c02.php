<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body text-center">
                        <h5>Welcome, <?php echo e(Auth::user()->username); ?></h5>
                        <?php if(Auth::user()->profile_image): ?>
                            <img src="<?php echo e(asset('storage/' . Auth::user()->profile_image)); ?>" class="img-thumbnail" alt="Profile Image" width="150">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Profile Image">
                        <?php endif; ?>
                        <a href="<?php echo e(route('user.profile', Auth::user()->user_id)); ?>" class="btn btn-primary mt-3">View Profile</a>
                        <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger mt-3"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dashboard.blade.php ENDPATH**/ ?>