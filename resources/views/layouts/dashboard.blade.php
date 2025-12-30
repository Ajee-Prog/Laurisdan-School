@php
    $admin   = Auth::guard('web')->user();
    $student = Auth::guard('student')->user();
@endphp


<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - @if($admin)
        
        {{ ucfirst($admin->role) }} Panel
        
      @elseif($student)

      {{ ucfirst($student->first_name) }} Panel
                
      @endif </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <div class="bg-dark text-white p-3" style="width:220px;min-height:100vh;"> 

  @if($admin)
  <img src="{{ asset('storage/'.$admin->image) }}" width="60" height="60" style="border-radius:50%;">
        
        <h4>{{ ucfirst($admin->role) }} Panel</h4>
        
      @elseif($student)

    <img src="{{ asset('storage/'.$student->image) }}" width="60" height="60" style="border-radius:50%;">
      <h4>{{ ucfirst($student->first_name) }} Panel</h4>
                
      @endif

<!--  -->

    

      


      

    
    <hr>
    @if($admin)
         
        @include('layouts.sidebar.' . Auth::user()->role)
        
      @elseif($student)
    
      @include('layouts.sidebar' . Auth::user()->role)
                
    @endif
    {{-- @include('layouts.sidebar.' . Auth::user()->role) --}}
  </div>
  
  <!-- Main -->
  <div class="flex-grow-1 p-4">
    @yield('content')
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>