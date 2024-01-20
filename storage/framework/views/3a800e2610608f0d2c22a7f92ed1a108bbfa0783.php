<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('content'); ?>

    <?php if($adminHasPermition->can(['dashboard_list'])): ?>

        <link href="<?php echo e(asset('assets/admin/vendors/fullcalendar/dist/fullcalendar.min.css')); ?> " rel="stylesheet">
        <form method="POST" action="<?php echo e(url('admin/dashboard')); ?>" id="case_board_form">
        <?php echo e(csrf_field()); ?>

        <!-- top tiles -->
            <div class="page-title">
                <div class="title_left">
                    <h3><?php echo e(__("t.dashboard")); ?></h3>
                </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">
                <a href="<?php echo e(route('clients.index')); ?>">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-users"></i>
                            </div>
                            <div class="count"><?php echo e($client ?? ''); ?></div>
                            <h3><?php echo e(__("t.clients")); ?></h3>
                            <p><?php echo e(__("t.total_clients")); ?>.</p>
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(route('case-running.index')); ?>">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-gavel"></i>
                            </div>
                            <div class="count"><?php echo e($case_total ?? ''); ?></div>
                            <h3><?php echo e(__("t.cases")); ?></h3>
                            <p><?php echo e(__("t.total_cases")); ?>.</p>
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(url('admin/case-important')); ?>">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-star"></i>
                            </div>
                            <div class="count"><?php echo e($important_case ?? ''); ?></div>
                            <h3><?php echo e(__("t.important_case")); ?></h3>
                            <p><?php echo e(__("t.total_important_cases")); ?>.</p>
                        </div>
                    </div>
                </a>
                <a href="<?php echo e(url('admin/case-archived')); ?>">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-file-archive-o"></i>
                            </div>
                            <div class="count"><?php echo e($archived_total); ?></div>
                            <h3><?php echo e(__("t.archived_case")); ?></h3>
                            <p><?php echo e(__("t.total_completed_cases")); ?>.</p>
                        </div>
                    </div>
                </a>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?php echo e(__("t.case_board")); ?> </h2>
                            &nbsp;&nbsp;
                            <?php if($totalCaseCount>0): ?>
                                <a href="javascript:void(0);" onClick="downloadCaseBorad()" title="Download case board"><i
                                        class="fa fa-download fa-2x"></i></a>
                                &nbsp;
                                <a href="javascript:void(0);" onClick="printCaseBorad()" title="Print case board"
                                   target="_blank"><i class="fa fa-print fa-2x"></i></a><?php endif; ?>

                            <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="client_case" id="client_case"
                                           class="form-control  datecase" readonly=""
                                           value="<?php echo e(($date!='')?date($date_format_laravel,strtotime($date)):date($date_format_laravel)); ?>">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <?php if($totalCaseCount>0): ?>
                                <?php if(count($case_dashbord)>0 && !empty($case_dashbord)): ?>
                                    <?php $__currentLoopData = $case_dashbord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $court): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <h4 class="title text-primary"> <?php echo $court['judge_name']; ?></h4>
                                        <table id="case_list" class="table row-border" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th width="3%"><?php echo e(__("t.no")); ?></th>
                                                <th width="20%"><?php echo e(__("t.case_no")); ?></th>
                                                <th width="35%"><?php echo e(__("t.case")); ?></th>
                                                <th width="15%"><?php echo e(__("t.next_date")); ?></th>
                                                <th width="10%"><?php echo e(__("t.status")); ?></th>
                                                <th width="17%" style="text-align: center;"><?php echo e(__("t.action")); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(!empty($court['cases']) && count($court['cases'])>0): ?>
                                                <?php $__currentLoopData = $court['cases']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $class = ( $value->priority=='High')?'fa fa-star':(( $value->priority=='Medium')?'fa fa-star-half-o':'fa fa-star-o');
                                                    ?>
                                                    <?php if($value->client_position=='Petitioner'): ?>
                                                        <?php
                                                            $first = $value->first_name.' '.$value->middle_name.' '.$value->last_name;
                                                            $second = $value->party_name;
                                                        ?>
                                                    <?php else: ?>
                                                        <?php
                                                            $first = $value->party_name;
                                                            $second = $value->first_name.' '.$value->middle_name.' '.$value->last_name;
                                                        ?>
                                                    <?php endif; ?>

                                                    <tr>
                                                        <td><?php echo e($key+1); ?></td>
                                                        <td><span
                                                                class="text-primary"><?php echo e($value->registration_number); ?></span><br/><small><?php echo e(($value->caseSubType!='')?$value->caseSubType:$value->caseType); ?></small>
                                                        </td>
                                                        <td>
                                                            <?php echo $first; ?> <br/><b>VS</b><br/> <?php echo $second; ?>

                                                        </td>
                                                        <td><?php if($value->hearing_date!=''): ?>
                                                                <?php echo e(date($date_format_laravel,strtotime($value->hearing_date))); ?>

                                                            <?php else: ?>
                                                                <span
                                                                    class="blink_me text-danger"><?php echo e(__("t.date_not_updated")); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($value->case_status_name); ?></td>
                                                        <td>
                                                            <ul class="padding-bottom-custom" style="list-style: none;">
                                                                <?php if($adminHasPermition->can(['case_edit']) =="1"): ?>

                                                                    <li style="text-align:left"><a class=""
                                                                                                   href="javascript:void(0);"
                                                                                                   onclick="nextDateAdd('<?php echo e($value->case_id); ?>');"><i
                                                                                class="fa fa-calendar-plus-o"></i>
                                                                            &nbsp;&nbsp;<?php echo e(__("t.next_date")); ?></a></li>
                                                                    <li style="text-align:left"><a class=""
                                                                                                   href="javascript:void(0);"
                                                                                                   onClick="transfer_case('<?php echo e($value->case_id); ?>');"><i
                                                                                class="fa fa-gavel"></i> &nbsp;&nbsp;<?php echo e(__("t.case_transfer")); ?>

                                                                            </a></li>
                                                                <?php endif; ?>


                                                            </ul>
                                                        </td>
                                                    </tr>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php elseif($case_total>0 && count($case_dashbord)==0): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="customers-space">
                                            <p class="customers-tittle text-center"><?php echo e(__("t.today_you_have_no_case_board")); ?>.</p>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="customers-space">
                                                <h4 class="customers-heading"><?php echo e(__("t.manage_your_case")); ?></h4>
                                                <p class="customers-tittle"><?php echo e(__("t.maintain_complete_case")); ?></p>
                                                <div class="cst-btn">
                                                    <div class="top-btns" style="text-align: left;">
                                                        <a class="btn btn-info"
                                                           href="<?php echo e(url('admin/case-running/create')); ?>"> <?php echo e(__("t.add_case")); ?> </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="customers-img">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?php echo e(__("t.appointment")); ?></h2>
                            <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="appoint_range" id="appoint_range" class="form-control"
                                           value="<?php echo e(date($date_format_laravel)); ?>" readonly="">
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <?php if(count($appoint_calander)>0): ?>
                                <table id="appointment_list" class="table row-border" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__("t.no")); ?></th>
                                        <th><?php echo e(__("t.client_name")); ?></th>
                                        <th><?php echo e(__("t.date")); ?></th>
                                        <th><?php echo e(__("t.time")); ?></th>
                                    </tr>
                                    </thead>
                                </table>
                            <?php elseif($appointmentCount>0 && count($appoint_calander)==0): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="customers-space">
                                            <p class="customers-tittle text-center"><?php echo e(__("t.today_no_appointment")); ?>.</p>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="customers-space">
                                                <h4 class="customers-heading"><?php echo e(__("t.manage_your_appointment")); ?>  </h4>
                                                <p class="customers-tittle"><?php echo e(__("t.schedule_your_appointment")); ?></p>
                                                <div class="cst-btn">
                                                    <div class="top-btns" style="text-align: left;">
                                                        <a class="btn btn-info"
                                                           href="<?php echo e(url('admin/appointment/create')); ?>"> <?php echo e(__("t.add_appointment")); ?>

                                                             </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="customers-img">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>


            </div>

            <br>


            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?php echo e(__("t.calendar")); ?></h2>
                            <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
                                <div class="input-group">

                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="calendar_dashbors_case"></div>


                        </div>
                    </div>
                </div>


            </div>


            <div id="load-modal"></div>
            <!-- /top tiles -->
        </form>



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

        <input type="hidden" name="token-value"
               id="token-value"
               value="<?php echo e(csrf_token()); ?>">

        <input type="hidden" name="case-running"
               id="case-running"
               value="<?php echo e(url('admin/case-running')); ?>">

        <input type="hidden" name="appointment"
               id="appointment"
               value="<?php echo e(url('admin/appointment')); ?>">
        <input type="hidden" name="ajaxCalander"
               id="ajaxCalander"
               value="<?php echo e(url('admin/ajaxCalander')); ?>">

        <input type="hidden" name="date_format_datepiker"
               id="date_format_datepiker"
               value="<?php echo e($date_format_datepiker); ?>">
        <input type="hidden" name="dashboard_appointment_list"
               id="dashboard_appointment_list"
               value="<?php echo e(url('admin/dashboard-appointment-list')); ?>">

        <input type="hidden" name="getNextDateModal"
               id="getNextDateModal"
               value="<?php echo e(url('admin/getNextDateModal')); ?>">

        <input type="hidden" name="getChangeCourtModal"
               id="getChangeCourtModal"
               value="<?php echo e(url('admin/getChangeCourtModal')); ?>">

        <input type="hidden" name="getCaseImportantModal"
               id="getCaseImportantModal"
               value="<?php echo e(url('admin/getCaseImportantModal')); ?>">
        <input type="hidden" name="getCourt"
               id="getCourt"
               value="<?php echo e(url('getCourt')); ?>">
        <input type="hidden" name="downloadCaseBoard"
               id="downloadCaseBoard"
               value="<?php echo e(url('admin/downloadCaseBoard')); ?>">
        <input type="hidden" name="printCaseBoard"
               id="printCaseBoard"
               value="<?php echo e(url('admin/printCaseBoard')); ?>">

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/lib/moment.min.js'></script>
    <script src="<?php echo e(asset('assets/admin/vendors/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dashbord/dashbord-datatable.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>