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
    </style>
</head>
<body>
    <h2><?=$headding?></h2>
    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Description</th>
                <th>Account Debit</th>
                <th>Account Credit</th>
                <th>Amount</th>
                <th>Asset ID</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($results): ?>
                <?php $i = 1; foreach ($results as $row): ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$row['Date']?></td>
                        <td><?=$row['Description']?></td>
                        <td><?=$row['Account_Debit']?></td>
                        <td><?=$row['Account_Credit']?></td>
                        <td><?=number_format($row['Amount'], 2)?></td>
                        <td><?=$row['Asset_ID']?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No journal entries found for the selected period.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>