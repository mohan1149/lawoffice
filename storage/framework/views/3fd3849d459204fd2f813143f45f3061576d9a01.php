<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<?php $__env->startSection('title',__("t.case_roll")); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="container-fluid">
                        <div>
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="case_num">
                                                <?php echo e(__("t.case_number")); ?>

                                            </label>
                                            <input value="<?php echo e(request('case_number')); ?>" type="text" name="case_number" id="case_num" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="case_type">
                                                <?php echo e(__("t.case_type")); ?>

                                            </label>
                                            <select name="case_type" class="form-control">
                                                <option value="0">----</option>
                                                <?php $__currentLoopData = $filter_data['types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(request('case_type') == $key ? 'selected':''); ?> value="<?php echo e($key); ?>"><?php echo e($type); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="case_status">
                                                <?php echo e(__("t.case_status")); ?>

                                            </label>
                                            <select name="case_level" class="form-control" required>
                                                    <option <?php echo e(request('case_level') == 'police' ? 'selected':''); ?> value="police"><?php echo e(__('t.police')); ?></option>
                                                    <option <?php echo e(request('case_level') == 'prosecution' ? 'selected':''); ?> value="prosecution"><?php echo e(__('t.prosecution')); ?></option>
                                                    <option <?php echo e(request('case_level') == 'first-degree' ? 'selected':''); ?> value="first-degree"><?php echo e(__('t.first-degree')); ?></option>
                                                    <option <?php echo e(request('case_level') == 'resumption' ? 'selected':''); ?> value="resumption"><?php echo e(__('t.resumption')); ?></option>
                                                    <option <?php echo e(request('case_level') == 'excellence' ? 'selected':''); ?> value="excellence"><?php echo e(__('t.excellence')); ?></option>
                                                    <option <?php echo e(request('case_level') == 'expert' ? 'selected':''); ?> value="expert"><?php echo e(__('t.expert')); ?></option>
                                                    <option <?php echo e(request('case_level') == 'shapes' ? 'selected':''); ?> value="shapes"><?php echo e(__('t.shapes')); ?></option>
                                                </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">
                                                <?php echo e(__("t.start_date")); ?>

                                            </label>
                                            <input value="<?php echo e(request("start_date")); ?>" type="date" name="start_date" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">
                                                <?php echo e(__("t.end_date")); ?>

                                            </label>
                                            <input value="<?php echo e(request('end_date')); ?>" type="date" name="end_date" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="priority">
                                                <?php echo e(__("t.priority")); ?>

                                            </label>
                                            <select name="priority" class="form-control">
                                                <option value="0">----</option>
                                                <option <?php echo e(request('priority') == "High" ? 'selected':''); ?> value="High"><?php echo e(__("t.high")); ?></option>
                                                <option <?php echo e(request('priority') == "Medium" ? 'selected':''); ?> value="Medium"><?php echo e(__("t.medium")); ?></option>
                                                <option <?php echo e(request('priority') == "Low" ? 'selected':''); ?> value="Low"><?php echo e(__("t.low")); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="court">
                                                <?php echo e(__("t.court")); ?>

                                            </label>
                                            <select name="court" class="form-control">
                                                <option value="0">----</option>
                                                <?php $__currentLoopData = $filter_data['courts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $court): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option  <?php echo e(request('court') == $key ? 'selected':''); ?>  value="<?php echo e($key); ?>"><?php echo e($court); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exe_status">
                                                <?php echo e(__("t.exe_status")); ?>

                                            </label>
                                            <select name="exe_status" class="form-control">
                                                <option value="2">----</option>
                                                <option <?php echo e(request('exe_status') == "0" ? 'selected':''); ?> value="0"><?php echo e(__("t.not_done")); ?></option>
                                                <option <?php echo e(request('exe_status') == "1" ? 'selected':''); ?> value="1"><?php echo e(__("t.done")); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="<?php echo e(url()->full()."&pdf=true"); ?>" class="btn btn-danger"><?php echo e(__("t.pdf")); ?></a>
                                        <input class="btn btn-primary" type="submit" value="<?php echo e(__("t.filter")); ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="slidersTable" class="table responsive responsive-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__("t.case_number")); ?></th>
                                    <th><?php echo e(__("t.priority")); ?></th>
                                    <th><?php echo e(__("t.client_name")); ?></th>
                                    <th><?php echo e(__("t.next_hearing")); ?></th>
                                    <th><?php echo e(__("t.client_position")); ?></th>
                                    <th><?php echo e(__("t.exe_status")); ?></th>
                                    <th><?php echo e(__("t.notice_status")); ?></th>
                                    <th><?php echo e(__("t.case_level")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($case->case_number); ?></td>
                                        <td><?php echo e($case->priority); ?></td>
                                        <td><?php echo e($case->first_name.' '.$case->last_name); ?></td>
                                        <td><?php echo e($case->next_date); ?></td>
                                        <td><?php echo e($case->client_position); ?></td>
                                        <td><?php echo e($case->exe_status == 0 ? __('t.not_done') : __('t.done')); ?></td>
                                        <td><?php echo e($case->notice_status == 0 ? __('t.not_sent') : __('t.sent')); ?></td>
                                        <td class="text red"><?php echo e(__("t.".$case->case_level)); ?></td>
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
                targets: 4,
                orderable: false,
                searchable: false,
            },
        ],
    });
} );
</script>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>