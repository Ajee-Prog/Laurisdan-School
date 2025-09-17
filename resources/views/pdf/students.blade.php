<h2>Students List</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
  <thead>
    <tr><th>ID</th><th>Name</th><th>Class</th><th>Parent</th></tr>
  </thead>
  <tbody>
    @foreach($students as $s)
      <tr>
        <td>{{ $s->id }}</td>
        <td>{{ $s->full_name }}</td>
        <td>{{ $s->class->name }}</td>
        <td>{{ $s->parentModel->full_name }}</td>
      </tr>
    @endforeach
  </tbody>
</table>