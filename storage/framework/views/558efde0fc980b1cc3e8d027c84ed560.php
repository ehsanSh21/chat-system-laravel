<?php $__env->startSection('content'); ?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th>created at</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo e($user->id); ?></td>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo e($user->email); ?></td>
            <td><?php echo e($user->created_at); ?> </td>
        </tr>


        </tbody>
    </table>



    <h3 class="display-4 text-danger">PRODUCTS</h3>
    <table class="table">
        <thead>
        <tr>

            <th>product id</th>
            <th>write</th>
            <th >title</th>
            <th >body</th>
            <th>description</th>

        </tr>
        </thead>
        <tbody>

        <?php $__currentLoopData = $user->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>

                <td><?php echo e($product->id); ?></td>
                <td><?php echo e($user->name." ".$user->last_name); ?></td>
                <td><?php echo e($product->title); ?></td>
                <td><?php echo e($product->body); ?></td>
                <td><?php echo e($product->description); ?> </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </tbody>
    </table>

    <h3 class="display-4 text-danger">BLOGS</h3>
    <table class="table">
        <thead>
        <tr>
            <th>blog id</th>
            <th>write</th>
            <th >title</th>
            <th >body</th>
            <th>description</th>

        </tr>
        </thead>
        <tbody>

        <?php $__currentLoopData = $user->blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($blog->id); ?></td>
                <td><?php echo e($user->name." ".$user->last_name); ?></td>
                <td><?php echo e($blog->title); ?></td>
                <td><?php echo e($blog->body); ?></td>
                <td><?php echo e($blog->description); ?> </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/exer/resources/views/admin/user/show.blade.php ENDPATH**/ ?>