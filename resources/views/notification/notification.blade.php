<div class="fixed-bottom px-4" id="liveAlertPlaceholder">
    {{-- cart notification --}}
    <div class="alert alert-success alert-dismissible d-none" id="alertAddToCart">
        <div id="alertTextAddToCart"></div>
    </div>
    <div class="alert alert-danger alert-dismissible d-none" id="alertNoAddToCart">
        <div id="alertTextNoAddToCart"></div>
    </div>
    {{-- login notification --}}
    @if (session('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <div>{{ session('status') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    {{-- all the rest notification --}}

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div>{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <div>{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <div>{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-dismissible" role="alert">
            <div>{{ $message }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
