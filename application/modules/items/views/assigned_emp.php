<style>
.modal{
  margin-right:0px !important;
  border-radius: 0px !important;
}
.modern-modal {
  box-shadow: 0 8px 25px rgba(0,0,0,0.25);
  overflow: hidden;
  backdrop-filter: blur(8px);
}

.modal-gradient {
  background: linear-gradient(90deg, #044852d3, #06355ccf);
  color: #fff;
  border: none;
}

.close-btn:hover {
  opacity: 1;
  transform: rotate(90deg);
}

.modern-table {
  width: 100%;
  border-radius: 0px;
  background: #fdfdfd;
  box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
}
.modern-table th {
  background-color: #f5f5f5;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  
}
.modern-table td {
  vertical-align: middle;
  border: 1px solid #000000ff;
}
.modern-table tr:hover {
  background-color: #f1f7ff;
  transition: 0.2s;
  border: 1px solid #000000ff;
}

.loading-spinner {
  text-align: center;
  padding: 30px 0;
  color: #555;
}
.loading-spinner p {
  margin-top: 10px;
  font-weight: 500;
}
.modal-content{
  border-radius: 0px !important;
}

@keyframes popIn {
  from { transform: scale(0.9); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}
@media (min-width: 992px) {
  .modal-lg {
    width: 1000px;
  }
}
@media (min-width: 768px) {
  .modal-dialog {
    margin: 0px auto;
  }
}
.modal-header {
  padding: 10px;
}
</style>

<div class="page-content">
    <div class="content">
        <ul class="breadcrumb" style="margin-bottom: 20px;">
            <li><a href="<?= base_url('dashboard') ?>" class="active">Dashboard</a></li>
            <li><a href="<?= base_url('items') ?>" class="active"><?= $module_title; ?></a></li>
            <li><?= $meta_title; ?></li>
        </ul>

        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple">
                    <div class="grid-title">
                        <h4><span class="semi-bold"><?= $meta_title; ?></span></h4>
                        <div class="pull-right">
                            <a href="<?= base_url('items/assigned_emp_entry_form') ?>" class="btn btn-info btn-xs btn-mini">Assign Employee</a>
                        </div>
                    </div>

                    <div class="grid-body">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-error"><?= $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>

                        <table class="table table-bordered dataTable table-condensed">
                            <thead>
                              <tr>
                                <th style="display:none"></th>
                                <th class="text-center">SL</th>
                                <th class="text-center">Employee Name</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Branch</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($assets)): $i = 0; ?>
                                  <?php foreach ($assets as $asset): $i++; 
                                    // dd($asset);
                                  ?>
                                    <tr>
                                      <td style="display:none"><?= $asset['id'] ?></td>
                                      <td class="text-center"><?= $i ?></td>
                                      <td class="text-center"><?= $asset['first_name'] ?></td>
                                      <td class="text-center"><?= $asset['dept_name'] ?></td>
                                      <td class="text-center"><?= $asset['branch_name'] ?></td>
                                      <td class="text-center">
                                        <button class="btn btn-primary btn-mini view-details" data-asset='<?= json_encode($asset) ?>'>
                                          Details
                                        </button>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                <?php else: ?>
                                  <tr><td colspan="5" class="text-center">No Data Found</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="assetModal" tabindex="-1" role="dialog" aria-labelledby="assetModalLabel"  >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content modern-modal">
      <div class="modal-header modal-gradient">
        <h5 class="modal-title" id="assetModalLabel" style="font-size: 18px;font-weight: 600;color: #ffffffff;">
          <i class="fa fa-boxes"></i> Asset Details
        </h5>
      </div>

      <div class="modal-body">
        <div id="loading-spinner" class="loading-spinner">
          <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <p>Loading asset details...</p>
        </div>

        <table class="table table-hover  modern-table" id="asset-table" style="display: none; border-collapse: collapse; border: 1px solid #000000ff;">
          <thead >
            <tr >
              <th style="border: 1px solid #000000ff;">#</th>
              <th style="border: 1px solid #000000ff;">Item Name</th>
              <th style="border: 1px solid #000000ff;">Serial</th>
              <!-- <th style="border: 1px solid #000000ff;">Brand</th> -->
              <th style="border: 1px solid #000000ff;">Acquisition Date</th>
              <th style="border: 1px solid #000000ff;">Status</th>
            </tr>
          </thead>
          <tbody id="asset-details-body" ></tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger rounded-pill btn-mini" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editAssetModal" tabindex="-1" role="dialog" aria-labelledby="editAssetModalLabel">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content modern-modal">
      <div class="modal-header modal-gradient">
        <h5 class="modal-title" id="editAssetModalLabel">
          <i class="fa fa-edit"></i> Edit Asset
        </h5>
      </div>
      <div class="modal-body">
        <form id="edit-asset-form">
          <input type="hidden" name="asset_id" id="edit-asset-id" />
          <div class="form-group">
            <label>Item Name</label>
            <input type="text" class="form-control" name="item_name" id="edit-item-name">
          </div>
          <div class="form-group">
            <label>Serial No</label>
            <input type="text" class="form-control" name="serial_no" id="edit-serial-no">
          </div>
          <div class="form-group">
            <label>Brand</label>
            <input type="text" class="form-control" name="brand_name" id="edit-brand-name">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="asset_status" id="edit-asset-status">
              <option value="1">Not Use</option>
              <option value="2">Used</option>
              <option value="3">Maintenance</option>
              <option value="4">Retired</option>
              <option value="5">Disposed</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-mini" id="save-asset-btn">Save</button>
        <button type="button" class="btn btn-danger btn-mini" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- 🟨 JavaScript Section -->
<script>
  $(document).ready(function() {
    $(document).on('click', '.view-details', function() {
      const asset = $(this).data('asset');
      // console.log(asset);
      // return false;
      const assets = asset.assets || [];
      const assetIds = assets.map(a => a.asset_id);

      // console.log(assetIds);
      // return false;
      
      $('#asset-details-body').empty();
      $('#asset-table').hide();
      $('#loading-spinner').show();
      $('#assetModal').modal('show');
      $.ajax({
        url: '<?= base_url("items/get_asset_details") ?>',
        type: 'POST',
        data: { ids: assetIds },
        dataType: 'json',
        success: function(response) {
          $('#loading-spinner').hide();
          if (response.length > 0) {
          let rows = '';
          // console.log(response);
          // return false;
          response.forEach((item, index) => {
            rows += `
            <tr>
              <td>${index + 1}</td>
              <td style="display:none">${item.asset_ids}</td>
              <td>${item.item_name}</td>
              <td>${item.serial_number ?? '-'}</td>
              <td>${item.created_at ? new Date(item.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }) : '-'}</td>
              <td>
                <span class="badge ${item.asset_status == 1 ? 'badge-success' : 'badge-danger'}">
                    ${item.asset_status == 1 ? 'Active' : 'Inactive'}
                </span>
                <button class="btn btn-warning btn-mini edit-asset-btn" data-item='${encodeURIComponent(JSON.stringify(item))}'>
                  Edit
                </button>
              </td>
            </tr>`;
          });
            $('#asset-details-body').html(rows);
            $('#asset-table').fadeIn(300);
          } else {
            $('#asset-details-body').html('<tr><td colspan="5" class="text-center text-muted">No Data Found</td></tr>');
            $('#asset-table').fadeIn(300);
          }
        }
      });
    });
  });

  $(document).on('click', '.edit-asset-btn', function() {
    const item = JSON.parse(decodeURIComponent($(this).attr('data-item')));
    // console.log(item);

    $('#edit-asset-id').val(item.id);
    $('#edit-item-name').val(item.item_name);
    $('#edit-serial-no').val(item.serial_no);
    $('#edit-brand-name').val(item.brand_name);
    $('#edit-asset-status').val(item.asset_status);
    $('#editAssetModal').modal('show');
  });

  $('#save-asset-btn').on('click', function() {
    const formData = $('#edit-asset-form').serialize();
    $.ajax({
      url: '<?= base_url("items/update_asset_data") ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        // Update the main modal table row if needed
        $('#editAssetModal').modal('hide');
        $('#assetModal').modal('show'); // keep main modal open
        // Optionally reload the asset table via AJAX
        // $('.view-details[data-asset]').trigger('click');
      },
      error: function(err) {
        alert('Error updating asset');
      }
    });
  });

</script>

