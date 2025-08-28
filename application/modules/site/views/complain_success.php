<div class="py-1"></div>
      <div class="container w-75">
        <div class="secondary_sc_content px-4 py-4 ">
            <?php echo form_open_multipart("site/complain");?>
              <div class="container pt-3 pb-3" style="border: 1px solid #cccccc;">
                <p class="lead font-weight-bold text-center py-2 mt-2 text-white" style="background-color: #1aa326;"><?=$meta_title?></p>
                 <?php if($this->session->flashdata('success')):?>
                     <div class="alert alert-success">
                        <?=$this->session->flashdata('success');;?>
                     </div>
                  <?php endif; ?>

                </div> <!-- end of row -->
            </div>
          <?php echo form_close();?>
        <div class="py-2"></div>
      </div>
    </div>
    <div class="pt-3"></div> 