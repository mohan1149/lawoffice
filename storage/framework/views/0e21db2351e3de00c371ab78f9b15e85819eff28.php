<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(app()->getLocale() == 'ar'): ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet"> 
        <link href="<?php echo e(asset('assets/css/ar.css')); ?>" rel="stylesheet">
    <?php endif; ?>
    <?php if($image_logo->favicon_img!=''): ?>
        <link rel="shortcut icon"
              href="<?php echo e(asset(config('constants.FAVICON_FOLDER_PATH') .'/'. $image_logo->favicon_img)); ?>">
    <?php endif; ?>
    <title><?php echo e($image_logo->company_name ?? ''); ?> | <?php echo $__env->yieldContent('title'); ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo e(asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(), ], 512) ?>
    </script>
    <link href="<?php echo e(asset('assets/admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')); ?>"
          rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('assets/admin/vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/admin/vendors/select2/dist/css/select2.min.css')); ?>" rel="stylesheet">
<?php echo $__env->yieldPushContent('style'); ?>
<!-- bootstrap-progressbar -->
    <link href="<?php echo e(asset('assets/admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>"
          rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo e(asset('assets/admin/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')); ?>"
          rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('assets/admin/build/css/custom.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/admin/vendors/bootstrap-datepicker/css/bootstrap-datepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
</head>

<body class="nav-md ">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title app-border">
                    <a href="<?php echo e(url('')); ?>" class="site_title">

                        <span><?php echo e($image_logo->company_name ?? ''); ?></span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <?php if(Auth::guard('admin')->user()): ?>
                            <?php if(Auth::guard('admin')->user()->profile_img!=""): ?>
                                <img alt="" class="img-circle profile_img"
                                     src='<?php echo e(asset(config('constants.CLIENT_FOLDER_PATH') .'/'. Auth::guard('admin')->user()->profile_img)); ?>'>
                            <?php else: ?>
                                <img src="<?php echo e(asset('upload/user-icon-placeholder.png')); ?>" class="img-circle profile_img"
                                     alt="">
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="profile_info">
                        <span><?php echo e(__("t.welcome")); ?></span>
                        <h2> <?php echo e(Auth::guard('admin')->user()->first_name.' '.Auth::guard('admin')->user()->last_name); ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
            <?php echo $__env->make('admin.layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
    <?php echo $__env->make('admin.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
    <?php echo $__env->make('admin.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /footer content -->
    </div>
</div>
<!-- jQuery -->
<script src="<?php echo e(asset('assets/admin/vendors/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendors/select2/dist/js/select2.full.min.js')); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo e(asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('assets/admin/vendors/fastclick/lib/fastclick.js')); ?>"></script>
<!-- NProgress -->
<script src="<?php echo e(asset('assets/admin/vendors/nprogress/nprogress.js')); ?>"></script>
<!-- bootstrap-progressbar -->
<script src="<?php echo e(asset('assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>"></script>
<!-- DateJS -->
<script src="<?php echo e(asset('assets/admin/vendors/DateJS/build/date.js')); ?>"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?php echo e(asset('assets/admin/vendors/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/sweetalert2.all.min.js')); ?>"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo e(asset('assets/admin/build/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
<script
        src="<?php echo e(asset('assets/admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/js/jquery.validate.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
<script>


    <?php if(Session::has( 'error' )): ?>
    message.fire({
        type: 'error',
        title: 'Error',
        text: "<?php echo session('error'); ?>"
    });
    <?php session()->forget('error') ?>
    <?php endif; ?>

    <?php if(Session::has('success')): ?>
    message.fire({
        type: 'success',
        title: 'Success',
        text: "<?php echo session('success'); ?>"
    });
    <?php session()->forget('scueess') ?>
    <?php endif; ?>


</script>
<?php echo $__env->yieldPushContent('js'); ?>
<div class="modal fade" id="gendeleteModal" tabindex="-1" role="dialog" aria-labelledby="gendeleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="gendeleteModal"><?php echo e(__("t.sure_to_delete")); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p><?php echo e(__("t.delete_record")); ?></p>
        </div>
        <div class="modal-footer">
            <button type="button"data-dismiss="modal"  class="btn btn-secondary"><?php echo e(__("t.cancel")); ?></button>
            <a type="button" class="btn btn-primary gendeleteConfirm"><?php echo e(__("t.delete")); ?></a>
        </div>
      </div>
    </div>
</div>
</body>
<script src="<?php echo e(asset('assets/js/master.js')); ?>"></script>
</html>

