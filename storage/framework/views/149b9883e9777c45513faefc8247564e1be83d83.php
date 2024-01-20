<?php $__env->startSection('title','Appointment'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('assets/admin/jquery-confirm-master/css/jquery-confirm.css')); ?>">

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="">

        <?php $__env->startComponent('component.heading' , [

       'page_title' => __("t.appointment"),
       'action' => route('appointment.create') ,
       'text' => __("t.add_appointment"),
       'permission' => $adminHasPermition->can(['appointment_add'])
        ]); ?>
        <?php echo $__env->renderComponent(); ?>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="date_from"><?php echo e(__("t.from_date")); ?> :</label>

                                <input type="text" class="form-control dateFrom" id="date_from" autocomplete="off"
                                       readonly="">

                            </div>

                            <div class="col-md-3 form-group">
                                <label for="date_to"><?php echo e(__("t.to_date")); ?> :</label>

                                <input type="text" class="form-control dateTo" id="date_to" autocomplete="off"
                                       readonly="">


                            </div>

                            <ul class="nav navbar-left panel_toolbox">

                                <br>
                                &nbsp;&nbsp;&nbsp;
                                <button class="btn btn-danger appointment-margin" type="button" id="btn_clear"
                                        name="btn_clear"
                                ><?php echo e(__("t.clear")); ?>

                                </button>
                                <button type="submit" id="search" class="btn btn-success appointment-margin"><i
                                        class="fa fa-search"></i>&nbsp;<?php echo e(__("t.search")); ?>

                                </button>
                            </ul>

                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <table id="Appointmentdatatable" class="table appointment_table"
                               data-url="<?php echo e(route('appointment.list')); ?>">
                            <thead>
                            <tr>
                                <th><?php echo e(__("t.no")); ?></th>
                                <th width="40%"><?php echo e(__("t.client_name")); ?></th>
                                <th width="10%"><?php echo e(__("t.mobile")); ?></th>
                                <th width="10%;"><?php echo e(__("t.date")); ?></th>
                                <th><?php echo e(__("t.time")); ?></th>
                                <th data-orderable="false"><?php echo e(__("t.status")); ?></th>
                                <th data-orderable="false"><?php echo e(__("t.action")); ?></th>
                            </tr>
                            </thead>


                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <input type="hidden" name="token-value"
           id="token-value"
           value="<?php echo e(csrf_token()); ?>">
    <input type="hidden" name="date_format_datepiker"
           id="date_format_datepiker"
           value="<?php echo e($date_format_datepiker); ?>">
    <input type="hidden" name="common_change_state"
           id="common_change_state"
           value="<?php echo e(url('common_change_state')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/admin/jquery-confirm-master/js/jquery-confirm.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/appointment/appointment-datatable.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>