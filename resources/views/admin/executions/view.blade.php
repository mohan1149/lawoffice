@extends('admin.layout.app')
@section('title',__("t.view_execution"))
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <h2>{{ __('t.view_execution') }}</h2>
                    <div class="x_content">
                        <div class="card">
                            <div class="card-body">
                                <p>{{ __("t.exe_date") }}</p>
                                <h2 class="alert alert-info">{{ $record->exe_date }}</h2>
                                <p>{{ __("t.exe_notes") }}</p>
                                <h4>{{ $record->exe_notes }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <h2>{{ __('t.edit') }}</h2>
                    <div class="x_content">
                        <div class="card">
                            <div class="card-body">
                                <form action="/admin/update/execution/{{$record->eid}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>{{ __("t.exe_date") }}</label>
                                        <input class="form-control" type="date" name="exe_date" value="{{ $record->exe_date}}">
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __("t.exe_date") }}</label>
                                        <textarea class="form-control" type="date" name="exe_notes" >{{$record->exe_notes}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="{{ __("t.save") }}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
