<!-- Cropping modal -->
<div id="crop-avatar">
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content panel-primary">
                <form class="avatar-form" action="<?php print site_url();?>avatar-upload" enctype="multipart/form-data" method="post">
                    <div class="modal-header panel-heading">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Picture</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Upload image and data -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" class="filestyle avatar-input" id="avatarInput" name="avatar_file">
                                </div>
                            </div>
                            <!-- Crop and preview -->                                
                            <div class="col-md-12">
                                <div class="avatar-wrapper"></div>
                            </div> 
                            <div class="avatar-upload">
                                <input type="hidden" id="upltypeid" class="upltypecls" name="upltype">    
                                <!-- <input type="hidden" id="ussmid" class="uss-id" name="ussid">   -->
                                <input type="hidden" class="avatar-src" name="avatar_src">
                                <input type="hidden" class="avatar-data" name="avatar_data">
                            </div>                                                 
                        </div>

                    </div>
                    <div class="modal-footer panel-footer">
                        <button type="button" class="avatar-btns btn btn-primary" data-method="rotate" data-option="-90" title="Rotate the image 9 degree to the left"><i class="fa fa-rotate-left"></i> Rotate</button>
                        <button type="button" class="avatar-btns btn btn-primary" data-method="rotate" data-option="-90" title="Rotate the image 9 degree to the right"><i class="fa fa-rotate-right"></i> Rotate</button>
                        <button type="submit" class="btn btn-primary avatar-save">Crop & Save</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div> 
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
</div>
<!-- Loading state -->
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>