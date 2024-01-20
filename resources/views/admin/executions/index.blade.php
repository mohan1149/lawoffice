@extends('admin.layout.app')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@section('title',__("t.executions"))
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <h2>{{ __('t.executions') }}</h2>
                    <div class="x_content">
                        <table id="slidersTable" class="table responsive responsive-table">
                            <thead>
                                <tr>
                                    <th>{{__("t.case_number")}}</th>
                                    <th>{{__("t.client")}}</th>
                                    <th>{{__("t.against")}}</th>
                                    <th>{{__("t.status")}}</th>
                                    <th data-orderable="false" class="text-center">{{__("t.action")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->case_number }}</td>
                                        <td>{{ $case->first_name.' '.$case->last_name }}</td>
                                        <td>{{ $case->party_name}}</td>
                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                        <td>
                                            @if ($case->exe_status == 0 )
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                                                {{  __("t.add")}}
                                            </button>
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLongTitle">{{ __("t.add_execution") }}</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      
                                                      <form action="/admin/executions/update" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="case_id" value="{{ $case->id }}">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group" style="width: 100%">
                                                                    <label for="exe_date">{{ __("t.exe_date") }}</label>
                                                                    <br>
                                                                    <input required style="width: 100%" type="date" class="form-control" name="exe_date" id="exe_date">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group" style="width: 100%">
                                                                    <label for="exe_notes">{{ __("t.exe_notes") }}</label>
                                                                    <br>
                                                                    <textarea required style="width: 100%" class="form-control" name="exe_notes" id="exe_notes" cols="30" rows="10"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div 
                                                        style="padding: 20px">
                                                            <input type="submit" class="btn btn-primary" value="{{__("t.save") }}">
                                                        </div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            @else
                                                <a class="btn btn-primary" href="/admin/executions/view/{{$case->id}}">{{ __("t.view") }}</a>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#slidersTable').DataTable({
        columnDefs: [
            {
                targets: 4,
                orderable: false,
                searchable: false,
            },
        ],
    });
} );
</script>
