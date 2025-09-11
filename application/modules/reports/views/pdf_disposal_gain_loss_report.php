<!DOCTYPE html>
<html>
<head>
    <title><?=$meta_title?></title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2><?=$headding?></h2>
    </div>

    <?php if (!empty($results)): ?>
        <table>
            <thead>
                <tr>
                    <th>Asset ID</th>
                    <th>Item Name</th>
                    <th>Original Cost</th>
                    <th>Disposal Date</th>
                    <th>Disposal Type</th>
                    <th>Sale Proceeds</th>
                    <th>Accumulated Depreciation at Disposal</th>
                    <th>Net Book Value at Disposal</th>
                    <th>Gain/Loss</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?=$row['disposal_info']->id?></td>
                    <td><?=$row['disposal_info']->item_name?></td>
                    <td><?=number_format($row['disposal_info']->cost, 2)?></td>
                    <td><?=$row['disposal_info']->disposal_date?></td>
                    <td><?=$row['disposal_info']->disposal_type?></td>
                    <td><?=number_format($row['disposal_info']->sale_proceeds, 2)?></td>
                    <td><?=number_format($row['accumulated_depreciation_at_disposal'], 2)?></td>
                    <td><?=number_format($row['net_book_value'], 2)?></td>
                    <td><?=number_format($row['gain_loss'], 2)?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No disposal gain/loss data found.</p>
    <?php endif; ?>
</body>
</html>