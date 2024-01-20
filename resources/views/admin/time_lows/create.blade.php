@extends('admin.layout.app')
@section('title',__("t.add_time"))
@section('content')

    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <form action="/admin/judge-time-low" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <h2>{{ __("t.add_judgment_time_low") }}</h2>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="days">{{ __("t.case_level")}}</label>
                                        <select name="case_level" class="form-control">
                                            <option value="police">{{ __('t.police') }}</option>
                                            <option value="prosecution">{{ __('t.prosecution') }}</option>
                                            <option value="first-degree">{{ __('t.first-degree') }}</option>
                                            <option value="resumption">{{ __('t.resumption') }}</option>
                                            <option value="excellence">{{ __('t.excellence') }}</option>
                                            <option value="expert">{{ __('t.expert') }}</option>
                                            <option value="shapes">{{ __('t.shapes') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="case_type">{{ __("t.case_type") }}</label>
                                        <select name="case_type" class="form-control">
                                            @foreach ($case_types as $key=> $case_type)
                                                <option value="{{ $key }}">{{ $case_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="days">{{ __("t.days")}}</label>
                                        <input type="number" name="days" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-primary" type="sumbit">{{ __("t.add") }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
