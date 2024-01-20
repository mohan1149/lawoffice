<?php $__env->startSection('title', 'Case List'); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <?php echo $__env->make('admin.case.view.card_header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="dashboard-widget-content">
                        <h2 class="line_30 case_detail-m-f-10"><?php echo e(__('t.case_details')); ?>l</h2>
                        <div class="col-md-6 hidden-small">


                            <table class="countries_list">
                                <tbody>
                                    <tr>
                                        <td><?php echo e(__('t.case_type')); ?></td>
                                        <td class="fs15 fw700 text-right"><?php echo e($case->caseType); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.filling_no')); ?></td>
                                        <td class="fs15 fw700 text-right"><?php echo e($case->filing_number); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.filling_date')); ?></td>
                                        <td class="fs15 fw700 text-right">
                                            <?php echo e(date($date_format_laravel, strtotime($case->filing_date))); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.registration_no')); ?></td>
                                        <td class="fs15 fw700 text-right"><?php echo e($case->registration_number); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.registration_date')); ?></td>
                                        <td class="fs15 fw700 text-right">
                                            <?php echo e(date($date_format_laravel, strtotime($case->registration_date))); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.cnr_no')); ?></td>
                                        <td class="fs15 fw700 text-right"> <?php echo e($case->cnr_number); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 hidden-small">

                            <table class="countries_list">
                                <tbody>

                                    <tr>
                                        <td><?php echo e(__('t.first_hearing_date')); ?></td>
                                        <td class="fs15 fw700 text-right s">
                                            <?php echo e(date($date_format_laravel, strtotime($case->first_hearing_date))); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.next_hearing_date')); ?></td>

                                        <?php if($adminHasPermition->can(['case_edit']) == '1'): ?>
                                            <td class="fs15 fw700 text-right">

                                                <?php echo e(date($date_format_laravel, strtotime($case->next_date))); ?>

                                                &nbsp;<a href="javascript:void(0);"
                                                    onClick="nextDateAdd(<?php echo e($case->case_id); ?>);">
                                                    <i class="fa fa-calendar"></i></a>
                                            </td>
                                        <?php else: ?>
                                            <td class="fs15 fw700 text-right">
                                                <?php echo e(date($date_format_laravel, strtotime($case->next_date))); ?>


                                                &nbsp;<a href="javascript:void(0);">
                                                    <i class="fa fa-calendar"></i></a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.case_status')); ?></td>
                                        <td class="fs15 fw700 text-right"><?php echo e($case->case_status_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.court_no')); ?>.</td>
                                        <td class="fs15 fw700 text-right"><?php echo e($case->court_no); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.judge')); ?></td>
                                        <td class="fs15 fw700 text-right"><?php echo e($case->judge_name); ?></td>
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
            <div class="x_panel">
                <div class="x_content">
                    <h3><?php echo e(__('t.case_level')); ?> - <strong
                            style="text-transform: uppercase"><?php echo e(__('t.' . $case->case_level) . ' '); ?></strong><a
                            class="btn btn-success" href="/admin/case/level/history/<?php echo e($case->case_id); ?>"
                            rel="noopener"><?php echo e(__('t.level_history')); ?></a></h3>
                    <div class="clearfix"></div>
                    <div class="accordion" id="case_view_accordian">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo e(__('t.add_hearing')); ?>

                                </button>
                            </div>
                            <div class="panel-body">
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#case_view_accordian">
                                    <div class="">
                                        <div class="level_form">
                                            <form action="/admin/case/add/hearing" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <input type="hidden" name="case_id" value="<?php echo e($case->case_id); ?>">
                                                    <input type="hidden" name="case_level"
                                                        value="<?php echo e($case->case_level); ?>">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="judcial_dept"><?php echo e(__('t.judcial_dept')); ?></label>
                                                        <input type="text" class="form-control" name="judcial_dept">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="floor"><?php echo e(__('t.floor')); ?></label>
                                                        <input type="text" class="form-control" name="floor">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="room"><?php echo e(__('t.room')); ?></label>
                                                        <input type="text" class="form-control" name="room">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="court_secretary"><?php echo e(__('t.court_secretary')); ?></label>
                                                        <input type="text" class="form-control" name="court_secretary">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="last_hearing"><?php echo e(__('t.last_hearing')); ?></label>
                                                        <input type="date" class="form-control" name="last_hearing">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="next_hearing"><?php echo e(__('t.next_hearing')); ?></label>
                                                        <input type="date" class="form-control" name="next_hearing">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label
                                                            for="last_requirements"><?php echo e(__('t.last_requirements')); ?></label>
                                                        <input type="text" class="form-control" name="last_requirements">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label
                                                            for="current_requirements"><?php echo e(__('t.current_requirements')); ?></label>
                                                        <input type="text" class="form-control"
                                                            name="current_requirements">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label
                                                            for="hearing_statement"><?php echo e(__('t.hearing_statement')); ?></label>
                                                        <input type="text" class="form-control"
                                                            name="hearing_statement">
                                                    </div>
                                                    <?php if($case->case_level == 'resumption'): ?>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_resumption"><?php echo e(__('t.date_of_resumption')); ?></label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_resumption">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level == 'excellece'): ?>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_excellence"><?php echo e(__('t.date_of_excellence')); ?></label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_excellence">
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if($case->case_level == 'expert'): ?>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_expert"><?php echo e(__('t.date_of_expert')); ?></label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_expert">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label for="expert_name"><?php echo e(__('t.expert_name')); ?></label>
                                                            <input type="text" class="form-control"
                                                                name="expert_name">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label for="section"><?php echo e(__('t.section')); ?></label>
                                                            <input type="text" class="form-control" name="section">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level == 'shapes'): ?>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_shapes"><?php echo e(__('t.date_of_shapes')); ?></label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_shapes">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label for="shape_number"><?php echo e(__('t.shape_number')); ?></label>
                                                            <input type="text" class="form-control"
                                                                name="shape_number">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-2">
                                                        <input class="btn btn-primary" type="submit"
                                                            value="<?php echo e(__('t.add')); ?>">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo e(__('t.add_judgement')); ?>

                                </button>
                            </div>
                            <div class="panel-body">
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#case_view_accordian">
                                    <form action="/admin/add/judgement" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <input type="hidden" name="case_id" value="<?php echo e($case->case_id); ?>">
                                            <input type="hidden" name="case_level" value="<?php echo e($case->case_level); ?>">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="j_from_date"><?php echo e(__('t.j_from_date')); ?></label>
                                                    <input type="date" name="j_from_date" id="j_from_date"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="case_type"><?php echo e(__('t.case_type')); ?></label>
                                                    <select id="case_type" name="case_type" class="form-control">
                                                        <option value="null">----</option>
                                                        <?php $__currentLoopData = $case_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($case_type->number_days); ?>">
                                                                <?php echo e($case_type->case_type_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="j_days"><?php echo e(__('t.days')); ?></label>
                                                    <input class="form-control" type="text" name="days"
                                                        id="j_days" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="j_date"><?php echo e(__('t.judgement_date')); ?></label>
                                                    <input type="text" name="j_date" id="j_date"
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="notes"><?php echo e(__('t.notes')); ?></label>
                                                    <textarea name="notes" class="form-control" id="notes" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" value="<?php echo e(__('t.add')); ?>"
                                                        class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo e(__('t.update_level')); ?>

                                </button>
                            </div>
                            <div class="panel-body">
                                <div id="collapseThree" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#case_view_accordian">
                                    <form action="/admin/level/save/<?php echo e($case->case_id); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname"><?php echo e(__('t.case_level')); ?> <span
                                                        class="text-danger">*</span></label>
                                                <select name="case_level" id="level_controller" class="form-control">
                                                    <option value="undefined">-----</option>
                                                    <?php if($case->case_level != 'police'): ?>
                                                        <option value="police"><?php echo e(__('t.police')); ?></option>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level != 'prosecution'): ?>
                                                        <option value="prosecution"><?php echo e(__('t.prosecution')); ?></option>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level != 'first-degree'): ?>
                                                        <option value="first-degree"><?php echo e(__('t.first-degree')); ?></option>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level != 'resumption'): ?>
                                                        <option value="resumption"><?php echo e(__('t.resumption')); ?></option>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level != 'excellence'): ?>
                                                        <option value="excellence"><?php echo e(__('t.excellence')); ?></option>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level != 'expert'): ?>
                                                        <option value="expert"><?php echo e(__('t.expert')); ?></option>
                                                    <?php endif; ?>
                                                    <?php if($case->case_level != 'shapes'): ?>
                                                        <option value="shapes"><?php echo e(__('t.shapes')); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                <label for="case_number"><?php echo e(__('t.case_number')); ?></label>
                                                <input type="text" name="case_number" class="form-control">
                                            </div>
                                            
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="police_station"><?php echo e(__('t.police_station')); ?></label>
                                                <input type="text" name="police_station" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="officer"><?php echo e(__('t.officer')); ?></label>
                                                <input type="text" name="officer" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="reg_date"><?php echo e(__('t.reg_date')); ?></label>
                                                <input type="date" name="reg_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="decision"><?php echo e(__('t.decision')); ?></label>
                                                <input type="text" name="decision" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="dec_date"><?php echo e(__('t.dec_date')); ?></label>
                                                <input type="date" name="dec_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="rel_date"><?php echo e(__('t.rel_date')); ?></label>
                                                <input type="date" name="rel_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="warranty"><?php echo e(__('t.warranty')); ?></label>
                                                <input type="text" name="warranty" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="date_payment"><?php echo e(__('t.date_payment')); ?></label>
                                                <input type="date" name="date_payment" class="form-control">
                                            </div>
                                            
                                            
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="pros_type"><?php echo e(__('t.pros_type')); ?></label>
                                                <input type="text" name="pros_type" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="officer"><?php echo e(__('t.officer')); ?></label>
                                                <input type="text" name="officer" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="summon"><?php echo e(__('t.summon')); ?></label>
                                                <input type="date" name="summon" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="summon_next"><?php echo e(__('t.summon_next')); ?></label>
                                                <input type="date" name="summon_next" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="decision"><?php echo e(__('t.decision')); ?></label>
                                                <input type="text" name="decision" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="dec_date"><?php echo e(__('t.dec_date')); ?></label>
                                                <input type="date" name="dec_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="rel_date"><?php echo e(__('t.rel_date')); ?></label>
                                                <input type="date" name="rel_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="warranty"><?php echo e(__('t.warranty')); ?></label>
                                                <input type="text" name="warranty" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="date_payment"><?php echo e(__('t.date_payment')); ?></label>
                                                <input type="date" name="date_payment" class="form-control">
                                            </div>
                                            

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                <label for="level_notes"><?php echo e(__('t.level_notes')); ?></label>
                                                <textarea name="level_notes" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary"
                                                    value="<?php echo e(__('t.update')); ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="current_level">
                        <div class="container">
                            <table class="table">
                                <?php if($case->case_level != 'police' && $case->case_level != 'prosecution'): ?>
                                    <tr>
                                        <td><?php echo e(__('t.judcial_dept')); ?></td>
                                        <td><?php echo e($current_level->judcial_dept); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.floor')); ?></td>
                                        <td><?php echo e($current_level->floor); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.room')); ?></td>
                                        <td><?php echo e($current_level->room); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.court_secretary')); ?></td>
                                        <td><?php echo e($current_level->court_secretary); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.last_hearing')); ?></td>
                                        <td><?php echo e($current_level->last_hearing); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.next_hearing')); ?></td>
                                        <td><?php echo e($current_level->next_hearing); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.last_requirements')); ?></td>
                                        <td><?php echo e($current_level->last_requirements); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.current_requirements')); ?></td>
                                        <td><?php echo e($current_level->current_requirements); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.hearing_statement')); ?></td>
                                        <td><?php echo e($current_level->hearing_statement); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($case->case_level == 'police'): ?>
                                    <tr>
                                        <td><?php echo e(__('t.police_station')); ?></td>
                                        <td><?php echo e($current_level->ps_station); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.officer')); ?></td>
                                        <td><?php echo e($current_level->officer); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.decision')); ?></td>
                                        <td><?php echo e($current_level->decision); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.dec_date')); ?></td>
                                        <td><?php echo e($current_level->dec_date); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.rel_date')); ?></td>
                                        <td><?php echo e($current_level->rel_date); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.warranty')); ?></td>
                                        <td><?php echo e($current_level->warranty); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.date_payment')); ?></td>
                                        <td><?php echo e($current_level->date_payment); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($case->case_level == 'prosecution'): ?>
                                    <tr>
                                        <td><?php echo e(__('t.pros_type')); ?></td>
                                        <td><?php echo e($current_level->pros_type); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.pros_name')); ?></td>
                                        <td><?php echo e($current_level->pros_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.pros_next_summon_date')); ?></td>
                                        <td><?php echo e($current_level->pros_next_summon_date); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.pros_summon')); ?></td>
                                        <td><?php echo e($current_level->pros_summon); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><?php echo e(__('t.decision')); ?></td>
                                        <td><?php echo e($current_level->decision); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.dec_date')); ?></td>
                                        <td><?php echo e($current_level->dec_date); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.rel_date')); ?></td>
                                        <td><?php echo e($current_level->rel_date); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.warranty')); ?></td>
                                        <td><?php echo e($current_level->warranty); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.date_payment')); ?></td>
                                        <td><?php echo e($current_level->date_payment); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($case->case_level != 'first-degree'): ?>
                                <?php endif; ?>
                                <?php if($case->case_level != 'resumption'): ?>
                                <?php endif; ?>
                                <?php if($case->case_level != 'excellence'): ?>
                                <?php endif; ?>
                                <?php if($case->case_level == 'expert'): ?>
                                    <tr>
                                        <td><?php echo e(__('t.date_of_expert')); ?></td>
                                        <td><?php echo e($current_level->date_of_expert); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.expert_name')); ?></td>
                                        <td><?php echo e($current_level->expert_name); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('t.section')); ?></td>
                                        <td><?php echo e($current_level->section); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($case->case_level != 'shapes'): ?>
                                <?php endif; ?>
                            </table>
                            <div class="col-md-2">
                                <a class="btn btn-success" href="/admin/case/hearing/history/<?php echo e($case->case_id); ?>"
                                    rel="noopener"><?php echo e(__('t.hearing_history')); ?></a>
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-success" href="/admin/history/judgement/<?php echo e($case->case_id); ?>"
                                    rel="noopener"><?php echo e(__('t.judgement_history')); ?></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <div class="col-md-6 hidden-small">
                            <h4 class="line_30"><?php echo e(__('t.petioner_and_advocate')); ?></h4>


                            <table class="countries_list">
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php if(count($petitioner_and_advocate) > 0 && !empty($petitioner_and_advocate)): ?>
                                                <?php $i=1; ?> <?php $__currentLoopData = $petitioner_and_advocate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p class="subscri-ti-das"> <?php echo e($i . ') ' . $value['party_name']); ?></p>
                                                    <p class="subscri-ti-das"> Advocate - <?php echo e($value['party_advocate']); ?>

                                                    </p>
                                                    <?php $i++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 hidden-small">
                            <h4 class="line_30"><?php echo e(__('t.respondent_and_advocate')); ?></h4>

                            <table class="countries_list">
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php if(count($respondent_and_advocate) > 0 && !empty($respondent_and_advocate)): ?>
                                                <?php $i=1; ?> <?php $__currentLoopData = $respondent_and_advocate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p class="subscri-ti-das"> <?php echo e($i . ') ' . $value['party_name']); ?></p>
                                                    <p class="subscri-ti-das"> Advocate - <?php echo e($value['party_advocate']); ?>

                                                    </p>
                                                    <?php $i++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>

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
        <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <h4 class="line_30">
                            <?php echo e(__('t.documents')); ?>

                        </h4>
                        <form action="/admin/upload-document" method="POST" enctype="multipart/form-data"
                            id="uplaod_docuemt">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="case_doc"><?php echo e(__('t.attach_document')); ?></label>
                                <input required type="file" name="case_doc" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="cid" value="<?php echo e($docuemts['id']); ?>">
                                <input type="submit" class="btn btn-primary" value="<?php echo e(__('t.upload')); ?>">
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('t.name')); ?></th>
                                    <th><?php echo e(__('t.uploaded_on')); ?></th>
                                    <th><?php echo e(__('t.actions')); ?></th>
                                </tr>
                            <tbody>
                                <?php $__currentLoopData = $docuemts['documents']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->name); ?></td>
                                        <td><?php echo e($item->uploaded_on); ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="<?php echo e($item->url); ?>"><i
                                                    class="fa fa-eye"></i></a>
                                            <button doc_id="<?php echo e($item->id); ?>" type="button"
                                                class="btn btn-danger deleteButton" data-toggle="modal"
                                                data-target="#deleteModal">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            </thead>
                        </table>
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModal"><?php echo e(__('t.sure_to_delete')); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php echo e(__('t.delete_text')); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"data-dismiss="modal"
                                            class="btn btn-secondary"><?php echo e(__('t.cancel')); ?></button>
                                        <a type="button" class="btn btn-primary deleteConfirm"><?php echo e(__('t.delete')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <a href="/admin/delete/case/<?php echo e($case->case_id); ?>" class="btn btn-danger"><?php echo e(__('t.delete')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <div id="load-modal"></div>


    <div class="modal fade" id="modal-next-date" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal_next_date">

            </div>
        </div>
    </div>

    <input type="hidden" name="getNextDateModals" id="getNextDateModals" value="<?php echo e(url('admin/getNextDateModal')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/js/case/case_view_detail.js')); ?>"></script>
    <script>
        let url = "";
        $('.deleteButton').click((e) => {
            let id = $(e.target).attr('doc_id');
            url = "/admin/delete/document/" + id;
            $('#deleteModal').show();
        });
        $('#deleteModal').on('show.bs.modal', function(event) {
            $('.deleteConfirm').click((e) => {
                window.location.assign(url);
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>