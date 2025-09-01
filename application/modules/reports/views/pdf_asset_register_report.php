<!DOCTYPE html>
<html>
<head>
    <title><?=$headding?></title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2><?=$headding?></h2>
    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Asset Name</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Acquisition Date</th>
                <th>Cost</th>
                <th>Supplier</th>
                <th>Serial No.</th>
                <th>Warranty (Months)</th>
                <th>Custodian</th>
                <th>Asset Status</th>
                <th>Accumulated Depreciation</th>
                <th>Net Book Value</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($results): ?>
                <?php $i = 1; foreach ($results as $row): ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$row->item_name?></td>
                        <td><?=$row->category_name?></td>
                        <td><?=$row->sub_cate_name?></td>
                        <td><?=$row->acquisition_date?></td>
                        <td><?=$row->cost?></td>
                        <td><?=$row->supplier_name?></td>
                        <td><?=$row->serial_number?></td>
                        <td><?=$row->warranty_months?></td>
                        <td><?=$row->custodian_name?></td>
                        <td><?=$row->asset_status?></td>
                        <td><?=$row->accumulated_depreciation?></td>
                        <td><?=$row->net_book_value?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13">No assets found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>