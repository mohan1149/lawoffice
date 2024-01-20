<div>
	<table class="table">
		<tr>
			<th>{{ __("t.case_number") }} </th>
			<th>{{ __("t.party") }} </th>
			<th>{{ __("t.priority") }} </th>
			<th>{{ __("t.hearing_on") }} </th>
			<th>{{ __("t.action") }} </th>
		</tr>
		<tbody>
			@foreach ($notif as $n)
			<tr>
			    <td>{{ $n->case_number }} </td>
			    <td>{{ $n->party_name }}</td>
			    <td>{{ $n->priority }} </td>
			    <td>{{ $n->next_date }} </td>
		            <td> <a class="btn btn-primary"href="/admin/case-running/{{$n->id}}">{{ __("t.open") }}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
