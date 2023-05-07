@extends('frontend.layouts.master', ['title' => 'Request-Otp'])

@section('css')
    <style>
        .parsley-error {
            margin: 0px !important;
            border-color: #f1556c !important;
        }

        .code-input {
            width: 70px !important;
            padding: 25px !important;
            font-size: 30px !important;
        }

        .section-title-area {
            margin-bottom: 0 !important;
        }
    </style>
@endsection

@section('main-content')
    @php
        $data = otpData($otp_id);
    @endphp

    <!-- LOGIN AREA START (Register) -->
    <div class="ltn__login-area pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">Verify OTP</h1>
                        <b>Enter the 4-digit code send to {{ $data->username }}.</b>
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
                        <form action="{{ route('frontend.verifyOtp') }}" method="POST"
                            class="customer-otp-form ltn__form-box contact-form-box">
                            @csrf
                            <input type="hidden" name="username" placeholder="Email or Phone*"
                                value="{{ $data->username }}">

                            @if ($for)
                                <input type="hidden" name="for" value="{{ $for }}">
                            @endif
                            <h3 class="text-center">Enter Your Verification Code.</h3>
                            {{-- <input type="text" name="code" placeholder="Enter Your Verification Code*" value="" required> --}}
                            <div class="d-flex justify-content-center gap-3">
                                <input type="text" name='code_1' class='code-input' required />
                                <input type="text" name='code_2' class='code-input' required />
                                <input type="text" name='code_3' class='code-input' required />
                                <input type="text" name='code_4' class='code-input' required />
                            </div>
                            <div class="btn-wrapper d-flex justify-content-center">
                                <button class="theme-btn-1 btn reverse-color btn-block" type="submit">VERIFY OTP</button>
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
    <script src="{{ asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script>
        $('.customer-otp-form').parsley();

        const inputElements = [...document.querySelectorAll('input.code-input')]
        inputElements.forEach((ele, index) => {
            ele.addEventListener('keydown', (e) => {
                // if the keycode is backspace & the current field is empty
                // focus the input before the current. Then the event happens
                // which will clear the "before" input box.
                if (e.keyCode === 8 && e.target.value === '') inputElements[Math.max(0, index - 1)].focus()
            })
            ele.addEventListener('input', (e) => {
                // take the first character of the input
                const [first, ...rest] = e.target.value
                e.target.value = first ??
                    '' // first will be undefined when backspace was entered, so set the input to ""
                const lastInputBox = index === inputElements.length - 1
                const didInsertContent = first !== undefined
                if (didInsertContent && !lastInputBox) {
                    // continue to input
                    inputElements[index + 1].focus()
                }
            })
        })
    </script>
@endsection
