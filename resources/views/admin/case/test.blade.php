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
                                                <input type="text" id="party_name" name="party_name"
                                                       data-rule-required="true" data-msg-required="{{__('t.enter_name')}}"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <label class="discount_text "><b class="position_advo">{{__("t.respondent_advocate")}}
                                                        </b><span class="text-danger">*</span></label>
                                                <input type="text" id="party_advocate" name="party_advocate"
                                                       data-rule-required="true"
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
                        <h2>{{ __("t.case_level") }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.client")}} <span class="text-danger">*</span></label>
                                <select name="case_level" id="level_controller" class="form-control">
                                    <option value="undefined">-----</option>
                                    <option value="police">{{ __("t.police") }}</option>
                                    <option value="prosecution">{{ __("t.prosecution") }}</option>
                                    <option value="first_degree">{{ __("t.first_degree") }}</option>
                                    <option value="resumption">{{ __("t.resumption") }}</option>
                                    <option value="excellece">{{ __("t.excellece") }}</option>
                                    <option value="expert">{{ __("t.expert") }}</option>
                                    <option value="shapes">{{ __("t.shapes") }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__('t.case_details')}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__('t.case_no')}}<span class="text-danger">*</span></label>
                                <input readonly value="{{ mt_rand(10000,99999) }}" type="text" id="case_no" name="case_no" class="form-control">
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
                        </div>
                        <div class="row">
                            {{-- police --}}
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="police_station">{{__("t.police_station")}}</label>
                                    <input type="text" id="police_station" name="police_station" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="detective">{{__("t.detective")}} </label>
                                    <input type="text" id="detective" name="detective" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="police_decision">{{__("t.police_decision")}} </label>
                                    <input type="text" id="police_decision" name="police_decision" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="police_decision_date">{{__("t.police_decision_date")}} </label>
                                    <input type="date" id="police_decision_date" name="police_decision_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="police_release_date">{{__("t.police_release_date")}} </label>
                                    <input type="date" id="police_release_date" name="police_release_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="police_warranty_value">{{__("t.police_warranty_value")}} </label>
                                    <input type="text" id="police_warranty_value" name="police_warranty_value" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="police_date_payment">{{__("t.police_date_payment")}} </label>
                                    <input type="date" id="police_date_payment" name="police_date_payment" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="fullname">{{__("t.registration_no")}} </label>
                                    <input type="text" id="police_reg_num" name="registration_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group police hidden_field">
                                <div class="">
                                    <label for="police_reg_date">{{__("t.registration_date")}}</label>
                                    <input type="date" id="police_reg_date" name="registration_date" class="form-control datetimepickerregdate" readonly="">
                                </div>
                            </div>
                            {{-- prosecution --}}
                            <div class="clearfix"></div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_type">{{__("t.pros_type")}}</label>
                                    <input type="text" id="pros_type" name="pros_type" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_name">{{__("t.pros_name")}}</label>
                                    <input type="text" id="pros_name" name="pros_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_sec_name">{{__("t.pros_sec_name")}}</label>
                                    <input type="text" id="pros_sec_name" name="pros_sec_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_summon_date">{{__("t.pros_summon_date")}}</label>
                                    <input type="date" id="pros_summon_date" name="pros_summon_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_next_summon_date">{{__("t.pros_next_summon_date")}}</label>
                                    <input type="date" id="pros_next_summon_date" name="pros_next_summon_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_decision">{{__("t.pros_decision")}}</label>
                                    <input type="text" id="pros_decision" name="pros_decision" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_decision_date">{{__("t.pros_decision_date")}}</label>
                                    <input type="date" id="pros_decision_date" name="pros_decision_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_release_date">{{__("t.pros_release_date")}}</label>
                                    <input type="date" id="pros_release_date" name="pros_release_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_warranty">{{__("t.pros_warranty")}}</label>
                                    <input type="text" id="pros_warranty" name="pros_warranty" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group pros hidden_field">
                                <div class="">
                                    <label for="pros_date_pay">{{__("t.pros_date_pay")}}</label>
                                    <input type="date" id="pros_date_pay" name="pros_date_pay" class="form-control">
                                </div>
                            </div>
                            {{-- first_degree --}}
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="act">{{__("t.act")}} <span class="text-danger">*</span></label>
                                    <input type="text" id="act" name="act" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="filing_number">{{__("t.filling_number")}} <span class="text-danger">*</span></label>
                                    <input type="text" id="filing_number" name="filing_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="filing_date">{{__("t.filling_date")}} <span class="text-danger">*</span></label>
                                    <input type="text" id="filing_date" name="filing_date" class="form-control datetimepickerfilingdate" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="next_date">{{__("t.first_hearing")}} <span class="text-danger">*</span></label>
                                    <input type="text" id="next_date" name="next_date" class="form-control datetimepickernextdate" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fullname">{{__("t.court_no")}} <span class="text-danger">*</span></label>
                                    <input type="text" id="court_no" name="court_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fullname">{{__("t.court_type")}}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="court_type" name="court_type"
                                            onchange="getCourt(this.value);">
                                        <option value="">{{__("t.select_court_type")}}</option>
                                        @foreach($courtTypes as $courtType)
                                            <option value="{{$courtType->id}}">{{$courtType->court_type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="court_name">{{__("t.court")}} <span class="text-danger">*</span></label>
                                    <select class="form-control" id="court_name" name="court_name"></select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_jud_dept">{{__("t.fd_jud_dept")}}</label>
                                    <input type="text" id="fd_jud_dept" name="fd_jud_dept" class="form-control">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_floor">{{__("t.fd_floor")}}</label>
                                    <input type="text" id="fd_floor" name="fd_floor" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_room">{{__("t.fd_room")}}</label>
                                    <input type="text" id="fd_room" name="fd_room" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_sec">{{__("t.fd_sec")}}</label>
                                    <input type="text" id="fd_sec" name="fd_sec" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_last_hear">{{__("t.fd_last_hear")}}</label>
                                    <input type="date" id="fd_last_hear" name="fd_last_hear" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_next_hear">{{__("t.fd_next_hear")}}</label>
                                    <input type="date" id="fd_next_hear" name="fd_next_hear" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_last_req">{{__("t.fd_last_req")}}</label>
                                    <input type="text" id="fd_last_req" name="fd_last_req" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_now_req">{{__("t.fd_now_req")}}</label>
                                    <input type="text" id="fd_now_req" name="fd_now_req" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_statement">{{__("t.fd_statement")}}</label>
                                    <input type="text" id="fd_statement" name="fd_statement" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
                                <div class="">
                                    <label for="fd_judge_date">{{__("t.fd_judge_date")}}</label>
                                    <input type="date" id="fd_judge_date" name="fd_judge_date" class="form-control">
                                </div>
                            </div>
                            {{-- resumption --}}
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class=""><label for="fullname">{{__("t.court_type")}}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="court_type" name="res_court_type"
                                            onchange="getCourt(this.value);">
                                        <option value="">{{__("t.select_court_type")}}</option>
                                        @foreach($courtTypes as $courtType)
                                            <option value="{{$courtType->id}}">{{$courtType->court_type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class="">
                                    <label for="res_floor">{{__("t.res_floor")}}</label>
                                    <input type="text" id="res_floor" name="res_floor" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class="">
                                    <label for="res_room">{{__("t.res_room")}}</label>
                                    <input type="text" id="res_room" name="res_room" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class="">
                                    <label for="res_date">{{__("t.res_date")}}</label>
                                    <input type="date" id="res_date" name="res_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class="">
                                    <label for="res_jud_dept">{{__("t.res_jud_dept")}}</label>
                                    <input type="text" id="res_jud_dept" name="res_jud_dept" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class="">
                                    <label for="res_court_sec">{{__("t.res_court_sec")}}</label>
                                    <input type="text" id="res_court_sec" name="res_court_sec" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class="">
                                    <label for="res_hear_req">{{__("t.res_hear_req")}}</label>
                                    <input type="text" id="res_hear_req" name="res_hear_req" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
                                <div class="">
                                    <label for="res_judge_date">{{__("t.res_judge_date")}}</label>
                                    <input type="date" id="res_judge_date" name="res_judge_date" class="form-control">
                                </div>
                            </div>

                            {{-- excellence --}}
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group excel hidden_field">
                                <div class=""><label for="fullname">{{__("t.court_type")}}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="court_type" name="excel_court_type"
                                            onchange="getCourt(this.value);">
                                        <option value="">{{__("t.select_court_type")}}</option>
                                        @foreach($courtTypes as $courtType)
                                            <option value="{{$courtType->id}}">{{$courtType->court_type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group excel hidden_field">
                                <div class="">
                                    <label for="excel_floor">{{__("t.excel_floor")}}</label>
                                    <input type="text" id="excel_floor" name="excel_floor" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group excel hidden_field">
                                <div class="">
                                    <label for="excel_room">{{__("t.excel_room")}}</label>
                                    <input type="text" id="excel_room" name="excel_room" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group excel hidden_field">
                                <div class="">
                                    <label for="excel_date">{{__("t.excel_room_date")}}</label>
                                    <input type="date" id="excel_date" name="excel_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group excel hidden_field">
                                <div class="">
                                    <label for="excel_room_jud_dept">{{__("t.excel_room_jud_dept")}}</label>
                                    <input type="text" id="excel_jud_dept" name="excel_jud_dept" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group excel hidden_field">
                                <div class="">
                                    <label for="excel_room_court_sec">{{__("t.excel_room_court_sec")}}</label>
                                    <input type="text" id="excel_court_sec" name="excel_court_sec" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group excel hidden_field">
                                <div class="">
                                    <label for="excel_hear_req">{{__("t.excel_hear_req")}}</label>
                                    <input type="text" id="excel_hear_req" name="excel_hear_req" class="form-control">
                                </div>
                            </div>
                            {{-- expert --}}
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class=""><label for="fullname">{{__("t.court_type")}}<span class="text-danger">*</span></label>
                                    <select class="form-control" id="court_type" name="exp_court_type"
                                            onchange="getCourt(this.value);">
                                        <option value="">{{__("t.select_court_type")}}</option>
                                        @foreach($courtTypes as $courtType)
                                            <option value="{{$courtType->id}}">{{$courtType->court_type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class="">
                                    <label for="exp_floor">{{__("t.exp_floor")}}</label>
                                    <input type="text" id="exp_floor" name="exp_floor" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class="">
                                    <label for="exp_room">{{__("t.exp_room")}}</label>
                                    <input type="text" id="exp_room" name="exp_room" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class="">
                                    <label for="exp_date">{{__("t.exp_date")}}</label>
                                    <input type="date" id="exp_date" name="exp_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class="">
                                    <label for="exp_jud_dept">{{__("t.exp_judge__dept")}}</label>
                                    <input type="text" id="exp_jud_dept" name="exp_jud_dept" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class="">
                                    <label for="exp_name">{{__("t.exp_name")}}</label>
                                    <input type="text" id="exp_name" name="exp_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class="">
                                    <label for="exp_name">{{__("t.exp_section")}}</label>
                                    <input type="text" id="exp_section" name="exp_section" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group exp hidden_field">
                                <div class="">
                                    <label for="exp_hear_req">{{__("t.exp_hear_req")}}</label>
                                    <input type="text" id="exp_hear_req" name="exp_hear_req" class="form-control">
                                </div>
                            </div>

                            {{-- shapes --}}
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group shapes hidden_field">
                                <div class="">
                                    <label for="shapes_date">{{__("t.shapes_date")}}</label>
                                    <input type="date" id="shapes_date" name="shapes_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group shapes hidden_field">
                                <div class="">
                                    <label for="shapes_floor">{{__("t.shapes_floor")}}</label>
                                    <input type="text" id="shapes_floor" name="shapes_floor" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group shapes hidden_field">
                                <div class="">
                                    <label for="shapes_room">{{__("t.shapes_room")}}</label>
                                    <input type="text" id="shapes_room" name="shapes_room" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group shapes hidden_field">
                                <div class="">
                                    <label for="shapes_num">{{__("t.shapes_num")}}</label>
                                    <input type="text" id="shapes_num" name="shapes_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group shapes hidden_field">
                                <div class="">
                                    <label for="shapes_sec">{{__("t.shapes_sec")}}</label>
                                    <input type="text" id="shapes_sec" name="shapes_sec" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group shapes hidden_field">
                                <div class="">
                                    <label for="shapes_jud_dept">{{__("t.shapes_jud_dept")}}</label>
                                    <input type="text" id="shapes_jud_dept" name="shapes_jud_dept" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 form-group shapes hidden_field">
                                <div class="">
                                    <label for="shapes_hear_req">{{__("t.shapes_hear_req")}}</label>
                                    <input type="text" id="shapes_hear_req" name="shapes_hear_req" class="form-control">
                                </div>
                            </div>








                            {{-- <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="fullname">{{__("t.case_stage")}} <span class="text-danger">*</span></label>
                                <select class="form-control" id="case_status" name="case_status">
                                    <option value="">{{__("t.select_case_status")}}</option>
                                    @foreach($caseStatuses as $caseStatus)
                                        <option value="{{$caseStatus->id}}">{{$caseStatus->case_status_name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <br><br>
                                <input type="radio" id="test3" name="priority" value="High">&nbsp;&nbsp;{{__("t.high")}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="test4" name="priority" value="Medium" checked>&nbsp;&nbsp;{{__("t.medium")}}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="test5" name="priority" value="Low">&nbsp;&nbsp;{{__("t.low")}}
                            </div> --}}
                        </div>
                        <div class="row">
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{__("t.court_detail")}}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        

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

            </div>
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
