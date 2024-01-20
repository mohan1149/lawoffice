<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="clientNextdatemodal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">{{__("t.add_next_date")}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <label for="fullname">{{__("t.case_status")}} <span class="text-danger">*</span></label>
                        <select class="form-control">

                            <option>{{__("t.hearing")}}</option>
                            <option>{{__("t.further_statement")}}</option>

                        </select>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <label for="fullname">{{__("t.next_date")}} <span class="text-danger">*</span></label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <label for="fullname">{{__("t.remarks")}} <span class="text-danger"></span></label>
                        <input type="text" placeholder="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__("t.close")}}</button>
                    <button type="button" class="btn btn-primary">{{__("t.save")}}</button>
                </div>

            </div>
        </div>
    </div>
</div>
