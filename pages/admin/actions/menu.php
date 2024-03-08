<div class="my-3 text-center p-2">
    <a href="/?s=admin&vue=to" <?= (empty($_GET['vue']) || $_GET['vue'] == "to") ? "class='tw-bold'" : null ?>>Tour Operators</a>
    /
    <a href="/?s=admin&vue=author" <?= (!empty($_GET['vue']) && $_GET['vue'] == "author") ? "class='tw-bold'" : null ?>>Authors</a>
</div>