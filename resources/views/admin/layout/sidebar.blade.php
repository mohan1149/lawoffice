<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">

        <ul class="nav side-menu">
            @if($adminHasPermition->can(['dashboard_list'])=="1")
                <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-tachometer"></i> {{__("t.dashboard")}}</a></li>
            @endif

            @if($adminHasPermition->can(['client_list']) =="1")
                <li><a href="{{ route('clients.index') }}"><i class="fa fa-user-plus"></i> {{__("t.clients")}}</a></li>
            @endif

            @if($adminHasPermition->can(['case_list']) =="1")
                <li><a href="{{ route('case-running.index') }}"><i class="fa fa-gavel"></i> {{__("t.cases")}}</a></li>

            @endif
            @if($adminHasPermition->can(['task_list']) =="1")
                <li><a href="{{ route('tasks.index') }}"><i class="fa fa-tasks"></i> {{__("t.tasks")}}</a></li>
            @endif


            @if($adminHasPermition->can(['appointment_list']) =="1")
                <li><a href="{{ route('appointment.index') }}"><i class="fa fa-calendar-plus-o"></i> {{__("t.appointments")}}</a>
                </li>

            @endif
            @if(\Auth::guard('admin')->user()->user_type=="Admin")
                
                <li><a href="/admin/notices"><i class="fa fa-clipboard"></i>  {{__("t.notices")}} </a>
                <li><a href="/admin/executions"><i class="fa fa-balance-scale"></i>  {{__("t.executions")}} </span></a>
                {{-- <li><a href="/admin/case/levels"><i class="fa fa-align-center"></i>  {{__("t.case_levels")}} </span></a> --}}
                <li><a href="/admin/case/roll"><i class="fa fa-list"></i>  {{__("t.roll")}} </span></a>
                <li><a><i class="fa fa-users"></i>  {{__("t.team_members")}} <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('admin/client_user') }}"> {{__('t.team_member')}}</a></li>
                        <li><a href="{{ route('role.index') }}">{{__("t.role")}}</a></li>
                    </ul>
                </li>
            @endif
            @if($adminHasPermition->can(['service_list']) == "1" || $adminHasPermition->can(['invoice_list'])=="1")
                <li><a><i class="fa fa-money"></i> {{__("t.income")}} <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        @if($adminHasPermition->can(['service_list']) == "1")
                            <li><a href="{{ url('admin/service') }}">{{__("t.service")}}</a></li>
                        @endif

                        @if($adminHasPermition->can(['invoice_list']) == "1")
                            <li><a href="{{ url('admin/invoice') }}">{{__("t.invoice")}}</a>
                        @endif


                    </ul>
                </li>
            @endif
            @if($adminHasPermition->can(['vendor_list']) =="1")
                <li><a href="{{ route('vendor.index') }}"><i class="fa fa-user-plus"></i> {{__("t.vendor")}}</a></li>
            @endif

            @if($adminHasPermition->can(['expense_type_list'])=="1" || $adminHasPermition->can(['expense_list'])=="1")
                <li><a><i class="fa fa-money"></i> {{__("t.expense")}} <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                        @if($adminHasPermition->can(['expense_type_list']) =="1")
                            <li><a href="{{ url('admin/expense-type') }}">{{__("t.expense_type")}}</a></li>
                        @endif


                        @if($adminHasPermition->can(['expense_list']) =="1")
                            <li><a href="{{ url('admin/expense') }}">{{__("t.expense")}}</a></li>
                        @endif

                    </ul>
                </li>

            @endif


            @if($adminHasPermition->can(['case_type_list'])=="1"
            || $adminHasPermition->can(['court_type_list'])=="1"
            || $adminHasPermition->can(['court_list'])=="1"
            || $adminHasPermition->can(['case_status_list'])=="1"
            || $adminHasPermition->can(['judge_list'])=="1"
            || $adminHasPermition->can(['tax_list'])=="1"
            || $adminHasPermition->can(['general_setting_edit'])=="1")
                <li><a><i class="fa fa-gear"></i> {{__("t.settings")}} <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('admin/judge-time-low') }}">{{__("t.judgement_time_lows")}}</a></li>
                        @if($adminHasPermition->can(['case_type_list']) == "1")
                            <li><a href="{{ url('admin/case-type') }}">{{__("t.case_type")}}</a></li>
                        @endif

                        @if($adminHasPermition->can(['court_type_list']) == "1")
                            <li><a href="{{ url('admin/court-type') }}">{{__("t.court_type")}}</a></li>
                        @endif

                        @if($adminHasPermition->can(['court_list']) == "1")
                            <li><a href="{{ url('admin/court') }}">{{__("t.courts")}}</a></li>
                        @endif

                        @if($adminHasPermition->can(['case_status_list']) == "1")
                            <li><a href="{{ url('admin/case-status') }}">{{__('t.case_status')}}</a></li>
                        @endif

                        @if($adminHasPermition->can(['judge_list']) == "1")
                            <li><a href="{{ url('admin/judge') }}">{{__("t.judge_type")}}</a></li>
                        @endif

                        {{-- @if($adminHasPermition->can(['tax_list']) == "1")
                            <li><a href="{{ url('admin/tax') }}">{{__("t.tax")}}</a></li>
                        @endif --}}


                        @if($adminHasPermition->can(['general_setting_edit']) == "1")
                            <li><a href="{{ url('admin/general-setting') }}">{{__("t.general_setting")}}</a></li>
                        @endif
                        @if(\Auth::guard('admin')->user()->user_type=="Admin")
                            <li><a href="{{ url('admin/database-backup') }}">{{__("t.database_backup")}}</a></li>
                        @endif

                    </ul>
                </li>
            @endif
            <li><a href="{{ url('admin/timeslots') }}"><i class="fa fa-calendar"></i> {{__("t.calendar")}}</a></li>
            <li><a href="{{ url('admin/sliders') }}"><i class="fa fa-image"></i> {{__("t.sliders")}}</a></li>
            <li><a href="{{ url('admin/consultations') }}"><i class="fa fa-users"></i> {{__("t.consultations")}}</a></li>
        </ul>
    </div>
</div>