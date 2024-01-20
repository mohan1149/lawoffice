@extends('admin.layout.app')
@section('title','Vendor Create')
@section('content')
    @component('component.heading' , [

        'page_title' => __("t.add_vendor"),
        'action' => route('vendor.index') ,
        'text' => 'Back'
         ])
    @endcomponent

    <div class="row">
        <form id="add_vendor" name="add_vendor" role="form" method="POST" action="{{route('vendor.store')}}"
              enctype="multipart/form-data">
            @csrf()

            <div class="col-md-12 col-sm-12 col-xs-12">
                @include('component.error')
                <div class="x_panel">

                    <div class="x_content">

                        <div class="row">

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="company_name">{{__("t.company_name")}} <span class="text-danger"></span></label>
                                <input type="text" placeholder="" class="form-control" name="company_name"
                                       id="company_name">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="f_name">{{__("t.first_name")}} <span class="text-danger"></span></label>
                                <input type="text" placeholder="" class="form-control" id="f_name" name="f_name">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="l_name">{{__("t.last_name")}} <span class="text-danger"></span></label>
                                <input type="text" placeholder="" class="form-control" id="l_name" name="l_name">
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="email">{{__("t.email")}} <span class="text-danger"></span></label>
                                <input type="email" placeholder="" class="form-control" id="email" name="email">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="mobile">{{__("t.mobile_no")}}. <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="mobile" name="mobile"
                                       data-rule-required="true"
                                       data-rule-number="true"
                                       data-msg-required="Mobile no is required"
                                       data-rule-minlength="10"
                                       data-rule-maxlength="10">
                            </div>

                            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                <label for="alternate_no">{{__("t.alternate_no")}}<span class="text-danger"></span></label>
                                <input type="text" placeholder="" class="form-control" id="alternate_no"
                                       name="alternate_no"
                                       data-rule-required="false"
                                       data-rule-number="true"
                                       data-rule-minlength="10"
                                       data-rule-maxlength="10">
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                <label for="address">{{__("t.address")}} <span class="text-danger">*</span></label>
                                <input type="text" placeholder="" class="form-control" id="address" name="address"
                                       data-rule-required="true" data-msg-required="Adress is required">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="country">{{__("t.country")}} <span class="text-danger">*</span></label>
                                <select class="form-control select-change country-select2" data-rule-required="true"
                                        data-msg-required=" Please select country selct2-width-100" name="country"
                                        id="country"
                                        data-url="{{ route('get.country') }}"
                                        data-clear="#city_id,#state"
                                >
                                    <option value="">{{__("t.select_country")}}</option>

                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="state">{{__("t.state")}} <span class="text-danger">*</span></label>
                                <select id="state" name="state"

                                        data-url="{{ route('get.state') }}"
                                        data-target="#country"
                                        data-clear="#city_id"
                                        class="form-control state-select2 select-change" data-rule-required="true"
                                        data-msg-required=" Please select state">
                                    <option value="">{{__("t.select_state")}}</option>


                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="city">{{__("t.city")}} <span class="text-danger">*</span></label>
                                <select id="city_id" name="city_id"
                                        data-url="{{ route('get.city') }}"
                                        data-target="#state"
                                        class="form-control city-select2" data-rule-required="true"
                                        data-msg-required=" Please select city">
                                    <option value=""> {{__("t.select_city")}}</option>


                                </select>
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="gst">GSTIN </label>
                                <input type="text" placeholder="" class="form-control" id="gst" name="gst">
                            </div>

                            <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                                <label for="pan">PAN</label>
                                <input type="text" placeholder="" class="form-control" id="pan" name="pan">
                            </div>


                            <div class="form-group pull-right">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                    <br>
                                    <a href="{{ route('vendor.index') }}" class="btn btn-danger">{{__("t.cancel")}}</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"
                                                                                     id="show_loader"></i>&nbsp;{{__("t.save")}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/admin/js/selectjs.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/vendor.js') }}"></script>
@endpush
