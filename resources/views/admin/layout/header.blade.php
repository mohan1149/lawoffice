<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        @if(Auth::guard('admin')->user())
                            @if(Auth::guard('admin')->user()->profile_img!="")
                                <img
                                    src='{{asset(config('constants.CLIENT_FOLDER_PATH') .'/'. Auth::guard('admin')->user()->profile_img)}}'>
                            @else
                                <img src="{{asset('public/upload/user-icon-placeholder.png')}}" width='50px' height='40px'>

                            @endif
                        @endif
                        {{Auth::guard('admin')->user()->first_name.' '.Auth::guard('admin')->user()->last_name}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{ url('admin/admin-profile') }}"> <i
                                    class=" fa fa-fw fa-user"></i>&nbsp;&nbsp;{{__('t.profile')}}</a></li>


                        <li><a href="{{ url('/admin/logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><i
                                    class="fa fa-fw fa-sign-out"></i>&nbsp;&nbsp;{{ __('t.logout')}}</a>
                            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li>
                            <a href="{{ url('admin/lang').'/'.app()->getLocale() }}"> <i class=" fa fa-fw fa-globe"></i>&nbsp;&nbsp;{{ app()->getLocale() == "en" ? "العربية" : "English" }}</a></li>
                        <li>
                        
                    </ul>
                </li>

                @if($adminHasPermition->can(['case_list']) =="1")
                    {!! App\Helpers\LogActivity::generateTasks() !!}
                    {!! App\Helpers\LogActivity::getNotifications() !!}
                @endif
		<li>
			<button type="button"style="margin-top:10px"  class="btn btn-danger" data-toggle="modal" data-target="#urgentModal">
                         {{ __("t.urgent")  }}
			</button>
		</li>


            </ul>
	</nav>
<!-- Modal -->
<div class="modal fade" id="urgentModal" tabindex="-1" role="dialog" aria-labelledby="urgentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ __("t.urgent_notications") }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       {!!  App\Http\Controllers\Admin\CaseRunningController::urgentNotifications() !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("t.close") }} </button>
      </div>
    </div>
  </div>
</div>
    </div>
</div>
