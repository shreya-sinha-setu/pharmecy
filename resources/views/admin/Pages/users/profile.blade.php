@extends('admin.layouts.app')
@section('title','Profile')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
                <!-- <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addUserModal"><i
                            class="fa fa-plus"></i> Add User</a>
                </div> -->
            </div>
        </div>
    <section class="" >
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-md-9 col-lg-7 col-xl-5">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-4">
                <div class="d-flex text-black">
                  <div class="flex-shrink-0">
                    <img src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/img/avatar.png')}}"
                      alt="profile image" class="img-fluid"
                      style="width: 180px; border-radius: 10px;">
                  </div>
                  <div class="flex-grow-1 ms-3 mt-5">
                    <h5 class="mb-1">Name : {{ Auth::user()->name }}</h5>
                    <p class="mb-2 pb-1" style="color: #2b2a2a;">Role : {{ Auth::user()->role }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>

    </div>
  @endsection
    @section('script')
    <script>
        $(document).ready(function () {
            $(".sidebar-users_profile").addClass('active');
        });
      </script>
@endsection