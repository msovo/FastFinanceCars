<!-- resources/views/auth/verify-email.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Verify Your Email Address</div>
            <div class="card-body">
                <?php if(session('message')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo e(session('message')); ?>

                    </div>
                <?php endif; ?>
                <p>Before proceeding, please check your email for a verification link.</p>
                <p>If you did not receive the email,</p>
                <form method="POST" action="<?php echo e(route('verification.resend')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary">Click here to request another</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/auth/verify-email.blade.php ENDPATH**/ ?>