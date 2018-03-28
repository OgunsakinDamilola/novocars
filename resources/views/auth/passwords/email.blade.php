@extends('layouts.auth')

@section('page-title')  Password Recovery  @endsection

@section('content')

    <div class="cls-content">
        <div class="cls-content-sm panel">
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h1 class="h3">Forgot password</h1>
                <p class="pad-btm">Enter your email address to recover your password. </p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-danger btn-lg btn-block" type="submit">Reset Password</button>
                    </div>
                </form>
                <div class="pad-top">
                    <a href="{{url('/login')}}" class="btn-link text-bold text-main">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
