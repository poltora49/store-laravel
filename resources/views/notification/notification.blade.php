@if(Session::has('success') or Session::has('warning'))
<div class="toast-container position-fixed  top-0 end-0  mt-5"
role="alert" aria-live="assertive" aria-atomic="true">
    <div class='d-flex text-bg-dark  p-3 mt-5'>
        <div class="toast-body">
            @if(Session::has('success'))

                {{Session::get('success')}}
            @endif

            @if(Session::has('warning'))
                {{Session::get('warning')}}
            @endif
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto close" data-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
@endif


<script>
const toastElList = document.querySelectorAll('.toast')
const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl, option))

</script>
