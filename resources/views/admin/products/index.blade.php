@extends('layouts.admin')
@section('header')
    @include('layouts.parts.header-admin')
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Products
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                            @include('admin.notification.notification')
                            <table id="datatables-clients" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Hide</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)

                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->price}}$</td>
                                            <td>
                                                @if($product->hidden)
                                                    <i class="ion ion-ios-checkmark-circle me-2"></i>
                                                    Yes
                                                @else
                                                    <i class="ion ion-ios-remove-circle me-2"></i>
                                                    No
                                                @endif
                                            </td>
                                            <td class="table-action">
                                                <a href="{{ route('product.edit', $product->id) }}"><i class="align-middle fas fa-fw fa-pen"></i></a>
                                                <a href="{{ route('product.hide', $product->id) }}">
                                                @if($product->hidden)
                                                    <i class="ion ion-ios-eye-off me-2"></i>
                                                @else
                                                    <i class="ion ion-ios-eye me-2"></i>
                                                @endif
                                                </a>
                                                <a href="" onclick="event.preventDefault();if(confirm( 'Are you sure?')){
                                                    document.getElementById('delete_product_{{ $product->id }}').submit();}">
                                                    <i class="align-middle fas fa-fw fa-trash"></i>
                                                </a>
                                                <form id='delete_product_{{ $product->id }}' action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id"  value="{{ $product->id }}">
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
