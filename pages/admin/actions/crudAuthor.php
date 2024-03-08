<?php
$manager = new Manager($connexion);
$authors = $manager->getAllAuthors();
// echo "<pre>";
// var_dump($authors);
// echo "</pre>";
?>
<h2 class="text-center">Manage authors</h2>
<table id="tableAuthor" class="table col-12 col-sm-11 col-lg-8 text-space-primary-reverse bg-space-primary">
    <thread>
        <tr>
            <th>Name</th>
            <th>Reviews</th>
            <th>Options</th>
        </tr>
    </thread>
    
    <?php
    foreach($authors as $author) {
        ?>
        <tr>
           <td class="bg-space-primary text-space-primary-reverse"><?= $author->getName() ?></td>
           <td class="bg-space-primary text-space-primary-reverse"><?= sizeof($author->getReviews()) ?></td>
           <td class="bg-space-primary text-space-primary-reverse"><button data-id="<?= $author->getId() ?>" data-name="<?= $author->getName() ?>" class="deleteAuthor btn btn-danger">Delete</button></td>
        </tr>
        <?php
    }
    ?>
</table>
<h2 id="manageReviews" class="text-center">Manage reviews</h2>
<div class="d-flex justify-content-center ">
    <?php
    foreach($authors as $author){
        foreach ($author->getReviews() as $review) {
            ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $review->getAuthor() ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">--</h6>
                    <p class="card-text"><?= $review->getMessage() ?></p>
                    <a href="/?s=admin&process&delete_review=<?= $review->getId() ?>" class="card-link">Delete</a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>