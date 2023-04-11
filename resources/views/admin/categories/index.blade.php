@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Category
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Clients</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatables-clients" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)

                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td>{{$category->title}}</td>
                                            {{-- <td><span class="badge bg-success">Active</span></td> --}}
                                            <td class="table-action">
                                                <a href="{{ route('category.edit', [$category->id]) }}"><i class="align-middle fas fa-fw fa-pen"></i></a>
                                                <a href="" onclick="event.preventDefault();if(confirm( 'Are you sure?')){
                                                    document.getElementById('delete_category_{{ $category->id }}').submit();}">
                                                    <i class="align-middle fas fa-fw fa-trash"></i>
                                                </a>
                                                <form id='delete_category_{{ $category->id }}' action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id"  value="{{ $category->id }}">
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
<svg width="0" height="0" style="position:absolute">
    <defs>
        <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
            <path
                d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
            </path>
        </symbol>
    </defs>
</svg>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables clients
            $("#datatables-clients").DataTable({
                responsive: true,
                order: [
                    [1, "asc"]
                ]
            });
        });
    </script>
@endpush
