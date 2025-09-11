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
                    <th>Asset Name</th>
                    <th>Transfer Date</th>
                    <th>From Branch</th>
                    <th>From Department</th>
                    <th>To Branch</th>
                    <th>To Department</th>
                    <th>Transferred By</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?=$row->item_name?></td>
                    <td><?=$row->transfer_date?></td>
                    <td><?=$row->from_branch_name?></td>
                    <td><?=$row->from_department_name?></td>
                    <td><?=$row->to_branch_name?></td>
                    <td><?=$row->to_department_name?></td>
                    <td><?=$row->first_name . ' ' . $row->last_name?></td>
                    <td><?=$row->notes?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No asset movement history found.</p>
    <?php endif; ?>
</body>
</html>