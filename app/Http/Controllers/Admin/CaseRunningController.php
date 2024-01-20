<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CaseType;
use App\Model\CaseStatus;
use App\Model\CourtType;
use App\Model\Judge;
use App\Model\CourtCase;
use App\Model\Court;
use App\Model\CaseLog;
use App\Model\CaseTransfer;
use App\Model\AdvocateClient;
use App\Model\CaseMember;
use App\Model\CasePartiesInvolves;
use App\Model\ClientPartiesInvoive;
use App\Model\GeneralSettings;
use App\Admin;
use Validator;
use DB;
use Auth;
// use pdf;
use Carbon\Carbon;
use PDF;
use App\Traits\DatatablTrait;
use App\Helpers\LogActivity;

class CaseRunningController extends Controller
{
    use DatatablTrait;

    public function select2Case(Request $request)
    {
        $search = $request->get('search');
        $data = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS id', 'case.registration_number AS case_number', 'case.act', 'case.priority',
                'case.court_no',
                's.case_status_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id', 'case.is_nb', 'case.is_active'
            )
            // ->where('case.is_active','Yes')
            ->where('ac.first_name', 'like', '%' . $search . '%')
            ->orWhere('ac.middle_name', 'like', '%' . $search . '%')
            ->orWhere('ac.last_name', 'like', '%' . $search . '%')
            // ->orWhere('ac.registration_number', 'like', '%' . $search . '%')
            ->get();

        return response()->json(['items' => $data->toArray(), 'pagination' => false]);
    }


    public function index()
    {

        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_list')) {
            abort(403, 'Unauthorized action.');
        }

        // $totalData = DB::table('court_cases AS case')
        //     ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
        //     ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
        //     ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
        //     ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
        //     ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
        //     ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
        //     ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
        //     ->select('case.id AS case_id', 'case.next_date', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.case_number', 'case.act', 'case.priority',
        //         'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
        //         's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id'
        //     )
        //     ->count();

        return view('admin.case.running');


    }

    public function caseImportant()
    {
        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_list')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.case.important_cases');
    }

    public function caseNB()
    {
        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_list')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.case.nb-cases');
    }

    public function caseArchived()
    {
        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_list')) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.case.archived');
    }

    public function caseListByClientId($id)
    {
        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_list')) {
            abort(403, 'Unauthorized action.');
        }

        $totalCourtCase = CourtCase::where('advo_client_id', $id)->count();
        $clientName = AdvocateClient::findorfail($id);
        $name = $clientName->first_name . ' ' . $clientName->middle_name . ' ' . $clientName->last_name;
        return view('admin.case.client_case_list', ['advo_client_id' => $id, 'name' => $name, 'totalCourtCase' => $totalCourtCase]);
    }

    public function client_case_list(Request $request)
    {


        $user = \Auth::guard('admin')->user();
        $isEdit = $user->can('case_edit');
        $isDelete = $user->can('case_delete');
        /*
          |----------------
          | Listing colomns
          |----------------
         */

        $columns = array(
            0 => 'case_id',
            1 => 'first_name',
            5 => 'last_login_at',
            6 => 'is_active'
        );

        $advocate_id = 1;
        $cond = array('case.advo_client_id' => $request->advocate_client_id);
        $totalData = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS case_id', 'case.next_date', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.registration_number AS case_number', 'case.act', 'case.priority',
                'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id'
            )
            ->where($cond)
            ->count();

        $totalFiltered = $totalData;
        $totalRec = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $cases = DB::table('court_cases AS case')
                ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
                ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
                ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
                ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
                ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
                ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
                ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
                ->select('case.id AS case_id', 'case.next_date', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.registration_number AS case_number', 'case.act', 'case.priority',
                    'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                    's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id'
                )
                ->where($cond)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            /*
              |--------------------------------------------
              | For table search filterfrom frontend site.
              |--------------------------------------------
             */
            $search = $request->input('search.value');


            $cases = DB::table('court_cases AS case')
                ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
                ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
                ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
                ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
                ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
                ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
                ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
                ->select('case.id AS case_id', 'case.next_date', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.registration_number AS case_number', 'case.act', 'case.priority',
                    'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                    's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id'
                )
                // ->where('case.advocate_id',$advocate_id)
                ->where($cond)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = DB::table('court_cases AS case')
                ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
                ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
                ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
                ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
                ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
                ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
                ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
                ->select('case.id AS case_id', 'case.id', 'case.next_date', 'case.party_name', 'case.party_lawyer', 'case.registration_number AS case_number', 'case.act', 'case.priority',
                    'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                    's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id'
                )
                ->where($cond)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->count();
        }
        /*
          |----------------------------------------------------------------------------------------------------------------------------------
          | Creating json array with all records based on input from front end site like all,searcheded,pagination record (i.e 10,20,50,100).
          |----------------------------------------------------------------------------------------------------------------------------------
         */
        $data = array();
        if (!empty($cases)) {
            foreach ($cases as $key => $case) {
                /**
                 * For HTMl action option like edit and delete
                 */

                $show = route('case-running.show', $case->case_id);


                $case_list = url('admin/case-list/' . $case->advo_client_id);
                /**
                 * -/End
                 */
                if ($case->client_position == 'Petitioner') {
                    $first = $case->first_name . '&nbsp;' . $case->middle_name . '&nbsp;' . $case->last_name;
                    $second = $case->party_name;
                } else {
                    $first = $case->party_name;
                    $second = $case->first_name . '&nbsp;' . $case->middle_name . '&nbsp;' . $case->last_name;
                }
                $class = ($case->priority == 'High') ? 'fa fa-star' : (($case->priority == 'Medium') ? 'fa fa-star-half-o' : 'fa fa-star-o');

                if (empty($request->input('search.value'))) {
                    $final = $totalRec - $start;
                    $nestedData['id'] = $final;
                    $totalRec--;
                } else {
                    $start++;
                    $nestedData['id'] = $start;
                }

                if ($isEdit == "1") {
                    $nestedData['name'] = '<div style="font-size:15px;" class="clinthead text-primary">
                       <a  class="text-primary" href="javascript:void(0);" onclick="change_case_important(' . $case->case_id . ')"><i class="text-primary ' . $class . '" aria-hidden="true"></i></a>'
                        . '&nbsp;<a  class="text-primary" href="' . $show . '">' . $case->case_number . '</a></div>
                                        <p class="clinttittle">Case: <b>' . $case->caseType . '</b></p>';

                } else {
                    $nestedData['name'] = '<div style="font-size:15px;"  class="clinthead text-primary"><a class="text-primary" href="javascript:void(0);" ><i class="text-primary ' . $class . '" aria-hidden="true"></i></a>'
                        . '&nbsp;<a  class="text-primary" href="' . $show . '">' . $case->case_number . '</a></div>
                                        <p class="clinttittle">Case: <b>' . $case->caseType . '</b></p>';

                }


                $nestedData['court'] = '<p class="currenttittle">Court :<b> ' . $case->court_name . '</b></p>
                                        <p class="currenttittle">No:<b> ' . $case->court_no . '</b></p>
                                        <p class="currenttittle">Magistrate :<b> ' . $case->judge_name . '</b></p>';

                $nestedData['case'] = '<p class="currenttittle">' . $first . ' <br/><b>VS</b> <br/> ' . $second . '<p>';

                $nestedData['next_date'] = '<p class="currenttittle">' . date(LogActivity::commonDateFromatType(), strtotime(LogActivity::commonDateFromat($case->next_date))) . '<p><small class="currenttittle">' . $this->getLoginUserNameById($case->updated_by) . '</small>';
                $nestedData['status'] = $case->case_status_name;


                if ($isEdit == "1" || $isDelete == "1") {
                    $nestedData['options'] = $this->action([
                        'view' => route('case-running.show', $case->case_id),
                        'edit' => route('case-running.edit', $case->case_id),
                        'next_date_case' => collect([
                            'id' => $case->case_id,
                            'action' => url('admin/addNextDate/' . $case->case_id),
                            'target' => '#addtag'
                        ]),
                        'case_transfer' => collect([
                            'id' => $case->case_id,
                            'action' => url('admin/addNextDate/' . $case->case_id),
                            'target' => '#addtag'
                        ]),
                        'edit_permission' => $isEdit,
                        'delete_permission' => $isDelete,


                    ]);
                } else {
                    $nestedData['options'] = $this->action([
                        'view' => route('case-running.show', $case->case_id),
                        'edit_permission' => $isEdit,
                        'delete_permission' => $isDelete,


                    ]);

                }

                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    public function getLoginUserNameById($id)
    {

        if ($id != '') {
            $name = DB::table('admins')->where('id', $id)->first();
            if (!empty($name)) {
                $fullname = $name->first_name . ' ' . $name->last_name;
                return $fullname;
            } else {
                return 'N/A';
            }
        } else {
            return 'N/A';
        }
    }

    public function allCaseList(Request $request)
    {
	    try{
        $user = \Auth::guard('admin')->user();
        $isEdit = $user->can('case_edit');
        $isDelete = $user->can('case_delete');
        $checkTask = LogActivity::CheckuserType();
        $columns = array(
            0 => 'case_id',
            1 => 'first_name',
            2 => 'last_login_at',
            3 => 'is_active'
        );
        $archived_case = '';
        if ($request->case_listing == 'running') {
            $cond = array('case.is_active' => 'Yes', 'case.is_nb' => 'No');
        } elseif ($request->case_listing == 'NB') {
            $cond = array('case.is_nb' => 'Yes', 'case.is_active' => 'Yes');
        } elseif ($request->case_listing == 'important') {
            $cond = array('case.is_active' => 'Yes', 'case.is_nb' => 'No', 'priority' => 'High');
        } else {
            $cond = array('case.is_active' => 'No');
            $archived_case .= 'Yes';
        }
        $totalData = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS case_id', 'case.next_date', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.registration_number AS case_number', 'case.act', 'case.priority',
                'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id', 'case.is_active'
            )
            ->where($cond)
            ->when($checkTask['type'] == "User", function ($query) use ($checkTask) {
                $query->leftJoin('case_members AS cm', 'cm.case_id', '=', 'case.id');
                $query->where('cm.employee_id', $checkTask['id']);
                return $query;
            })
            ->count();
        $totalRec = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $customcollections = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS case_id', 'case.next_date', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.registration_number AS case_number', 'case.act', 'case.priority',
                'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id', 'case.is_nb', 'case.is_active'
            )
            ->where($cond)
            ->when($request->input('date_from'), function ($query, $iterm) {

                return $query->whereDate('case.next_date', '>=', date('Y-m-d', strtotime(LogActivity::commonDateFromat($iterm))));
            })
            ->when($request->input('date_to'), function ($query, $iterm) {
                return $query->whereDate('case.next_date', '<=', date('Y-m-d', strtotime(LogActivity::commonDateFromat($iterm))));
            })
            ->when($checkTask['type'] == "User", function ($query) use ($checkTask) {
                $query->leftJoin('case_members AS cm', 'cm.case_id', '=', 'case.id');
                $query->where('cm.employee_id', $checkTask['id']);
                return $query;
            })
            ->when($search, function ($query, $search) {
                return $query->where('ac.last_name', 'LIKE', "%{$search}%")
                    ->orWhere('ac.middle_name', 'LIKE', "%{$search}%")
                    ->orWhere('ac.first_name', 'LIKE', "%{$search}%")
                    ->orWhere('case.case_number', 'LIKE', "%{$search}%")
                    ->orWhere('ct.case_type_name', 'LIKE', "%{$search}%")
                    ->orWhere('c.court_name', 'LIKE', "%{$search}%")
                    ->orWhere('case.court_no', 'LIKE', "%{$search}%")
                    ->orWhere('case.judge_name', 'LIKE', "%{$search}%");
            });
        $totalFiltered = $customcollections->count();
        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        $data = [];
        foreach ($customcollections as $key => $case) {
            $case_list = url('admin/case-list/' . $case->advo_client_id);
            if ($case->client_position == 'Petitioner') {
                $first = $case->first_name . '&nbsp;' . $case->middle_name . '&nbsp;' . $case->last_name;
                $second = $case->party_name;
            } else {
                $first = $case->party_name;
                $second = $case->first_name . '&nbsp;' . $case->middle_name . '&nbsp;' . $case->last_name;
            }
            $class = ($case->priority == 'High') ? 'fa fa-star' : (($case->priority == 'Medium') ? 'fa fa-star-half-o' : 'fa fa-star-o');
            if ($isEdit == "1") {
                if ($case->is_nb == 'Yes' || $case->is_active == 'No') {
                    $priorityModal = '<a class="title text-primary" href="javascript:void(0);"></a>';
                } else {
                    $priorityModal = '<a  class="title text-primary" href="javascript:void(0);" onclick="change_case_important(' . $case->case_id . ')"><i class="' . $class . '" aria-hidden="true"></i></a>';
                }
            } else {
                if ($case->is_nb == 'Yes' || $case->is_active == 'No') {
                    $priorityModal = '<a class="title text-primary" href="javascript:void(0);"></a>';
                } else {
                    $priorityModal = '<a class="title text-primary" href="javascript:void(0);"><i class="' . $class . '" aria-hidden="true"></i></a>';
                }
            }
            if (empty($request->input('search.value'))) {
                $final = $totalRec - $start;
                $row['id'] = $final;
                $totalRec--;
            } else {
                $start++;
                $row['id'] = $start;
            }
            $members = $this->getMembers($case->case_id);
            $row['name'] = '<div style="font-size:15px;"  class="clinthead text-primary">' . $priorityModal . ''
                . '&nbsp;<a class="title text-primary"  href="' . $case_list . '">' . $case->first_name . '&nbsp;' . $case->middle_name . '&nbsp;' . $case->last_name . '</a></div>
                                        <p class="clinttittle">No :<b>' . $case->case_number . '</b></p>
                                        <p class="clinttittle">Case: <b>' . $case->caseType . '</b></p>
                                        <p class="clinttittle"><b>Assign To</b></p>
                                        ' . $members;

            $row['court'] = '<p class="currenttittle">Court :<b> ' . $case->court_name . '</b></p>
                                        <p class="currenttittle">No :<b> ' . $case->court_no . '</b></p>
                                        <p class="currenttittle">Magistrate :<b> ' . $case->judge_name . '</b></p>';

            $row['case'] = '<p class="currenttittle">' . $first . ' <br/><b>VS</b> <br/>' . $second . '<p>';
            $row['next_date'] = '<p class="currenttittle">' . date(LogActivity::commonDateFromatType(), strtotime($case->next_date)) . '</p><small class="currenttittle">' . $this->getLoginUserNameById($case->updated_by) . '</small>';
            $row['status'] = $case->case_status_name;


            if ($isEdit == "1" || $isDelete == "1") {
                $row['options'] = $this->action([
                    'view' => route('case-running.show', $case->case_id),
                    'edit' => route('case-running.edit', $case->case_id),
                    'next_date_case' => collect([
                        'id' => $case->case_id,
                        'action' => url('admin/addNextDate/' . $case->case_id),
                        'target' => '#addtag'
                    ]),
                    'case_transfer' => collect([
                        'id' => $case->case_id,
                        'action' => url('admin/addNextDate/' . $case->case_id),
                        'target' => '#addtag'
                    ]),
                    'delete_permission' => $isDelete,
                    'edit_permission' => $isEdit,
                ]);

            } else {
                $row['options'] = $this->action([
                    'view' => route('case-running.show', $case->case_id),

                ]);

            }


            $data[] = $row;

        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

	return response()->json($json_data);
	    }
	    catch(\Exception $e){
	    return $e->getMessage();
	    }

    }

    public function getMembers($id)
    {

        $getTaskMemberArr = CaseMember::where('case_id', $id)->pluck('employee_id');
        $getmulti = Admin::whereIn('id', $getTaskMemberArr)->get();
        $con = "<div style='display: flex;''>";
        foreach ($getmulti as $key => $value) {
            $con .= '<div title="' . $value->first_name . ' ' . $value->last_name . '" data-letters="' . ucfirst(substr($value->first_name, 0, 1)) . '"> </div>';
        }
        $con .= "</div>";

        return $con;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_add')) {
            abort(403, 'Unauthorized action.');
        }

        //Get case type
        $data['caseTypes'] = CaseType::where('parent_id', 0)
            ->where('is_active', 'Yes')
            ->orderBy('case_type_name', 'asc')
            ->get();
        //Get case status
        $data['caseStatuses'] = CaseStatus::where('is_active', 'Yes')
            ->orderBy('case_status_name', 'asc')
            ->get();

        //Get court type
        $data['courtTypes'] = CourtType::where('is_active', 'Yes')
            ->orderBy('court_type_name', 'asc')
            ->get();

        //Get judge type
        $data['judges'] = Judge::where('is_active', 'Yes')
            ->orderBy('judge_name', 'asc')
            ->get();

        $data['client_list'] = AdvocateClient::where('is_active', 'Yes')->orderBy('first_name', 'asc')->get();
        // dd(   $data['client_list']);

        $data['users'] = Admin::where('user_type', '=', "User")->where('is_active', 'Yes')->get();


        return view('admin.case.add_case', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $index = 0;
        $case = new CourtCase();
        $case->advocate_id = "1";
        $case->ctitle = $request->ctitle;
        $case->advo_client_id = $request->client_name;
        $case->client_position = $request->position;
        $case->party_name = $request->input('parties_detail.' . $index . '.party_name');
        $case->party_lawyer = $request->input('parties_detail.' . $index . '.party_advocate');
        $case->case_number = $request->case_no;
        $case->case_types = $request->case_type;
        $case->case_sub_type = $request->case_sub_type;
        $case->case_status = $request->case_status;
        $case->act = $request->act;
        $case->priority = $request->priority;
        $case->court_no = $request->court_no;
        $case->court_type = $request->court_type;
        $case->court = $request->court_name;
        $case->judge_type = $request->judge_type;
        $case->judge_name = $request->judge_name;
        $case->filing_number = $request->filing_number;
        $case->filing_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->filing_date)));
        $case->registration_number = $request->registration_number;
        $case->registration_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->registration_date)));
        if ($request->next_date != '') {
            $case->first_hearing_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
            $case->next_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
        }
        $case->cnr_number = $request->cnr_number;
        $case->remark = $request->remarks;
        $case->description = $request->description;
        $case->police_station = $request->police_station;
        $case->fir_number = $request->fir_number;
        $case->fir_date = ($request->fir_date != '') ? date('Y-m-d', strtotime(LogActivity::commonDateFromat($request->fir_date))) : null;
        $case->updated_by = Auth::guard('admin')->user()->id;
        $case->case_level = $request['case_level'];
        $case->save();
        $input[] = ['case_id'=>$case->id];
        DB::table('case_levels')->insert([
            'case_id'=>$case->id,
            'case_level'=>$request['case_level'],
            'case_num'=>$request['case_no'],
            'level_notes'=>$request['description'],
            'ps_station'=>$request['ps_station'],
            'officer'=> $request['case_level'] == 'police' ? $request['po_officer'] : $request['pro_officer'],
            'reg_date'=> $request['reg_date'],
            'decision'=>$request['case_level'] == 'police' ? $request['po_officer'] : $request['pro_officer'],
            'dec_date'=>$request['case_level'] == 'police' ? $request['po_decision'] : $request['pro_decision'],
            'rel_date'=>$request['case_level'] == 'police' ? $request['po_rel_date'] : $request['pro_rel_date'],
            'warranty'=>$request['case_level'] == 'police' ? $request['po_warranty'] : $request['pro_warranty'],
            'date_payment'=>$request['case_level'] == 'police' ? $request['po_date_payment'] : $request['pro_date_payment'],
            'pros_type'=>$request['pros_type'],
            'pros_name'=>$request['pro_officer'],
            'pros_summon'=>$request['summon'],
            'pros_next_summon_date'=>$request['summon_next'],
        ]);
        DB::table('case_executions')->insert([
            'case_id'=>$case->id,
        ]);

        if (isset($request->assigned_to) && count($request->assigned_to)) {
            foreach ($request->assigned_to as $key => $value) {
                # Arrary in assigne employee...
                $taskMember = new CaseMember();
                $taskMember->case_id = $case->id;
                $taskMember->employee_id = $value;
                $taskMember->save();
            }
        }
        if ($case->id) {
            if (!empty($request->parties_detail)) {
                foreach ($request->parties_detail as $key => $val) {
                    $party = new CasePartiesInvolves();
                    $party->court_case_id = $case->id;
                    $party->position = $case->client_position;
                    $party->party_name = $request->input('parties_detail.' . $key . '.party_name');
                    $party->party_advocate = $request->input('parties_detail.' . $key . '.party_advocate');
                    $party->save();
                }
            }
            $caseLog = new CaseLog();
            $caseLog->advocate_id = "1";
            $caseLog->court_case_id = $case->id;
            $caseLog->judge_type = $request->judge_type;
            $caseLog->case_status = $request->case_status;
            $caseLog->court_no = $request->court_no;
            $caseLog->judge_name = $request->judge_name;
            $caseLog->bussiness_on_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
            $caseLog->updated_by = Auth::guard('admin')->user()->id;
            $caseLog->save();
        }
        return redirect()->route('case-running.index')->with('success', "Case added successfully.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    protected function validator_case(array $data)
    {
        return Validator::make($data, [
            'client_name' => 'required',
            'position' => 'required',
            'case_no' => 'required|max:190',
            'case_type' => 'required',

            'case_status' => 'required',
            'act' => 'required',
            'priority' => 'required',

            'court_no' => 'required',
            'court_type' => 'required',
            'court_name' => 'required',
            'judge_type' => 'required',

            'filing_number' => 'required|max:190',
            'filing_date' => 'required',
            'registration_number' => 'required',
            'registration_date' => 'required',

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_list')) {
            abort(403, 'Unauthorized action.');
        }

        $case = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS case_id', 'case.advo_client_id AS client_id', 'case.next_date', 'case.decision_date', 'case.nature_disposal', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.case_number', 'case.act', 'case.priority',
                'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', DB::raw('CONCAT(ac.first_name, " ", ac.middle_name, " " ,ac.last_name) AS full_name'), 'case.filing_number', 'case.filing_date', 'case.registration_number', 'case.registration_date',
                'case.remark', 'case.description', 'case.cnr_number', 'case.first_hearing_date', 'case.case_number','case.case_level'
            )
            ->where('case.id', $id)
            ->first();


        $data = $this->getRespon($case->client_id, $case->case_id, $case->client_position);

        $data['case'] = $case;
        $data['courtTypes'] = CourtType::where('is_active', 'Yes')
        ->orderBy('court_type_name', 'asc')
        ->get();

        $data['docuemts'] = [
            'id'=>$id,
            'documents' => DB::table('case_documents')->where('case_id',$id)->get(),
        ];
        $data['current_level'] = DB::table('court_cases as case')
            ->leftJoin('case_hearings as hearing','case.case_current_hearing','=','hearing.hid')
            ->leftJoin('case_levels as level','case.case_level','=','level.case_level')
            ->where('case.id',$id)
            ->where('level.case_level',$case->case_level)
            ->orderBy('level.lid','DES')
            ->first();
        $data['case_types'] = DB::table('tudgement_time_lows as laws')
            ->leftJoin('case_types as types','types.id','=','laws.case_type')
            ->where('laws.case_level',$case->case_level)
            ->select(['laws.jtlid','laws.number_days','laws.case_level','types.case_type_name'])
            ->get();
        $data['days'] = DB::table('tudgement_time_lows')->where('case_level',$case->case_level)->get();
        return view('admin.case.view.view_case_details', $data);
    }

    public function uploadDocument(Request $request){
        try {
            $cid = $request['cid'];
            $case_doc = $request->file('case_doc');
            $org_name  = $case_doc->getClientOriginalName();
            $unique_name  = uniqid().'.'.$case_doc->getClientOriginalExtension();
            $destination = 'storage/documents';
            $case_doc->move($destination, $unique_name );
            $thumbnail = $request->getSchemeAndHttpHost().'/storage/documents/'.$unique_name;
            DB::table('case_documents')->insert([
                'case_id'=> $cid,
                'name' => $org_name,
                'url' => $thumbnail,
                'uploaded_on' => date('Y-m-d'),
            ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteDocument(Request $request){
        try {
            $id = $request['id'];
            DB::table('case_documents')->where('id',$id)->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRespon($client_id, $court_case_id, $client_position)
    {

        //for petitioner and respondent
        $client_single_name = AdvocateClient::select('first_name', 'middle_name', 'last_name')->find($client_id);
        $client_single = $client_single_name->first_name . ' ' . $client_single_name->middle_name . ' ' . $client_single_name->last_name;
        $admin = Admin::find(1);


        $clientPar = array();
        $clientPartiesInvoive = ClientPartiesInvoive::where('client_id', $client_id)->get();
        if (count($clientPartiesInvoive) && !empty($clientPartiesInvoive)) {
            foreach ($clientPartiesInvoive as $key => $value) {
                $clientPar[$key]['party_name'] = $value['party_firstname'] . ' ' . $value['party_middlename'] . ' ' . $value['party_lastname'];
                if (empty($value['party_advocate'])) {
                    $clientPar[$key]['party_advocate'] = $admin->first_name . ' ' . $admin->last_name;
                } else {
                    $clientPar[$key]['party_advocate'] = $value['party_advocate'];
                }
            }
        }


        $mearge = array();
        $cli[0]['party_name'] = $client_single;
        $cli[0]['party_advocate'] = $admin->first_name . ' ' . $admin->last_name;

        if (!empty($clientPar) && count($clientPar) > 0) {
            $mearge = array_merge($cli, $clientPar);
        } else {
            $mearge = $cli;
        }

        $respondent = CasePartiesInvolves::select("party_name", "party_advocate")->where('court_case_id', $court_case_id)->get();
        if (count($respondent) && !empty($respondent)) {
            $second = collect($respondent)->toArray();
        }
        // $result=collect($case)->toArray();

        $PetitiAndRespo = array();
        if ($client_position == "Petitioner") {
            $result['petitioner_and_advocate'] = $mearge;
            $result['respondent_and_advocate'] = $second;
        } else {
            $result['petitioner_and_advocate'] = $second;
            $result['respondent_and_advocate'] = $mearge;
        }
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth::guard('admin')->user();
        if (!$user->can('case_edit')) {
            abort(403, 'Unauthorized action.');
        }

        $checkTask = LogActivity::CheckuserType();

        if ($checkTask['type'] == "User") {
            $check = CaseMember::where('case_id', $id)->where('employee_id', $checkTask['id'])->count();
            if ($check == 0) {
                abort(403, 'Unauthorized action.');
            }
        }


        //Get case type all by added superadmin + added by advocate
        $data['caseTypes'] = CaseType::where('parent_id', 0)
            ->where('is_active', 'Yes')
            ->orderBy('case_type_name', 'asc')
            ->get();
        //Get case status all by added superadmin + added by advocate
        $data['caseStatuses'] = CaseStatus::where('is_active', 'Yes')
            ->orderBy('case_status_name', 'asc')
            ->get();

        //Get court type all by added superadmin + added by advocate
        $data['courtTypes'] = CourtType::where('is_active', 'Yes')
            ->orderBy('court_type_name', 'asc')
            ->get();

        //Get judge type all by added superadmin + added by advocate
        $data['judges'] = Judge::where('is_active', 'Yes')
            ->orderBy('judge_name', 'asc')
            ->get();

        $data['case'] = CourtCase::findorfail($id);

        $data['caseSubTypes'] = CaseType::where('parent_id', $data['case']->case_types)->where('is_active', 'Yes')->orderBy('created_at', 'desc')->get();

        $data['courts'] = Court::where('court_type_id', $data['case']->court_type)->where('is_active', 'Yes')->orderBy('created_at', 'desc')->get();

        $data['client_list'] = AdvocateClient::orderBy('first_name', 'asc')->get();

        $data['parties'] = CasePartiesInvolves::where('court_case_id', $id)->get();

        $data['users'] = Admin::where('user_type', '=', "User")->get();


        $data['user_ids'] = array();

        $data['user_ids'] = CaseMember::where('case_id', $id)->pluck('employee_id')->toArray();

        return view('admin.case.edit_case', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validatedData = $this->validator_case($input);
        $index = '0';
        if ($validatedData->passes()) {
            // $advocate_id = $this->getLoginUserId();
            $case = CourtCase::findorfail($id);

            $case->advocate_id = '1';
            $case->ctitle = $request->ctitle;
            $case->advo_client_id = $request->client_name;
            $case->client_position = $request->position;
            $case->party_name = $request->input('parties_detail.' . $index . '.party_name');
            $case->party_lawyer = $request->input('parties_detail.' . $index . '.party_advocate');
            $case->case_number = $request->case_no;
            $case->case_types = $request->case_type;
            $case->case_sub_type = $request->case_sub_type;
            $case->case_status = $request->case_status;
            $case->act = $request->act;
            $case->priority = $request->priority;
            $case->court_no = $request->court_no;
            $case->court_type = $request->court_type;
            $case->court = $request->court_name;
            $case->judge_type = $request->judge_type;
            $case->judge_name = $request->judge_name;
            $case->filing_number = $request->filing_number;
            $case->filing_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->filing_date)));
            $case->registration_number = $request->registration_number;
            $case->registration_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->registration_date)));
            if ($request->next_date != '') {
                //Update case log table with old bussines date to update bussiness dat eith next date of case update form
                $caseLogCount = CaseLog::where('court_case_id', $id)->count();
                //dd($caseLogCount);
                $caseLog = CaseLog::Where('court_case_id', $id)->where('bussiness_on_date', $case->next_date)->first();

                $caseLogHearingDate = CaseLog::where('court_case_id', $id)->where('hearing_date', $case->next_date)->first();
                //dd($caseLogHearingDate);
                if (!empty($caseLog)) {
                    $caseLogUpdate = CaseLog::findorfail($caseLog->id);

                    $caseLogUpdate->judge_type = $request->judge_type;
                    $caseLogUpdate->case_status = $request->case_status;
                    $caseLogUpdate->court_no = $request->court_no;
                    $caseLogUpdate->judge_name = $request->judge_name;
                    $caseLogUpdate->bussiness_on_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
                    if (!empty($caseLogHearingDate->hearing_date)) {
                        $caseLogUpdateHearingDate = CaseLog::findorfail($caseLogHearingDate->id);

                        $caseLogUpdateHearingDate->hearing_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));

                        $caseLogUpdateHearingDate->updated_by = Auth::guard('admin')->user()->id;
                        $caseLogUpdateHearingDate->save();
                    }


                    $caseLogUpdate->updated_by = Auth::guard('admin')->user()->id;

                    $caseLogUpdate->save();
                    //End of updateion on case log table
                    if ($caseLogCount == 1) {
                        $case->first_hearing_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
                    }
                    if (date('Y-m-d', strtotime($case->next_date)) == date('Y-m-d', strtotime(LogActivity::commonDateFromat($request->next_date)))) {
                        $case->next_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
                    } else {
                        $case->next_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
                        $case->updated_by = Auth::guard('admin')->user()->id;
                        // $case->updated_by           = "1";
                    }
                }
            }
            $case->cnr_number = $request->cnr_number;
            $case->remark = $request->remarks;
            $case->description = $request->description;
            $case->police_station = $request->police_station;
            $case->fir_number = $request->fir_number;
            $case->fir_date = ($request->fir_date != '') ? date('Y-m-d', strtotime(LogActivity::commonDateFromat($request->fir_date))) : null;;

            if ($request->decision_date != '') {
                $case->decision_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->decision_date)));

                $case->nature_disposal = $request->nature_disposal;
                $case->is_active = 'No';

            }

            $case->save();


            //assign user
            $getCaseMember = CaseMember::where('case_id', $id)->delete();
            if (isset($request->assigned_to) && count($request->assigned_to)) {

                foreach ($request->assigned_to as $key => $value) {
                    # Arrary in assigne employee...
                    $taskMember = new CaseMember();
                    $taskMember->case_id = $case->id;
                    $taskMember->employee_id = $value;
                    $taskMember->save();
                }

            }

            if ($case->id) {

                //Update records to parties table for multiple records or single.
                if (!empty($request->parties_detail)) {
                    $delete = CasePartiesInvolves::where('court_case_id', $id)->delete();
                    foreach ($request->parties_detail as $key => $val) {

                        $party = new CasePartiesInvolves();
                        $party->court_case_id = $case->id;
                        $party->position = $case->client_position;
                        $party->party_name = $request->input('parties_detail.' . $key . '.party_name');
                        $party->party_advocate = $request->input('parties_detail.' . $key . '.party_advocate');
                        $party->save();
                    }
                }
            }


            return redirect()->route('case-running.index')->with('success', "Case updated successfully.");
        }
        return back()->with('errors', $validatedData->errors());
    }

    public function getNextDateModal($case_id)
    {
        $caseStatuses = CaseStatus::where('is_active', 'Yes')->orderBy('case_status_name', 'asc')->get();

        $judges = Judge::where('is_active', 'Yes')->orderBy('judge_name', 'asc')->get();
        $case = CourtCase::findorfail($case_id);
        return view('admin.case.modal_next_date', ['caseStatuses' => $caseStatuses, 'case' => $case, 'judges' => $judges]);
    }

    public function getChangeCourtModal($case_id)
    {

        $caseStatuses = CaseStatus::where('is_active', 'Yes')->orderBy('case_status_name', 'asc')->get();
        $judges = Judge::where('is_active', 'Yes')->orderBy('judge_name', 'asc')->get();
        $case = CourtCase::findorfail($case_id);
        return view('admin.case.modal_change_court', ['caseStatuses' => $caseStatuses, 'case' => $case, 'judges' => $judges]);
    }

    //Function for change case priority

    public function addNextDate($case_id)
    {
        $caseStatuses = CaseStatus::where('is_active', 'Yes')->orderBy('created_at', 'desc')->get();
        $judges = Judge::where('is_active', 'Yes')->orderBy('created_at', 'desc')->get();
        $case = CourtCase::findorfail($case_id);
        return view('admin.case.modal_next_date', ['caseStatuses' => $caseStatuses, 'case' => $case, 'judges' => $judges]);
    }

    public function getCaseImportantModal($case_id)
    {
        $case = CourtCase::findorfail($case_id);
        return view('admin.case.modal_change_priority', ['case' => $case]);
    }

    public function changeCasePriority(Request $request)
    {
        // dd($request->all());
        $case = CourtCase::findorfail($request->id);

        //activity logs
        $redirect_url = url('admin/case-running');
        $activity = 'Case priority ' . $case->priority . ' to ' . $request->priority . ' Registration no :&nbsp;' . $case->case_number;


        $case->priority = $request->priority;
        $case->save();

        echo 'success';
    }

    public function restoreCase($case_id, Request $request)
    {
        $case = CourtCase::findorfail($case_id);
        $case->is_active = 'Yes';

        $case->update();

        $redirect_url = url('admin/case-running/' . $case_id);
        $activity = '#case no&nbsp;' . $case->registration_number;
        LogActivity::addToLog('Restore case', $activity, $redirect_url);
        return redirect()->to('admin/case-archived')->with('success', "Case no# " . $case->registration_number . "  restore successfully.");
    }

    public function caseNextDate(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            //'judgeType'     => 'required',
            'case_status' => 'required',
            'next_date' => 'sometimes',
        ]);

        if ($validatedData->passes()) {

            //Update caourt case table with latest status and next date
            $CourtCase = CourtCase::findorfail($request->case_id);

            //Update next date with bussiness on date

            $caseLog = CaseLog::where('court_case_id', $request->case_id)->where('bussiness_on_date', $CourtCase->next_date)->first();

            if ($request->next_date == '') {

                $caseLogUpdate = CaseLog::findorfail($caseLog->id);

                $caseLogUpdate->judge_type = $CourtCase->judge_type;

                $caseLogUpdate->court_no = $CourtCase->court_no;
                $caseLogUpdate->judge_name = $CourtCase->judge_name;
                $caseLogUpdate->updated_by = Auth::guard('admin')->user()->id;
                $caseLogUpdate->remark = $request->remarks;


                if ($request->decision_date != '') {

                    $CourtCase->decision_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->decision_date)));

                    $CourtCase->nature_disposal = $request->nature_disposal;
                    $CourtCase->is_active = 'No';

                    //Insert next date on bussines on date
                    $caseLogUpdate->hearing_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->decision_date)));
                    $caseLogInsert = new CaseLog();

                    $caseLogInsert->advocate_id = "1";
                    $caseLogInsert->court_case_id = $request->case_id;
                    $caseLogInsert->judge_type = $CourtCase->judge_type;
                    $caseLogInsert->case_status = $request->case_status;
                    $caseLogInsert->court_no = $CourtCase->court_no;
                    $caseLogInsert->judge_name = $CourtCase->judge_name;
                    $caseLogInsert->bussiness_on_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->decision_date)));
                    $caseLogInsert->updated_by = Auth::guard('admin')->user()->id;

                    $caseLogInsert->save();

                    $CourtCase->next_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->decision_date)));

                    if ($CourtCase->is_nb == 'Yes') {
                        $activity_msg = 'Case status change from No Board to Archived. ';
                    } else {
                        $activity_msg = 'Case status change from Running to Archived. ';
                    }


                } else {
                    $caseLogUpdate->case_status = $request->case_status;
                }
                $caseLogUpdate->save();

                $CourtCase->case_status = $request->case_status;


                $CourtCase->updated_by = "1";


                if ($request->is_nb == 'Yes') {

                    $CourtCase->is_nb = 'Yes';
                    $CourtCase->priority = 'Low';
                    $CourtCase->is_active = 'Yes';


                }

                $CourtCase->update();


            } else {

                $caseLogUpdate = CaseLog::findorfail($caseLog->id);

                $caseLogUpdate->judge_type = $CourtCase->judge_type;

                $caseLogUpdate->court_no = $CourtCase->court_no;
                $caseLogUpdate->judge_name = $CourtCase->judge_name;
                $caseLogUpdate->hearing_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
                $caseLogUpdate->updated_by = Auth::guard('admin')->user()->id;


                $caseLogUpdate->remark = $request->remarks;
                $caseLogUpdate->save();

                //Insert next date on bussines on date

                $caseLogInsert = new CaseLog();

                $caseLogInsert->advocate_id = "1";
                $caseLogInsert->court_case_id = $request->case_id;
                $caseLogInsert->judge_type = $CourtCase->judge_type;
                $caseLogInsert->case_status = $request->case_status;
                $caseLogInsert->court_no = $CourtCase->court_no;
                $caseLogInsert->judge_name = $CourtCase->judge_name;
                $caseLogInsert->bussiness_on_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
                $caseLogInsert->updated_by = Auth::guard('admin')->user()->id;
                $caseLogInsert->save();


                if ($CourtCase->decision_date != '' && $CourtCase->is_active = 'No' && ($request->case_status != 'Disposed' || $request->case_status != 'Closed')) {
                    $CourtCase->decision_date = NULL;

                    $CourtCase->nature_disposal = NULL;
                    $CourtCase->is_active = 'Yes';
                } else {
                    if ($CourtCase->is_nb == 'No') {
                        $activity_msg = 'Add next date of ';
                    } else {
                        $activity_msg = 'Case status change from No Board to Running.';
                    }

                }
                $CourtCase->case_status = $request->case_status;
                $CourtCase->updated_by = "1";
                $CourtCase->next_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->next_date)));
                $CourtCase->is_nb = 'No';
                $CourtCase->update();
            }
            echo 'success';
        }
    }

    public function caseHistory($case_id){
        return view('admin.case.view.view_case_history', ['case_id' => $case_id]);
    }

    public function allCaseHistoryList(Request $request)
    {
        // Listing column to show
        $columns = array(
            0 => 'registration_number',
            1 => 'judge',
            2 => 'business_on_date',
            3 => 'hearing_date',
            4 => 'purpose_of_hearing'
        );

        $case_id = $request->case_id;


        $totalData = DB::table('case_logs AS cl')
            ->join('court_cases AS cc', 'cl.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'cl.judge_type', '=', 'j.id')
            ->join('case_statuses AS s', 'cl.case_status', '=', 's.id')
            ->select('cl.id AS case_log_id', 'cl.remark', 'cl.bussiness_on_date', 'cl.hearing_date', 'j.judge_name'
                , 's.case_status_name', 'cc.registration_number')
            ->where('cl.court_case_id', $case_id)
            ->count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');


        $customcollections = DB::table('case_logs AS cl')
            ->join('court_cases AS cc', 'cl.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'cl.judge_type', '=', 'j.id')
            ->join('case_statuses AS s', 'cl.case_status', '=', 's.id')
            ->select('cl.id AS case_log_id', 'cl.remark', 'cl.bussiness_on_date', 'cl.hearing_date', 'j.judge_name', 's.case_status_name', 'cc.registration_number')
            ->where('cl.court_case_id', $case_id)
            ->when($search, function ($query, $search) {
                $query->where('cc.registration_number', 'LIKE', "%{$search}%")
                    ->orWhere('j.judge_name', 'LIKE', "%{$search}%")
                    ->orWhere('s.case_status_name', 'LIKE', "%{$search}%");
            });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $log) {


            $row['registration_no'] = $log->registration_number;
            $row['judge'] = $log->judge_name;
            $row['business_on_date'] = date(LogActivity::commonDateFromatType(), strtotime(LogActivity::commonDateFromat($log->bussiness_on_date)));
            if ($log->hearing_date != '') {
                $row['hearing_date'] = date(LogActivity::commonDateFromatType(), strtotime(LogActivity::commonDateFromat($log->hearing_date)));
            } else {
                $row['hearing_date'] = '';
            }
            $bod = "'" . date('d-m-Y', strtotime($log->bussiness_on_date)) . "'";
            $remarks = "'" . (($log->remark != '') ? addslashes($log->remark) : 'N/A') . "'";

            $row['purpose_of_hearing'] = $log->case_status_name;
            $row['remarks'] = '<a href="javascript:void(0);" onclick="showRemark(' . $bod . ',' . $remarks . ');"  class="text-center"><i class="fa fa-eye fa-2x"></i></a>';


            $data[] = $row;


        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }

    public function caseTransfer($case_id)
    {
        return view('admin.case.view.view_case_transfer', ['case_id' => $case_id]);
    }

    public function allCaseTransferList(Request $request)
    {


        // Listing column to show
        $columns = array(
            0 => 'case_transfer_id',
            1 => 'registration_no',
            2 => 'transferDate',
            3 => 'judge_name',
            4 => 'to_court_no'
        );

        $case_id = $request->case_id;

        $totalData = DB::table('case_transfers AS ct')
            ->join('court_cases AS cc', 'ct.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'ct.from_judge_type', '=', 'j.id')
            ->join('judges AS jt', 'ct.to_judge_type', '=', 'jt.id')
            ->select('ct.id AS case_transfer_id', 'ct.transfer_date AS transferDate', 'ct.from_court_no', 'j.judge_name'
                , 'cc.registration_number', 'ct.to_court_no', 'jt.judge_name AS transferJudge')
            ->where('ct.court_case_id', $case_id)
            ->count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');


        $customcollections = DB::table('case_transfers AS ct')
            ->join('court_cases AS cc', 'ct.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'ct.from_judge_type', '=', 'j.id')
            ->join('judges AS jt', 'ct.to_judge_type', '=', 'jt.id')
            ->select('ct.id AS case_transfer_id', 'ct.transfer_date AS transferDate', 'ct.from_court_no', 'j.judge_name'
                , 'cc.registration_number', 'ct.to_court_no', 'jt.judge_name AS transferJudge')
            ->where('ct.court_case_id', $case_id)
            ->where(function ($query) use ($search) {
                $query->where('cc.registration_number', 'LIKE', "%{$search}%")
                    ->orWhere('ct.transfer_date', 'LIKE', "%{$search}%");
            });


        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $log) {


            $row['id'] = $log->case_transfer_id;
            $row['registration_no'] = $log->registration_number;
            $row['transfer_date'] = date(LogActivity::commonDateFromatType(), strtotime(LogActivity::commonDateFromat($log->transferDate)
            ));
            $row['from'] = $log->from_court_no . '-' . $log->judge_name;
            $row['to'] = $log->to_court_no . '-' . $log->transferJudge;


            $data[] = $row;


        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }

    public function destroy($id)
    {
        //
    }

    public function downloadPdf($id, $action)
    {
        $data['setting'] = GeneralSettings::where('id', "1")->first();

        $case = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS case_id', 'case.advo_client_id AS client_id', 'case.next_date', 'case.decision_date', 'case.nature_disposal', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.case_number', 'case.act', 'case.priority',
                'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name AS judgeType', DB::raw('CONCAT(ac.first_name, " ", ac.middle_name, " " ,ac.last_name) AS full_name'), 'case.filing_number', 'case.filing_date', 'case.registration_number', 'case.registration_date',
                'case.remark', 'case.description', 'case.cnr_number', 'case.first_hearing_date',
                'case.police_station', 'case.fir_number', 'case.fir_date', 'case.act')
            ->where('case.id', $id)
            ->first();
        $data['associatedName'] = Admin::select('associated_name')->where('id', '1')->first();
        $data['case'] = $case;
        $getRespo = $this->getRespon($case->client_id, $case->case_id, $case->client_position);
        $data['petitioner_and_advocate'] = $getRespo['petitioner_and_advocate'];
        $data['respondent_and_advocate'] = $getRespo['respondent_and_advocate'];

        //case hestroy
        $getHistory = DB::table('case_logs AS cl')
            ->join('court_cases AS cc', 'cl.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'cl.judge_type', '=', 'j.id')
            ->join('case_statuses AS s', 'cl.case_status', '=', 's.id')
            ->select('cl.id AS case_log_id', 'cl.bussiness_on_date', 'cl.hearing_date', 'j.judge_name'
                , 's.case_status_name', 'cc.registration_number')
            ->where('cl.court_case_id', $id)
            ->get();

        $data['history'] = array();
        if (count($getHistory) > 0 && !empty($getHistory)) {
            $data['history'] = $getHistory;
        }
        //for transfer
        $transfer = DB::table('case_transfers AS ct')
            ->join('court_cases AS cc', 'ct.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'ct.from_judge_type', '=', 'j.id')
            ->join('judges AS jt', 'ct.to_judge_type', '=', 'jt.id')
            ->select('ct.id AS case_transfer_id', 'ct.transfer_date AS transferDate', 'ct.from_court_no', 'j.judge_name'
                , 'cc.registration_number', 'ct.to_court_no', 'jt.judge_name AS transferJudge')
            ->where('ct.court_case_id', $id)
            ->get();


        $data['transfer'] = array();
        if (count($transfer) > 0 && !empty($transfer)) {
            $data['transfer'] = $transfer;
        }

        if ($action == "print") {
		//pdf view
	//	$pdf = new PDF(['autoArabic' => true]);
            $pdf = PDF::loadView('pdf.welcome', $data);
            return $pdf->stream();

        } else {

            //pdf download
            $pdf = PDF::loadView('pdf.welcome', $data);
            $filename = time() . ".pdf";
            return $pdf->download($filename);
        }
    }

    public function transferCaseCourt(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'judge_type' => 'required',
            'court_number' => 'required',
            'transfer_date' => 'required',
        ]);
        if ($validatedData->passes()) {

            $toCourt = $request->court_number;
            $CourtCase = CourtCase::findorfail($request->case_id);

            $fromCourt = $CourtCase->court_no;
            $case_transfer = new CaseTransfer();

            $case_transfer->advocate_id = "1";
            $case_transfer->court_case_id = $CourtCase->id;
            $case_transfer->from_judge_type = $CourtCase->judge_type;
            $case_transfer->to_judge_type = $request->judge_type;
            $case_transfer->from_court_no = $CourtCase->court_no;
            $case_transfer->to_court_no = $request->court_number;
            $case_transfer->judge_name = $request->judge_name;
            $case_transfer->transfer_date = date('Y-m-d H:i:s', strtotime(LogActivity::commonDateFromat($request->transfer_date)));

            $case_transfer->save();

            $CourtCase->court_no = $request->court_number;
            $CourtCase->judge_type = $request->judge_type;
            $CourtCase->judge_name = $request->judge_name;


            $CourtCase->save();
            echo 'success';
        }
        return back()->with('errors', $validatedData->errors());
    }

    public static  function urgentNotifications(){
	    try{
		    $current = Carbon::today();	    
		    $endDate = Carbon::today()->addDays(10);
		    $notif = DB::table('court_cases')->whereBetween('next_date', [$current, $endDate])->get();
		    return view("admin.case.urgent",['notif'=>$notif]);
	    }catch(\Exception $e){
		    return view("admin.case.urgent",['notif'=>[]]);
	    }
    }


    public function addLevel(Request $request){
        try {
            DB::table('case_step_levels')->insert([
                'case_id'=>$request['case_id'],
                'case_level'=>$request['case_level'],
                'detective'=>$request['detective'],
                'police_decision'=>$request['police_decision'],
                'police_decision_date'=>$request['police_decision_date'],
                'police_release_date'=>$request['police_release_date'],
                'police_warranty_value'=>$request['police_warranty_value'],
                'police_date_payment'=>$request['police_date_payment'],
                'pros_type'=>$request['pros_type'],
                'pros_name'=>$request['pros_name'],
                'pros_sec_name'=>$request['pros_summon_date'],
                'pros_summon_date'=>$request['pros_summon_date'],
                'pros_next_summon_date'=>$request['pros_next_summon_date'],
                'pros_decision'=>$request['pros_decision'],
                'pros_decision_date'=>$request['pros_decision_date'],
                'pros_release_date'=>$request['pros_release_date'],
                'pros_warranty'=>$request['pros_warranty'],
                'pros_date_pay'=>$request['pros_date_pay'],
                'fd_jud_dept'=>$request['fd_jud_dept'],
                'fd_floor'=>$request['fd_floor'],
                'fd_room'=>$request['fd_room'],
                'fd_sec'=>$request['fd_sec'],
                'fd_last_hear'=>$request['fd_last_hear'],
                'fd_next_hear'=>$request['fd_next_hear'],
                'fd_last_req'=>$request['fd_last_req'],
                'fd_now_req'=>$request['fd_now_req'],
                'fd_statement'=>$request['fd_statement'],
                'fd_judge_date'=>$request['fd_judge_date'],
                'res_court_type'=>$request['res_court_type'],
                'res_floor'=>$request['res_floor'],
                'res_room'=>$request['res_room'],
                'res_date'=>$request['res_date'],
                'res_jud_dept'=>$request['res_jud_dept'],
                'res_court_sec'=>$request['res_court_sec'],
                'res_hear_req'=>$request['res_hear_req'],
                'res_judge_date'=>$request['res_judge_date'],
                'excel_court_type'=>$request['excel_court_type'],
                'excel_floor'=>$request['excel_floor'],
                'excel_room'=>$request['excel_room'],
                'excel_date'=>$request['excel_date'],
                'excel_jud_dept'=>$request['excel_jud_dept'],
                'excel_court_sec'=>$request['excel_court_sec'],
                'excel_hear_req'=>$request['excel_hear_req'],
                'exp_court_type'=>$request['exp_court_type'],
                'exp_floor'=>$request['exp_floor'],
                'exp_room'=>$request['exp_room'],
                'exp_date'=>$request['exp_date'],
                'exp_jud_dept'=>$request['exp_jud_dept'],
                'exp_name'=>$request['exp_name'],
                'exp_section'=>$request['exp_section'],
                'exp_hear_req'=>$request['exp_hear_req'],
                'shapes_date'=>$request['shapes_date'],
                'shapes_floor'=>$request['shapes_floor'],
                'shapes_room'=>$request['shapes_room'],
                'shapes_num'=>$request['shapes_num'],
                'shapes_sec'=>$request['shapes_sec'],
                'shapes_jud_dept'=>$request['shapes_jud_dept'],
                'shapes_hear_req'=>$request['shapes_hear_req'],
            ]);
            DB::table('court_cases')->where('id',$request['case_id'])->update(['case_level'=>$request['case_level']]);
            return redirect('admin/case-running/'.$request['case_id']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addHearing(Request $request){
        try{
            $hid = DB::table('case_hearings')->insertGetId([
                'case_id'=>$request['case_id'],
                'case_level'=>$request['case_level'],
                'judcial_dept'=>$request['judcial_dept'],
                'floor'=>$request['floor'],
                'room'=>$request['room'],
                'court_secretary'=>$request['court_secretary'],
                'last_hearing'=>$request['last_hearing'],
                'next_hearing'=>$request['next_hearing'],
                'last_requirements'=>$request['last_requirements'],
                'current_requirements'=>$request['current_requirements'],
                'hearing_statement'=>$request['hearing_statement'],
                'date_of_resumptopn'=>$request['date_of_resumption'],
                'date_of_excellence'=>$request['date_of_excellence'],
                'date_of_expert'=>$request['date_of_expert'],
                'expert_name'=>$request['expert_name'],
                'section'=>$request['section'],
                'date_of_shapes'=>$request['date_of_shapes'],
                'shape_number'=>$request['shape_number'],
            ]);
            DB::table('court_cases')->where('id',$request['case_id'])->update(['case_current_hearing'=>$hid]);
            return redirect('admin/case-running/'.$request['case_id']);
            //case_current_hearing
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function hearingHistory(Request $request){
        try {
            $history  = DB::table('case_hearings')->where('case_id',$request['id'])->get();
            return view('admin.case.view.hearing_history',['history'=>$history]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }        
    }

    public function addJudgement(Request $request){
        try {
            DB::table('case_judgements')->insert([
                'case_id'=>$request['case_id'],
                'case_level'=>$request['case_level'],
                'days'=>$request['days'],
                'j_date'=>$request['j_date'],
                'notes'=>$request['notes'],
                'j_from_date'=>$request['j_from_date'],
            ]);
            return redirect('admin/case-running/'.$request['case_id']);
        } catch (\Exception $e) {
            return abort(500,'ISE');
        }
    }

    public function judgementHistory(Request $request){
        try {
            $history = DB::table('case_judgements')
                ->where('case_id',$request['id'])
                ->orderBy('cjid','DSC')
                ->get();
            return view('admin.case.view.jhistory',['history'=>$history]);
        } catch (\Exception $e) {
            return abort(500,'ISE');
        }
    }
    public function deleteCase(Request $request){
        DB::table('court_cases')->where('id',$request['id'])->delete();
        return redirect('/admin/case-running');
    }

    public function deleteHearing(Request $request){
        DB::table('case_hearings')->where('hid',$request['id'])->delete();
        return redirect()->back();
    }
    public function deleteJudgement(Request $request){
        DB::table('case_judgements')->where('cjid',$request['id'])->delete();
        return redirect()->back();
    }

    
    
}
