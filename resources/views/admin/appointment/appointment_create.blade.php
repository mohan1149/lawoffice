@extends('admin.layout.app')
@section('title','Appointment Add')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>{{ __("t.add_appointment") }}</h3>
        </div>

        <div class="title_right">
            <div class="form-group pull-right top_search">
                <a href="{{ route('appointment.index') }}" class="btn btn-primary">{{__("t.back")}}</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @include('component.error')
            <div class="x_panel">
                <div class="x_content">
                    <form id="add_appointment" name="add_appointment" role="form" method="POST"
                          action="{{route('appointment.store')}}" enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="x_content">

                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <input type="radio" id="test5" value="new" name="type" checked>

                                        <b> {{__("t.new_client")}}
                                        </b>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <input type="radio" id="test4" value="exists" name="type">

                                        <b> {{__("t.existing_client")}}
                                       </b>

                                    </div>
                                </div>
                                <br>
                                <div class="row exists">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            @if(!empty($client_list) && count($client_list)>0)
                                                <label class="discount_text">{{__("t.select_client")}}
                                                    <er class="rest">*</er>
                                                </label>
                                                <select class="form-control selct2-width-100" name="exists_client"
                                                        id="exists_client"
                                                        onchange="getMobileno(this.value);">
                                                    <option value="">{{__("t.select_client")}}</option>
                                                    @foreach($client_list as $list)
                                                        <option value="{{ $list->id}}">{{  $list->full_name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif


                                        </div>

                                    </div>
                                </div>


                                <div class="row new">
                                    <div class="col-md-12 form-group">
                                        <label for="newclint_name">{{__("t.new_client_name")}} <span
                                                    class="text-danger">*</span></label>
                                        <input type="text" placeholder="" class="form-control" id="new_client"
                                               name="new_client" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="mobile">{{__("t.mobile_no")}} <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="" class="form-control" id="mobile" name="mobile"
                                               autocomplete="off">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="date">{{__("t.date")}} <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="date" name="date">


                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="time">{{__("t.time")}} <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" id="time" name="time">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="note">{{__("t.note")}}</label>
                                        <textarea type="text" placeholder="" class="form-control" id="note"
                                                  name="note"></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group pull-right">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <br>
                                    <a href="{{ route('appointment.index') }}" class="btn btn-danger">{{__("t.cancel")}}</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"
                                                                                     id="show_loader"></i>&nbsp;{{__("t.save")}}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="date_format_datepiker"
           id="date_format_datepiker"
           value="{{$date_format_datepiker}}">

    <input type="hidden" name="getMobileno"
           id="getMobileno"
           value="{{ route('getMobileno') }}">
@endsection

@push('js')
    <script src="{{asset('assets/admin/appointment/appointment.js') }}"></script>
    <script src="{{asset('assets/js/appointment/appointment-validation.js')}}"></script>
@endpush
