<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<?php $__env->startSection('title',__("t.time_lows")); ?>
<?php $__env->startSection('content'); ?>

    <div class="">
        <?php $__env->startComponent('component.heading' , [
            'page_title' => __("t.time_lows"),
            'action' => '/admin/judge-time-low/create' ,
            'text' => __("t.add_time_low"),
            'permission' => 1,
        ]); ?>
        <?php echo $__env->renderComponent(); ?>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="slidersTable" class="table responsive responsive-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__("t.number_days")); ?></th>
                                    <th><?php echo e(__("t.case_level")); ?></th>
                                    <th><?php echo e(__("t.case_type")); ?></th>
                                    <th data-orderable="false" class="text-center"><?php echo e(__("t.action")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($time->number_days); ?></td>
                                        <td><?php echo e(__("t.".$time->case_level)); ?></td>
                                        <td><?php echo e($time->case_type_name); ?></td>
                                        <td>
                                            <a target="/admin/judge-time-low/<?php echo e($time->jtlid); ?>" class="red genDeleteBtn" data-toggle="modal" data-target="#gendeleteModal"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#slidersTable').DataTable({
        columnDefs: [
            {
                targets: 2,
                orderable: false,
                searchable: false,
            },
        ],
    });
} );
</script>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>