<?php $__env->startSection('title','Appointment Edit'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-title">
        <div class="title_left">
            <h3><?php echo e(__("t.edit_appointment")); ?></h3>
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
                          action="<?php echo e(route('appointment.update',$appointment->id)); ?>">
                        <input name="_method" type="hidden" value="PATCH">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="x_content">

                                <?php if(count($errors) > 0): ?>
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>


                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <input type="radio" id="test5" value="new" name="type"
                                               <?php if($appointment->type=="new"): ?> checked <?php endif; ?>>

                                        <b> New Client
                                        </b>


                                    </div>

                                    <div class="form-group col-md-6">

                                        <input type="radio" id="test4" value="exists" name="type"
                                               <?php if($appointment->type=="exists"): ?> checked <?php endif; ?>>

                                        <b> Existing Client
                                        </b>


                                    </div>
                                </div>
                                <br>
                                <div class="row exists">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <?php if(count($client_list)>0): ?>
                                                <label class="discount_text"><?php echo e(__("t.select_client")); ?>

                                                    <er class="rest">*</er>
                                                </label>
                                                <select class="form-control selct2-width-100" name="exists_client"
                                                        id="exists_client"
                                                        onchange="getMobileno(this.value);">
                                                    <option value="">Select client</option>
                                                    <?php $__currentLoopData = $client_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($list->id); ?>"
                                                                <?php if(!empty($appointment->client_id) && $appointment->client_id==$list->id): ?>
                                                                selected <?php endif; ?>><?php echo e($list->full_name); ?></option>
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
                                               name="new_client" autocomplete="off"
                                               value="<?php echo e($appointment->name ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="mobile"><?php echo e(__("t.mobile_no")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="" class="form-control" id="mobile" name="mobile"
                                               autocomplete="off" value="<?php echo e($appointment->mobile); ?>">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="date"><?php echo e(__("t.date")); ?> <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="date" name="date"
                                               value="<?php echo e(date($date_format_laravel, strtotime($appointment->date))); ?>">


                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="time"><?php echo e(__("t.time")); ?> <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="time" name="time"
                                               value="<?php echo e($appointment->time); ?>">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="note"><?php echo e(__("t.note")); ?></label>
                                        <textarea type="text" placeholder="" class="form-control" id="note"
                                                  name="note"><?php echo e($appointment->note ?? ''); ?></textarea>
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

    <input type="hidden" name="type_chk"
           id="type_chk"
           value="<?php echo e($appointment->type); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/appointment/appointment.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/appointment/appointment-validation_edit.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>