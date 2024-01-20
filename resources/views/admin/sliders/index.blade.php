@extends('admin.layout.app')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@section('title',__("t.sliders"))
@section('content')

    <div class="">
        @component('component.heading' , [
            'page_title' => __("t.sliders"),
            'action' => route('sliders.create') ,
            'text' => __("t.add_slider"),
            'permission' => 1,
        ])
        @endcomponent
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <table id="slidersTable" class="table responsive responsive-table">
                            <thead>
                                <tr>
                                    <th>{{__("t.image")}}</th>
                                    <th>{{__("t.name")}}</th>
                                    <th>{{__("t.published")}}</th>
                                    <th>{{__("t.created")}}</th>
                                    <th data-orderable="false" class="text-center">{{__("t.action")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td><img src="{{ $slider->image }}" alt="" style="width: 100px"></td>
                                        <td>{{ $slider->name }}</td>
                                        <td>{{ $slider->published == '1' ? __('t.yes') : __('t.no') }}</td>
                                        <td>{{ $slider->created_on }}</td>
                                        <td>
                                            {{-- <a href="/admin/sliders/{{ $slider->id }}/edit"><i class="fa fa-edit"></i></a> --}}
                                            <a target="/admin/sliders/{{ $slider->id }}" class="red genDeleteBtn" data-toggle="modal" data-target="#gendeleteModal"><i class="fa fa-trash"></i></a>
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
