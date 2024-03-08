<?php
$manager = new Manager($connexion);
$operator = $manager->getOperatorById(TO);
echo "<pre>";
var_dump($operator);
echo "</pre>";
?>
<h2 class="text-center">Manage account</h2>
