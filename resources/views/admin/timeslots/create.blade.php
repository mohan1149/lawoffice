@extends('admin.layout.app')
@section('title',__("t.add_timeslot"))
@section('content')

    <div class="">
        <div class="clearfix"></div>
        <div class="bg-blue" id="snackbar">{{ __('t.slot_added') }}</div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <form action="/admin/timeslots" method="post" id="add_time_slot">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lawyer">{{ __("t.lawyer")}}</label>
                                        <select required class="form-control" name="lawyer" id="lawyer">
                                            @foreach ($lawyers as $lawyer)
                                                <option value="{{ $lawyer->id }}">{{ $lawyer->first_name.' ',$lawyer->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">{{ __("t.date")}}</label>
                                        <input type="date" name="date" class="form-control" id="date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="day">{{ __("t.start_time")}}</label>
                                        <input required class="form-control" type="text" name="start_time" id="s_time">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="day">{{ __("t.end_time")}}</label>
                                        <input required class="form-control" type="text" name="end_time" id="e_time">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-primary" type="sumbit">{{ __("t.add_slot") }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
