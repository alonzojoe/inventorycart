@extends('layouts.layout')
@section('title')
Products
@endsection
@section('content')
@include('layouts.sidebar')
@include('layouts.navbar')
<style>
    .html, body{
    padding: 0 !important;
    }
</style>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Products</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li><a href="/products">Products</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Products Table</strong>
                    </div>
                   <div>
             
                        <div class="alert alert-success product-insert" role="alert" id="insertalert" style="width:25%; display:none;">
                            Product Added
                        </div>
                        <div class="alert alert-info product-update" role="alert" id="updatealert" style="width:25%; display:none;">
                            Product Updated
                         </div>
                            
                        <div class="alert alert-danger product-delete" role="alert" id="deletealert" style="width:25%; display:none;">
                            Product Deleted
                        </div>

                    </div>
                    <div class="card-body">                        
                        <div class="card-body card-block">
                            <form action="/products" method="GET" class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3"><input type="text" name="name" placeholder="Product Name" class="form-control" value="{{ app('request')->input('name') }}"></div>
                                    <div class="col col-md-3"><input type="text" name="description" placeholder="Product Description" class="form-control" value="{{ app('request')->input('description') }}"></div>
                                    <div class="col col-md-3"><button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Search</button>&nbsp;<a href="/products" class="btn btn-secondary"><i class="fa fa-refresh"></i>&nbsp; Refresh</a></div>
                                    <div class="col col-md-3"><button type="button" class="btn btn-success" id="addNewProduct" style="float: right;">Add Product</button></div>
                                </div>
                            </form>
                        </div>
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Updated At</th>
                                    <th class="text-center">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                @if(!$products->isEmpty())
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->created }}</td>
                                    <td>{{ $product->updated }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)"  type="button" id="editProduct" type="button" class="btn btn-primary edit" data-id="{{ $product->prodid }}">Update</a>
                                        <a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $product->prodid }}">Delete</a>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="9">No Data Available</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex">                     
                            <div class="pagination-wrapper">
                                <ul class="pagination">
                                    <?php

                                    $interval = isset($interval) ? abs(intval($interval)) : 3 ;
                                    $from = $products->currentPage() - $interval;
                                    if($from < 1){
                                        $from = 1;
                                    }
                            
                                    $to = $products->currentPage() + $interval;
                                    if($to > $products->lastPage()){
                                        $to = $products->lastPage();
                                    }
                                    ?>
                            
                                    <!-- first/previous -->
                                    @if($products->currentPage() > 1)
                                        <li class="page-item">
                                            <a href="{{ $products->url(1) }}" aria-label="First" class="page-link">
                                                <span aria-hidden="true">«</span>
                                            </a>
                                        </li>

                                        <li class="page-item">
                                            <a href="{{ $products->url($products->currentPage() - 1) }}" aria-label="Previous" class="page-link">
                                                <span aria-hidden="true">Previous</span>
                                            </a>
                                        </li>
                                    @endif

                            
                                    <!-- links -->
                                    @for($i = $from; $i <= $to; $i++)
                                        <?php 
                                        $isCurrentPage = $products->currentPage() == $i;
                                        ?>
                                        <li class="page-item {{ $isCurrentPage ? 'active' : '' }}">
                                            <a href="{{ !$isCurrentPage ? $products->url($i) : '#' }}" class="page-link">
                                                {{ $i }}
                                            </a>
                                        </li>
                                    @endfor
                            
                                    <!-- next/last -->
                                    @if($products->currentPage() < $products->lastPage())
                                        <li class="page-item">
                                            <a href="{{ $products->url($products->currentPage() + 1) }}" aria-label="Next" class="page-link">
                                                <span aria-hidden="true">Next</span>
                                            </a>
                                        </li>
                            
                                        <li class="page-item">
                                            <a href="{{ $products->url($products->lastpage()) }}" aria-label="Last" class="page-link">
                                                <span aria-hidden="true">»</span>
                                            </a>
                                        </li>
                                    @endif
                            
                                </ul>         
                           </div>
                       </div>
                       @include('products.modalproducts')
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div> <!-- .content -->
</div><!-- end right-panel -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    setTimeout(function() {
        $('#insertalert').fadeOut('slow');
    }, 3000); 
    setTimeout(function() {
        $('#deletealert').fadeOut('slow');
    },3000)            
</script>
<script>
$(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addNewProduct').click(function () {
       $('#addEditProductForm').trigger("reset");
       $('#productModal').html("Add Product");
       $('#ProductModal').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('products/edit-product') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#productModal').html("Edit Product");
              $('#ProductModal').modal('show');
              $('#id').val(res.id);
              $('#name').val(res.name);
              $('#description').val(res.description);
              $('#quantity').val(res.quantity);
              $('#price').val(res.price);
              $('#category').val(res.category);
           }
        });
    });
    $('body').on('click', '.delete', function () {
       if (confirm("Delete Record?") == true) {
        var id = $(this).data('id');
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('/products/delete-product') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              alert('Product Deleted!');
              window.location.reload();
           }
        });
       }
    });
    $('body').on('click', '#btn-save', function (event) {
          var id = $("#id").val();
          var name = $("#name").val();
          var description = $("#description").val();
          var quantity = $("#quantity").val();
          var price = $("#price").val();
          var category = $("#category").val();
          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('/products/add-update-product') }}",
            data: {
              id:id,
              name:name,
              description:description,
              quantity:quantity,
              price:price,
              category:category,
            },
            dataType: 'json',
            success: function(res){
             alert('Product Saved!');
             window.location.reload();
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
           }
        });
    });
});
</script>

@endsection