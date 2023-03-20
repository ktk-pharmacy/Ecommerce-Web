<div id="brandModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add/Edit Brand</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="post" id="brandModalFormAction" class="needs-validation" novalidate enctype="multipart/form-data">
                <input type="hidden" name="_method" id="brand_method">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="brand_name" class="control-label">Brand Name</label>
                                <input type="text" name="name" id="brand_name" class="form-control" placeholder="Enter Brand Name" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please enter brand name.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group brand_input">
                                <label for="brand_image" class="control-label">Brand Image</label>
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
                                <input id="brand_status" type="checkbox" name="status" checked="" value="1">
                                <label for="brand_status">
                                    Active
                                </label>
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