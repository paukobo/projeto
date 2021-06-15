@extends('layout_admin')
@section('title','Reset Password' )
@section('content')
    <div class="form-group row">
        <label for="oldPassword" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

        <div class="col-md-5">
            <input id="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" name="oldPassword" required autocomplete="old-password" value="{{ old('password') }}" autofocus>

            @error('oldPassword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-5">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-5">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>
    @can('update',$user)
        <div class="form-group text-right">
            <div class="col-md-9">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a href="{{route('admin.users')}}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
        @endcan
@endsection
