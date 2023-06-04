@props([
    'img' => false,
    'title' => false,
])
<div {{ $attributes->merge([
    'class' => 'modal fade',
    'tabindex' => '-1',
    'aria-hidden' => 'true',
]) }}>
    <div class="modal-dialog">
        <div class="modal-content p-2">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column gap-2 justify-content-center align-items-center">
                <img width="110" src="{{ $img ? asset($img) : 'assets/theme/img/sayaid1.png' }}" alt="#">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
