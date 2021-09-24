<!DOCTYPE html>

<head>
    <title>UserList</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <h1>User`s list</h1>
    
    <table class="table">
        <a href="/users/create"><button class="create">Create new User</button></a>
        <tr>
            <th>Login</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birtday</th>
            <th>Active</th>
            <th>Edit user</th>
            <th>Delete user</th>
        </tr>
        <?php

        foreach ($UserArr as $user) {
            $outmsv = $user["json"];
            $id = $user["id"];
            $id = (int)$id;
            if ($outmsv["active"] != "on") {
                $outmsv["active"] = "off";
            }
        ?>
            <tr>
                <td><?php echo $outmsv["login"]  ?></td>
                <td><?php echo $outmsv["firstName"]  ?></td>
                <td><?php echo $outmsv["lastName"]  ?></td>
                <td><?php echo $outmsv["birthday"]  ?></td>
                <td><?php echo $outmsv["active"]  ?></td>
                <td><a href="/users/edit/?id=<?= $id ?> " class="aMain" id="<?= $id; ?>"><button class="btn-main">Edit</button></a></td>
                <td><a href="/users/delete/?id=<?= $id ?>" class="aMain" id="<?= $id; ?>"><button class="btn-main">Delete</button></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <a href="/AdminPanel"><button class="create">Admin Panel</button></a>
</body>

</html>