

<?php $__env->startSection('content'); ?>
    <h1>News Management</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('dealer.store.news')); ?>" method="POST" enctype="multipart/form-data"> 
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category" required>
                <option value="">Select
 Category</option> 
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->category_name); ?>">
                        <?php echo e($category->category_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="thumbnail_url">Thumbnail</label> 
            <input type="file" class="form-control-file" id="thumbnail_url" name="thumbnail_url" required>
        </div>
       
        <button type="submit" class="btn btn-primary">Add News</button>
    </form>

    <h2>Existing News</h2>
    <table id="news-table" class="table table-bordered table-striped"> 
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($newsItem->title); ?></td>
                    <td>
                        <a href="<?php echo e(route('dealer.news.edit', $newsItem->news_id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('dealer.news.destroy', $newsItem->news_id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="button" class="btn btn-danger btn-sm delete-news">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#news-table').DataTable();

            $(document).on('click', '.delete-news', function(e) {
                e.preventDefault();
                if (confirm("Are you sure you want to delete this news item?")) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/news_management.blade.php ENDPATH**/ ?>