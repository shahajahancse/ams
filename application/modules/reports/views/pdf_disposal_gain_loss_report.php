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
                <th>Disposal Date</th>
                <th>Original Cost</th>
                <th>Accumulated Depreciation</th>
                <th>Net Book Value</th>
                <th>Sale Proceeds</th>
                <th>Gain/Loss</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($results): ?>
                <?php $i = 1; foreach ($results as $row): ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$row['asset_info']->item_name?></td>
                        <td><?=$row['disposal_info']->disposal_date?></td>
                        <td><?=$row['asset_info']->cost?></td>
                        <td><?=$row['accumulated_depreciation_at_disposal']?></td>
                        <td><?=$row['net_book_value']?></td>
                        <td><?=$row['disposal_info']->sale_proceeds?></td>
                        <td><?=$row['gain_loss']?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No disposal records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>