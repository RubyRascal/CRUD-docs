<?php

if(isset($_POST["submitCreate"])){
    $i = 1;
    $fileUsers = 'data/users/' . $i . '.json';
    while (is_file($fileUsers)) {
        $fileUsers = 'data/users/' . $i++ . '.json';
    }
}
if (isset($_GET["id"])) {
    $dir = __DIR__ . '/data/users';
    $fileUsers = __DIR__ . '/data/users/' . $_GET["id"] . '.json';
    $readFile = file_get_contents($fileUsers);
    $userArr = json_decode($readFile, true);
}

$userData = array(
    'login' => $_POST["login"],
    'firstName' => $_POST["firstName"],
    'lastName' => $_POST["lastName"],
    'birthday' => $_POST["date"],
    'active' => $_POST["active"]
);

$formIsCorrect = true;

if (empty($userData["login"])) {
    $loginErr = "Введите логин.";
    $formIsCorrect = false;
} else {
    if (strlen($userData["login"]) < 8) {
        $loginErr = "Логин должен быть минимум 8 символов.";
        $formIsCorrect = false;
    }
}

if (empty($userData["firstName"])) {
    $firstNameErr = "Введите имя.";
    $formIsCorrect = false;
} else {
    if (strlen($userData["firstName"]) < 4) {
        $firstNameErr = "Имя должно быть не менее 4 символов.";
        $formIsCorrect = false;
    }
}

if (empty($userData["lastName"])) {
    $lastNameErr = "Введите фамилию.";
    $formIsCorrect = false;
} else {
    if (strlen($userData["lastName"]) < 6) {
        $lastNameErr = "Фамилия должна быть не менее 6 символов.";
        $formIsCorrect = false;
    }
}

if (empty($userData["birthday"])) {
    $birthdayErr = "Введите дату.";
    $formIsCorrect = false;
}

if ($formIsCorrect) { 
    $json_string = json_encode($userData);
    file_put_contents($fileUsers, $json_string);
    header('Location: /users');
    exit;
}
?>
<!DOCTYPE html>

<head>
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="/style.css" />
</head>

<body>
    <h1><?php if (isset($_GET["id"])){ ?>Edit User<?php }else{ ?>Create New User<?php } ?></h1>
    <form class="formCreate" method="POST" action="">
        <h3 class="form-text">Login</h3>
        <input class="input" type="login" placeholder="login" name="login" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["login"];}else{echo $userArr["login"];}  ?>" /><p class="error"><?php echo $loginErr ?></p>
        <h3 class="form-text">First Name</h3>
        <input class="input" type="first name" placeholder="first name" name="firstName" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["firstName"];}else{echo $userArr["firstName"];} ?>" /><p class="error"><?php echo $firstNameErr ?></p>
        <h3 class="form-text">Last Name</h3>
        <input class="input" type="last name" placeholder="last name" name="lastName" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["lastName"];}else{echo $userArr["lastName"];} ?>" /><p class="error"><?php echo $lastNameErr ?></p>
        <h3 class="form-text">Birthday</h3>
        <input class="input" type="date" placeholder="birthday" name="date" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["date"];}else{echo $userArr["birthday"];} ?>" /><p class="error"><?php echo $birthdayErr ?></p>
        <h3 class="form-text">Active</h3>
        <input class="input-check" type="checkbox" name="active" />
        <input class="input" type="submit" <?php if (isset($_GET["id"])) {?> name="submitEdit"<?php }else{ ?> name="submitCreate"<?php } ?> <?php if (isset($_GET["id"])) {?> value="Edit"<?php }else{ ?> value="Create"<?php } ?>/>
    </form>
</body>

</html>