<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<?php $__env->startSection('title',__("t.timeslots")); ?>
<?php $__env->startSection('content'); ?>

    <div class="">
        <?php $__env->startComponent('component.heading' , [
            'page_title' => __("t.timeslots"),
            'action' => route('timeslots.create') ,
            'text' => __("t.add_time_slot"),
            'permission' => 1,
        ]); ?>
        <?php echo $__env->renderComponent(); ?>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <table id="timeSlotsTable" class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__("t.lawer")); ?></th>
                                    <th><?php echo e(__("t.date")); ?></th>
                                    <th><?php echo e(__("t.start_date")); ?></th>
                                    <th><?php echo e(__("t.end_date")); ?></th>
                                    <th data-orderable="false" class="text-center"><?php echo e(__("t.action")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $timeslots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeslot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($timeslot->first_name.' '.$timeslot->last_name); ?></td>
                                        <td><?php echo e($timeslot->date); ?></td>
                                        <td><?php echo e($timeslot->start_time); ?></td>
                                        <td><?php echo e($timeslot->end_time); ?></td>
                                        <td>
                                            <a target="/admin/timeslots/<?php echo e($timeslot->tsid); ?>" class="red genDeleteBtn" data-toggle="modal" data-target="#gendeleteModal"><i class="fa fa-trash"></i></a>
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
    $('#timeSlotsTable').DataTable({
        columnDefs: [
            {
                targets: 4,
                orderable: false,
                searchable: false,
            },
        ],
    });
} );
</script>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>