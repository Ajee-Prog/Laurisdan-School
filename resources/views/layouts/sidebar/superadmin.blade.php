@if(auth()->user()->role == 'superadmin')
<li class="nav-item">
    <a href="{{ route('superadmin.dashboard') }}" class="nav-link">Dashboard</a>
</li>
<li class="nav-item">
    <a href="{{ route('admins.index') }}" class="nav-link">Admins</a>
</li>
<li class="nav-item">

    <a href="{{ route('teachers.index') }}" class="nav-link">Teachers</a>
</li>
<li class="nav-item">
    <a href="{{ route('students.index') }}" class="nav-link">Students</a>
</li>
<li class="nav-item">
    <a href="{{ route('parents.index') }}" class="nav-link">Parents</a>
</li>
<li class="nav-item">
    <a href="{{ route('classes.index') }}" class="nav-link">Classes</a>
</li>
<li class="nav-item">
    <a href="{{ route('subjects.index') }}" class="nav-link">Subjects</a>
</li>
<li class="nav-item">
    <a href="{{ route('exams.index') }}" class="nav-link">Exams</a>
</li>
<li class="nav-item">
    <a href="{{ route('fees.index') }}" class="nav-link">School Fees</a>
</li>
@endif