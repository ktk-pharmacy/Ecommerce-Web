<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.shared.title-meta', ['title' => 'Coming Soon'])

    @include('admin.layouts.shared.head-css')

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,700%7CMontserrat:400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/theme/css/new-home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/libs/fontAwesome/fontawesome.min.css') }}"> --}}
</head>

<body>
    <div class="comming-soon">
        <div class="mobile-screen">
            <img src="{{ asset('assets/theme/img/bg/phone1.jpg') }}" alt="" />
        </div>

        <div class="comming-soon-info" style="background-image: url({{ asset('assets/theme/img/bg/main-image.jpg') }})"></div>
        {{-- <div class="comming-soon-info" style="background-image: url({{ asset('assets/theme/img/bg/cat.jpg') }})"></div> --}}

        <div class="easyapp-info">
            <div class="easyapp-box">
                <div class="logo">
                    <img class="" src="{{ asset('assets/theme/img/bg/1.png') }}" alt="" />
                    <h2>is coming soon</h2>
                </div>

                <div class="button-download">
                    <p>Yes, Download Latest version of Myansan</p>
                    <a href="{{ config('custom_value.application.ios.url') }}" target="_blank" type="button" class="btn-download"><i class="fa-brands fa-apple"></i> App Store</a>
                    <a href="{{ config('custom_value.application.android.url') }}" target="_blank" type="button" class="btn-download "><i class="fa fa-play"></i> Play Store</a>
                </div>

                <div class="about">
                    <h3 class="text-white">Stay tunned, we're launching very soon.<br> We're making the system more awesome.</h3>
                </div>

                <div class="social-link">
                    <a href="{{ config('settings.social_facebook') }}"><i class="fa-brands fa-facebook-f"></i></i></a>
                    <a href="{{ config('settings.social_twitter') }}"><i class="fa-brands fa-twitter"></i></a>
                    <a href="{{ config('settings.social_linkedin') }}"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="{{ config('settings.social_instagram') }}"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
