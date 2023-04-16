@if ($message = Session::get('error'))

    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-message">
            {{$message}}
        </div>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('success'))

    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="alert-message">
            {{$message}}
        </div>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif
