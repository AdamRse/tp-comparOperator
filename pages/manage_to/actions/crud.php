<?php
$manager = new Manager($connexion);
$operator = $manager->getOperatorById(TO);
echo "<pre>";
var_dump($operator);
echo "</pre>";
?>
<h2 id="manageAccount" class="text-center">Manage account</h2>
<form method="get" class="col-lg-4 col-sm-8 col-11">
        <input type="hidden" name="s" value="manage_to"/>
        <input type="hidden" name="process" value="manage_to"/>
        <div class="form-group mb-3">
            <label for="inputAddOpName">New password</label>
            <input type="password" name="pw" class="form-control text-center" id="inputAddOpName" placeholder="Enter New Password">
            <?= isset($_GET['pw_success']) ? "<h6 class='text-success'>Mot de passe modifié !</h6>" : "" ?>
        </div>
        <input type="submit" value="Change password" class="btn btn-success">
    </form>