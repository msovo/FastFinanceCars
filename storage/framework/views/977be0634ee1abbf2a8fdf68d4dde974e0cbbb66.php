

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit News: <?php echo e($newsItem->title); ?></h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="row"> 
            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-header">
                        Edit News Details
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('dealer.news.update', $newsItem->news_id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?php echo e($newsItem->title); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" required><?php echo e($newsItem->content); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->category_name); ?>" <?php echo e($newsItem->category == $category->category_name ? 'selected' : ''); ?>>
                                            <?php echo e($category->category_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail_url">Thumbnail</label>
                                <input type="file" class="form-control-file" id="thumbnail_url" name="thumbnail_url">
                            </div>

                            <button type="submit" class="btn btn-primary">Update News</button>
                        </form>
                    </div>
                </div>
            </div> 

            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-header">
                        Add Poll
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('dealer.news.poll.add', $newsItem->news_id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" id="question" name="question" required>
                            </div>
                            <div class="form-group">
                                <label for="options">Options (one per line)</label>
                                <textarea class="form-control" id="options" name="options" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Poll</button>
                        </form>
                    </div>
                </div>
            </div> 
        </div> 

        <div class="row mt-4"> 
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add Comment
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('dealer.news.comment.add', $newsItem->news_id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="content">Comment</label>
                                <textarea class="form-control" id="content" name="content" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add Images
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('dealer.news.images.add', $newsItem->news_id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="images">Select Images</label>
                                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Images</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Existing Comments
                    </div>
                    <div class="card-body">
                        <?php if($newsItem->comments->isNotEmpty()): ?>
                            <ul class="list-group">
                                <?php $__currentLoopData = $newsItem->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item"><?php echo e($comment->user->username); ?> : <?php echo e($comment->content); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p>No comments added yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4"> 
            <div class="card-header">
                Existing Images
            </div>
            <div class="card-body">
                <?php if($newsItem->images->isNotEmpty()): ?>
                    <div class="row">
                        <?php $__currentLoopData = $newsItem->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3">
                                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" alt="News Image" class="img-thumbnail">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p>No images added yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/edit_news.blade.php ENDPATH**/ ?>