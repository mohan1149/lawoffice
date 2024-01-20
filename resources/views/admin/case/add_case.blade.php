@extends('admin.layout.app')
@section('title','Case Create')


@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{__('t.add_case')}}</h3>
        </div>

        <div class="title_right">
            <div class="form-group pull-right top_search">
                <a href="{{route('case-running.index')}}" class="btn btn-primary">{{__('t.back')}}</a>

            </div>
        </div>
    </div>
    <!------------------------------------------------ ROW 1-------------------------------------------- -->


    <form method="post" name="add_case" id="add_case" action="{{route('case-running.store')}}" class="">
        @csrf()
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__('t.client_detail')}}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>{{__("t.input_error")}}</strong> <br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ctitle">{{__("t.ctitle")}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ctitle" id="ctitle" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.client")}} <span class="text-danger">*</span></label>
                                <select class="form-control" name="client_name" id="client_name">
                                    <option value="">{{__("t.select_client")}}</option>
                                    @foreach($client_list as $list)
                                        <option value="{{ $list->id}}">{{  $list->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <br><br>
                                <input type="radio" id="test1" name="position" value="Petitioner" checked>&nbsp;&nbsp;{{__("t.petitioner")}}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="test2" name="position" value="Respondent">&nbsp;&nbsp;{{__("t.respondent")}}
                            </div>
                        </div>


                        <div class="repeater">
                            <div data-repeater-list="parties_detail">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="discount_text "> <b class="position_name">{{__("t.respondent_name")}}</b><span class="text-danger">*</span></label>
                                                <input type="text" id="party_name" name="party_name"data-msg-required="{{__('t.enter_name')}}"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <label class="discount_text "><b class="position_advo">{{__("t.respondent_advocate")}}
                                                        </b><span class="text-danger">*</span></label>
                                                <input type="text" id="party_advocate" name="party_advocate"
                                                       data-msg-required="{{__('t.enter_advocate_name')}}"
                                                       class="form-control">
                                            </div>


                                        </div>

                                        <div class="col-md-1">

                                            <div class="form-group">

                                                <div class="case-margin-top-23"></div>
                                                <button type="button" data-repeater-delete type="button"
                                                        class="btn btn-danger waves-effect waves-light"><i
                                                        class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </div>


                                        </div>


                                    </div>

                                    <br>
                                </div>
                            </div>
                            <button data-repeater-create type="button" value="Add New"
                                    class="btn btn-success waves-effect waves-light btn btn-success-edit" type="button">
                                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;{{__("t.add_more")}}
                            </button>
                        </div>


                    </div>
                </div>

            </div>

        </div>
        <!------------------------------------------------------- End ROw --------------------------------------------->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__('t.case_details')}}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group highlight_input">
                                <label for="case_level">{{ __("t.case_level") }}**</label>
                                <select name="case_level" class="form-control" id="level_controller" required>
                                    <option value="NULL">------ </option>
                                    <option value="police">{{ __('t.police') }}</option>
                                    <option value="prosecution">{{ __('t.prosecution') }}</option>
                                    <option value="first-degree">{{ __('t.first-degree') }}</option>
                                    <option value="resumption">{{ __('t.resumption') }}</option>
                                    <option value="excellence">{{ __('t.excellence') }}</option>
                                    <option value="expert">{{ __('t.expert') }}</option>
                                    <option value="shapes">{{ __('t.shapes') }}</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="code_number">{{__('t.code_num')}}<span class="text-danger">*</span></label>
                                <input type="text" id="code_number" name="registration_number" class="form-control" value="{{ time() }}">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.filling_number")}} <span class="text-danger">*</span></label>
                                <input type="text" id="filing_number" name="filing_number" class="form-control">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="case_no">{{__('t.case_no')}}<span class="text-danger">*</span></label>
                                <input type="text" id="case_no" name="case_no" class="form-control" >
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__('t.case_type')}} <span class="text-danger">*</span></label>
                                <select class="form-control" id="case_type" name="case_type"
                                        onchange="getCaseSubType(this.value);">
                                    <option value="">{{__("t.select_case_type")}}</option>
                                    @foreach($caseTypes as $caseType)
                                        <option value="{{$caseType->id}}">{{$caseType->case_type_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.case_sub_type")}} <span class="text-danger"></span></label>
                                <select class="form-control" id="case_sub_type" name="case_sub_type"></select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="police_station">{{ __("t.police_station") }}</label>
                                <input type="text" name="ps_station" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="officer">{{ __("t.officer") }}</label>
                                <input type="text" name="po_officer" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="reg_date">{{ __("t.reg_date") }}</label>
                                <input type="date" name="reg_date" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="decision">{{ __("t.decision") }}</label>
                                <input type="text" name="po_decision" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="dec_date">{{ __("t.dec_date") }}</label>
                                <input type="date" name="po_dec_date" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="rel_date">{{ __("t.rel_date") }}</label>
                                <input type="date" name="po_rel_date" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="warranty">{{ __("t.warranty") }}</label>
                                <input type="text" name="po_warranty" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <label for="date_payment">{{ __("t.date_payment") }}</label>
                                <input type="date" name="po_date_payment" class="form-control">
                            </div>
                        {{-- end --}}
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                            <label for="pros_type">{{ __("t.pros_type") }}</label>
                            <input type="text" name="pros_type" class="form-control">
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                            <label for="officer">{{ __("t.officer") }}</label>
                            <input type="text" name="pro_officer" class="form-control">
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                            <label for="summon">{{ __("t.summon") }}</label>
                            <input type="date" name="summon" class="form-control">
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                            <label for="summon_next">{{ __("t.summon_next") }}</label>
                            <input type="date" name="summon_next" class="form-control">
                        </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <label for="decision">{{ __("t.decision") }}</label>
                                <input type="text" name="pro_decision" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <label for="dec_date">{{ __("t.dec_date") }}</label>
                                <input type="date" name="pro_dec_date" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <label for="rel_date">{{ __("t.rel_date") }}</label>
                                <input type="date" name="pro_rel_date" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <label for="warranty">{{ __("t.warranty") }}</label>
                                <input type="text" name="pro_warranty" class="form-control">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <label for="date_payment">{{ __("t.date_payment") }}</label>
                                <input type="date" name="pro_date_payment" class="form-control">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.case_stage")}} <span class="text-danger">*</span></label>
                                <select class="form-control" id="case_status" name="case_status">
                                    <option value="">{{__("t.select_case_status")}}</option>
                                    @foreach($caseStatuses as $caseStatus)
                                        <option value="{{$caseStatus->id}}">{{$caseStatus->case_status_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <br><br>
                                <input type="radio" id="test3" name="priority" value="High">&nbsp;&nbsp;{{__("t.high")}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="test4" name="priority" value="Medium" checked>&nbsp;&nbsp;{{__("t.medium")}}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="test5" name="priority" value="Low">&nbsp;&nbsp;{{__("t.low")}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.act")}} <span class="text-danger">*</span></label>
                                <input type="text" id="law_num" name="act" class="form-control">
                            </div>
                            
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.filling_date")}} <span class="text-danger">*</span></label>
                                <input type="text" id="filing_date" name="filing_date"
                                       class="form-control datetimepickerfilingdate" readonly="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.registration_date")}} <span class="text-danger">*</span></label>
                                <input type="text" id="filiregistration_dateng_date" name="registration_date"
                                       class="form-control datetimepickerregdate" readonly="">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.first_hearing")}} <span class="text-danger">*</span></label>
                                <input type="text" id="next_date" name="next_date"
                                       class="form-control datetimepickernextdate" readonly="">
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">CNR Number <span class="text-danger"></span></label>
                                <input type="text" id="cnr_number" name="cnr_number" class="form-control">
                            </div> --}}
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.description")}}  <span class="text-danger"></span></label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__("t.fir_details")}} </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.police_station")}} <span class="text-danger"></span></label>
                                <input type="text" id="police_station" name="police_station" class="form-control">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.fir_no")}} <span class="text-danger"></span></label>
                                <input type="text" id="fir_number" name="fir_number" class="form-control">
                            </div>


                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.fir_date")}} <span class="text-danger"></span></label>
                                <input type="text" id="fir_date" name="fir_date"
                                       class="form-control datetimepickerregdate" readonly="">
                            </div>
                        </div>


                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            {{-- <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__("t.court_detail")}}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.court_no")}} <span class="text-danger">*</span></label>
                                <input type="text" id="court_no" name="court_no" class="form-control">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.court_type")}}<span class="text-danger">*</span></label>
                                <select class="form-control" id="court_type" name="court_type"
                                        onchange="getCourt(this.value);">
                                    <option value="">{{__("t.select_court_type")}}</option>
                                    @foreach($courtTypes as $courtType)
                                        <option value="{{$courtType->id}}">{{$courtType->court_type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.court")}} <span class="text-danger">*</span></label>
                                <select class="form-control" id="court_name" name="court_name"></select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.judge_type")}} <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="judge_type" name="judge_type">
                                    <option value="">{{__("t.select_judge_type")}}</option>
                                    @foreach($judges as $judge)
                                        <option value="{{$judge->id}}">{{$judge->judge_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">  {{__("t.judge_name")}} <span class="text-danger"></span></label>
                                <input type="text" id="judge_name" name="judge_name" class="form-control">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"> {{__("t.remarks")}} <span class="text-danger"></span></label>
                                <textarea id="remarks" name="remarks" class="form-control"></textarea>

                            </div>
                        </div>


                    </div>
                </div>

            </div> --}}
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>   {{__("t.assign_task")}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname"> {{__("t.users")}}</label>
                                <select multiple class="form-control" id="assigned_to" name="assigned_to[]">
                                    @foreach($users as $key=>$val)
                                        <option value="{{$val->id}}">{{$val->first_name.' '.$val->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group pull-right">
                <div class="col-md-12 col-sm-6 col-xs-12">
                    <a class="btn btn-danger" href="{{route('case-running.index')}}"> {{__("t.cancel")}}</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" id="show_loader"></i>&nbsp;{{__("t.save")}}
                    </button>
                </div>
            </div>
            <br>
        </div>
    </form>
    <input type="hidden" name="date_format_datepiker"
           id="date_format_datepiker"
           value="{{$date_format_datepiker}}">
    <input type="hidden" name="getCaseSubType"
           id="getCaseSubType"
           value="{{ url('getCaseSubType')}}">
    <input type="hidden" name="getCourt"
           id="getCourt"
           value="{{ url('getCourt')}}">
@endsection
@push('js')
    <script src="{{asset('assets/js/case/case-add-validation.js')}}"></script>
    <script src="{{asset('assets/admin/js/repeter/repeater.js') }}"></script>

@endpush
