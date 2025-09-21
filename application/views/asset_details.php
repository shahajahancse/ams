
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
  border: 1px solid #ddd;
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
          <img src="<?= base_url('uploads/items/' . ($asset->asset_image ?? 'default-image.png')); ?>" alt="<?= $asset->item_image; ?>">
          <div style="margin-top: 10px;text-align: center;"><?= $asset->item_name; ?></div>
        </div>
        <!-- Right: Details -->
        <div class="asset-details">
          <table>
            <tbody>
              <tr>
                <th>ID</th>
                <td> <?php echo $unique_asset_id.'-'.$asset->id; ?> </td>
              </tr>
              <tr>
                <th>Name</th>
                <td><?= $asset->item_name; ?></td>
              </tr>
              <tr>
                <th>Category</th>
                <td><?= $asset->category_name; ?></td>
              </tr>
              <tr>
                <th>Sub Category</th>
                <td><?= $asset->sub_cate_name; ?></td>
              </tr>

              <tr>
                <th>Serial</th>
                <td><?= $asset->serial_number ?: 'N/A'; ?></td>
              </tr>
              <tr>
                <th>Location</th>
                <td>
                  Branch: <?= $asset->branch_name ?? 'None'; ?> ,
                  Department: <?= $asset->department_name ?? 'None'; ?>,<br>
                  Floor: <?= $asset->floor_name ?? 'None'; ?> ,
                  Room: <?= $asset->room_name ?? 'None'; ?>,
                </td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
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
                <th>Cost</th>
                <td>
                  Original Cost: <?= number_format($asset->original_cost,2); ?> BDT, 
                  Capitalized Cost: <?= number_format($asset->capitalized_cost,2); ?> BDT
                </td>
              </tr>
              <tr>
                <th> Date</th>
                <td>Acquisition Date: <?= date('d M, Y', strtotime($asset->acquisition_date)); ?> <br>
                Manufacture Date: <?= date('d M, Y', strtotime($asset->manufacture_date)); ?></td>
              </tr>
              <tr>
                <th>Supplier</th>
                <td>
                  <table style="border: 1px solid #e1e4e8;">
                    <tr>
                      <th>Name</th>
                      <td><?= $asset->name   ? : 'N/A'; ?></td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td><?= $asset->phone  ? : 'N/A'; ?></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><?= $asset->email  ? : 'N/A'; ?></td>
                    </tr>
                    <tr>
                      <th>Address</th>
                      <td><?= $asset->address? : 'N/A'; ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <th>Custodian</th>
                <td><?= $asset->custodian_name ?: 'N/A'; ?></td>
              </tr>
              <tr>
                <th>Warranty</th>
                <td><?= $asset->warranty_months; ?> months</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


