<div class="container">
<table class="table">
	<tr>
		<th>{{ __("t.name") }}</th>
		<th> {{ __("t.uploaded_on") }} </th>
		<th> {{ __("t.actions") }}</th>
	</tr>	
	@foreach($docs as $doc)
		<tr>
			<td> {{ $doc->name }} </td>
			<td> {{ $doc->uploaded_on }} </td>
			<td> <a href="{{ $doc->url }}" target="_blank" class="btn btn-primary">{{ __("t.open")}} </a> </td>
		</tr>
	@endforeach
<table>
</div>
