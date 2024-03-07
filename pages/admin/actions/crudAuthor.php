<?php
$manager = new Manager($connexion);
$operators = $manager->getAllOperator();
echo "<pre>";
//var_dump($operators);
echo "</pre>";
?>
<h2 class="text-center">Manage authors</h2>
