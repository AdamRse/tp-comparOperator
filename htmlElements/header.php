<?php
if(AUTHOR)
    $name = $_SESSION['user']['author']['name'];
elseif(TO)
    $name = $_SESSION['user']['to']['name'];
else
    $name = "Guest";
?>
<header>
    <nav class="navbar bg-space-primary container border-bottom border-light">
        <a class="navbar-brand text-space-primary-reverse fw-bold" href="/">
            <img src="/images/normandy.png" class="m-1 ms-5" style="max-height: 25px;" />
            SPACE OPERATOR
        </a>
        <div id="openConnect" class="text-space-primary-reverse fw-bold position-relative py-3 ps-3 me-5">
            <span id="nomSession"><?= $name ?></span>

            <!-- icone guest -->
            <i data-menuid="formConnect" class="<?= AUTHOR ? "d-none " : (TO ? "d-none " : "") ?>iconConnect fa-regular fa-user fa-lg text-space-primary-reverse ms-2 rounded-circle border-1 border-space-primary-reverse" style="cursor: pointer"></i>
            <!-- icone author -->
            <i data-menuid="divMenuAuthor" class="<?= AUTHOR ? "" : "d-none " ?>iconConnect fa-solid fa-user-astronaut fa-lg text-space-primary-reverse ms-2" style="cursor: pointer"></i>
            <!-- icone TO -->
            <i data-menuid="divMenuTo" class="<?= AUTHOR ? "d-none " : (TO ? "" : "d-none ") ?>iconConnect fa-solid fa-user-tie fa-lg text-space-primary-reverse ms-2" style="cursor: pointer"></i>

            <div id="divNavMenu" class="d-none border border-space-primary-reverse p-2 mt-3 position-absolute bg-space-primary rounded-2 top-100 end-0 " style="min-width: 300px">
                <form id="formConnect" class="">
                    <input type="text" placeholder="name" class="w-100 p-1 m-1 rounded-2 text-space-primary-reverse border-space-primary-reverse bg-space-primary" />
                    <input type="password" placeholder="password" class="w-100 py-1 m-1 rounded-2 text-space-primary-reverse border-space-primary-reverse bg-space-primary" />
                    <div class="d-flex justify-centent-center">
                        <button id="btConnect" class="btn my-2 text-space-primary-reverse bg-space-secondary text-secondary-reverse m-1 ">Connect to your destiny !</button>
                    </div>
                </form>
                <div id="divMenuAuthor" class="d-none">
                    Menu Author
                    <div id="divLogoutAuthor" style="cursor: pointer">Log out</div>
                </div>
                <div id="divMenuTo" class="d-none">
                    Menu TO
                    <div id="divLogoutTo" style="cursor: pointer">Log out</div>
                </div>
            </div>
        </div>
    </nav>
</header>