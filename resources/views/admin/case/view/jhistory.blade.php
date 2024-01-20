@extends('admin.layout.app')
@section('title',__("t.judgement_history"))
@section('content')
    <div class="container" style="padding: 15px;margin:15px;margin-top:50px">
        @foreach ($history as $item)
            <div class="panel panel-info">

                <a class="btn btn-danger" href="/admin/delete/judgement/{{ $item->cjid }}"
                    style="float: right">{{ __('t.delete') }}</a>
                <div class="panel-heading" style="text-align: center;font-size:20px">
                    <h2 style="text-transform: uppercase">
                        {{ __("t.judgement_history") }}
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="container">
                        <table class="table">
                            <tr>
                                <td>{{ __("t.case_level") }}</td>
                                <td>{{ __("t.".$item->case_level) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.days") }}</td>
                                <td>{{ $item->days }}</td>
                            </tr>
                            
                            <tr>
                                <td>{{ __("t.j_from_date") }}</td>
                                <td>{{ $item->j_from_date }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.j_date") }}</td>
                                <td>{{ $item->j_date }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("t.notes") }}</td>
                                <td>{{ $item->notes }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <i class="glyphicon glyphicon-arrow-up" aria-hidden="true" style="display:flex;justify-content: center;padding: 5px;font-size:20px;"></i>
        @endforeach
    </div>
@endsection