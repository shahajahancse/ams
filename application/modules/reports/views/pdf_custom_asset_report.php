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
    <?php if (!empty($results)): ?>
        <table>
            <thead>
                <tr>
                    <?php foreach ($selected_columns as $col): ?>
                        <th><?=ucwords(str_replace('_', ' ', $col))?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                <tr>
                    <?php foreach ($selected_columns as $col): ?>
                        <td><?=$row[$col]?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No data found for the selected criteria.</p>
    <?php endif; ?>
</body>
</html>