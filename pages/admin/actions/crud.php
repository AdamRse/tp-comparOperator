<?php
$manager = new Manager($connexion);
$operators = $manager->getAllOperator();
echo "<pre>";
//var_dump($operators);
echo "</pre>";
?>
<h2 class="text-center">Gérer les tour operator du site</h2>
<table class="table">
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
