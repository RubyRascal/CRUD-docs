<?php

if (isset($_POST["submitCreateDoc"])) {
    $i = 1;
    $fileDocs = 'data/docs/' . $i . '.json';
    while (is_file($fileDocs)) {
        $fileDocs = 'data/docs/' . $i++ . '.json';
    }
}
if (isset($_GET["id"])) {
    $dir = __DIR__ . '/data/docs';
    $fileDocs = __DIR__ . '/data/docs/' . $_GET["id"] . '.json';
    $readFile = file_get_contents($fileDocs);
    $DocArr = json_decode($readFile, true);
}

$docsData = array(
    'organization' => $_POST["organization"],
    'agent' => $_POST["agent"],
    'podpisan' => $_POST["podpisan"],
    'date-start' => $_POST["date-start"],
    'date-finish' => $_POST["date-finish"],
    'item' => $_POST["item"],
    'money' => $_POST["money"],
    'ur-addres' => $_POST["ur-addres"],
    'fiz-addres' => $_POST["fiz-addres"],
    'INN' => $_POST["INN"],
    'payment' => $_POST["payment"]
);

$formIsCorrect = true;

if (empty($docsData["organization"])) {
    $organizationErr = "Введите логин.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["organization"]) < 8) {
        $organizationErr = "Логин должен быть минимум 8 символов.";
        $formIsCorrect = false;
    }
}

if (empty($docsData["agent"])) {
    $agentErr = "Введите имя.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["agent"]) < 4) {
        $agentErr = "Имя должно быть не менее 4 символов.";
        $formIsCorrect = false;
    }
}

if (empty($docsData["podpisan"])) {
    $podpisanErr = "Введите имя.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["podpisan"]) < 4) {
        $podpisanErr = "Имя должно быть не менее 4 символов.";
        $formIsCorrect = false;
    }
}

if (empty($docsData["date-start"])) {
    $dateStartErr = "Введите дату начала.";
    $formIsCorrect = false;
}

if (empty($docsData["date-finish"])) {
    $dateFinishErr = "Введите дату окончания.";
    $formIsCorrect = false;
}

if (empty($docsData["item"])) {
    $itemErr = "Введите предмет договора.";
    $formIsCorrect = false;
}

if (empty($docsData["money"])) {
    $moneyErr = "Введите сумму.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["money"]) < 4) {
        $moneyErr = "Сумма должна быть не менее 4 символов.";
        $formIsCorrect = false;
    }
}

if (empty($docsData["ur-addres"])) {
    $urAddresErr = "Введите юридический адрес.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["ur-addres"]) < 20) {
        $urAddresErr = "Юридический адресс должен быть не менее 20 символов.";
        $formIsCorrect = false;
    }
}

if (empty($docsData["fiz-addres"])) {
    $fizAddresErr = "Введите физический адрес.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["fiz-addres"]) < 20) {
        $fizAddresErr = "Физический адрес должен быть не менее 20 символов.";
        $formIsCorrect = false;
    }
}

if (empty($docsData["INN"])) {
    $innErr = "Введите ИНН.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["INN"]) != 10) {
        $innErr = "Неверный ИНН.";
        $formIsCorrect = false;
    }
}

if (empty($docsData["payment"])) {
    $paymentErr = "Введите расчетный счет.";
    $formIsCorrect = false;
} else {
    if (strlen($docsData["payment"]) != 20) {
        $paymentErr = "Неверный расчетный счет.";
        $formIsCorrect = false;
    }
}

if ($formIsCorrect) {
    $json_string = json_encode($docsData);
    file_put_contents($fileDocs, $json_string);
    header('Location: /docs');
    exit;
}
?>
<!DOCTYPE html>

<head>
    <title>Doc</title>
    <link rel="stylesheet" type="text/css" href="/style.css" />
</head>

<body>

    <h1><?php if (isset($_GET["id"])) {?>Edit<?php }else{ ?>Create<?php } ?> Document</h1>
    <form class="formCreate" method="POST" action="">
        <h3 class="form-text">Organization</h3>
        <input class="input" type="organization" placeholder="organization" name="organization" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["organization"];}else{echo $DocArr["organization"];}?>"/><p class="error"><?php echo $organizationErr ?></p>
        <h3 class="form-text">Counterparty</h3>
        <input class="input" type="agent" placeholder="agent" name="agent" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["agent"];}else{echo $DocArr["agent"];}?>"/><p class="error"><?php echo $agentErr ?></p>
        <h3 class="form-text">Signatory</h3>
        <input class="input" type="podpisan" placeholder="podpisan" name="podpisan" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["podpisan"];}else{echo $DocArr["podpisan"];}?>"/><p class="error"><?php echo $podpisanErr ?></p>
        <h3 class="form-text">Contract start date</h3>
        <input class="input" type="date" name="date-start" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["date-start"];}else{echo $DocArr["date-start"];}?>"/><p class="error"><?php echo $dateStartErr ?></p>
        <h3 class="form-text">Contract finish date</h3>
        <input class="input" type="date" name="date-finish" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["date-finish"];}else{echo $DocArr["date-finish"];}?>"/><p class="error"><?php echo $dateFinishErr ?></p>
        <h3 class="form-text">Subject of the contract</h3>
        <p><select class="input" name="item" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["item"];}else{echo $DocArr["item"];}?>"><option>Покупка</option><option>Продажа</option></select></p><p class="error"><?php echo $itemErr ?></p>
        <h3 class="form-text">Contract amount</h3>
        <input class="input" type="money" name="money" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["money"];}else{echo $DocArr["money"];}?>"/><p class="error"><?php echo $moneyErr ?></p>
        <h3 class="form-text">Requisites</h3>
        <input class="input" type="ur-addres" placeholder="Legal address" name="ur-addres" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["ur-addres"];}else{echo $DocArr["ur-addres"];}?>"/><p class="error"><?php echo $urAddresErr ?></p>
        <!-- <p>Юр. адрес совпадает с физ. адресом?</p><input type="checkbox"> -->
        <input class="input" type="fiz-addres" placeholder="Physical address" name="fiz-addres" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["fiz-addres"];}else{echo $DocArr["fiz-addres"];}?>"/><p class="error"><?php echo $fizAddresErr ?></p>
        <input class="input" type="INN" placeholder="ИНН" name="INN" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["INN"];}else{echo $DocArr["INN"];}?>"/><p class="error"><?php echo $innErr ?></p>
        <input class="input" type="payment" placeholder="Payment account" name="payment" value="<?php if (isset($_POST["submitCreateDoc"])) {echo $_POST["payment"];}else{echo $DocArr["payment"];}?>"/><p class="error"><?php echo $paymentErr ?></p>
</br>
        <input class="input" type="submit" <?php if (isset($_GET["id"])) {?> name="submitUpdateDoc"<?php }else{ ?> name="submitCreateDoc"<?php } ?> <?php if (isset($_GET["id"])) {?> value="Edit"<?php }else{ ?> value="Create"<?php } ?>/>
    </form>
</body>

</html>