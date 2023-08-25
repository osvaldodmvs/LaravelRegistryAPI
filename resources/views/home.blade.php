@extends('layouts.app')

@section('content')
<div class="container">
  @if ($message = Session::get('error'))
  <div class="alert alert-error" style="color:red">
    <p>{{ $message }}</p>
  </div>
  @endif
    <div class="row justify-content-center">
        <div class="col-md-12 py-2">
            <div class="flex-shrink-0 p-3 bg-white float-left" style="height:100%;">
                <a href="{{route('home')}}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                    <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-5 fw-semibold" id="home">Home</span>
                  </a>
                <ul class="list-unstyled ps-0">
                  <li class="mb-1">
                    <button class="btn_grey_hover btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="false">
                      Users
                    </button>
                    <div class="collapse" id="users-collapse">
                      <ul class="btn-toggle-nav list-unstyled fw-normal px-3">
                        <li><a href="{{route('users_index')}}" class="link-dark d-inline-flex btn text-decoration-none rounded btn_blue_hover">List</a></li>
                        @if (Auth::user()->is_admin)
                        <li><a href="{{route('users_create')}}" class="link-dark d-inline-flex btn text-decoration-none rounded btn_blue_hover">Create</a></li>
                      @endif
                      </ul>
                    </div>
                  </li>
                  <li class="border-top my-3"></li>
                </ul>
              </div>
            
              <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        </div>
    </div>
</div>
@endsection
