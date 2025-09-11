<!DOCTYPE html>
<html>
<head>
    <title><?=$meta_title?></title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2><?=$headding?></h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Acquisition Date</th>
                <th>Cost</th>
                <th>Accumulated Depreciation</th>
                <th>Net Book Value</th>
                <th>Serial Number</th>
                <th>Custodian</th>
                <th>Branch</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
            <tr>
                <td><?=$row->id?></td>
                <td><?=$row->item_name?></td>
                <td><?=$row->category_name?></td>
                <td><?=$row->acquisition_date?></td>
                <td><?=number_format($row->cost, 2)?></td>
                <td><?=number_format($row->accumulated_depreciation, 2)?></td>
                <td><?=number_format($row->net_book_value, 2)?></td>
                <td><?=$row->serial_number?></td>
                <td><?=$row->custodian_first_name . ' ' . $row->custodian_last_name?></td>
                <td><?=$row->branch_name?></td>
                <td><?=$row->department_name?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>