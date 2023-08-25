@extends('layouts.app')

@section('content')
<div class="p-4">
    <div class="pull-left">
        <h2>User Information</h2>
        <hr>
    </div>
    <div class="row" id="row-2">
        <div class="col-xs-12 com-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name }} {{ $user->last_name }}
                <br>
                <strong>Address:</strong>
                {{ $user->address }}
                <br>
                <strong>Phone:</strong>
                {{ $user->phone }}
                <br>
                <strong>Email:</strong>
                {{ $user->email }}
                <br>
                <strong>Profession:</strong>
                {{ $user->profession }}
                <br>
                <strong>Is Admin:</strong>
                @if ($user->is_admin == 1)
                <button class="btn btn-sm btn-success"><i class="bi bi-check2"></i></button>
                @else
                <button class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></button>
                @endif
            </div>
        </div>
    </div>

    <div class="row" id="row-1">
        <div class="col-lg 12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">Go Back</a>
            </div>
            <div class="pull-right py-3">
                <a class="btn btn-secondary btn-sm" href="{{url('users/edit',$user->id)}}">Edit</a>
            </div>
        </div>
    </div>
</div>

@endsection