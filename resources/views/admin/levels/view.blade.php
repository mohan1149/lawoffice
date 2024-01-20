@extends('admin.layout.app')
@section('title',__("t.case_levels"))
@section('content')
    <div class="container">
        <div class="clearfix"></div>
        <div class="container">
            <h1 class="alert alert-info jumbo">{{ __("t.level".$case->case_level) }}</h1>
        </div>
        <div class="panel panel-info">
            <div style="padding: 10px">
                <div class="row">
                    <h2 style="padding: 25px">{{ __("t.case_details") }}</h2>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td>{{ __("t.case_type") }}</td>
                                <td>{{ $case->case_type_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.filling_no") }}</td>
                                <td>{{ $case->filing_number }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.filling_date") }}</td>
                                <td>{{ $case->filing_date }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.registration_number") }}</td>
                                <td>{{ $case->registration_number }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.registration_date") }}</td>
                                <td>{{ $case->registration_date }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.client") }}</td>
                                <td>{{ $case->first_name.' '.$case->last_name }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td>{{ __("t.first_hearing") }}</td>
                                <td>{{ $case->first_hearing_date }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.next_hearing_date") }}</td>
                                <td>{{ $case->next_date }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.case_status") }}</td>
                                <td>{{ $case->case_status_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.court") }}</td>
                                <td>{{ $case->court_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.judge_name") }}</td>
                                <td>{{ $case->judge_name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.againt") }}</td>
                                <td>{{ $case->party_name }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
        <br>
        <div class="panel panel-info">
            <div style="padding: 10px">
                <form action="/admin/level/save/{{ request('id') }}" method="post">
                    <input type="hidden" name="level" value="{{ $case->case_level }}">
                    @csrf
                    <div class="row">
                        <h2 style="padding: 25px">{{ __("t.level_details") }}</h2>
                        <a style="margin-left:25px" class="btn btn-info" href="/admin/case/level/history/{{ request('id') }}">{{ __("t.level_history") }}</a>
                        <br>
                        <div class="col-md-6">
                            <table class="table">
                                    @if ($case->case_level == 1)
                                        <tr>
                                            <td>{{ __("t.police_station") }}</td>
                                            <td>{{ $case->police_station }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __("t.fir_number") }}</td>
                                            <td>{{ $case->fir_number }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __("t.fir_date") }}</td>
                                            <td>{{ $case->fir_date }}</td>
                                        </tr>
                                    @endif
                                    @if ($case->case_level != 1)
                                        <tr>
                                            <td>{{ __("t.floor") }}</td>
                                            @if ($case->floor == "")
                                                <td> <input type="text" name="floor" class="form-control"> </td>
                                            @else
                                                <td>{{ $case->floor }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>{{ __("t.room") }}</td>
                                            @if ($case->room == "")
                                                <td> <input type="text" name="room" class="form-control"> </td>
                                            @else
                                                <td>{{ $case->room }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>{{ __("t.secretary") }}</td>
                                            @if ($case->secretary == "")
                                                <td> <input type="text" name="secretary" class="form-control"> </td>
                                            @else
                                                <td>{{ $case->secretary }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>{{ __("t.prev_request") }}</td>
                                        @if ($case->prev_request == "")
                                            <td>
                                                <textarea name="prev_request" class="form-control" cols="30" rows="10"></textarea>
                                            </td>
                                        @else
                                            <td>{{ $case->prev_request }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>{{ __("t.pre_response") }}</td>
                                        @if ($case->pre_response == "")
                                            <td>
                                                <textarea name="pre_response" class="form-control" cols="30" rows="10"></textarea>
                                            </td>
                                        @else
                                            <td>{{ $case->prev_request }}</td>
                                        @endif
                                    </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                @if ($case->case_level == 5)
                                    <tr>
                                        <td>{{ __("t.expert") }}</td>
                                        @if ($case->expert == "")
                                            <td><input type="text" name="expert" class="form-control"></td>
                                        @else
                                        <td>{{ $case->expert }}</td>
                                        @endif
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ __("t.next_request") }}</td>
                                    @if ($case->next_request == "")
                                        <td>
                                            <textarea name="next_request" class="form-control" cols="30" rows="10"></textarea>
                                        </td>
                                    @else
                                        <td>{{ $case->prev_request }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>{{ __("t.next_response") }}</td>
                                    @if ($case->next_response == "")
                                        <td>
                                            <textarea name="next_response" class="form-control" cols="30" rows="10"></textarea>
                                        </td>
                                    @else
                                        <td>{{ $case->prev_request }}</td>
                                    @endif
                                </tr>
                                
                            </table>
                        </div>
                        <div class="col-md-12">
                            <h2>{{ __("t.notes") }}</h2>
                            @if ($case->level_notes == "")
                                <textarea name="notes" class="form-control" cols="30" rows="10"></textarea>
                            @else
                                {{ $case->level_notes }}
                            @endif
                        </div>
                    </div>
                    <div style="margin: 10px">
                        <input class="btn btn-primary" type="submit" value={{ __("t.save_level") }}>
                    </div>
                </form>
                <form action="/admin/case/level-up" method="POST">
                    @csrf
                    <input type="hidden" name="case_id" value="{{ request('id') }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="up_level">{{ __("t.level") }}</label>
                                <select name="up_level" id="up_level" class="form-control">
                                    <option value="1">{{ __("t.level1") }}</option>
                                    <option value="2">{{ __("t.level2") }}</option>
                                    <option value="3">{{ __("t.level3") }}</option>
                                    <option value="4">{{ __("t.level4") }}</option>
                                    <option value="5">{{ __("t.level5") }}</option>
                                    <option value="6">{{ __("t.level6") }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div style="margin: 10px">
                        <input class="btn btn-primary" type="submit" value="{{ __("t.change_level") }}">
                    </div>
                </form>
            </div>
        </div>
        
    </div>
@endsection