

<div class="page-content">     
  <div class="content">  
    <!-- Breadcrumb -->
    <ul class="breadcrumb mb-4">
      <li><a href="<?=base_url()?>" class="active">Dashboard</a></li>
      <li>General Setting</li>
      <li><?= $meta_title; ?></li>
    </ul>

    <!-- Page Title -->
    

    <!-- Asset Card -->
    <div class="card shadow-sm bordered rounded-3" style="background-color: #fff;">
        <div class="grid-body">
          <h3><b><?= $meta_title; ?></b></h3>
        <table style="width:100%;border:1px solid #ddd;width:50%;">
        <tbody style="border:1px solid #ddd" class="text-center">
            <tr style="border:1px solid #ddd">
            <th style="padding-left:10px" >ID</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd"><?= $asset->id; ?></td>
            </tr>
            <tr style="border:1px solid #ddd">
            <th style="padding-left:10px" >Name</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd"><?= $asset->item_name; ?></td>
            </tr>
            <tr>
            <th style="padding-left:10px" >Serial</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd"><?= $asset->serial_number; ?></td>
            </tr>
            <tr style="border:1px solid #ddd">
            <th style="padding-left:10px" >Location</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd">
                <?= $asset->branch_name; ?> /
                <?= $asset->department_name; ?> /
                <?= $asset->floor_name; ?> /
                <?= $asset->room_name; ?>
            </td>
            </tr>
            <tr style="border:1px solid #ddd">
            <th style="padding-left:10px" >Status</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd">
                <span class="badge 
                <?php if($asset->asset_status=='Active'){echo 'bg-success';} 
                elseif($asset->asset_status=='Disposed'){echo 'bg-danger';} 
                else{echo 'bg-secondary';} ?>">
                <?= $asset->asset_status; ?>
                </span>
            </td>
            </tr>
            <tr style="border:1px solid #ddd">
            <th style="padding-left:10px" >Cost</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd"><?= number_format($asset->cost,2); ?> BDT</td>
            </tr>
            <tr style="border:1px solid #ddd">
            <th style="padding-left:10px" >Acquisition Date</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd"><?= date('d M, Y', strtotime($asset->acquisition_date)); ?></td>
            </tr>
            <tr>
            <th style="padding-left:10px" >Supplier</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd"><?= $asset->supplier_name; ?></td>
            </tr>
            <tr style="border:1px solid #ddd">
            <th style="padding-left:10px" >Custodian</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd"><?= $asset->custodian_name; ?></td>
            </tr>
            <tr>
            <th style="padding-left:10px"  >Warranty</th>
            <td  style="border:1px solid #ddd;padding:6px;" class="text-center" style="border:1px solid #ddd;padding:6px;" style="border:1px solid #ddd;padding:6px" style="border:1px solid #ddd" style="border:1px solid #ddd"><?= $asset->warranty_months; ?> months</td>
            </tr>
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
