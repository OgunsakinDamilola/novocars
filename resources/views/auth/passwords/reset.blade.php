@extends('layouts.auth')

@section('page-title')  Password Reset  @endsection

@section('content')

    <div class="cls-content">
        <div class="cls-content-sm panel">
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h1 class="h3">Reset Password</h1>
                    <p>Create and confirm a new password</p>
                </div>
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="New password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" placeholder="Confirm new password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Reset Password</button>
                </form>
            </div>

            <div class="pad-all">
                <a href="{{url('/login')}}" class="btn-link mar-rgt">Login</a>
                <a href="{{url('/register')}}" class="btn-link mar-lft">Create a new account</a>
            </div>
        </div>
    </div>

@endsection
