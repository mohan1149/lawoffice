<?php $__env->startSection('title','Appointment Add'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo e(__("t.add_appointment")); ?></h3>
        </div>

        <div class="title_right">
            <div class="form-group pull-right top_search">
                <a href="<?php echo e(route('appointment.index')); ?>" class="btn btn-primary"><?php echo e(__("t.back")); ?></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo $__env->make('component.error', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="x_panel">
                <div class="x_content">
                    <form id="add_appointment" name="add_appointment" role="form" method="POST"
                          action="<?php echo e(route('appointment.store')); ?>" enctype="multipart/form-data" autocomplete="off">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="x_content">

                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <input type="radio" id="test5" value="new" name="type" checked>

                                        <b> <?php echo e(__("t.new_client")); ?>

                                        </b>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <input type="radio" id="test4" value="exists" name="type">

                                        <b> <?php echo e(__("t.existing_client")); ?>

                                       </b>

                                    </div>
                                </div>
                                <br>
                                <div class="row exists">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <?php if(!empty($client_list) && count($client_list)>0): ?>
                                                <label class="discount_text"><?php echo e(__("t.select_client")); ?>

                                                    <er class="rest">*</er>
                                                </label>
                                                <select class="form-control selct2-width-100" name="exists_client"
                                                        id="exists_client"
                                                        onchange="getMobileno(this.value);">
                                                    <option value=""><?php echo e(__("t.select_client")); ?></option>
                                                    <?php $__currentLoopData = $client_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($list->id); ?>"><?php echo e($list->full_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            <?php endif; ?>


                                        </div>

                                    </div>
                                </div>


                                <div class="row new">
                                    <div class="col-md-12 form-group">
                                        <label for="newclint_name"><?php echo e(__("t.new_client_name")); ?> <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" placeholder="" class="form-control" id="new_client"
                                               name="new_client" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="mobile"><?php echo e(__("t.mobile_no")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="" class="form-control" id="mobile" name="mobile"
                                               autocomplete="off">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="date"><?php echo e(__("t.date")); ?> <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="date" name="date">


                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="time"><?php echo e(__("t.time")); ?> <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="time" name="time">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="note"><?php echo e(__("t.note")); ?></label>
                                        <textarea type="text" placeholder="" class="form-control" id="note"
                                                  name="note"></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group pull-right">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <br>
                                    <a href="<?php echo e(route('appointment.index')); ?>" class="btn btn-danger"><?php echo e(__("t.cancel")); ?></a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"
                                                                                     id="show_loader"></i>&nbsp;<?php echo e(__("t.save")); ?>

                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="date_format_datepiker"
           id="date_format_datepiker"
           value="<?php echo e($date_format_datepiker); ?>">

    <input type="hidden" name="getMobileno"
           id="getMobileno"
           value="<?php echo e(route('getMobileno')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/appointment/appointment.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/appointment/appointment-validation.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>