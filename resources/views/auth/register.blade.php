@extends('layouts.auth')

@section('page-title') Create a New Account @endsection

@section('content')

    <div class="cls-content">
        <div class="cls-content-lg panel">

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
                    <h1 class="h3">Create a New Account</h1>
                    <p>Create an account with us</p>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="First name" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Middle name" name="middle_name" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Last name" name="last_name" required>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                          <div class="form-group">
                              <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                              @endif
                          </div>
                      </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input id="phone" type="number" placeholder=" 11 digits phone number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input id="password" type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input id="password-confirm" type="password" placeholder="confirm-password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox pad-btm text-left">
                        <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" required>
                        <label for="demo-form-checkbox">I agree with the <a href="#" data-target="#term_and_conditions" data-toggle="modal" class="btn-link text-bold">Terms and Conditions</a></label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                </form>
            </div>
            <div class="pad-all">
                Already have an account ? <a href="{{url('/login')}}" class="btn-link mar-rgt text-bold">Sign In</a>
            </div>
        </div>
    </div>
@include('partials.terms_and_conditions')
@endsection
