
<style>
.page-content {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  padding: 20px;
  background-color: #f5f6fa;
}

.asset-card {
  display: flex;
  flex-direction: column;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  padding: 20px;
  max-width: 900px;
  margin: auto;
}

.asset-header h2 {
  margin-bottom: 20px;
  color: #2f3640;
  border-bottom: 2px solid #e1e4e8;
  padding-bottom: 10px;
}

.asset-body {
  display: flex;
  gap: 20px;
}

.asset-image img {
  width: 200px;
  height: 200px;
  object-fit: cover;
  border-radius: 12px;
  border: 1px solid #6e6e6eff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.asset-details {
  flex: 1;
}

.asset-details table {
  width: 100%;
  border-collapse: collapse;
}

.asset-details th, 
.asset-details td {
  text-align: left;
  padding: 12px 15px;
  border-bottom: 1px solid #e1e4e8;
}

.asset-details th {
  background-color: #f0f1f6;
  width: 150px;
  font-weight: 600;
  color: #333;
}

.status-badge {
  padding: 5px 12px;
  border-radius: 20px;
  color: #fff;
  font-weight: 600;
  display: inline-block;
}

.status-badge.active { background-color: #28a745; }
.status-badge.disposed { background-color: #dc3545; }
.status-badge.other { background-color: #6c757d; }
</style>

<style>
  .status-badge {
    padding: 4px 8px;
    border-radius: 4px;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
  }
  .status-badge.in-use { background-color: #28a745; }
  .status-badge.maintenance { background-color: #6c757d; }
  .status-badge.disposed { background-color: #dc3545; }
  .status-badge.retired { background-color: #ff9900; }
  .status-badge.other { background-color: #aaa; }
</style>
<?php 
  $text = $asset->item_name;
  // get first letters (Unicode-safe) and join them, then uppercase
  preg_match_all('/\b\p{L}/u', $text, $matches);
  $unique_asset_id = strtoupper(implode('', $matches[0]));
?>

<div class="page-content">
  <div class="content">
    <div class="asset-card">
      <div class="asset-header">
        <h2><?= $meta_title; ?></h2>
      </div>
      <div class="asset-body">
        <!-- Left: Image -->
        <div class="asset-image">
          <img src="<?= base_url('uploads/items/' . ($asset->asset_image ?? 'default-image.png')); ?>" alt="<?= $asset->item_image; ?>" />
          <div style="margin-top: 10px;text-align: center;"><?= $asset->item_name; ?></div>
        </div>
        <!-- Right: Details -->
        <div class="asset-details">
          <table class="table" style="width:100%; border-collapse: collapse;border: 1px solid #000000ff;">
            <tbody >
              <tr >
                <th style="border: 1px solid #000000ff;text-align: center;">ID</th>
                <td style="border: 1px solid #000000ff;" > <?php echo $unique_asset_id.'-'.$asset->id; ?> </td>
              </tr>
              <tr style="border: 1px solid #000000ff;">
                <th style="border: 1px solid #000000ff;text-align: center;">Name</th>
                <td style="border: 1px solid #000000ff;"><?= $asset->item_name; ?></td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Category</th>
                <td style="border: 1px solid #000000ff;"><?= $asset->category_name; ?></td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Sub Category</th>
                <td style="border: 1px solid #000000ff;"><?= $asset->sub_cate_name; ?></td>
              </tr>

              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Serial</th>
                <td style="border: 1px solid #000000ff;"><?= $asset->serial_number ?: 'N/A'; ?></td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Location</th>
                <td style="padding: 0;border: 1px solid #000000ff;">
                  <table>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Branch</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->branch_name ?? 'None'; ?></td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Department</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->department_name ?? 'None'; ?></td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Floor</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->floor_name ?? 'None'; ?></td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Room</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->room_name ?? 'None'; ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Status</th>
                <td style="border: 1px solid #000000ff;text-transform: uppercase;text-align: center;">
                  <span class="status-badge 
                   <?= $asset->asset_status == '1' ? 'in-use' : 
                      ($asset->asset_status == '2' ? 'maintenance' : 
                      ($asset->asset_status == '3' ? 'disposed' : 
                      ($asset->asset_status == '4' ? 'retired' : 'other'))); ?>">
                   <?= $asset->asset_status == '1' ? 'In Use' : 
                      ($asset->asset_status == '2' ? 'Maintenance' : 
                      ($asset->asset_status == '3' ? 'Disposed' : 
                      ($asset->asset_status == '4' ? 'Retired' : 'Other'))); ?>
                </span>

                </td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Cost</th>
                <td style="padding: 0;border: 1px solid #000000ff;padding:0;border: 1px solid #000000ff;">
                  <table>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Original Cost</th>
                      <td style="background-color: #f0f1f6;"><?= number_format($asset->original_cost,2); ?> BDT</td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Capitalized Cost</th>
                      <td style="background-color: #f0f1f6;"><?= number_format($asset->capitalized_cost,2); ?> BDT</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;"> Date</th>
                <td style="padding:0;border: 1px solid #000000ff;">
                  <table>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Acquisition Date</th>
                      <td style="background-color: #f0f1f6;"><?= date('d M, Y', strtotime($asset->acquisition_date)); ?></td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Manufacture Date</th>
                      <td style="background-color: #f0f1f6;"><?= date('d M, Y', strtotime($asset->manufacture_date)); ?></td>
                    </tr>
                  </table>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Supplier</th>
                <td style="padding: 0;border: 1px solid #000000ff;">
                  <table style="border: 1px solid #ffffffff;" style="margin:0px" cellspacing="0">
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Name</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->name   ? : 'N/A'; ?></td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff; text-align: center;">Phone</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->phone  ? : 'N/A'; ?></td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Email</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->email  ? : 'N/A'; ?></td>
                    </tr>
                    <tr>
                      <th style="background-color: #fffcfcff;text-align: center;">Address</th>
                      <td style="background-color: #f0f1f6;"><?= $asset->address? : 'N/A'; ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Custodian</th>
                <td style="border: 1px solid #000000ff;"><?= $asset->custodian_name ?: 'N/A'; ?></td>
              </tr>
              <tr>
                <th style="border: 1px solid #000000ff;text-align: center;">Warranty</th>
                <td style="border: 1px solid #000000ff;"><?= $asset->warranty_months; ?> months</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


