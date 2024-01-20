<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="clientPaymenthistroymodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo e(__("t.payment_history")); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?php echo e(__("t.invoice_no")); ?></th>
                                <th><?php echo e(__("t.amount")); ?></th>
                                <th><?php echo e(__("t.receiving_date")); ?></th>
                                <th><?php echo e(__("t.payment_method")); ?></th>
                                <th><?php echo e(__("t.reference_number")); ?></th>
                                <th>Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $getPaymentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($history->invoice_no); ?></td>
                                    <td>
                                        <?php echo e(round($history->amount)); ?>

                                    </td>
                                    <td><?php echo e(date($date_format_laravel,strtotime($history->receiving_date))); ?></td>
                                    <td><?php echo e($history->payment_type); ?> <?php if($history->payment_type=='Cheque'): ?>
                                            (<?php echo e(date($date_format_laravel,strtotime($history->cheque_date))); ?>

                                            ) <?php endif; ?></td>
                                    <td><?php echo e($history->reference_number ?? 'N/A'); ?></td>
                                    <td><a href="javascript:void(0);" tabindex="0" class="text-right"
                                           data-placement="bottom" data-toggle="popover" data-trigger="focus"
                                           title="Remarks" data-content="<?php echo e($history->note ?? 'N/A'); ?>"><i
                                                class="fa fa-eye"</a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center"><?php echo e(__("t.no_record_found")); ?>.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        "use strict";
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    });
</script>
