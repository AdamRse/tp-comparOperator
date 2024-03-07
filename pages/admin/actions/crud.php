<?php
$manager = new Manager($connexion);
$operators = $manager->getAllOperator();
echo "<pre>";
//var_dump($operators);
echo "</pre>";
?>
<h2 class="text-center">Gérer les tour operator du site</h2>
<table class="table" id="tableTourOperators">
<thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Commercial Link</th>
      <th scope="col">Options</th>
    </tr>
    <?php
    foreach ($operators as $operator){
        ?>
        <tr>
            <td class="bg-space-primary text-space-primary-reverse">
                <?= $operator->getName() ?>
            </td>
            <td class="bg-space-primary text-space-primary-reverse">
                <a href='<?= $operator->getLink() ?>'><?= $operator->getLink() ?></a>
            </td>
            <td class="bg-space-primary text-space-primary-reverse">
                <button data-id="<?= $operator->getId() ?>" data-name="<?= $operator->getName() ?>" class="deleteTo btn btn-danger">Delete</button>
            </td>
        </tr>
        <?php
    }
    ?>
</thead>
</table>
<h2 class="text-center mt-4">Ajouter un tour operator</h2>
<div class="d-flex justify-content-center">
    <form method="get" class="col-lg-6 col-11">
        <input type="hidden" name="s" value="admin"/>
        <input type="process" name="s" value="addOperator"/>
        <div class="form-group mb-3">
            <label for="inputAddOpName">Name</label>
            <input type="text" name="name" class="form-control text-center" id="inputAddOpName" placeholder="Enter Name">
            <!-- <small id="emailHelp" class="text-space-primary-reverse">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group mb-3">
            <label for="inputAddOpLink">Commercial Link</label>
            <input type="text" name="link" class="form-control text-center" id="inputAddOpLink" placeholder="Enter Commercial Link">
        </div>
        <div class="form-group mb-3">
            <label for="inputAddOpPw">Temporary password</label>
            <input type="text" name="pw" class="form-control text-center" id="inputAddOpPw" placeholder="Enter Temporary password">
        </div>
        <input type="submit" value="Ajouter" class="btn btn-success">
    </form>
</div>
<div>

</div>
