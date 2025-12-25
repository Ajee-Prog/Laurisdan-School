<form method="POST" action="{{ route('superadmin.login.post') }}">
    @csrf
    <h3>Super Admin Login</h3>

    <input type="email" name="email" class="form-control" placeholder="Email">
    <input type="password" name="password" class="form-control" placeholder="Password">

    <button class="btn btn-primary w-100 mt-3">Login</button>
</form>