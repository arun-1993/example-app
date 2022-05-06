@extends('layouts.app')

@section('content')
    <h1 class="text-center my-3">User Registration</h1>

    <form method="POST" accept="{{ route('register') }}">
        @csrf
        <div class="form-floating mb-3">
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required />
            <label for="name">Name</label>
            @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

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

        <div class="form-floating mb-3">
            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required />
            <label for="password_confirmation">Confirm Password</label>
        </div>

        <div class="form-group d-grid gap-2">
            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Register" />
        </div>
    </form>
@endsection