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
        <thead >
            <tr >
                <th style="font-size: 11px;">Sl</th>
                <th style="font-size: 11px;">Branch</th>
                <th style="font-size: 11px;">Department</th>
                <th style="font-size: 11px;">Category</th>
                <th style="font-size: 11px;">Sub Category</th>
                <th style="font-size: 11px;">Item Name</th>
                <th style="font-size: 11px;">Acquisition Date</th>
                <th style="font-size: 11px;">Original Cost</th>
                <th style="font-size: 11px;">Accumulated Depreciation</th>
                <th style="font-size: 11px;">Net Book Value</th>
                <th style="font-size: 11px;">Serial Number</th>
                <th style="font-size: 11px;">Custodian</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
            <tr>
                <td style="font-size: 11px;"><?= $i = $i + 1?></td>
                <td style="font-size: 11px;"><?= $row->branch_name?></td>
                <td style="font-size: 11px;"><?= $row->dept_name?></td>
                <td style="font-size: 11px;"><?= $row->category_name?></td>
                <td style="font-size: 11px;"><?= $row->sub_cate_name?></td>
                <td style="font-size: 11px;"><?= $row->item_name?></td>
                <td style="font-size: 11px;"><?= $row->acquisition_date?></td>
                <td style="font-size: 11px;"><?= number_format($row->original_cost, 2)?></td>
                <td style="font-size: 11px;"><?= number_format($row->accumulated_depreciation, 2)?></td>
                <td style="font-size: 11px;"><?= number_format($row->net_book_value, 2)?></td>
                <td style="font-size: 11px;"><?= $row->serial_number?></td>
                <td style="font-size: 11px;"><?= $row->custodian_first_name . ' ' . $row->custodian_last_name?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>