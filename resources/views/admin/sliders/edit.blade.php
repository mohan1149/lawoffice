@extends('admin.layout.app')
@section('title',__("t.add_timeslot"))
@section('content')

    <div class="">
        <div class="clearfix"></div>
        <div class="bg-red" id="snackbar">{{ __('t.slot_added') }}</div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <form id="edit_slider" action="/admin/sliders/{{ $slider->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">{{ __("t.image")}}</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <input type="checkbox" name="publish" id="publish">
                                        <label for="publish">{{ __("t.publish")}}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br>
                                        <button class="btn btn-primary edit_slider" type="sumbit">{{ __("t.update_slider") }}</button>
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
    <script type="text/javascript" src="/assets/js/master.js"></script>
@endsection
