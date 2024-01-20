<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __("t.case_roll") }}</title>
    <style>
        tr{
            border-bottom:2px solid gray;
        }
        td{
            border-bottom:2px solid gray;
        }
    </style>
</head>
<body>
    <div>
        <img src="https://fatmashaddadlawoffice.com/logo.png" width="100px" alt="">
    </div>
    <div>
        <br>
        <h2 style="text-align:center;"> {{ __("t.case_roll")  }}</h2>
	    <hr>
    </div>
    <div>
        <table id="slidersTable" class="table responsive responsive-table">
            <thead>
                <tr>
                    <th>{{__("t.case_number")}}</th>
                    <th>{{__("t.priority")}}</th>
                    <th>{{__("t.client_name")}}</th>
                    <th>{{__("t.next_hearing")}}</th>
                    <th>{{__("t.client_position")}}</th>
                    <th>{{__("t.case_level")}}</th>
                    <th>{{__("t.exe_status")}}</th>
                    <th>{{__("t.notice_status")}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cases as $case)
                    <tr>
                        <td>{{ $case->case_number }}</td>
                        <td>{{ $case->priority }}</td>
                        <td>{{ $case->first_name.' '.$case->last_name }}</td>
                        <td>{{ $case->next_date }}</td>
                        <td>{{ $case->client_position }}</td>
                        <td>{{ __("t.".$case->case_level) }}</td>
                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>