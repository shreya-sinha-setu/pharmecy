@extends('admin.layouts.app')
@section('title','Forget Password')
@section('user-not-login')



    <div class="home-btn d-none d-sm-block">
        <a href="#"><i class="fas fa-home h2 text-white"></i></a>
    </div>

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <a href="index.html">
                                    <!--<span><img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="28"></span>-->
                                </a>
                            </div>

                            <div class="mt-5">
                                @if ($errors->any())
                                    <div class="col-12">
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif

                                    @if (session()->has('error'))
                                    <div class="alert alert-danger">{{session('error')}}
                                    </div>

                                    @endif

                                    @if (session()->has('success'))
                                    <div class="alert alert-success">{{session('success')}}
                                    </div>

                                    @endif
                            </div>





                            <p style="font: bold">We will send a link on your email, use that link to reset password.
                            </p>

                            <form method="POST" action="{{ route('forget.post.password') }}" class="pt-2">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email address</label>
                                    <input class="form-control type="email"
                                        name="email" id="email" value="{{ old('email') }}" required
                                        autocomplete="email" autofocus placeholder="Enter your email">
                                    
                                </div>


                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-success btn-block" type="submit"> Send </button>

                                </div>

                            </form>






                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>



@endsection
