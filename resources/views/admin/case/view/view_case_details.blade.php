@extends('admin.layout.app')
@section('title', 'Case List')
@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    @include('admin.case.view.card_header')
                    <div class="dashboard-widget-content">
                        <h2 class="line_30 case_detail-m-f-10">{{ __('t.case_details') }}l</h2>
                        <div class="col-md-6 hidden-small">


                            <table class="countries_list">
                                <tbody>
                                    <tr>
                                        <td>{{ __('t.case_type') }}</td>
                                        <td class="fs15 fw700 text-right">{{ $case->caseType }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.filling_no') }}</td>
                                        <td class="fs15 fw700 text-right">{{ $case->filing_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.filling_date') }}</td>
                                        <td class="fs15 fw700 text-right">
                                            {{ date($date_format_laravel, strtotime($case->filing_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.registration_no') }}</td>
                                        <td class="fs15 fw700 text-right">{{ $case->registration_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.registration_date') }}</td>
                                        <td class="fs15 fw700 text-right">
                                            {{ date($date_format_laravel, strtotime($case->registration_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.cnr_no') }}</td>
                                        <td class="fs15 fw700 text-right"> {{ $case->cnr_number }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 hidden-small">

                            <table class="countries_list">
                                <tbody>

                                    <tr>
                                        <td>{{ __('t.first_hearing_date') }}</td>
                                        <td class="fs15 fw700 text-right s">
                                            {{ date($date_format_laravel, strtotime($case->first_hearing_date)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.next_hearing_date') }}</td>

                                        @if ($adminHasPermition->can(['case_edit']) == '1')
                                            <td class="fs15 fw700 text-right">

                                                {{ date($date_format_laravel, strtotime($case->next_date)) }}
                                                &nbsp;<a href="javascript:void(0);"
                                                    onClick="nextDateAdd({{ $case->case_id }});">
                                                    <i class="fa fa-calendar"></i></a>
                                            </td>
                                        @else
                                            <td class="fs15 fw700 text-right">
                                                {{ date($date_format_laravel, strtotime($case->next_date)) }}

                                                &nbsp;<a href="javascript:void(0);">
                                                    <i class="fa fa-calendar"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.case_status') }}</td>
                                        <td class="fs15 fw700 text-right">{{ $case->case_status_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.court_no') }}.</td>
                                        <td class="fs15 fw700 text-right">{{ $case->court_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.judge') }}</td>
                                        <td class="fs15 fw700 text-right">{{ $case->judge_name }}</td>
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
                    <h3>{{ __('t.case_level') }} - <strong
                            style="text-transform: uppercase">{{ __('t.' . $case->case_level) . ' ' }}</strong><a
                            class="btn btn-success" href="/admin/case/level/history/{{ $case->case_id }}"
                            rel="noopener">{{ __('t.level_history') }}</a></h3>
                    <div class="clearfix"></div>
                    <div class="accordion" id="case_view_accordian">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ __('t.add_hearing') }}
                                </button>
                            </div>
                            <div class="panel-body">
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#case_view_accordian">
                                    <div class="">
                                        <div class="level_form">
                                            <form action="/admin/case/add/hearing" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="case_id" value="{{ $case->case_id }}">
                                                    <input type="hidden" name="case_level"
                                                        value="{{ $case->case_level }}">
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="judcial_dept">{{ __('t.judcial_dept') }}</label>
                                                        <input type="text" class="form-control" name="judcial_dept">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="floor">{{ __('t.floor') }}</label>
                                                        <input type="text" class="form-control" name="floor">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="room">{{ __('t.room') }}</label>
                                                        <input type="text" class="form-control" name="room">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="court_secretary">{{ __('t.court_secretary') }}</label>
                                                        <input type="text" class="form-control" name="court_secretary">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="last_hearing">{{ __('t.last_hearing') }}</label>
                                                        <input type="date" class="form-control" name="last_hearing">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label for="next_hearing">{{ __('t.next_hearing') }}</label>
                                                        <input type="date" class="form-control" name="next_hearing">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label
                                                            for="last_requirements">{{ __('t.last_requirements') }}</label>
                                                        <input type="text" class="form-control" name="last_requirements">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label
                                                            for="current_requirements">{{ __('t.current_requirements') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="current_requirements">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                        <label
                                                            for="hearing_statement">{{ __('t.hearing_statement') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="hearing_statement">
                                                    </div>
                                                    @if ($case->case_level == 'resumption')
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_resumption">{{ __('t.date_of_resumption') }}</label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_resumption">
                                                        </div>
                                                    @endif
                                                    @if ($case->case_level == 'excellece')
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_excellence">{{ __('t.date_of_excellence') }}</label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_excellence">
                                                        </div>
                                                    @endif

                                                    @if ($case->case_level == 'expert')
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_expert">{{ __('t.date_of_expert') }}</label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_expert">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label for="expert_name">{{ __('t.expert_name') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="expert_name">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label for="section">{{ __('t.section') }}</label>
                                                            <input type="text" class="form-control" name="section">
                                                        </div>
                                                    @endif
                                                    @if ($case->case_level == 'shapes')
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label
                                                                for="date_of_shapes">{{ __('t.date_of_shapes') }}</label>
                                                            <input type="date" class="form-control"
                                                                name="date_of_shapes">
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                            <label for="shape_number">{{ __('t.shape_number') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="shape_number">
                                                        </div>
                                                    @endif
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-2">
                                                        <input class="btn btn-primary" type="submit"
                                                            value="{{ __('t.add') }}">
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
                                    {{ __('t.add_judgement') }}
                                </button>
                            </div>
                            <div class="panel-body">
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#case_view_accordian">
                                    <form action="/admin/add/judgement" method="POST">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="case_id" value="{{ $case->case_id }}">
                                            <input type="hidden" name="case_level" value="{{ $case->case_level }}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="j_from_date">{{ __('t.j_from_date') }}</label>
                                                    <input type="date" name="j_from_date" id="j_from_date"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="case_type">{{ __('t.case_type') }}</label>
                                                    <select id="case_type" name="case_type" class="form-control">
                                                        <option value="null">----</option>
                                                        @foreach ($case_types as $case_type)
                                                            <option value="{{ $case_type->number_days }}">
                                                                {{ $case_type->case_type_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="j_days">{{ __('t.days') }}</label>
                                                    <input class="form-control" type="text" name="days"
                                                        id="j_days" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="j_date">{{ __('t.judgement_date') }}</label>
                                                    <input type="text" name="j_date" id="j_date"
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="notes">{{ __('t.notes') }}</label>
                                                    <textarea name="notes" class="form-control" id="notes" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" value="{{ __('t.add') }}"
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
                                    {{ __('t.update_level') }}
                                </button>
                            </div>
                            <div class="panel-body">
                                <div id="collapseThree" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#case_view_accordian">
                                    <form action="/admin/level/save/{{ $case->case_id }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                <label for="fullname">{{ __('t.case_level') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="case_level" id="level_controller" class="form-control">
                                                    <option value="undefined">-----</option>
                                                    @if ($case->case_level != 'police')
                                                        <option value="police">{{ __('t.police') }}</option>
                                                    @endif
                                                    @if ($case->case_level != 'prosecution')
                                                        <option value="prosecution">{{ __('t.prosecution') }}</option>
                                                    @endif
                                                    @if ($case->case_level != 'first-degree')
                                                        <option value="first-degree">{{ __('t.first-degree') }}</option>
                                                    @endif
                                                    @if ($case->case_level != 'resumption')
                                                        <option value="resumption">{{ __('t.resumption') }}</option>
                                                    @endif
                                                    @if ($case->case_level != 'excellence')
                                                        <option value="excellence">{{ __('t.excellence') }}</option>
                                                    @endif
                                                    @if ($case->case_level != 'expert')
                                                        <option value="expert">{{ __('t.expert') }}</option>
                                                    @endif
                                                    @if ($case->case_level != 'shapes')
                                                        <option value="shapes">{{ __('t.shapes') }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                                <label for="case_number">{{ __('t.case_number') }}</label>
                                                <input type="text" name="case_number" class="form-control">
                                            </div>
                                            {{-- police --}}
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="police_station">{{ __('t.police_station') }}</label>
                                                <input type="text" name="police_station" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="officer">{{ __('t.officer') }}</label>
                                                <input type="text" name="officer" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="reg_date">{{ __('t.reg_date') }}</label>
                                                <input type="date" name="reg_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="decision">{{ __('t.decision') }}</label>
                                                <input type="text" name="decision" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="dec_date">{{ __('t.dec_date') }}</label>
                                                <input type="date" name="dec_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="rel_date">{{ __('t.rel_date') }}</label>
                                                <input type="date" name="rel_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="warranty">{{ __('t.warranty') }}</label>
                                                <input type="text" name="warranty" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                                <label for="date_payment">{{ __('t.date_payment') }}</label>
                                                <input type="date" name="date_payment" class="form-control">
                                            </div>
                                            {{-- end --}}
                                            {{-- pros --}}
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="pros_type">{{ __('t.pros_type') }}</label>
                                                <input type="text" name="pros_type" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="officer">{{ __('t.officer') }}</label>
                                                <input type="text" name="officer" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="summon">{{ __('t.summon') }}</label>
                                                <input type="date" name="summon" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="summon_next">{{ __('t.summon_next') }}</label>
                                                <input type="date" name="summon_next" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="decision">{{ __('t.decision') }}</label>
                                                <input type="text" name="decision" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="dec_date">{{ __('t.dec_date') }}</label>
                                                <input type="date" name="dec_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="rel_date">{{ __('t.rel_date') }}</label>
                                                <input type="date" name="rel_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="warranty">{{ __('t.warranty') }}</label>
                                                <input type="text" name="warranty" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                                <label for="date_payment">{{ __('t.date_payment') }}</label>
                                                <input type="date" name="date_payment" class="form-control">
                                            </div>
                                            {{-- end --}}

                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                                <label for="level_notes">{{ __('t.level_notes') }}</label>
                                                <textarea name="level_notes" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-primary"
                                                    value="{{ __('t.update') }}">
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
                                @if ($case->case_level != 'police' && $case->case_level != 'prosecution')
                                    <tr>
                                        <td>{{ __('t.judcial_dept') }}</td>
                                        <td>{{ $current_level->judcial_dept }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.floor') }}</td>
                                        <td>{{ $current_level->floor }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.room') }}</td>
                                        <td>{{ $current_level->room }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.court_secretary') }}</td>
                                        <td>{{ $current_level->court_secretary }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.last_hearing') }}</td>
                                        <td>{{ $current_level->last_hearing }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.next_hearing') }}</td>
                                        <td>{{ $current_level->next_hearing }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.last_requirements') }}</td>
                                        <td>{{ $current_level->last_requirements }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.current_requirements') }}</td>
                                        <td>{{ $current_level->current_requirements }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.hearing_statement') }}</td>
                                        <td>{{ $current_level->hearing_statement }}</td>
                                    </tr>
                                @endif
                                @if ($case->case_level == 'police')
                                    <tr>
                                        <td>{{ __('t.police_station') }}</td>
                                        <td>{{ $current_level->ps_station }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.officer') }}</td>
                                        <td>{{ $current_level->officer }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.decision') }}</td>
                                        <td>{{ $current_level->decision }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.dec_date') }}</td>
                                        <td>{{ $current_level->dec_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.rel_date') }}</td>
                                        <td>{{ $current_level->rel_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.warranty') }}</td>
                                        <td>{{ $current_level->warranty }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.date_payment') }}</td>
                                        <td>{{ $current_level->date_payment }}</td>
                                    </tr>
                                @endif
                                @if ($case->case_level == 'prosecution')
                                    <tr>
                                        <td>{{ __('t.pros_type') }}</td>
                                        <td>{{ $current_level->pros_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.pros_name') }}</td>
                                        <td>{{ $current_level->pros_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.pros_next_summon_date') }}</td>
                                        <td>{{ $current_level->pros_next_summon_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.pros_summon') }}</td>
                                        <td>{{ $current_level->pros_summon }}</td>
                                    </tr>
                                    {{-- <tr>
                                    <td>{{ __("t.officer") }}</td>
                                    <td>{{ $current_level->officer }}</td>
                                </tr> --}}
                                    <tr>
                                        <td>{{ __('t.decision') }}</td>
                                        <td>{{ $current_level->decision }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.dec_date') }}</td>
                                        <td>{{ $current_level->dec_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.rel_date') }}</td>
                                        <td>{{ $current_level->rel_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.warranty') }}</td>
                                        <td>{{ $current_level->warranty }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.date_payment') }}</td>
                                        <td>{{ $current_level->date_payment }}</td>
                                    </tr>
                                @endif
                                @if ($case->case_level != 'first-degree')
                                @endif
                                @if ($case->case_level != 'resumption')
                                @endif
                                @if ($case->case_level != 'excellence')
                                @endif
                                @if ($case->case_level == 'expert')
                                    <tr>
                                        <td>{{ __('t.date_of_expert') }}</td>
                                        <td>{{ $current_level->date_of_expert }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.expert_name') }}</td>
                                        <td>{{ $current_level->expert_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('t.section') }}</td>
                                        <td>{{ $current_level->section }}</td>
                                    </tr>
                                @endif
                                @if ($case->case_level != 'shapes')
                                @endif
                            </table>
                            <div class="col-md-2">
                                <a class="btn btn-success" href="/admin/case/hearing/history/{{ $case->case_id }}"
                                    rel="noopener">{{ __('t.hearing_history') }}</a>
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-success" href="/admin/history/judgement/{{ $case->case_id }}"
                                    rel="noopener">{{ __('t.judgement_history') }}</a>
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
                            <h4 class="line_30">{{ __('t.petioner_and_advocate') }}</h4>


                            <table class="countries_list">
                                <tbody>
                                    <tr>
                                        <td>
                                            @if (count($petitioner_and_advocate) > 0 && !empty($petitioner_and_advocate))
                                                @php $i=1; @endphp @foreach ($petitioner_and_advocate as $value)
                                                    <p class="subscri-ti-das"> {{ $i . ') ' . $value['party_name'] }}</p>
                                                    <p class="subscri-ti-das"> Advocate - {{ $value['party_advocate'] }}
                                                    </p>
                                                    @php $i++; @endphp
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 hidden-small">
                            <h4 class="line_30">{{ __('t.respondent_and_advocate') }}</h4>

                            <table class="countries_list">
                                <tbody>
                                    <tr>
                                        <td>
                                            @if (count($respondent_and_advocate) > 0 && !empty($respondent_and_advocate))
                                                @php $i=1; @endphp @foreach ($respondent_and_advocate as $value)
                                                    <p class="subscri-ti-das"> {{ $i . ') ' . $value['party_name'] }}</p>
                                                    <p class="subscri-ti-das"> Advocate - {{ $value['party_advocate'] }}
                                                    </p>
                                                    @php $i++; @endphp
                                                @endforeach
                                            @endif
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
                            {{ __('t.documents') }}
                        </h4>
                        <form action="/admin/upload-document" method="POST" enctype="multipart/form-data"
                            id="uplaod_docuemt">
                            @csrf
                            <div class="form-group">
                                <label for="case_doc">{{ __('t.attach_document') }}</label>
                                <input required type="file" name="case_doc" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="cid" value="{{ $docuemts['id'] }}">
                                <input type="submit" class="btn btn-primary" value="{{ __('t.upload') }}">
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('t.name') }}</th>
                                    <th>{{ __('t.uploaded_on') }}</th>
                                    <th>{{ __('t.actions') }}</th>
                                </tr>
                            <tbody>
                                @foreach ($docuemts['documents'] as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->uploaded_on }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ $item->url }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <button doc_id="{{ $item->id }}" type="button"
                                                class="btn btn-danger deleteButton" data-toggle="modal"
                                                data-target="#deleteModal">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </thead>
                        </table>
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModal">{{ __('t.sure_to_delete') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ __('t.delete_text') }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button"data-dismiss="modal"
                                            class="btn btn-secondary">{{ __('t.cancel') }}</button>
                                        <a type="button" class="btn btn-primary deleteConfirm">{{ __('t.delete') }}</a>
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
                    <a href="/admin/delete/case/{{$case->case_id}}" class="btn btn-danger">{{ __('t.delete') }}</a>
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

    <input type="hidden" name="getNextDateModals" id="getNextDateModals" value="{{ url('admin/getNextDateModal') }}">
@endsection

@push('js')
    <script src="{{ asset('assets/js/case/case_view_detail.js') }}"></script>
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
@endpush
