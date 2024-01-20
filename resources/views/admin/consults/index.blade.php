@extends('admin.layout.app')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@section('title',__("t.sliders"))
@section('content')

    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <table id="consultationsTable" class="table responsive responsive-table">
                            <thead>
                                <tr>
                                    <th>{{__("t.name")}}</th>
                                    <th>{{__("t.phone")}}</th>
				    <th>{{__("t.description")}}</th>
				    <th>{{  __("t.submitted_on")  }}</th>
                                    <th data-orderable="false" class="text-center">{{__("t.action")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $consultation)
                                    <tr>
                                        <td>{{ $consultation->name }}</td>
                                        <td>{{ $consultation->phone }}</td>
					<td>{{ $consultation->description }}</td>
                                        <td>{{ $consultation->submitted_on }}</td>
                                        <td>
                                            {{-- <a href="/admin/sliders/{{ $slider->id }}/edit"><i class="fa fa-edit"></i></a> --}}
					    <a target="/admin/consultations/{{ $consultation->c_id }}" class="red genDeleteBtn" data-toggle="modal" data-target="#gendeleteModal"><i class="fa fa-trash"></i></a>
                                           <a class="blue"style="margin-left:10px;" href="https://api.whatsapp.com/send/?phone={{ $consultation->phone }}" target="_blank"><i class="fa fa-whatsapp"></i></a>
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
    $('#consultationsTable').DataTable({
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
