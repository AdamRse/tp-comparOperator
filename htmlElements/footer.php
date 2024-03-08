<footer class="py-3 mt-3 d-flex justify-content-between border-top border-space-primary-reverse text-space-primary-reverse bg-space-primary" style="box-shadow: 0 -5px 5px #000;">
<div class="col-sm-6 text-end">
    <img src="/images/normandy.png" />
</div>
<div class="col-sm-6 d-flex align-items-center fw-bold " style="font-size: 3rem;">
    SPACE OPERATOR
</div>
</footer>
<?php
//Ajout dynamique de tous les scripts js de la page
foreach ($js as $fileJs){// L'existence des fichier du tableau $js a déjà été vérifiée dans index.php
    ?>
    <script src="<?= $fileJs ?>" type="module"></script>
    <?php
}