<header>
    <nav class="navbar bg-space-primary container border-bottom border-light">
    <a class="navbar-brand text-space-primary-reverse fw-bold" href="/">
        <img src="/images/normandy.png" class="w-25" />
        SPACE OPERATOR
    </a>
    <div class="text-space-primary-reverse fw-bold position-relative">
        <?php
        if(AUTHOR){
            echo $_SESSION['user']['author']['name'];
            ?>
            <i class="fa-solid fa-user-astronaut fa-lg text-space-primary-reverse ms-2"></i>
            <?php
        }
        elseif(TO){
            echo $_SESSION['user']['to']['name'];
            ?>
            <i class="fa-solid fa-user-tie fa-lg text-space-primary-reverse ms-2"></i>
            <?php
        }
        else{
            ?>
            Guest
            <i class="fa-regular fa-user fa-lg text-space-primary-reverse ms-2"></i>
            <div class="border border-light p-2 mt-3 position-absolute bg-space-primary rounded-2 top-100 end-0 " style="min-width: 300px">
                <div class="">
                    <input type="text" placeholder="Name" class="w-100 p-1 m-1 rounded-2 text-space-primary-reverse bg-space-primary" />
                    <input type="password" placeholder="Password" class="w-100 py-1 m-1 rounded-2 text-space-primary-reverse bg-space-primary" />
                    <button id="btConnect" class="btn my-2 text-space-primary-reverse bg-space-secondary text-secondary-reverse m-1 ">Connect to your destiny !</button>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    </nav>
</header>