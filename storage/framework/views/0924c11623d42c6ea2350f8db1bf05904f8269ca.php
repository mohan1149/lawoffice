<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">

        <ul class="nav side-menu">
            <?php if($adminHasPermition->can(['dashboard_list'])=="1"): ?>
                <li><a href="<?php echo e(url('admin/dashboard')); ?>"><i class="fa fa-tachometer"></i> <?php echo e(__("t.dashboard")); ?></a></li>
            <?php endif; ?>

            <?php if($adminHasPermition->can(['client_list']) =="1"): ?>
                <li><a href="<?php echo e(route('clients.index')); ?>"><i class="fa fa-user-plus"></i> <?php echo e(__("t.clients")); ?></a></li>
            <?php endif; ?>

            <?php if($adminHasPermition->can(['case_list']) =="1"): ?>
                <li><a href="<?php echo e(route('case-running.index')); ?>"><i class="fa fa-gavel"></i> <?php echo e(__("t.cases")); ?></a></li>

            <?php endif; ?>
            <?php if($adminHasPermition->can(['task_list']) =="1"): ?>
                <li><a href="<?php echo e(route('tasks.index')); ?>"><i class="fa fa-tasks"></i> <?php echo e(__("t.tasks")); ?></a></li>
            <?php endif; ?>


            <?php if($adminHasPermition->can(['appointment_list']) =="1"): ?>
                <li><a href="<?php echo e(route('appointment.index')); ?>"><i class="fa fa-calendar-plus-o"></i> <?php echo e(__("t.appointments")); ?></a>
                </li>

            <?php endif; ?>
            <?php if(\Auth::guard('admin')->user()->user_type=="Admin"): ?>
                
                <li><a href="/admin/notices"><i class="fa fa-clipboard"></i>  <?php echo e(__("t.notices")); ?> </a>
                <li><a href="/admin/executions"><i class="fa fa-balance-scale"></i>  <?php echo e(__("t.executions")); ?> </span></a>
                
                <li><a href="/admin/case/roll"><i class="fa fa-list"></i>  <?php echo e(__("t.roll")); ?> </span></a>
                <li><a><i class="fa fa-users"></i>  <?php echo e(__("t.team_members")); ?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo e(url('admin/client_user')); ?>"> <?php echo e(__('t.team_member')); ?></a></li>
                        <li><a href="<?php echo e(route('role.index')); ?>"><?php echo e(__("t.role")); ?></a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if($adminHasPermition->can(['service_list']) == "1" || $adminHasPermition->can(['invoice_list'])=="1"): ?>
                <li><a><i class="fa fa-money"></i> <?php echo e(__("t.income")); ?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <?php if($adminHasPermition->can(['service_list']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/service')); ?>"><?php echo e(__("t.service")); ?></a></li>
                        <?php endif; ?>

                        <?php if($adminHasPermition->can(['invoice_list']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/invoice')); ?>"><?php echo e(__("t.invoice")); ?></a>
                        <?php endif; ?>


                    </ul>
                </li>
            <?php endif; ?>
            <?php if($adminHasPermition->can(['vendor_list']) =="1"): ?>
                <li><a href="<?php echo e(route('vendor.index')); ?>"><i class="fa fa-user-plus"></i> <?php echo e(__("t.vendor")); ?></a></li>
            <?php endif; ?>

            <?php if($adminHasPermition->can(['expense_type_list'])=="1" || $adminHasPermition->can(['expense_list'])=="1"): ?>
                <li><a><i class="fa fa-money"></i> <?php echo e(__("t.expense")); ?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                        <?php if($adminHasPermition->can(['expense_type_list']) =="1"): ?>
                            <li><a href="<?php echo e(url('admin/expense-type')); ?>"><?php echo e(__("t.expense_type")); ?></a></li>
                        <?php endif; ?>


                        <?php if($adminHasPermition->can(['expense_list']) =="1"): ?>
                            <li><a href="<?php echo e(url('admin/expense')); ?>"><?php echo e(__("t.expense")); ?></a></li>
                        <?php endif; ?>

                    </ul>
                </li>

            <?php endif; ?>


            <?php if($adminHasPermition->can(['case_type_list'])=="1"
            || $adminHasPermition->can(['court_type_list'])=="1"
            || $adminHasPermition->can(['court_list'])=="1"
            || $adminHasPermition->can(['case_status_list'])=="1"
            || $adminHasPermition->can(['judge_list'])=="1"
            || $adminHasPermition->can(['tax_list'])=="1"
            || $adminHasPermition->can(['general_setting_edit'])=="1"): ?>
                <li><a><i class="fa fa-gear"></i> <?php echo e(__("t.settings")); ?> <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo e(url('admin/judge-time-low')); ?>"><?php echo e(__("t.judgement_time_lows")); ?></a></li>
                        <?php if($adminHasPermition->can(['case_type_list']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/case-type')); ?>"><?php echo e(__("t.case_type")); ?></a></li>
                        <?php endif; ?>

                        <?php if($adminHasPermition->can(['court_type_list']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/court-type')); ?>"><?php echo e(__("t.court_type")); ?></a></li>
                        <?php endif; ?>

                        <?php if($adminHasPermition->can(['court_list']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/court')); ?>"><?php echo e(__("t.courts")); ?></a></li>
                        <?php endif; ?>

                        <?php if($adminHasPermition->can(['case_status_list']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/case-status')); ?>"><?php echo e(__('t.case_status')); ?></a></li>
                        <?php endif; ?>

                        <?php if($adminHasPermition->can(['judge_list']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/judge')); ?>"><?php echo e(__("t.judge_type")); ?></a></li>
                        <?php endif; ?>

                        


                        <?php if($adminHasPermition->can(['general_setting_edit']) == "1"): ?>
                            <li><a href="<?php echo e(url('admin/general-setting')); ?>"><?php echo e(__("t.general_setting")); ?></a></li>
                        <?php endif; ?>
                        <?php if(\Auth::guard('admin')->user()->user_type=="Admin"): ?>
                            <li><a href="<?php echo e(url('admin/database-backup')); ?>"><?php echo e(__("t.database_backup")); ?></a></li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>
            <li><a href="<?php echo e(url('admin/timeslots')); ?>"><i class="fa fa-calendar"></i> <?php echo e(__("t.calendar")); ?></a></li>
            <li><a href="<?php echo e(url('admin/sliders')); ?>"><i class="fa fa-image"></i> <?php echo e(__("t.sliders")); ?></a></li>
            <li><a href="<?php echo e(url('admin/consultations')); ?>"><i class="fa fa-users"></i> <?php echo e(__("t.consultations")); ?></a></li>
        </ul>
    </div>
</div>