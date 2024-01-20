@extends('admin.layout.app')
@section('title','Expense Type')
@section('content')
    <div class="">
        @component('component.modal_heading',
             [
             'page_title' => __("t.expense_type"),
             'action'=>route("expense-type.create"),
             'model_title'=>__("t.add_expense_type"),
             'modal_id'=>'#addtag',
             'permission' => $adminHasPermition->can(['expense_type_add'])
             ] )
            Status
        @endcomponent


        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <table id="tagDataTable" class="table" data-url="{{ route('expense.type.list') }}"
                              >
                            <thead>
                            <tr>
                                <th width="5%">{{__("t.no")}}</th>
                                <th>{{__("t.name")}}</th>
                                <th width="5%" data-orderable="false">{{__("t.status")}}</th>
                                <th width="2%" data-orderable="false" class="text-center">{{__("t.action")}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="load-modal"></div>
@endsection

@push('js')
    <script src="{{asset('assets/js/expense/expense-type-datatable.js')}}"></script>
@endpush
