<div id="termModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
   style="display: none;">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add/Edit Blog Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <form method="post" id="termModalFormAction" class="needs-validation" novalidate enctype="multipart/form-data">
            <input type="hidden" name="_method" id="term_method">
            @csrf
            <div class="modal-body p-4">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="term_name" class="control-label">Blog Category Name</label>
                        <input type="text" name="name" id="term_name" class="form-control" placeholder="Enter Category Group Name"
                           required>
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