<?php $__env->startSection('title','Client Cases'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <div class="title_left">
            <h4>Client Name : <?php echo e($name); ?> </h4>
        </div>
        <div class="pull-right">
            <h4> Total Case : <?php echo e($totalCourtCase ?? ''); ?> </h4>
        </div>

    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="<?php echo e(request()->is('admin/clients/*') ? 'active' : ''); ?>"><a
                                href="<?php echo e(route('clients.show', [$client->id])); ?>"><?php echo e(__("t.client_detail")); ?></a>
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

                    <table id="clientCaselistDatatable1" class="table"
                           data-url="<?php echo e(route('client.case_view.list')); ?>">
                        <thead>
                        <tr>
                            <th><?php echo e(__("t.no")); ?></th>
                            <th><?php echo e(__("t.case_details")); ?></th>
                            <th><?php echo e(__("t.court_details")); ?></th>
                            <th><?php echo e(__("t.petitioner_vs_respondent")); ?></th>
                            <th><?php echo e(__("t.next_date")); ?></th>
                            <th><?php echo e(__("t.status")); ?></th>
                            <th><?php echo e(__("t.action")); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal-case-priority" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal">

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-change-court" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal_transfer">

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-next-date" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal_next_date">

            </div>
        </div>
    </div>


    <input type="hidden" name="advo_client_id"
           id="advo_client_id"
           value="<?php echo e($advo_client_id); ?>">

    <input type="hidden" name="token-value"
           id="token-value"
           value="<?php echo e(csrf_token()); ?>">

    <input type="hidden" name="get_case_important_modal"
           id="get_case_important_modal"
           value="<?php echo e(url('admin/getCaseImportantModal')); ?>">

    <input type="hidden" name="get_case_next_modal"
           id="get_case_next_modal"
           value="<?php echo e(url('admin/getNextDateModal')); ?>">

    <input type="hidden" name="get_case_cort_modal"
           id="get_case_cort_modal"
           value="<?php echo e(url('admin/getChangeCourtModal')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/js/client/client-case-datatable.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>