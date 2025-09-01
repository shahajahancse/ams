<div class="page-content">
   <div class="content">
      <ul class="breadcrumb">
         <li> <a href="<?=base_url('dashboard')?>" class="active"> Dashboard </a> </li>
         <li> <a href="<?=base_url('excel_import')?>" class="active"> Excel Import </a></li>
         <li> Import Assets </li>
      </ul>

      <div class="row">
         <div class="col-md-12">
            <div class="grid simple horizontal">
               <div class="grid-title">
                  <h4><span class="semi-bold">Import Assets</span></h4>
                  <div class="pull-right">
                     <!-- Optional: Add a back button or other actions here -->
                  </div>
               </div>
               <div class="grid-body" style="padding: 26px 29px;">
                  <!-- Original content starts here -->
                  <div class="container">
                     <br />
                     <h3 align="center">Import Excel Data into Mysql in Codeigniter</h3>
                     <form method="post" enctype="multipart/form-data" action="<?=base_url('excel_import/import')?>">
                        <p><label>Select Excel File</label>
                        <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
                        <br />
                        <input type="submit" name="import" value="Import" class="btn btn-info" />
                     </form>
                     <br />
                     <div class="table-responsive" id="customer_data">

                     </div>
                  </div>
                  <!-- Original content ends here -->
               </div>  <!-- END GRID BODY -->
            </div> <!-- END GRID -->
         </div>

      </div> <!-- END ROW -->

   </div>
</div>