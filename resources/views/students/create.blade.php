@extends('layouts.dashboard')

@section('content')
<h2>Add New Student</h2>
<div class="alert alert-info">
        Admission Number will be auto-generated...New adde/remove after
</div>


<form action="{{ route('students.store') }}" method="POST">
  @csrf
  <div class="row mb-3">
    <div class="col">
      <label>Family Name</label>
      <input type="text" name="last_name" class="form-control" placeholder="Last Name / Surname" required>
    </div>

    <div class="col">
      <label>First Name</label>
      <input type="text" name="first_name" class="form-control" placeholder="First Name / Child" required>
    </div>

    <div class="col">
      <label>Middle Name</label>
      <input type="text" name="middle_name" class="form-control" placeholder=" Other Name " required>
    </div>
    
  </div>

  

  <!-- <div class="row mb-3">
    <div class="col">
      <label>Email</label>
    <input type="email" name="email" class="form-control" required>
    </div>

    <div class="col">
      <label>Phone</label>
    <input type="text" name="phone" class="form-control" required>
    </div>
  </div> -->

  <div class="row mb-3">
    <!-- <div class="col">
      <label>Date of Birth</label>
      <input type="date" name="date_of_birth" class="form-control" required>
    </div> -->

    <div class="col">
      <label for="">Gender</label>
      <select name="gender" id="" class="form-control">
        <option value="">--Select gender---</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>
    </div>

    <div class="col">
      <label>Student Code</label>
      <input type="text" name="student_code" class="form-control" required>
    </div>
    <!-- <div class="col">
      <label>admission No</label> 
    <input type="text" name="admission_no" class="form-control" required>
    <!\-- This is new Example for Admission Number....I will choose the best fitted ones -\->
     <div class="mb-3">
        <label>Admission Number</label>
        <input type="text"
              class="form-control"
              value="Auto-generated"
              disabled>
        <small class="text-muted">
            Admission number will be generated automatically
        </small>
      </div>
     <!-\- New examples ends here -\->
    </div> -->

    <!-- Auto-generated admission number -->
        <div class="col">
            <label>Admission Number (Auto-Generated)</label>
            <input type="text" class="form-control" value="{{ $generatedAdmissionNo }}" readonly>

            <div class="mb-3">
             
              <input type="text"
                    class="form-control"
                    value="Auto-generated"
                    disabled>
              <small class="text-muted">
                  Admission number will be generated automatically
              </small>
            </div>
        </div>

        <div class="col">
            <label>Password (Admin chooses or default)</label>
            <input type="password" name="password" class="form-control" placeholder="Password / surname" required>
        </div>

  </div>

  <!-- Birth DOB place -->
   <div class="row mb-3">
    <div class="col">
      <label>Date of Birth</label>
      <input type="date" name="date_of_birth" class="form-control" required>
    </div>

    <div class="col">
      <label>Place Of Birth</label>
      <input type="text" name="place_birth" class="form-control" placeholder="Place OF Birth" required>
    </div>
    
    <!-- Auto-generated admission number -->
        <div class="col">
            <label>Age Number (Auto-Calculated)</label>
            <input type="text" class="form-control" value="Auto-generated " readonly>

            <div class="mb-3">
             
              
              <small class="text-muted">
                  Admission number will be generated automatically
              </small>
            </div>
        </div>

        <!-- <div class="col">
            <label>Password (Admin chooses or default)</label>
            <input type="password" name="password" class="form-control" placeholder="Password / surname" required>
        </div> -->

  </div>
   <!-- DOB ends -->


  

        <!-- <div class="mb-3">
            <label>Select Class Admin chooses</label>
            <select name="class_id" class="form-control" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div> -->


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

    

    <!-- <div class="col">
      <label>User</label>
    <select name="user_id" class="form-control">
      @foreach(App\Models\User::all() as $u)
        <option value="{{ $u->id }}">{{ $u->name }}</option>
      @endforeach
    </select>
    </div> -->

  </div>

  <div class="row mb-3">
    <div class="col">
      <label>Nationality</label>
      <input type="text" name="nationality" class="form-control" placeholder="Nationality" required>
    </div>
    <div class="col">
      <label>State</label>
      <input type="text" name="state" class="form-control" placeholder="State of Origin" required>
    </div>
    <div class="col">
      <label>LGA</label>
      <input type="text" name="lga" class="form-control" placeholder="Local Government" required>
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
    <input type="text" name="address" class="form-control" placeholder="Home Address" required>
  </div>
  <div class="row mb-3">
    <div class="col">
      <label>Medical Attention</label>
      <input type="text" name="medical_Att" class="form-control" placeholder="Provide Medical Health Attention" required>
    </div>
    <div class="col">
      <label class="form-label">Parent Contact</label>
      <input type="text" name="parent_contact" class="form-control" placeholder="Parent Communication" required>
    </div>

    <div class="col">
      <label class="form-label">Religion</label>
      <input type="text" name="religion" class="form-control" placeholder=" Religion Practices" required>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Upload Passport</label>
      <input type="file" name="image" class="form-control-file" required>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection


