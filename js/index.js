import * as THREE from 'three'
import { getFirstObjectWithName } from '/js/threejs/RayCastHelper.js';
// Data and visualization
import { CompositionShader } from '/js/threejs/shaders/CompositionShader.js'
import { BASE_LAYER, BLOOM_LAYER, BLOOM_PARAMS, OVERLAY_LAYER } from "/js/threejs/config/renderConfig.js";

// Rendering
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/addons/postprocessing/UnrealBloomPass.js';
import { Lensflare, LensflareElement } from 'three/addons/objects/Lensflare.js';
import { ShaderPass } from 'three/addons/postprocessing/ShaderPass.js';
import { Galaxy } from '/js/threejs/objects/galaxy.js';
import { Star } from '/js/threejs/objects/star.js';


let trigger = false
let camera, scene, renderer, controls, stats;
let id_an;
let mesh;
let sun;
const arrayPlanet = []
const amount = parseInt(window.location.search.slice(1)) || 10;
const count = Math.pow(amount, 3);
const canvas = document.querySelector("#canvas")
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2(1, 1);


scene = new THREE.Scene();
scene.background = new THREE.Color(0x121619)
const mercury = planete(3, "/js/threejs/resources/Gaseous1.png", 10,0)
const geometry = new THREE.TorusGeometry( 10, 0.1, 10, 100 ); 

arrayPlanet.push(mercury)
const mars = planete(4, "/js/threejs/resources/Volcanic.png", 30,10)
arrayPlanet.push(mars)

const earth = planete(5, "/js/threejs/resources/2k_venus_atmosphere.jpg", 50,70)
arrayPlanet.push(earth)

const coruscant = planete(3, "/js/threejs/resources/2k_neptune.jpg", 60,5)
arrayPlanet.push(coruscant)


let camX = 30;
    let camY = 100;
    let camZ = 170;


  const loader = new THREE.CubeTextureLoader();
  loader.setPath( '/js/threejs/resources/' );

  const textureCube = loader.load([
    'testtt.png', 'testtt.png',
    'testtt.png', 'testtt.png',
    'testtt.png', 'testtt.png'
  ]);

  scene.background = textureCube;



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
    camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.lookAt(0, 0, 1);
    camera.position.set(30, 100, 170);
    camera.rotateOnAxis(10)
    

    
    const color = new THREE.Color("#FDB813");
    const geometry = new THREE.IcosahedronGeometry(1, 15);
    const material = new THREE.MeshLambertMaterial({ color: color });
    sun = new THREE.Mesh(geometry, material);
    sun.position.set(0, 0, 0);
    //scene.add(sun);

    //lumiere
    const ambientlight = new THREE.AmbientLight(0xffffff, 0.1);
    scene.add(ambientlight);

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
    controls.enableDamping = true;
    controls.enableZoom = true;
    controls.enablePan = false;
    controls.enableRotate = true;




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
if(trigger){
    cancelAnimationFrame(id_an);
    console.log("ok")
}else{
    coruscant.obj.rotateY(0.003)
    earth.obj.rotateY(0.001)
    mars.obj.rotateY(0.004)
    mercury.obj.rotateY(0.002)
}
coruscant.mesh.rotateY(0.005)
    earth.mesh.rotateY(0.005)
    mars.mesh.rotateY(0.005)
id_an = requestAnimationFrame(animate); 
    
  
    controls.update();


    render();


}

mercury.mesh.name = "mercury"
earth.mesh.name = "earth"
coruscant.mesh.name = "coruscant"

// event listener click sur planete

window.addEventListener("click", function (e) {

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
    scene.add(obj);
    mesh.position.x = positionx;
    mesh.position.z = positiony;

    return { mesh, obj }
}
const axesHelper = new THREE.AxesHelper( 5 );
scene.add( axesHelper );
function zoom(){
    raycaster.setFromCamera(mouse, camera);
 

    arrayPlanet.forEach(el => {
        el.obj.rotateY(0)
        const intersection = raycaster.intersectObject(el.obj);
        if (intersection.length > 0) {

            const instanceId = intersection[0].instanceId;
            const vec = new THREE.Vector3()
            intersection[0].object.getWorldPosition(vec)
            

           
            camera.position.y = 0
         
            
            console.log(angle(camera,vec))
            console.log(vec)


        }
    });

}



let testtt = document.querySelector(".test")
testtt.addEventListener("click", function(e){
    if(trigger){
        trigger=false
    }else{
         trigger = true
    }
   
})

function angle(camera,obj) {
    const v1 = new THREE.Vector3(30,0,170);
    const v2 = new THREE.Vector3(obj.x,0,obj.y);
    const angle = v1.angleTo(v2)*180/Math.PI;
    return angle
  }