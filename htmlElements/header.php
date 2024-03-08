<?php
if(AUTHOR){
    $name = $_SESSION['user']['author']['name'];
}
elseif(TO){
    $name = $_SESSION['user']['to']['name'];
}
elseif(ADMIN){
    $name = $_SESSION['user']['admin']['name'];
}
else{
    $name = "Guest";
}
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
            <i data-menuid="formConnect" data-type="guest" class="<?= (AUTHOR || TO || ADMIN) ? "d-none " : "" ?>iconConnect fa-regular fa-user fa-lg text-space-primary-reverse ms-2 rounded-circle border-1 border-space-primary-reverse" style="cursor: pointer"></i>
            <!-- icone author -->
            <i data-menuid="divMenuAuthor" data-type="author" class="<?= AUTHOR ? "" : "d-none " ?>iconConnect fa-solid fa-user-astronaut fa-lg text-space-primary-reverse ms-2" style="cursor: pointer"></i>
            <!-- icone TO -->
            <i data-menuid="divMenuTo" data-type="to" class="<?= TO ? "" : "d-none " ?>iconConnect fa-solid fa-user-tie fa-lg text-space-primary-reverse ms-2" style="cursor: pointer"></i>
            <!-- icone admin -->
            <i data-menuid="divMenuAdmin" data-type="admin" class="<?= ADMIN ? "" : "d-none " ?>iconConnect fa-solid fa-user-secret fa-lg text-space-primary-reverse ms-2" style="cursor: pointer"></i>
            
            <div id="divNavMenu" class="d-none border border-space-primary-reverse p-2 mt-3 position-absolute bg-space-primary rounded-2 top-100 end-0 " style="min-width: 300px">
                <form id="formConnect" class="">
                    <input id="formConnectName" type="text" placeholder="name" class="w-100 p-1 m-1 rounded-2 text-space-primary-reverse border-space-primary-reverse bg-space-primary" />
                    <input id="formConnectPw" type="password" placeholder="password" class="w-100 py-1 m-1 rounded-2 text-space-primary-reverse border-space-primary-reverse bg-space-primary" />
                    <div class="d-flex justify-centent-center">
                        <button id="btConnect" class="btn my-2 text-space-primary-reverse bg-space-secondary text-secondary-reverse m-1 ">Connect to your destiny !</button>
                    </div>
                    <span id="spanReturnMessage" class="text-danger"></span>
                </form>
                <div id="divMenuAuthor" class="d-none">
                    Menu Author
                    <div id="divLogoutAuthor" class="divLogout" style="cursor: pointer">Log out</div>
                </div>
                <div id="divMenuTo" class="d-none">
                    Menu TO
                    <div class="my-3">
                        <a href="?s=manage_to">Management</a>
                    </div>
                    <div id="divLogoutTo" class="divLogout"  style="cursor: pointer">Log out</div>
                </div>
                <div id="divMenuAdmin" class="d-none">
                    Menu Admin
                    <div class="my-3">
                        <a href="?s=admin">Administration interface</a>
                    </div>
                    <div id="divLogoutAdmin" class="divLogout"  style="cursor: pointer">Log out</div>
                </div>
            </div>
        </div>
    </nav>
</header>