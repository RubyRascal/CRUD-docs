<!DOCTYPE html>

<head>
    <title>Doc`s List</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

    <h1>Doc`s List</h1>

    <table class="table">
        <a href="/docs/create"><button class="create">Create New Document</button></a>
        <tr>
            <th>Organization</th>
            <th>Counterparty</th>
            <th>Signatory</th>
            <th>Contract term(years)</th>
            <th>Subject of the contract</th>
            <th>Contract amount</th>
            <th>Add File</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($DocArr as $arr) {
            $outmsv = $arr["json"];
            $id = $arr["id"];
            $id = (int)$id;
            $result = $outmsv["date-finish"] - $outmsv["date-start"];
        ?>
            <tr>
                <td><?php echo $outmsv["organization"] ?></td>
                <td><?php echo $outmsv["agent"] ?></td>
                <td><?php echo $outmsv["podpisan"] ?></td>
                <td><?php echo $result ?></td>
                <td><?php echo $outmsv["item"] ?></td>
                <td><?php echo $outmsv["money"] ?></td>
                <td><a href="#" class="aMain" id="<?= $id; ?>"><button class="btn-main">Add File</button></a></td>
                <td><a href="/docs/edit/?id=<?= $id ?> " class="aMain" id="<?= $id; ?>"><button class="btn-main">Edit</button></a></td>
                <td><a href="/docs/delete/?id=<?= $id ?> " class="aMain" id="<?= $id; ?>"><button class="btn-main">Delete</button></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <a href="/AdminPanel"><button class="create">Admin Panel</button></a>
</body>

</html>