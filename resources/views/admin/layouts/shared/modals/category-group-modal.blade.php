<div id="categoryGroupModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Category Group</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" id="categoryGroupModalFormAction" class="needs-validation" novalidate enctype="multipart/form-data">
                <input type="hidden" name="_method" id="category_group_method">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_group_name" class="control-label">Category Group Name</label>
                                <input type="text" name="name" id="category_group_name" class="form-control" placeholder="Enter Category Group Name" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please enter category group name.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_group_sorting" class="control-label">Category Group Sorting</label>
                                <input type="number" min="1" name="sorting" id="category_group_sorting" class="form-control" placeholder="Enter Category Group Sorting" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please enter category group soting.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group category_group_input">
                                    <label for="category_group_image" class="control-label">Category Group Image</label>
                                    {{-- <input type="file" class="dropify" data-max-file-size="1M" id="brand_image" name="feature_image_media"/> --}}
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose image.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkbox checkbox-success checkbox-circle mb-2">
                                    <input id="category_group_status" type="checkbox" name="status" checked="" value="1">
                                    <label for="category_group_status">
                                        Active
                                    </label>
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
