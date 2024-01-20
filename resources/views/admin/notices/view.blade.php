@extends('admin.layout.app')
@section('title',__("t.view_notice"))
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <h2>{{ __('t.view_notice') }}</h2>
                    <div class="x_content">
                        <div class="card">
                            <div class="card-body">
                                <p>{{ __("t.sent_on") }}</p>
                                <h2 class="alert alert-info">{{ $record->notice_date }}</h2>
                                <p>{{ __("t.notes") }}</p>
                                <h4>{{ $record->notice_notes }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
