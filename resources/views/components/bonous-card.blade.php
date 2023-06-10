@props([
    'img' => false,
    'title',
    'target',
])
<div class="col-lg-4 col-sm-6 col-12">
    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="{{ $target }}">
        <div class="ltn__feature-item ltn__feature-item-6 text-center bg-white  box-shadow-1">
            <div class="ltn__feature-icon">
                <img width="90" src="{{ $img ? asset($img) : 'assets/theme/img/sayaid2.png' }}" alt="#">
            </div>
            <div class="ltn__feature-info">
                <h3><a href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="{{ $target }}">{{ $title }}</a></h3>
                <p>{{ Str::limit($slot, 100, '...') }}</p>
                <!-- <a class="ltn__service-btn" href="service-details.html">Find A Home <i class="flaticon-right-arrow"></i></a> -->
            </div>
        </div>
    </a>
</div>
