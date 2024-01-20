@extends('admin.layout.app')
@section('title',__("t.level_history"))
@section('content')
    <div class="container" style="padding: 15px;margin:15px;margin-top:50px">
        @foreach ($levels as $level)
            <div class="panel panel-info">

                <a class="btn btn-danger" href="/admin/delete/level/{{ $level->lid }}"
                    style="float: right">{{ __('t.delete') }}</a>
                <div class="panel-heading" style="text-align: center;font-size:20px">
                    <h2 style="text-transform: uppercase">
                        {{ __("t.".$level->case_level) }}
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="container">
                        <table class="table">
                            <tr>
                                <td>{{ __("t.case_number") }}</td>
                                <td>{{ $level->case_num }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.level_notes") }}</td>
                                <td>{{ $level->level_notes }}</td>
                            </tr>
                        </table>
                        {{-- @if ($level->case_level == 'police')
                            <div class="container">
                                <table class="table">
                                    <tr>
                                        <td>{{ __("t.detective") }}</td>
                                        <td>{{ $level->detective }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.police_decision") }}</td>
                                        <td>{{ $level->police_decision }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.police_decision_date") }}</td>
                                        <td>{{ $level->police_decision_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.police_release_date") }}</td>
                                        <td>{{ $level->police_release_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.police_warranty_value") }}</td>
                                        <td>{{ $level->police_warranty_value }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.police_date_payment") }}</td>
                                        <td>{{ $level->police_date_payment }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if ($level->case_level == 'prosecution')
                            <table class="table">
                                <tr>
                                    <td>{{ __("t.pros_type") }}</td>
                                    <td>{{ $level->pros_type }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_name") }}</td>
                                    <td>{{ $level->pros_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_sec_name") }}</td>
                                    <td>{{ $level->pros_sec_name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_summon_date") }}</td>
                                    <td>{{ $level->pros_summon_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_next_summon_date") }}</td>
                                    <td>{{ $level->pros_next_summon_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_decision") }}</td>
                                    <td>{{ $level->pros_decision }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_decision_date") }}</td>
                                    <td>{{ $level->pros_decision_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_release_date") }}</td>
                                    <td>{{ $level->pros_release_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_warranty") }}</td>
                                    <td>{{ $level->pros_warranty }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __("t.pros_date_pay") }}</td>
                                    <td>{{ $level->pros_date_pay }}</td>
                                </tr>
                            </table>
                        @endif
                        @if ($level->case_level == 'first_degree')
                            <div class="container">
                                <table class="table">
                                    <tr>
                                        <td>{{ __("t.fd_jud_dept") }}</td>
                                        <td>{{ $level->fd_jud_dept }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_floor") }}</td>
                                        <td>{{ $level->fd_floor }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_room") }}</td>
                                        <td>{{ $level->fd_room }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_sec") }}</td>
                                        <td>{{ $level->fd_sec }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_last_hear") }}</td>
                                        <td>{{ $level->fd_last_hear }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_next_hear") }}</td>
                                        <td>{{ $level->fd_next_hear }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_last_req") }}</td>
                                        <td>{{ $level->fd_last_req }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_now_req") }}</td>
                                        <td>{{ $level->fd_now_req }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_statement") }}</td>
                                        <td>{{ $level->fd_statement }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.fd_judge_date") }}</td>
                                        <td>{{ $level->fd_judge_date }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if ($level->case_level == 'resumption')
                            <div class="container">
                                <table class="table">
                                    <tr>
                                        <td>{{ __("t.res_court_type") }}</td>
                                        <td>{{ $level->res_court_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.res_floor") }}</td>
                                        <td>{{ $level->res_floor }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.res_room") }}</td>
                                        <td>{{ $level->res_room }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.res_date") }}</td>
                                        <td>{{ $level->res_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.res_jud_dept") }}</td>
                                        <td>{{ $level->res_jud_dept }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.res_court_sec") }}</td>
                                        <td>{{ $level->res_court_sec }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.res_hear_req") }}</td>
                                        <td>{{ $level->res_hear_req }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.res_judge_date") }}</td>
                                        <td>{{ $level->res_judge_date }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if ($level->case_level == 'excellece')
                            <div class="container">
                                <table class="table">
                                    <tr>
                                        <td>{{ __("t.excel_court_type") }}</td>
                                        <td>{{ $level->excel_court_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.excel_floor") }}</td>
                                        <td>{{ $level->excel_floor }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.excel_room") }}</td>
                                        <td>{{ $level->excel_room }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.excel_date") }}</td>
                                        <td>{{ $level->excel_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.excel_jud_dept") }}</td>
                                        <td>{{ $level->excel_jud_dept }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.excel_court_sec") }}</td>
                                        <td>{{ $level->excel_court_sec }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.excel_hear_req") }}</td>
                                        <td>{{ $level->excel_hear_req }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if ($level->case_level == 'expert')
                            <div class="container">
                                <table class="table">
                                    <tr>
                                        <td>{{ __("t.exp_court_type") }}</td>
                                        <td>{{ $level->exp_court_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.exp_floor") }}</td>
                                        <td>{{ $level->exp_floor }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.exp_room") }}</td>
                                        <td>{{ $level->exp_room }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.exp_date") }}</td>
                                        <td>{{ $level->exp_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.exp_jud_dept") }}</td>
                                        <td>{{ $level->exp_jud_dept }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.exp_name") }}</td>
                                        <td>{{ $level->exp_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.exp_section") }}</td>
                                        <td>{{ $level->exp_section }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.exp_hear_req") }}</td>
                                        <td>{{ $level->exp_hear_req }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if ($level->case_level == 'shapes')
                            <div class="container">
                                <table class="table">
                                    <tr>
                                        <td>{{ __("t.shapes_date") }}</td>
                                        <td>{{ $level->shapes_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.shapes_floor") }}</td>
                                        <td>{{ $level->shapes_floor }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.shapes_room") }}</td>
                                        <td>{{ $level->shapes_room }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.shapes_num") }}</td>
                                        <td>{{ $level->shapes_num }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.shapes_sec") }}</td>
                                        <td>{{ $level->shapes_sec }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.shapes_jud_dept") }}</td>
                                        <td>{{ $level->shapes_jud_dept }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.shapes_hear_req") }}</td>
                                        <td>{{ $level->shapes_hear_req }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
            <i class="glyphicon glyphicon-arrow-up" aria-hidden="true" style="display:flex;justify-content: center;padding: 5px;font-size:20px;"></i>
        @endforeach
    </div>
@endsection