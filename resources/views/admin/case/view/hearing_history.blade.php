@extends('admin.layout.app')
@section('title', __('t.level_history'))
@section('content')
    <div class="container" style="padding: 15px;margin:15px;margin-top:50px">
        @foreach ($history as $item)
            <div class="panel panel-info">
                <a class="btn btn-danger" href="/admin/delete/hearing/{{ $item->hid }}"
                    style="float: right">{{ __('t.delete') }}</a>
                <div class="panel-heading" style="text-align: center;font-size:20px">
                    <h2 style="text-transform: uppercase">
                        {{ $item->case_level . ' # ' . $item->hid }}
                    </h2>

                </div>

                <div class="panel-body">
                    <div class="container">
                        <table class="table">
                            <tr>
                                <td>{{ __('t.judcial_dept') }}</td>
                                <td>{{ $item->judcial_dept }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.floor') }}</td>
                                <td>{{ $item->floor }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.room') }}</td>
                                <td>{{ $item->room }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.court_secretary') }}</td>
                                <td>{{ $item->court_secretary }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.last_hearing') }}</td>
                                <td>{{ $item->last_hearing }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.next_hearing') }}</td>
                                <td>{{ $item->next_hearing }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.last_requirements') }}</td>
                                <td>{{ $item->last_requirements }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.current_requirements') }}</td>
                                <td>{{ $item->current_requirements }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('t.hearing_statement') }}</td>
                                <td>{{ $item->hearing_statement }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <h2 class="glyphicon glyphicon-arrow-down" aria-hidden="true" style="display:flex;justify-content: center"></h2>
        @endforeach
    </div>
@endsection
