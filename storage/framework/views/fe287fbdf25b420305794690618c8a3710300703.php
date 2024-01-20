<?php $__env->startSection('title','Client View'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <div class="title_left">
            <h4><?php echo e(__('t.client_name')); ?> : <?php echo e($name); ?> </h4>
        </div>
        <div class="pull-right">
            <h4> <?php echo e(__('t.total_case')); ?> : <?php echo e($totalCourtCase ?? ''); ?> </h4>
        </div>

    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">

                    <table id="client_case_listDatatable" class="table"
                           data-url="<?php echo e(route('client.case_view.list')); ?>">
                        <thead>
                        <tr>
                            <th><?php echo e(__('t.no')); ?></th>
                            <th data-orderable="false"><?php echo e(__('t.case_details')); ?></th>
                            <th data-orderable="false"><?php echo e(__('t.court_details')); ?></th>
                            <th data-orderable="false"><?php echo e(__('t.petitioner_vs_respondent')); ?></th>
                            <th data-orderable="false"><?php echo e(__('t.next_date')); ?></th>
                            <th data-orderable="false"><?php echo e(__('t.status')); ?></th>
                            <th data-orderable="false"><?php echo e(__('t.action')); ?></th>
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
    <input type="hidden" name="get_case_important_modal"
           id="get_case_important_modal"
           value="<?php echo e(url('admin/getCaseImportantModal')); ?>">

    <input type="hidden" name="get_case_next_modal"
           id="get_case_next_modal"
           value="<?php echo e(url('admin/getNextDateModal')); ?>">

    <input type="hidden" name="get_case_cort_modal"
           id="get_case_cort_modal"
           value="<?php echo e(url('admin/getChangeCourtModal')); ?>">

    <input type="hidden" name="advo_client_id"
           id="advo_client_id"
           value="<?php echo e($advo_client_id); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/js/case/case-client-datatable.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>