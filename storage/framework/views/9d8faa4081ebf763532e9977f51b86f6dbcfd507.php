<?php $__env->startSection('title','Invoice View'); ?>
<?php $__env->startPush('stylesheets'); ?>

<?php $__env->startSection('content'); ?>
    <!-- /page content start -->
    <div class="x_panel">
        <div id="content">
            <div class="col-md-12">
                <div class="right-part-bg-all">
                    <div class="ctzn-usrs">
                        <div class="row">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#sendInvoiceModal"><?php echo e(__("t.send_to_client")); ?></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="modal" tabindex="-1" role="dialog" id='sendInvoiceModal'>
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title"><?php echo e(__("t.enter_the_invoice_url")); ?></h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="invoice_link" class="form-control">
                            </div>
                            <div class="modal-footer">
                              <a phone="<?php echo e($advocate_client->mobile); ?>" id="invoice_whatsapp_link" href="https://web.whatsapp.com/" target="_blank" type="button" class="btn btn-primary"><?php echo e(__("t.send")); ?></a>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__("t.close")); ?></button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <form id="add_invoice" name="add_invoice" role="form" method="POST" action="<?php echo e(url('admin/add_invoice')); ?>"
                  autocomplete="off">
                <?php echo e(csrf_field()); ?>

                <div class="col-md-12">
                    <div class="row">
                        <!-- Section Right Part Start -->
                        <!-- Col-md-6 Start -->
                        <div class="col-md-12">
                            <div class="right-part-bg-all">
                                <div class="ctzn-usrs">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a target="_blank"
                                               href="<?php echo e(url('admin/create-Invoice-view-detail/'.$invoice->id.'/print')); ?>"
                                               title="Print invoice"><i class="fa fa-print fa-2x pull-right"
                                                                        aria-hidden="true"></i></a>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="text-center"><?php echo e(__("t.invoice")); ?> </h1>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="invoice-title">
                                                <h3 class="pull-right"><?php echo e(__("t.invoice_no")); ?>: <?php echo e($invoice_no ?? ''); ?></h3>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <address>
                                                        <div class="margin-top-30">

                                                            <div class="discount_text">


                                                                <strong><?php echo e(__("t.billed_to")); ?>:</strong>
                                                                <?php echo e(ucfirst($advocate_client->first_name)." ".$advocate_client->middle_name." ".$advocate_client->last_name); ?>


                                                                <br>
                                                                <strong><?php echo e(__("t.address")); ?>: </strong><?php echo e($advocate_client->address.' ,'.$city); ?>


                                                                <br>
                                                                <strong><?php echo e(__("t.mobile")); ?>: </strong> <?php echo e($advocate_client->mobile); ?>

                                                    </address>
                                                </div>
                                                <div class="col-xs-6 text-right">
                                                    <address>
                                                        <strong><?php echo e(__("t.invoice_date")); ?>:</strong> <?php echo e($inv_date ?? ''); ?><br>

                                                        <strong><?php echo e(__("t.invoice_due_date")); ?>:</strong> <?php echo e($due_date ?? ''); ?><br>


                                                    </address>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">

                                                </div>
                                                <div class="col-xs-6 text-right">

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-condensed">
                                                            <thead>
                                                            <tr>
                                                                <td class="text-center"><strong><?php echo e(__("t.no")); ?></strong></td>
                                                                <td class="text-left"><strong><?php echo e(__("t.service")); ?></strong></td>
                                                                <td class="text-left"><strong><?php echo e(__("t.description")); ?></strong></td>
                                                                <td class="text-center" width="10%">
                                                                    <strong><?php echo e(__("t.qty")); ?></strong></td>
                                                                <td class="text-center" width="10%">
                                                                    <strong><?php echo e(__("t.rate")); ?></strong></td>
                                                                <td class="text-center" width="10%">
                                                                    <strong><?php echo e(__("t.amount")); ?></strong></td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php $i=1; ?>
                                                            <?php if(!empty($iteam) && count($iteam)>0): ?>
                                                                <?php $__currentLoopData = $iteam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo e($i); ?></td>
                                                                        <td class="text-left"><?php echo e($value['service_name']); ?></td>
                                                                        <td class="text-left"><?php echo e($value['custom_items_name']); ?></td>

                                                                        <td class="text-center"><?php echo e($value['custom_items_qty']); ?></td>
                                                                        <td class="text-center"><?php echo e($value['item_rate']); ?></td>
                                                                        <td class="text-center"><?php echo e($value['custom_items_amount']); ?></td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            <?php endif; ?>


                                                            </tbody>
                                                        </table>


                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <?php if($invoice->remarks!=''){ 
                                        ?>
                                        <div class="col-sm-7 col-md-7">
                                            <div class="contct-info">
                                                <div class="form-group">
                                                    <label class="discount_text"> <?php echo e(__("t.note")); ?>

                                                    </label>
                                                    <p><?php echo e($invoice->remarks ?? ''); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }  ?>
                                        <div class="pull-right col-md-4 invoice-margin-right-32">

                                            <table class="table row-border dataTable no-footer" id="tab_logic_total">

                                                <tr>
                                                    <td width="75%" align="right"><b
                                                                class="font-size-expense-17"><?php echo e(__("t.subtotal")); ?></b></td>
                                                    <td width="25%" align="right"><b
                                                                class="font-size-expense-17"><?php echo e($subTotal); ?></b></td>
                                                </tr>

                                                <tr>
                                                    <td width="75%" align="right"><b
                                                                class="font-size-expense-17"><?php echo e(__("t.tax")); ?></b>
                                                    </td>
                                                    <td width="25%" align="right"><b
                                                                class="font-size-expense-17"><?php echo e($tax_amount); ?></b></td>
                                                </tr>


                                                <tr>
                                                    <td align="right"><b class="font-size-expense-17"><?php echo e(__("t.total")); ?></b></td>
                                                    <td align="right"><b
                                                                class="font-size-expense-17"><?php echo e($total_amount); ?></b>
                                                    </td>
                                                </tr>


                                            </table>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <!-- /page content end  -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>