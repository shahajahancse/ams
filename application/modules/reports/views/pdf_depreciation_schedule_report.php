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
        .asset-details { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2><?=$headding?></h2>
    </div>

    <?php if (!empty($results)): ?>
        <?php foreach ($results as $report_item): ?>
            <div class="asset-details">
                <h3>Asset: <?=$report_item['asset_info']->item_name?> (ID: <?=$report_item['asset_info']->id?>)</h3>
                <p>Cost: <?=number_format($report_item['asset_info']->cost, 2)?></p>
                <p>Salvage Value: <?=number_format($report_item['asset_info']->salvage_value, 2)?></p>
                <p>Useful Life: <?=$report_item['asset_info']->useful_life?> years</p>
                <p>Depreciation Method: <?=$report_item['asset_info']->depreciation_method?></p>
                <p>Acquisition Date: <?=$report_item['asset_info']->acquisition_date?></p>
            </div>

            <?php if (!empty($report_item['schedule'])): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Depreciation Amount</th>
                            <th>Accumulated Depreciation</th>
                            <th>Net Book Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($report_item['schedule'] as $schedule_entry): ?>
                            <tr>
                                <td><?=$schedule_entry['month']?></td>
                                <td><?=number_format($schedule_entry['depreciation_amount'], 2)?></td>
                                <td><?=number_format($schedule_entry['accumulated_depreciation'], 2)?></td>
                                <td><?=number_format($schedule_entry['net_book_value'], 2)?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No depreciation schedule available for this asset.</p>
            <?php endif; ?>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No assets found for depreciation schedule report.</p>
    <?php endif; ?>
</body>
</html>