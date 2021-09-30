<!DOCTYPE html>

<head>
    <title>Doc</title>
    <link rel="stylesheet" type="text/css" href="/style.css" />
</head>

<body>

<h1><?php if (isset($_GET["id"])) {?>Edit<?php }else{ ?>Create<?php } ?> Document</h1>
<form class="formCreate" method="POST" action="">
    <h3 class="form-text">Organization</h3>
    <input class="input" type="organization" placeholder="organization" name="organization" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["organization"];}else{echo $DocsData["organization"];}?>"/><p class="error"><?php echo $errors["organizationErr"] ?></p>
    <h3 class="form-text">Counterparty</h3>
    <input class="input" type="agent" placeholder="agent" name="agent" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["agent"];}else{echo $DocsData["agent"];}?>"/><p class="error"><?php echo $errors["agentErr"]?></p>
    <h3 class="form-text">Signatory</h3>
    <input class="input" type="podpisan" placeholder="podpisan" name="podpisan" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["podpisan"];}else{echo $DocsData["podpisan"];}?>"/><p class="error"><?php echo $errors["podpisanErr"] ?></p>
    <h3 class="form-text">Contract start date</h3>
    <input class="input" type="date" name="dateStart" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["dateStart"];}else{echo $DocsData["dateStart"];}?>"/><p class="error"><?php echo $errors["dateStartErr"] ?></p>
    <h3 class="form-text">Contract finish date</h3>
    <input class="input" type="date" name="dateFinish" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["dateFinish"];}else{echo $DocsData["dateFinish"];}?>"/><p class="error"><?php echo $errors["dateFinishErr"] ?></p>
    <h3 class="form-text">Subject of the contract</h3>
    <p><select class="input" name="item" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["item"];}else{echo $DocsData["item"];}?>"><option>Покупка</option><option>Продажа</option></select></p><p class="error"><?php echo $errors["itemErr"] ?></p>
    <h3 class="form-text">Contract amount</h3>
    <input class="input" type="money" name="money" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["money"];}else{echo $DocsData["money"];}?>"/><p class="error"><?php echo $errors["moneyErr"] ?></p>
    <h3 class="form-text">Requisites</h3>
    <input class="input" type="ur-addres" placeholder="Legal address" name="urAddress" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["urAddress"];}else{echo $DocsData["urAddress"];}?>"/><p class="error"><?php echo $errors["urAddresErr"] ?></p>
    <!-- <p>Юр. адрес совпадает с физ. адресом?</p><input type="checkbox"> -->
    <input class="input" type="fiz-addres" placeholder="Physical address" name="fizAddress" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["fizAddress"];}else{echo $DocsData["fizAddress"];}?>"/><p class="error"><?php echo $errors["fizAddresErr"] ?></p>
    <input class="input" type="INN" placeholder="ИНН" name="INN" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["INN"];}else{echo $DocsData["INN"];}?>"/><p class="error"><?php echo $errors["innErr"] ?></p>
    <input class="input" type="payment" placeholder="Payment account" name="payment" value="<?php if (isset($_POST["submitCreate"])) {echo $_POST["payment"];}else{echo $DocsData["payment"];}?>"/><p class="error"><?php echo $errors["paymentErr"] ?></p>
    </br>
    <input class="input" type="submit" <?php if (isset($_GET["id"])) {?> name="submitEdit"<?php }else{ ?> name="submitCreate"<?php } ?> <?php if (isset($_GET["id"])) {?> value="Edit"<?php }else{ ?> value="Create"<?php } ?>/>
</form>
</body>

</html>
