<div class="modal fade" id="ProductModal" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Product Details</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="javascript:void(0)" id="addEditProductForm" enctype="multipart/form-data" class="form-horizontal" method="POST">
                                    <input type="hidden" name="id" id="id">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" value=""  name="name" id="name" placeholder="name" class="form-control" required></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Description</label></div>
                                        <div class="col-12 col-md-9"><input type="text" value=""  name="description" id="description" placeholder="description" class="form-control" required></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Quantity</label></div>
                                        <div class="col-12 col-md-9"><input type="number" value=""  name="quantity" id="quantity" placeholder="quantity" class="form-control" required></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Price</label></div>
                                        <div class="col-12 col-md-9"><input type="number" value=""  name="price" id="price" placeholder="price" class="form-control" required></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Product Category</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="category" id="category" class="form-control-sm form-control" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" id="btn-save" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>