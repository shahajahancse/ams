<div class="container">
    <h3><?= $meta_title; ?></h3>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?= $asset->id; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?= $asset->item_name; ?></td>
        </tr>
        <tr>
            <th>Serial</th>
            <td><?= $asset->serial_number; ?></td>
        </tr>
        <tr>
            <th>Location</th>
            <td>
                <?= $asset->branch_name; ?>,
                <?= $asset->department_name; ?>,
                <?= $asset->floor_name; ?>,
                <?= $asset->room_name; ?>
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $asset->asset_status; ?></td>
        </tr>
        <tr>
            <th>Cost</th>
            <td><?= $asset->cost; ?></td>
        </tr>
        <tr>
            <th>Acquisition Date</th>
            <td><?= $asset->acquisition_date; ?></td>
        </tr>
        <tr>
            <th>Supplier</th>
            <td><?= $asset->supplier_name; ?></td>
        </tr>
        <tr>
            <th>Custodian</th>
            <td><?= $asset->custodian_name; ?></td>
        </tr>
        <tr>
            <th>Warranty</th>
            <td><?= $asset->warranty_months; ?> months</td>
        </tr>
    </table>
</div>
