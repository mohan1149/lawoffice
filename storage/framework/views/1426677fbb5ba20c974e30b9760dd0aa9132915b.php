<?php $__env->startSection('title','Client Detail'); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-title">
        <div class="title_left">
            <h4>Client Name : <?php echo e($name); ?> </h4>
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

                    <div class="dashboard-widget-content">
                        <div class="col-md-6 hidden-small">
                            <table class="countries_list">
                                <tbody>
                                <tr>
                                    <td><?php echo e(__("t.name")); ?></td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->full_name); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.mobile")); ?></td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->mobile ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.reference_number")); ?></td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->reference_name ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.country")); ?></td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->country->name); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.state")); ?></td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->state->name); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.city")); ?></td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->city->name); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 hidden-small">

                            <table class="countries_list">
                                <tbody>

                                <tr>
                                    <td><?php echo e(__("t.email")); ?></td>
                                    <td class="fs15 fw700 text-right s"><?php echo e($client->email ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.alternate_no")); ?>.</td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->alternate_no ?? ''); ?> </td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.reference_mobile")); ?></td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->reference_mobile ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("t.address")); ?> :</td>
                                    <td class="fs15 fw700 text-right"><?php echo e($client->address ?? ''); ?></td>

                                </tr>


                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if(count($single)>0 && !empty($single)): ?>
                <div class="x_panel">

                    <div class="x_content">
                        <div class="dashboard-widget-content">
                            <?php
                                $i=1;
                            ?>
                            <?php if(isset($single) && !empty($single)): ?>
                                <?php $__currentLoopData = $single; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 hidden-small">
                                        <h4 class="line_30">Advocate</h4>


                                        <table class="countries_list">
                                            <tbody>

                                            <tr>
                                                <td><?php echo e($i.' ) '.$s->party_firstname.' '.$s->party_middlename.' '.$s->party_lastname); ?></td>

                                            </tr>
                                            <tr>
                                                <td><?php echo e(__("t.mobile")); ?> :- <?php echo e($s->party_mobile); ?></td>

                                            </tr>
                                            <tr>
                                                <td><?php echo e(__("t.address")); ?> :-<?php echo e($s->party_address); ?></td>

                                            </tr>
                                            <?php if($client->client_type=="multiple"): ?>
                                                <tr>
                                                    <td><?php echo e(__("t.advocate")); ?>:-<?php echo e($s->party_advocate); ?></td>

                                                </tr>

                                            <?php endif; ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                        $i++;
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-12">
		<h2><?php echo e(__("t.user_documents")); ?> </h2>
                <?php echo $__env->make('admin.client.view.docs',$docs, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>