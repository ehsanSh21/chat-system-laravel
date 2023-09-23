<?php $__env->startSection('content'); ?>






    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">price of each one</th>
            <th scope="col">qty</th>
            <th scope="col">total price(without discount)</th>
            <th scope="col">total price(with discount)</th>
            <th scope="col">discount amount</th>

        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $basket->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <th scope="row"><?php echo e(array_search($item->toArray(),$basket->items->toArray())+1); ?></th>
            <td><?php echo e($item->product->title); ?></td>
            <td><?php echo e($item->product->price); ?></td>
            <td><?php echo e($item->qty); ?></td>
            <td><?php echo e($item->qty*$item->product->price); ?></td>
            <td><?php echo e($item->price); ?></td>
            <td><?php echo e(($item->qty*$item->product->price)-$item->price); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/exer/resources/views/admin/product/final.blade.php ENDPATH**/ ?>