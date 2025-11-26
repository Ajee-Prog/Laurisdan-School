@extends('layouts.dashboard')

@section('content')
<h2>Add New Student</h2>
<form action="{{ route('students.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Full Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="row mb-3">
    <div class="col">
      <label>Email</label>
    <input type="email" name="email" class="form-control" required>
    </div>

    <div class="col">
      <label>Phone</label>
    <input type="text" name="phone" class="form-control" required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col">
      <label>Student Code</label>
    <input type="text" name="student_code" class="form-control" required>
    </div>
    <div class="col">
      <label>admission No</label> 
    <input type="text" name="admission_no" class="form-control" required>
    </div>
  </div>


  <div class="row mb-3">
    <div class="col">
      <label>Parent</label>
    <select name="parent_id" class="form-control">
      @foreach(App\Models\ParentModel::all() as $p)
        <option value="{{ $p->id }}">{{ $p->full_name ?? ''}}</option>
      @endforeach
    </select>
    </div>
    <div class="col">
      <label>Class</label>
    <select name="class_id" class="form-control">
      @foreach(App\Models\SchoolClass::all() as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select>
    </div>

    

    <div class="col">
      <label>User</label>
    <select name="user_id" class="form-control">
      @foreach(App\Models\User::all() as $u)
        <option value="{{ $u->id }}">{{ $u->name }}</option>
      @endforeach
    </select>
    </div>

  </div>

  <div class="row mb-3">
    <div class="col">
      <label>Nationality</label>
    <input type="text" name="nationality" class="form-control" required>
    </div>
    <div class="col">
      <label>State</label>
    <input type="text" name="state" class="form-control" required>
    </div>
    <div class="col">
      <label for="">Gender</label>
      <select name="gender" id="" class="form-control">
        <option value="">--Select gender---</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>
    </div>
  </div>
  

  <!-- 'user_id', 'class_id', 'parent_id','date_of_birth', 'email' ,'image', 'phone', 'gender', 'admission_no', 'state', 'nationality','address',  'parent_contact','religion' -->
  <div class="mb-3">
    
  </div>
  <div class="mb-3">
    
  </div>
  <div class="mb-3">
    
  </div>
  <div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control" required>
  </div>
  <div class="row mb-3">
    <div class="col">
      <label>Date of Birth</label>
      <input type="date" name="date_of_birth" class="form-control" required>
    </div>
    <div class="col">
      <label class="form-label">Parent Contact</label>
      <input type="text" name="parent_contact" class="form-control" required>
    </div>

    <div class="col">
      <label class="form-label">Religion</label>
      <input type="text" name="religion" class="form-control" required>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Upload Passport</label>
      <input type="file" name="image" class="form-control-file" required>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection


