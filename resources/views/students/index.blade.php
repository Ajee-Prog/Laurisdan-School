@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between mb-3">
  <h2>Students</h2>
  <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>
  <a href="{{ route('students.export.pdf') }}" class="btn btn-primary mb-3">Export PDF</a>
</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Admission No</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Middle Name</th>
      <th>Class</th> 
      <th>Age</th>
       <th>Parent</th> 
       <th>Parent Contact</th> 
       <th>Passport</th>
       <th>Action</th>
    </tr>
  </thead>
  <tbody>
  

        <!-- I dont need the above code -->

    @foreach($students as $student)
      <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->admission_no }}</td>
        <td>{{ $student->first_name }}</td>
        <td>{{ $student->last_name }}</td>
        <td>{{ $student->middle_name }}</td>
        <td>{{ $student->class->name ?? 'N/A' }}</td>
        <td>{{ $student->age }} Years</td>
        
        <td>{{ $student->parent->full_name ?? '  -  ' }}</td>
        <td>{{ $student->parent_contact }}</td>
        <td>@if($student->image)
          <img src="{{asset('storage/'.$student->image) }}" width="60" class="rounded" alt="">
          @endif
        </td>

        <td>
          <a href="{{ route('students.show',$student->id) }}" class="btn btn-sm btn-info">View</a>
          <a href="{{ route('students.edit',$student->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('students.destroy',$student->id) }}" method="POST" style="display:inline-block;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>
@endsection











