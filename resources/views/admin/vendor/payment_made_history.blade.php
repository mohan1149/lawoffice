<div class="modal fade bs-example-modal-lg" id="payment_made_history" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">{{__("t.payment_made_history")}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12 table">
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>{{__("t.invoice_no")}}</th>
                    <th>{{__("t.amout")}}</th>
                    <th>{{__("t.receiving_date")}}</th>
                    <th>{{__("t.payment_method")}}</th>
                    <th>{{__("t.reference_number")}}</th>
                    <th>{{__("t.note")}}</th>
                  </tr>
                </thead>

                <tbody>
                 
                </tbody>

            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{__("t.close")}}</button>
        <button type="button" class="btn btn-primary">{{__("t.save_changes")}}</button>
      </div>

    </div>
  </div>
</div>