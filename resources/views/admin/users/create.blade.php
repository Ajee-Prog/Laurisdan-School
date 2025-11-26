@extends('layouts.admin')
@section('content')
<div class="container mt-4">
  <h3>Add New User</h3>

  <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="form-group mb-2">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group mb-2">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group mb-2">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group mb-2">
      <label>Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="form-group mb-2">
      <label>Role</label>
      <select name="role" class="form-control" required>
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
        <option value="parent">Parent</option>
      </select>
    </div>

    <!-- Student fields -->
    <div id="student-fields" style="display:none">
      <div class="mb-2">
        <label>Assign Class</label>
        <select name="class_id" class="form-control">
          <option value="">Select Class</option>
          @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-2">
        <label>Assign Parent</label>
        <select name="parent_id" class="form-control">
          <option value="">Select Parent</option>
          @foreach($parents as $parent)
            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Save User</button>
  </form>
</div>

<script>
  document.getElementById('role-select').addEventListener('change', function() {
    document.getElementById('student-fields').style.display =
      this.value === 'student' ? 'block' : 'none';
  });
</script>
@endsection