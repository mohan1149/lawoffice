<?php $__env->startSection('title','Client Create'); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('component.heading' , [
    'page_title' => 'Add Client',
    'action' => route('clients.index') ,
    'text' => 'Back'
     ]); ?>
     <?php echo $__env->renderComponent(); ?>
     <link rel="stylesheet" href="/assets/css/tel.css">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo $__env->make('component.error', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="x_panel">
                <form id="add_client" name="add_client" role="form" method="POST" autocomplete="nope"
                      action="<?php echo e(route('clients.store')); ?>">
                    <?php echo e(csrf_field()); ?>

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

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.first_name")); ?> <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="f_name" name="f_name">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.middle_name")); ?> <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="m_name" name="m_name">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.last_name")); ?> <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="l_name" name="l_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.gender")); ?> <span class="text-danger">*</span></label><br>

                                <input type="radio" name="gender" id="genderM" value="Male" checked="" required/> &nbsp;&nbsp;<?php echo e(__("t.male")); ?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="gender" id="genderF" value="Female"/>&nbsp;&nbsp;<?php echo e(__("t.female")); ?>

                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.email")); ?><span class="text-danger">*</span></label>
                                <input type="text" required placeholder="" class="form-control" id="email" name="email">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.mobile_no")); ?>. <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="mobile"
                                       name="mobile">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.alternate_no")); ?>.</label>
                                <input type="text" placeholder="" class="form-control" id="alternate_no"
                                       name="alternate_no">
                            </div>
                            <div class="col-md-9 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.address")); ?> <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.country")); ?> <span class="text-danger">*</span></label>
                                <select class="form-control select-change country-select2"
                                        name="country" id="country"
                                        data-url="<?php echo e(route('get.country')); ?>"
                                        data-clear="#city_id,#state"
                                >
                                    <option value=""> <?php echo e(__("t.select_country")); ?></option>

                                </select>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.state")); ?> <span class="text-danger">*</span></label>
                                <select id="state" name="state"

                                        data-url="<?php echo e(route('get.state')); ?>"
                                        data-target="#country"
                                        data-clear="#city_id"
                                        class="form-control state-select2 select-change">
                                    <option value=""> <?php echo e(__("t.select_state")); ?></option>

                                </select>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.city")); ?> <span class="text-danger">*</span></label>
                                <select id="city_id" name="city_id"
                                        data-url="<?php echo e(route('get.city')); ?>"
                                        data-target="#state"

                                        class="form-control city-select2">
                                    <option value=""> <?php echo e(__("t.select_city")); ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.refrence_name")); ?> </label>
                                <input type="text" placeholder="" class="form-control" id="reference_name"
                                       name="reference_name">
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"><?php echo e(__("t.reference_mobile")); ?> </label>
                                <input type="text" placeholder="" class="form-control" id="reference_mobile"
                                       name="reference_mobile">
                            </div>

                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <br>
                            <input type="checkbox" value="Yes" name="change_court_chk" id="change_court_chk"><?php echo e(__("t.add_more")); ?>

                            person
                            <br/>

                        </div>
                        <div id="change_court_div" class="hidden">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label for="fullname"><?php echo e(__("t.client")); ?> <span class="text-danger">*</span></label><br>
                                    <br>
                                    <input type="radio" name="type" id="test6" value="single" checked="" required/>
                                    &nbsp;&nbsp;<?php echo e(__("t.single_advocate")); ?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="type" id="test7" value="multiple"/>&nbsp;&nbsp;<?php echo e(__("t.multiple_advocate")); ?>

                                    
                                </div>
                            </div>
                            <div class="repeater one">
                                <div data-repeater-list="group-a">
                                    <div data-repeater-item>
                                        <div class="row border-addmore"
                                        >
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.first_name")); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="firstname" name="firstname"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter first name."
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.middle_name")); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="middlename" name="middlename"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter middle name."
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.last_name")); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="lastname" name="lastname"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter last name." class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.mobile_no")); ?>. <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="mobile_client" name="mobile_client"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter mobile number."
                                                       data-rule-number="true" data-msg-number="please enter digit 0-9."
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.address")); ?> <span class="text-danger">*</span></label>
                                                <input type="text" id="address_client" name="address_client"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter address." class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <br>
                                                <button type="button" data-repeater-delete type="button"
                                                        class="btn btn-danger"><i class="fa fa-trash-o"
                                                                                  aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <br>
                                    <button data-repeater-create type="button" value="Add New"
                                            class="btn btn-success waves-effect waves-light btn btn-success-edit"
                                            type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="repeater two">
                                <div data-repeater-list="group-b">
                                    <div data-repeater-item>
                                        <div class="row border-addmore"
                                        >
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.first_name")); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="firstname" name="firstname"
                                                       data-rule-required="true" data-msg-required="Please enter name."
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.middle_name")); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="middlename" name="middlename"
                                                       data-rule-required="true" data-msg-required="Please enter name."
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.last_name")); ?> <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="lastname" name="lastname"
                                                       data-rule-required="true" data-msg-required="Please enter name."
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.mobile_no")); ?>. <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="mobile_client" name="mobile_client"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter mobile number."
                                                       data-rule-number="true" data-msg-number="please enter digit 0-9."
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.address")); ?> <span class="text-danger">*</span></label>
                                                <input type="text" id="address_client" name="address_client"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter address." class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__("t.advocate_name")); ?>. <span class="text-danger">*</span></label>
                                                <input type="text" id="advocate_name" name="advocate_name"
                                                       data-rule-required="true"
                                                       data-msg-required="Please enter advocate name."
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                                <br>
                                                <button type="button" data-repeater-delete type="button"
                                                        class="btn btn-danger waves-effect waves-light"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <br>
                                    <button data-repeater-create type="button" value="Add New"
                                            class="btn btn-success waves-effect waves-light btn btn-success-edit"
                                            type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <a href="<?php echo e(route('clients.index')); ?>" class="btn btn-danger"><?php echo e(__("t.cancel")); ?></a>
                                <input type="hidden" name="route-exist-check"
                                       id="route-exist-check"
                                       value="<?php echo e(url('admin/check_client_email_exits')); ?>">
                                <input type="hidden" name="token-value"
                                       id="token-value"
                                       value="<?php echo e(csrf_token()); ?>">

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/admin/js/selectjs.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/vendors/repeter/repeater.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/vendors/jquery-ui/jquery-ui.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/client/add-client-validation.js')); ?>"></script>
    <script src="/assets/js/tel.js"></script> 
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>