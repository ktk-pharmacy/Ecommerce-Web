@extends('frontend.layouts.master', ['title' => 'Register'])

@section('css')
<style>
   .parsley-error {
      margin: 0px !important;
      border-color: #f1556c !important;
   }
</style>
@endsection

@section('main-content')

<!-- LOGIN AREA START (Register) -->
<div class="ltn__login-area pb-110">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-title-area text-center">
               <h1 class="section-title">Register <br>Your Account</h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 offset-lg-3">
            {{-- @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif --}}
            <div class="account-login-inner">
               <form action="{{ route('frontend.register') }}" method="POST" class="customer-register-form ltn__form-box contact-form-box">
                  @csrf
                  <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                  <input type="text" name="email" placeholder="Email*" value="{{ $otp->username }}" required readonly>
                  <input type="password" name="password" id="password" placeholder="Password*" required>
                  <input type="password" name="confirm_password" placeholder="Confirm Password*" data-parsley-equalto="#password" required>
                  <div class="btn-wrapper">
                     <button class="theme-btn-1 btn reverse-color btn-block" type="submit">CREATE ACCOUNT</button>
                  </div>
               </form>
               <div class="by-agree text-center">
                  <p>By creating an account, you agree to our:</p>
                  <p><a href="#">TERMS OF CONDITIONS &nbsp; &nbsp; | &nbsp; &nbsp; PRIVACY POLICY</a></p>
                  <div class="go-to-btn mt-50">
                     <a href="{{ route('frontend.loginForm') }}">ALREADY HAVE AN ACCOUNT ?</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- LOGIN AREA END -->
@endsection

@section('script')
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

<script>
   $('.customer-register-form').parsley();
</script>
@endsection
