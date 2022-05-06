@extends('layouts.app')

@section('content')
    <h1 class="text-center my-3">User Login</h1>

    <form method="POST" accept="{{ route('login') }}">
        @csrf
        <div class="form-floating mb-3">
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
            <label for="email">Email</label>
            @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-floating mb-3">
            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" id="password" name="password" placeholder="Password" required />
            <label for="name">Password</label>
            @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="remember" name="remember" value="{{ old('remember') ? 'checked' : '' }}" />
            <label class="form-check-label" for="remember">
                Remember Me
            </label>
        </div>

        <div class="form-group d-grid gap-2">
            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Log In" />
        </div>
    </form>
@endsection