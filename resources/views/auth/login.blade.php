@extends('layouts.auth')

@section('page-title') Login @endsection

@section('content')

    <div class="cls-content">
        <div class="cls-content-sm panel">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h1 class="h3">Account Login</h1>
                    <p>Sign In to your account</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="checkbox pad-btm text-left">
                        <input type="checkbox" id="demo-form-checkbox" class="magic-checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="demo-form-checkbox">Remember me</label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                </form>
            </div>

            <div class="pad-all">
                <a href="{{ route('password.request') }}" class="btn-link mar-rgt">Forgot password ?</a>
                <a href="{{url('/register')}}" class="btn-link mar-lft">Create a new account</a>

            </div>
        </div>
    </div>
@endsection
