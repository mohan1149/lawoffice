<?php $__env->startSection('title','Invoice'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo e(__("t.invoice")); ?></h3>
        </div>

        <div class="title_right">
            <div class="form-group pull-right top_search">
                <?php if($adminHasPermition->can(['invoice_add'])): ?>
                    <a href="<?php echo e(url('admin/create-Invoice-view')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>
                        <?php echo e(__("t.add_invoice")); ?></a>
                <?php endif; ?>


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <table id="client_list" class="table" >
                        <thead>
                        <tr>
                            <th width="3%;"><?php echo e(__("t.no")); ?></th>
                            <th width="15%"><?php echo e(__("t.invoice_no")); ?></th>
                            <th width="30%"><?php echo e(__("t.client_name")); ?></th>
                            <th width="10%"><?php echo e(__("t.total").'['.__('t.kwd').']'); ?></th>
                            <th width="10%"><?php echo e(__("t.paid").'['.__('t.kwd').']'); ?></th>
                            <th width="15%"><?php echo e(__("t.due").'['.__('t.kwd').']'); ?></th>
                            <th width="5%"><?php echo e(__("t.status")); ?></th>
                            <th width="5%;"><?php echo e(__("t.action")); ?></th>
                        </tr>
                        </thead>

                    </table>

                </div>
            </div>
        </div>

    </div>
    <div id="load-modal"></div>

    <!-- /page content end  -->
    <div class="modal fade" id="modal-common" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal">

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>


    <input type="hidden" name="token-value"
           id="token-value"
           value="<?php echo e(csrf_token()); ?>">

    <input type="hidden" name="invoice-list"
           id="invoice-list"
           value="<?php echo e(url('admin/invoice-list')); ?>">

    <script src="<?php echo e(asset('assets/js/invoice/invoice-datatable.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>