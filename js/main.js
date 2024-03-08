import * as THREE from 'three'
import { getFirstObjectWithName } from '/js/threejs/RayCastHelper.js';
// Data and visualization
import { CompositionShader } from '/js/threejs/shaders/CompositionShader.js'
import { BASE_LAYER, BLOOM_LAYER, BLOOM_PARAMS, OVERLAY_LAYER } from "/js/threejs/config/renderConfig.js";

import { getFetch } from '/js/global.js';

// // Rendering
 import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/addons/postprocessing/UnrealBloomPass.js';
import { Lensflare, LensflareElement } from 'three/addons/objects/Lensflare.js';
import { ShaderPass } from 'three/addons/postprocessing/ShaderPass.js';
import { Galaxy } from '/js/threejs/objects/galaxy.js';
import { Star } from '/js/threejs/objects/star.js';
import {FlyControls} from 'three/addons/controls/FlyControls.js';


let BackDescription = document.querySelector(".BackDescription")
let btnListe = document.querySelector(".btnListe")
let baseComposer, bloomComposer, overlayComposer
let scene1, scene2,camera2, camera1
let coruscant,Earth,Naboo,mercury;
let planeteDetail = document.querySelector(".planeteDetail")
let listeTO = document.querySelector(".listeTO")
let listeTOs = document.querySelector(".listeTOs")
let getTo = document.querySelector(".getTO")
let trigger = false
let camera, scene, renderer, controls, stats, flyControls;
let id_an;
let mesh;
let sun;
let btnClick = false;
let btnChoicePlanet;
let trigger2 = false
let backToMiddle = document.querySelector(".Back")
let divPrincipal = document.querySelector(".divPrincipal")
let nameTitre = document.querySelector(".namePlanet")
const arrayPlanet = []
const amount = parseInt(window.location.search.slice(1)) || 10;
const count = Math.pow(amount, 3);
const canvas = document.querySelector("#canvas")
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2(1, 1);
let ind = 0.1;
let test = 0.02;
let cliclPlanet = 0

// const mercury = planete(3, "/js/threejs/resources/Gaseous1.png", 10,0)
// const geometry = new THREE.TorusGeometry( 10, 0.1, 10, 100 ); 

// arrayPlanet.push(mercury)

// const mars = planete(4, "/js/threejs/resources/Volcanic.png", 50,10)
// arrayPlanet.push(mars)

// const earth = planete(5, "/js/threejs/resources/2k_venus_atmosphere.jpg", 80,70)
// arrayPlanet.push(earth)

// const coruscant = planete(3, "/js/threejs/resources/2k_neptune.jpg", 110,5)
// arrayPlanet.push(coruscant)

let speedPlanet2 = 0.004
let angleCamRotate= 0;
let vectorCible = new THREE.Vector3()
let objectCible;
let speedPlanet = 0.001
  const loader = new THREE.CubeTextureLoader();
  loader.setPath( '/js/threejs/resources/' );

  const textureCube = loader.load([
    'testtt.png', 'testtt.png',
    'testtt.png', 'testtt.png',
    'testtt.png', 'testtt.png'
  ]);

 
btnListe.innerHTML += `
  <button class="btnPlanet btn btn-space-secondary" value="Naboo">Naboo</button>
  <button class="btnPlanet btn btn-space-secondary" value="Earth">Earth</button>

`
let listeBtnPlanet = document.querySelectorAll(".btnPlanet")

    listeBtnPlanet.forEach(element => {
    element.addEventListener("click", function(e){
        btnChoicePlanet = e.target.value
        arrayPlanet.forEach(element => {
            if(element.mesh.name === btnChoicePlanet){
                btnChoicePlanet = element
                btnClick = true
                zoom()
            }
        });
    })
});





init();
animate();


const textureLoader = new THREE.TextureLoader();

const textureFlare0 = textureLoader.load( '/js/threejs/resources/lensflare0.png' );
const textureFlare3 = textureLoader.load( '/js/threejs/resources//lensflare3.png' );

addLight( 0.55, 0.9, 0.5, 5000, 0, - 1000 );
addLight( 0.08, 0.8, 0.5, 0, 0, - 1000 );
addLight( 0.995, 0.5, 0.9, 5000, 5000, - 1000 );

function addLight( h, s, l, x, y, z ) {

    const light = new THREE.PointLight( 0xFCE570, 15, 100, 0 );
    light.color.setHSL( h, s, l );
    light.position.set( 0, 0, 0 );
    scene.add( light );

    const lensflare = new Lensflare();
    lensflare.addElement( new LensflareElement( textureFlare0, 100, 0, light.color ) );
    lensflare.addElement( new LensflareElement( textureFlare3, 60, 0.6 ) );
    lensflare.addElement( new LensflareElement( textureFlare3, 70, 0.7 ) );
    lensflare.addElement( new LensflareElement( textureFlare3, 120, 0.9 ) );
    lensflare.addElement( new LensflareElement( textureFlare3, 70, 1 ) );
    light.add( lensflare );

}

function init() {
    scene = new THREE.Scene();
    scene1 = new THREE.Scene();
    scene2 = new THREE.Scene();
    scene = scene2
    scene2.background = new THREE.Color(0x121619)
    scene2.background = textureCube;

    // camera scene 2
    camera2 = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera2.lookAt(0, 0, 1);
    camera2.position.x = 30
    camera2.position.y = 100
    camera2.position.z = 170
    camera2.rotateOnAxis(10)
    camera = camera2
    trigger = false

    // camera scene 1
    camera1 = new THREE.PerspectiveCamera( 60, window.innerWidth / window.innerHeight, 0.1, 5000000 );
    camera1.position.set(0, 500, 500);
    camera1.up.set(0, 0, 1);
    camera1.lookAt(0, 0, 0);


    //
    mercury = planete(3, "/js/threejs/resources/Gaseous1.png", 10,0)
    arrayPlanet.push(mercury)
    Earth = planete(4, "/js/threejs/resources/Volcanic.png", 50,0)
    arrayPlanet.push(Earth)
    Naboo = planete(5, "/js/threejs/resources/2k_venus_atmosphere.jpg", 90,0)
    arrayPlanet.push(Naboo)
    coruscant = planete(3, "/js/threejs/resources/2k_neptune.jpg", 130,0)
    arrayPlanet.push(coruscant)
    
    const color = new THREE.Color("#FDB813");
    const geometry = new THREE.IcosahedronGeometry(1, 15);
    const material = new THREE.MeshLambertMaterial({ color: color });
    sun = new THREE.Mesh(geometry, material);
    sun.position.set(0, 0, 0);
    //scene.add(sun);

    //lumiere
    const ambientlight = new THREE.AmbientLight(0xffffff, 0.1);
    scene2.add(ambientlight);

    // rendu fenetre
    renderer = new THREE.WebGLRenderer({
        antialias: true,
        canvas,
        logarithmicDepthBuffer: true,
        alpha: true
    })
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(window.innerWidth, window.innerHeight);

    // ORBIT control
    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = false;
    controls.enableZoom = false;
    controls.enablePan = false;
    controls.enableRotate = false;

    window.addEventListener('resize', onWindowResize);
    document.addEventListener('click', onMouseMove);

}


function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize(window.innerWidth, window.innerHeight);

}

// track coord mouse

function onMouseMove(event) {

    event.preventDefault();

    let rect = renderer.domElement.getBoundingClientRect();
    mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
    mouse.y = - ((event.clientY - rect.top) / rect.height) * 2 + 1;

}

// function animater et actualisation

function animate() {
if(trigger && cliclPlanet === 0){
    cancelAnimationFrame(id_an);
    camRotate(angleCamRotate,vectorCible,objectCible)
    console.log(trigger)
}else{
    coruscant.obj.rotateY(0.003)
    Naboo.obj.rotateY(speedPlanet)
    Earth.obj.rotateY(speedPlanet2)
    mercury.obj.rotateY(0.004)
}
coruscant.mesh.rotateY(0.005)
    Naboo.mesh.rotateY(0.005)
    Earth.mesh.rotateY(0.005)
    mercury.mesh.rotateY(0.005)
id_an = requestAnimationFrame(animate); 

camera.zoom = 100


    render();


}

mercury.mesh.name = "mercury"
Naboo.mesh.name = "Naboo"
coruscant.mesh.name = "coruscant"
Earth.mesh.name = "Earth"
// event listener click sur planete
console.log(Earth)
canvas.addEventListener("click", function (e) {

        zoom()

})



requestAnimationFrame(animate)




function render() {

    renderer.render(scene, camera);

}




window.addEventListener('resize', function () {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

// creation planete

function planete(size, texture, positionx,positiony) {
    const geo = new THREE.SphereGeometry(size, 30, 30);
    const map = new THREE.TextureLoader().load(texture)
    //const material = new THREE.PointsMaterial( { color: 0x888888 } );
    const material = new THREE.MeshBasicMaterial({ map: map, });
    const mesh = new THREE.Mesh(geo, material);
    const obj = new THREE.Object3D();
    obj.add(mesh);
    scene2.add(obj);
    mesh.position.x = positionx;
    mesh.position.z = positiony;

    return { mesh, obj }
}
const axesHelper = new THREE.AxesHelper( 5 );
scene2.add( axesHelper );




function zoom(){
    
    raycaster.setFromCamera(mouse, camera);
 

    arrayPlanet.forEach(el => {
        el.obj.rotateY(0)
        const intersection = raycaster.intersectObject(el.obj);
        
        if (intersection.length > 0 || btnClick === true) {
            trigger = true
          
            if(btnClick){
                
                btnChoicePlanet.mesh.getWorldPosition(vectorCible)
                console.log(vectorCible)
                objectCible = btnChoicePlanet.mesh
                nameTitre.innerHTML = btnChoicePlanet.mesh.name
            }else{
                intersection[0].object.getWorldPosition(vectorCible)
                objectCible = intersection[0].object
                nameTitre.innerHTML = intersection[0].object.name
            }
            
        }  
           
            const imgPlanet = document.querySelector(".imgPlanet")
            const descriptionPlanet = document.querySelector(".descriptionPlanet")
            listeTOs.innerHTML =""
          getData().then((res)=>{
            console.log(res)
                res.forEach(element => {
                    if (intersection.length > 0 && element.name === intersection[0].object.name) {
                        descriptionPlanet.innerHTML = element.description
                        imgPlanet.src = "/images/planets/" + element.image
                        listeTOs.innerHTML += `
                    
                        <a class="link-underline link-underline-opacity-0 d-flex flex-row my-1 card bg-secondary justify-content-center justify-content-between align-items-center ps-3" href="${element.link}" style="width:40vh; height:10vh">
                            <img src="/images/logos/${element.logo_to}" alt="" style="height:40px; width:40px;" class="">
                            <div class="nameTO">${element.name_to}</div>
                            <div class="prixTO">${element.price}$</div>
                            <div class="likeUsers"></div>
                        </a>
                    
                        `
                    }else
                    if(element.name === btnChoicePlanet.mesh.name  && btnClick === true){
                        descriptionPlanet.innerHTML = element.description
                        imgPlanet.src = "/images/planets/" + element.image
                        listeTOs.innerHTML += `
                    
                        <a class="link-underline link-underline-opacity-0 d-flex flex-row my-1 card bg-secondary justify-content-center justify-content-between align-items-center ps-3" href="${element.link}" style="width:40vh; height:10vh">
                            <img src="/images/logos/${element.logo_to}" alt="" style="height:40px; width:40px;" class="">
                            <div class="nameTO">${element.name_to}</div>
                            <div class="prixTO">${element.price}</div>
                            <div class="likeUsers"></div>
                        </a>
                    
                        `
                        
                    }
                });

              })
               
           
             
            
            
            
            const camVector = new THREE.Vector3(30,0,170);
            angleCamRotate = camVector.angleTo(vectorCible)
            console.log(objectCible)
            
            
           return angleCamRotate, vectorCible, objectCible
        
    });

}





function camRotate(angleCamRotate, vectorCible, obj){
    if(obj.name === "Naboo"){
        speedPlanet = 0
    }else{
        speedPlanet2 = 0
    }
    if(obj && cliclPlanet === 0){
        arrayPlanet.forEach(element => {
        
            if(obj.name === element.mesh.name){
              camera.position.y = 0
      if(vectorCible.x > 0){
          
         if(ind < angleCamRotate +0.15){
          camera.position.applyQuaternion( new THREE.Quaternion().setFromAxisAngle(
          new THREE.Vector3( 0, 1, 0 ), 
          0.02 ));
          camera.lookAt( scene2.position );
          ind += test
          
      }else{
          const camVector = camera.position;
          let distanceCible = camVector.distanceTo(vectorCible)
          
          if(distanceCible > 18 && trigger === true){
              camera.translateZ(-1 );
              distanceCible-= 10
          }else{
            cliclPlanet = 1
            divPrincipal.style.display = "flex"
          }
          
          
          
      }
      }else{
          
          if(ind < angleCamRotate){
              camera.position.applyQuaternion( new THREE.Quaternion().setFromAxisAngle(
              new THREE.Vector3( 0, 1, 0 ), 
              -0.02 ));
              camera.lookAt( scene2.position );
              ind += test
              
          }else{
              const camVector = camera.position;
              let distanceCible = camVector.distanceTo(vectorCible)
             
              if(distanceCible > 17 && trigger === true ){
                  camera.translateZ(-1 );
                  distanceCible-= 10
              }else{
                cliclPlanet = 1
            divPrincipal.style.display = "flex"
              }
          }
      }
      
            }
          
      });
      
    }
    
}




backToMiddle.addEventListener("click", function(e){
    trigger = false
    divPrincipal.setAttribute('style', 'display:none !important');
    speedPlanet = 0.001
    speedPlanet2 = 0.004
    ind = 0.1
    angleCamRotate = 0
    controls.reset()
    cliclPlanet = 0
    console.log(camera)
})

async function getData(){
    const tableauPlanet = await getFetch("getDestinations")
return tableauPlanet
}

getTo.addEventListener("click", function(e){
    planeteDetail.setAttribute('style', 'display:none !important');
    listeTO.setAttribute('style', 'display:flex !important');

})
BackDescription.addEventListener("click", function(e){
    planeteDetail.setAttribute('style', 'display:flex !important');
    listeTO.setAttribute('style', 'display:none !important');
})
