@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="fs-5 text-danger">
            {{ __('username, email atau kata sandi salah') }}
        </div>
    </div>
@endif
