@extends('layouts.app')

@section('content')
<div class="p-4">
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="d-flex justify-content-between">
    <div class="d-flex justify-content-between">
    <h2 class="px-4">Users</h2>
    @if (Auth::user()->is_admin)
        <a href="{{route('users_export')}}"  class="px-4 btn-outline-primary d-inline-flex btn text-decoration-none rounded">Export as .csv</a></li>
    @endif
    </div>
    <div class="d-flex justify-content-between">
    <div class="px-4">
        <form action="{{url('users/search')}}" type="get">
            <input type="search" placeholder="Search by name..." class="rounded" name="query">
            @csrf
            <button class="btn btn-success btn_search_hover btn-outline-light " type="submit" style="color">Search</button>
        </form>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Profession
        </button>
        <ul class="dropdown-menu">
            @forelse ($professions as $profession)
            <li><a class="dropdown-item" href="{{url('users/filter',$profession)}}">{{$profession}}</a></li>
            @empty
            @endforelse
        </ul>
      </div>
    </div>
</div>
<ul class="list-group" style="padding-bottom:10px">
    <hr>
    @forelse ($users as $user)
    <li class="list-group-item p-1">
        <h6>{{$user->name}} - {{$user->email}} - {{$user->profession}}</h6>
        <form action="{{url('users/destroy/'.$user->id)}}" method="post">
            <a class="btn btn-primary btn-sm" href="{{url('users/show',$user->id)}}">Show</a>
            <a class="btn btn-secondary btn-sm" href="{{url('users/edit',$user->id)}}">Edit</a>
            @csrf
            <button type="submit" class="btn btn-danger btn-sm"><strong>Delete</strong></button>
        </form>
    </li>
    @empty
    <h5 class="text-center">No users found!</h5>
    @endforelse
</ul>
{!! $users->links('pagination::bootstrap-5') !!}

</div>
@endsection