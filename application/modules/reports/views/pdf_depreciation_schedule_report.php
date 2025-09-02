<!DOCTYPE html>
<html>
<head>
    <title><?=$headding?></title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        h3 { margin-top: 20px; }
    </style>
</head>
<body>
    <h2><?=$headding?></h2>

    <?php if ($results): ?>
        <?php foreach ($results as $asset_report): ?>
            <h3>Asset: <?=$asset_report['asset_info']->item_name?> (ID: <?=$asset_report['asset_info']->id?>)</h3>
            <p>Method: <?=$asset_report['depreciation_parameters']->method_name?></p>
            <p>Useful Life: <?php
    if ($asset_report['depreciation_parameters']->method_name == 'Units of Production Method' && !empty($asset_report['depreciation_parameters']->useful_life_units)) {
        echo $asset_report['depreciation_parameters']->useful_life_units . ' Units';
    } else {
        echo $asset_report['depreciation_parameters']->useful_life_years . ' Years';
    }
?></p>
            <p>Salvage Value: <?=$asset_report['depreciation_parameters']->salvage_value?></p>
            <p>Start Date: <?=$asset_report['depreciation_parameters']->depreciation_start_date?></p>

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Depreciation Amount</th>
                        <th>Accumulated Depreciation</th>
                        <th>Net Book Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($asset_report['schedule']): ?>
                        <?php foreach ($asset_report['schedule'] as $entry): ?>
                            <tr>
                                <td><?=$entry->schedule_date?></td>
                                <td><?=$entry->depreciation_amount?></td>
                                <td><?=$entry->accumulated_depreciation?></td>
                                <td><?=$entry->net_book_value?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No depreciation schedule found for this asset.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No assets with depreciation parameters found.</p>
    <?php endif; ?>
</body>
</html>