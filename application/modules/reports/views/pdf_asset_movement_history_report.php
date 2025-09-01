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
                <th>Movement Date</th>
                <th>From Location</th>
                <th>To Location</th>
                <th>From Custodian</th>
                <th>To Custodian</th>
                <th>Notes</th>
                <th>Recorded By</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($results): ?>
                <?php $i = 1; foreach ($results as $row): ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$row->item_name?></td>
                        <td><?=$row->movement_date?></td>
                        <td><?=$row->from_location?></td>
                        <td><?=$row->to_location?></td>
                        <td><?=$row->from_custodian_fname . ' ' . $row->from_custodian_lname?></td>
                        <td><?=$row->to_custodian_fname . ' ' . $row->to_custodian_lname?></td>
                        <td><?=$row->notes?></td>
                        <td><?=$row->created_by_fname . ' ' . $row->created_by_lname?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No asset movements found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>