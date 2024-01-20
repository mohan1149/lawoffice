<?php $__env->startSection('title','Client Account'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <div class="title_left">
            <h4><?php echo e(__("t.client_name")); ?> : <?php echo e($name); ?> </h4>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="<?php echo e(request()->is('admin/clients/*') ? 'active' : ''); ?>"><a
                                href="<?php echo e(route('clients.show', [$client->id])); ?>"><?php echo e(__("t.client_details")); ?></a>
                        </li>

                        <?php if($adminHasPermition->can(['case_list']) =="1"): ?>
                            <li class="<?php echo e(request()->is('admin/client/case-list/*') ? 'active' : ''); ?>"
                                role="presentation"><a href="<?php echo e(route('clients.case-list',[$client->id])); ?>"><?php echo e(__("t.cases")); ?></a>
                            </li>
                        <?php endif; ?>


                        <?php if($adminHasPermition->can(['invoice_list']) =="1"): ?>
                            <li class="<?php echo e(request()->is('admin/client/account-list/*') ? 'active' : ''); ?>"
                                role="presentation"><a
                                    href="<?php echo e(route('clients.account-list',[$client->id])); ?>"><?php echo e(__("t.account")); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>


                </div>

                <div class="x_content">

                    <table id="clientAccountlistDatatable" class="table" data-url="<?php echo e(route('invoice-list-client')); ?>"
                           >
                        <thead>
                        <tr>
                            <th><?php echo e(__("t.no")); ?></th>
                            <th><?php echo e(__("t.invoice_no")); ?></th>
                            <th><?php echo e(__("t.client_name")); ?></th>
                            <th data-orderable="false"><?php echo e(__("t.total").' ['.__('t.kwd').']'); ?></th>
                            <th><?php echo e(__("t.paid").' ['.__('t.kwd').']'); ?></th>
                            <th data-orderable="false"><?php echo e(__("t.due").' ['.__('t.kwd').']'); ?></th>
                            <th data-orderable="false"><?php echo e(__("t.status")); ?></th>
                            <th data-orderable="false"><?php echo e(__("t.action")); ?></th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <div id="load-modal"></div>

    <input type="hidden" name="advo_client_id"
           id="advo_client_id"
           value="<?php echo e($advo_client_id); ?>">

    <input type="hidden" name="token-value"
           id="token-value"
           value="<?php echo e(csrf_token()); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/js/client/client-account-datatable.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>