@extends('layouts.app')

@section('content')
<div class="p-4">
<div class="row">
    <div class="col-lg 12 margin-tb">
        <div class="pull-left">
            <h2>Edit User Information</h2>
            <hr>
        </div>
</div>
</div>

<form action="{{url('users/update/'.$user->id)}}" method="post" id="update_form">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control fillable" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input type="text" name="address" value="{{ $user->address }}" class="form-control" placeholder="Address">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="tel" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="912345678">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Profession:</strong>
                <input type="text" name="profession" value="{{ $user->profession }}" class="form-control" placeholder="Engineer">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Is Admin:</strong>
            <div class="form-check">
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" class="form-check-input" name="is_admin" {{$user->is_admin == 1 ? 'checked' : null}} value="1">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>

<div class="row" id="row-1">
    <div class="col-lg 12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">Go Back</a>
        </div>
    </div>
</div>

</div>

@endsection