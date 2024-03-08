<?php
require "php_config/init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "htmlElements/head_config.php"; ?>
</head>
<body class="bg-dark text-light min-vh-100 user-select-none" style="height: 100%;">
    <?php
    // echo "///<pre>";
    // var_dump($_SESSION, $_GET);
    // echo "</pre>///";
    include "./htmlElements/header.php";// Le contenu HTML du header (haut de la page html)

    include $section;// On execute le code de la section demmandée et vérifiée

    include "./htmlElements/footer.php";// Le contenu HTML du footer (bas de la page html) 
    ?>
</body>
</html>
<?php
ob_end_flush();