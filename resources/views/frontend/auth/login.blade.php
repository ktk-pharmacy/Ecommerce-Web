@extends('frontend.layouts.master', ['title' => 'Login'])

@section('css')
<style>
   .parsley-error {
      margin: 0px !important;
      border-color: #f1556c !important;
   }
</style>
@endsection

@section('main-content')
<!-- LOGIN AREA START -->
<div class="ltn__login-area pb-65">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-title-area text-center">
               <h1 class="section-title">Sign In <br>To Your Account</h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6">
            <div class="account-login-inner">
               <form method="POST" class="customer-login-form ltn__form-box contact-form-box">
                  @csrf
                  <input type="text" name="email" placeholder="Email or Password*" value="{{ old('email') }}" required>
                  <input type="password" name="password" placeholder="Password*" required>
                  <div class="btn-wrapper mt-0">
                     <button class="theme-btn-1 btn btn-block" type="submit">SIGN IN</button>
                  </div>
                  <div class="go-to-btn mt-20">
                     <a href="{{ route('frontend.requestOtpForm') }}?for=psw"><small>FORGOTTEN YOUR PASSWORD?</small></a>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="account-create text-center pt-50">
               <h4>DON'T HAVE AN ACCOUNT?</h4>
               <p>Add items to your wishlistget personalised recommendations <br>
                  check out more quickly track your orders register</p>
               <div class="btn-wrapper">
                  <a href="{{ route('frontend.requestOtpForm') }}" class="theme-btn-1 btn black-btn">CREATE ACCOUNT</a>
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
   $('.customer-login-form').parsley();
</script>
@endsection
