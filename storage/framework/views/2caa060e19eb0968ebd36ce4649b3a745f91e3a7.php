<div class="x_title">
    <h2> Case</h2>
    <ul class="nav navbar-right panel_toolbox">
        <li>

            <a class="card-header-color"  href="<?php echo e(url('admin/case-running-download/'.$case->case_id.'/download')); ?>"
               title="Download case file"><i class="fa fa-download fa-2x "></i></a>
        </li>
        <li>
            <a class="card-header-color"  href="<?php echo e(url('admin/case-running-download/'.$case->case_id.'/print')); ?>"
               title="Print case file" target="_blank"><i class="fa fa-print fa-2x"></i></a>
        </li>

    </ul>
    <div class="clearfix"></div>
</div>

<br>
<div class="" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
        <li role="presentation" class="<?php if(Request::segment(2)=='case-running'): ?>active @ else <?php endif; ?>"><a
                href="<?php echo e(route('case-running.show',$case->case_id)); ?>"><?php echo e(__("t.detail")); ?></a>
        </li>
        <li role="presentation" class="<?php if(Request::segment(4)=='histroy'): ?>active @ else <?php endif; ?>"><a
                href="<?php echo e(url( 'admin/case-history/'.$case->case_id)); ?>"><?php echo e(__("t.history")); ?></a>

        </li>
        <li role="presentation" class="<?php if(Request::segment(4)=='transfer'): ?>active @ else <?php endif; ?>"><a
                href="<?php echo e(url('admin/case-transfer/'.$case->case_id)); ?>"><?php echo e(__("t.transfer")); ?></a>
        </li>
        <?php if($adminHasPermition->can(['case_edit']) =="1"): ?>
            <li role="presentation" class="pull-right udt-nd"><a href="javascript:void(0);"
                                                                 onClick="nextDateAdd(<?php echo e($case->case_id); ?>);"><i
                        class="fa fa-calendar"></i> <?php echo e(__("t.update_next_date")); ?></a>
            </li>
        <?php else: ?>
            <li role="presentation" class="pull-right udt-nd"><a href="javascript:void(0);"><i
                        class="fa fa-calendar"></i><?php echo e(__("t.update_next_date")); ?></a>
            </li>
        <?php endif; ?>
    </ul>

</div>
