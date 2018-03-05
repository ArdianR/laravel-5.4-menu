@extends('layouts.login')

@section('content')

<!-- BEGIN LOGIN FORM -->
<form class="login-form"  method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <h3 class="form-title font-green">Sign In</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} ">
        <label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="Email" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus />
    </div>
    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} ">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required autofocus />
    </div>
    <div class="form-group" align="center">
        <button type="submit" class="btn green uppercase">Login</button>
    </div>
</form>
<!-- END LOGIN FORM -->
@endsection
