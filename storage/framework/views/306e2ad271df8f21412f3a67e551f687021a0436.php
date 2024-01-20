<?php $__env->startSection('title','Client'); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <?php $__env->startComponent('component.heading' , [
       'page_title' => __("t.client"),
       'action' => route('clients.create') ,
       'text' => __("t.add_client"),
       'permission' => $adminHasPermition->can(['client_add'])
        ]); ?>
        <?php echo $__env->renderComponent(); ?>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <table id="clientDataTable" class="table" data-url="<?php echo e(route('clients.list')); ?>">
                            <thead>
                            <tr>
                                <th width="5%"> <?php echo e(__("t.No")); ?></th>
                                <th> <?php echo e(__("t.client_name")); ?></th>
                                <th width="5%"> <?php echo e(__("t.mobile")); ?></th>
                                <th width="5%" data-orderable="false"> <?php echo e(__("t.case")); ?></th>
                                <th width="5%" data-orderable="false"> <?php echo e(__("t.status")); ?></th>
                                <th width="5%" data-orderable="false" class="text-center"> <?php echo e(__("t.action")); ?></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/js/client/client-datatable.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>