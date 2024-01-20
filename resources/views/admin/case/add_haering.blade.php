{{-- hearing --}}

<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_jud_dept">{{__("t.fd_jud_dept")}}</label>
        <input type="text" id="fd_jud_dept" name="fd_jud_dept" class="form-control">
    </div>
</div>
<div class="clearfix"></div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_floor">{{__("t.fd_floor")}}</label>
        <input type="text" id="fd_floor" name="fd_floor" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_room">{{__("t.fd_room")}}</label>
        <input type="text" id="fd_room" name="fd_room" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_sec">{{__("t.fd_sec")}}</label>
        <input type="text" id="fd_sec" name="fd_sec" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_last_hear">{{__("t.fd_last_hear")}}</label>
        <input type="date" id="fd_last_hear" name="fd_last_hear" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_next_hear">{{__("t.fd_next_hear")}}</label>
        <input type="date" id="fd_next_hear" name="fd_next_hear" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_last_req">{{__("t.fd_last_req")}}</label>
        <input type="text" id="fd_last_req" name="fd_last_req" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_now_req">{{__("t.fd_now_req")}}</label>
        <input type="text" id="fd_now_req" name="fd_now_req" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_statement">{{__("t.fd_statement")}}</label>
        <input type="text" id="fd_statement" name="fd_statement" class="form-control">
    </div>
</div>


<div class="col-md-6 col-sm-12 col-xs-12 form-group fd hidden_field">
    <div class="">
        <label for="fd_judge_date">{{__("t.fd_judge_date")}}</label>
        <input type="date" id="fd_judge_date" name="fd_judge_date" class="form-control">
    </div>
</div>




<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class=""><label for="fullname">{{__("t.court_type")}}<span class="text-danger">*</span></label>
        <select class="form-control" id="court_type" name="res_court_type"
                onchange="getCourt(this.value);">
            <option value="">{{__("t.select_court_type")}}</option>
            @foreach($courtTypes as $courtType)
                <option value="{{$courtType->id}}">{{$courtType->court_type_name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class="">
        <label for="res_floor">{{__("t.res_floor")}}</label>
        <input type="text" id="res_floor" name="res_floor" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class="">
        <label for="res_room">{{__("t.res_room")}}</label>
        <input type="text" id="res_room" name="res_room" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class="">
        <label for="res_date">{{__("t.res_date")}}</label>
        <input type="date" id="res_date" name="res_date" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class="">
        <label for="res_jud_dept">{{__("t.res_jud_dept")}}</label>
        <input type="text" id="res_jud_dept" name="res_jud_dept" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class="">
        <label for="res_court_sec">{{__("t.res_court_sec")}}</label>
        <input type="text" id="res_court_sec" name="res_court_sec" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class="">
        <label for="res_hear_req">{{__("t.res_hear_req")}}</label>
        <input type="text" id="res_hear_req" name="res_hear_req" class="form-control">
    </div>
</div>
<div class="col-md-6 col-sm-12 col-xs-12 form-group res hidden_field">
    <div class="">
        <label for="res_judge_date">{{__("t.res_judge_date")}}</label>
        <input type="date" id="res_judge_date" name="res_judge_date" class="form-control">
    </div>
</div>