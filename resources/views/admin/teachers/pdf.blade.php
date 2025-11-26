<h2>Teachers List</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<thead>
<tr>
<th>Name</th><th>Email</th><th>Phone</th>
</tr>
</thead>
<tbody>
@foreach($teachers as $t)
<tr>
<td>{{ $t->name }}</td>
<td>{{ $t->email }}</td>
<td>{{ $t->phone }}</td>
</tr>
@endforeach
</tbody>
</table>