<div id="categoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" id="categoryModalFormAction" class="needs-validation" novalidate>
                <input type="hidden" name="_method" id="category_method">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12 category_group_form">
                            <div class="form-group">
                                <label class="control-label category_label"></label>
                                <select class="form-control" id="category_options" required></select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please choose one.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_name" class="control-label">Category Name</label>
                                <input type="text" name="name" id="category_name" class="form-control" placeholder="Enter Category Name" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please enter category name.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->