@php $i=1; $j=0; @endphp
@foreach($table_column_name as $column_name)
<tr>
	<td>{{$i++}}</td>
	<td><input type="text" name="column_name[]" value="{{$column_name}}" class="form-control" /></td>
	<td><input type="text" name="mapping_name[]" value="@if(isset($a)){{explode(':',json_decode($a->mapping)[$j])[1]}} @endif" class="form-control" /></td>
</tr>
@php $j++; @endphp
@endforeach