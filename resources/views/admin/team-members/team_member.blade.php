@extends('admin.layout.app')
@section('title','Team Member')
@section('content')
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>{{__("t.member_list")}}</h3>
            </div>

            <div class="title_right">
                <div class="form-group pull-right top_search">
                    <a href="{{ url('admin/client_user/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                        {{__("t.add_member")}}r</a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <table id="user_table" class="table">
                            <thead>
                            <tr>
                                <th width="5%">{{__("t.no")}}</th>
                                <th width="30%">{{__("t.name")}}</th>
                                <th width="30%">{{__("t.email")}}</th>
                                <th>{{__("t.contact_no")}}</th>
                                <th>{{__("t.role")}}</th>
                                <th>{{__("t.status")}}</th>
                                <th width="5%">{{__("t.action")}}</th>
                            </tr>
                            </thead>


                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')

    <input type="hidden" name="list"
           id="list"
           value="{{ url('admin/client-user-list') }}">
    <script src="{{asset('assets/js/team_member/member-datatable.js')}}"></script>

@endpush
