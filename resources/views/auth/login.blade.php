@extends('templates.auth')
@section('content')
<div class="container">
    <div class="auth-section">
        <div class="auth-box">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('login.check')}}" method="POST">
                    @csrf
                        <h5 class="card-title"><span class="icon"><i class="fa fa-lock"
                                    aria-hidden="true"></i></span>Login</h5>
                        <hr>
                        <p class="card-text">

                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                <input type="email" class="form-control" id="email" required name="email">
                            </div>

                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" class="form-control" id="pwd" required name="password">
                            </div>

                            <div class="checkbox">
                                <span><input type="checkbox"> Remember me</span>
                            </div>

                            <hr>
                            <div class="actions">
                                <button type="submit" class="btn btn-default btn-dark">Submit</button>
                            </div>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
