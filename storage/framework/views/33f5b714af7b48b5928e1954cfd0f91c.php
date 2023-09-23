<?php $__env->startSection('content'); ?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th>last name</th>
            <th>phone number</th>
            <th scope="col">email</th>
            <th>image url</th>
            <th>settings</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->last_name); ?></td>
                <td><?php echo e($user->phone); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td>
                    <?php if(isset($user->image->url)): ?>
                        <?php echo e($user->image->url); ?>

                    <?php else: ?>
                        <?php echo 'no image'; ?>

                    <?php endif; ?>

                </td>
                <td>
                    <div class="btn-group">
                        <a href="<?php echo e(route('admin.user.show',$user->id)); ?>" class="btn btn-primary">show</a>
                        <a href="<?php echo e(route('admin.user.edit',$user->id)); ?>" class="btn btn-info mr-1">Edit</a>
                        <form action="<?php echo e(route('admin.user.destroy',$user->id)); ?>" method="post">
                            <?php echo method_field('DELETE'); ?>
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>


                </td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>
    <?php echo e($items->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\exer_branch4_message\resources\views/admin/user/index.blade.php ENDPATH**/ ?>