


<div class="position-relative">
    <!-- FENETRE CANVA THREEJS -->
    <canvas id="canvas" data-engine="three.js r146"></canvas>
    <!-- DIV CONTENANT INFOS PLANETE ET TO INFOS -->
    <div class=" flex-column position-absolute end-0 top-0 align-items-center justify-content-center btnListe"></div>
    <div class=" flex-column position-absolute end-0 top-0 align-items-center justify-content-center divPrincipal " >
        <!-- DIV INFOS PLANETE -->
        <div class="d-flex flex-column gap-3 planeteDetail" style="width: 100%; height:100%">
            <div class="">
                <button class="Back btn text-white "><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
            </div>
            <img src="" alt="" class="imgPlanet ">
            <h1 class="namePlanet text-white text-center"></h1>
            <div class="text-white descriptionPlanet px-4">
            </div>
            <div class="text-center">
                <button class="btn btn-space-secondary getTO">Voir offre</button>
                <button class="btn btn-space-secondary testReset">test</button>
            </div>
            
        </div>
        <!-- DIV INFOS TO -->
        <div class="listeTO d-none flex-column" style="width: 100%; height:100%"></div>

    </div>
</div>

