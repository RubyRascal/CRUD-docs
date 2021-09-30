<!DOCTYPE html>
<head>
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="/style.css" />
</head>

<body>
    <h1><?php if (isset($_GET["id"])){ ?>Edit User<?php }else{ ?>Create New User<?php } ?></h1>
    <form class="formCreate" method="POST" action="">
        <h3 class="form-text">Login</h3>
        <input class="input" type="text" placeholder="login" name="login" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["login"];}else{echo $userData["login"];}  ?>" /><p class="error"><?php echo $errors["loginErr"] ?></p>
        <h3 class="form-text">First Name</h3>
        <input class="input" type="text" placeholder="first name" name="firstName" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["firstName"];}else{echo $userData["firstName"];} ?>" /><p class="error"><?php echo $errors["firstNameErr"] ?></p>
        <h3 class="form-text">Last Name</h3>
        <input class="input" type="text" placeholder="last name" name="lastName" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["lastName"];}else{echo $userData["lastName"];} ?>" /><p class="error"><?php echo $errors["lastNameErr"] ?></p>
        <h3 class="form-text">Birthday</h3>
        <input class="input" type="date" placeholder="birthday" name="birthday" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["birthday"];}else{echo $userData["birthday"];} ?>" /><p class="error"><?php echo $errors["birthdayErr"] ?></p>
        <h3 class="form-text">Active</h3>
        <input class="input-check" type="checkbox" name="active" />
        <input class="input" type="submit" <?php if (isset($_GET["id"])) {?> name="submitEdit"<?php }else{ ?> name="submitCreate"<?php } ?> <?php if (isset($_GET["id"])) {?> value="Edit"<?php }else{ ?> value="Create"<?php } ?>/>
    </form>
</body>

</html>