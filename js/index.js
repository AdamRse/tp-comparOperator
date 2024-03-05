import * as THREE from 'three'
import { getFirstObjectWithName } from '/js/threejs/RayCastHelper.js';
// Data and visualization
import { CompositionShader} from '/js/threejs/shaders/CompositionShader.js'
import { BASE_LAYER, BLOOM_LAYER, BLOOM_PARAMS, OVERLAY_LAYER } from "/js/threejs/config/renderConfig.js";

// Rendering
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'three/addons/postprocessing/UnrealBloomPass.js';

import { ShaderPass } from 'three/addons/postprocessing/ShaderPass.js';
import { Galaxy } from '/js/threejs/objects/galaxy.js';
import { Star } from '/js/threejs/objects/star.js';






let camera, scene, renderer, controls, stats;

let mesh;
let sun;
const amount = parseInt( window.location.search.slice( 1 ) ) || 10;
const count = Math.pow( amount, 3 );
const canvas = document.querySelector("#canvas")
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2( 1, 1 );

const color = new THREE.Color();
const white = new THREE.Color().setHex( 0xffffff );
scene = new THREE.Scene();
scene.background = new THREE.Color()
const mercury = planete(1, "/js/threejs/resources/Gaseous1.png", 10)
const mars = planete(2, "/js/threejs/resources/Gaseous1.png", 30)
const earth = planete(1, "/js/threejs/resources/Gaseous1.png", 50)
const coruscant = planete(3, "/js/threejs/resources/Gaseous1.png", 60)


init();
animate();
function resizeRendererToDisplaySize(renderer) {
    const canvas = renderer.domElement;
    const width = canvas.clientWidth;
    const height = canvas.clientHeight;
    const needResize = canvas.width !== width || canvas.height !== height;
    if (needResize) {
    renderer.setSize(width, height, false);
    }
    return needResize;
}
function init() {

    camera = new THREE.PerspectiveCamera( 60, window.innerWidth / window.innerHeight, 0.1, 100 );
   
    camera.lookAt( 0, 0, 1 );
    camera.position.set(6, 8, 30);
    

    const light = new THREE.HemisphereLight( 0xffffff, 0x888888, 3 );
    light.position.set( 0, 1, 0 );
    scene.add( light );

    const geometry = new THREE.SphereGeometry( 1, 20, 16 ); 
    const material = new THREE.PointsMaterial( { color: 0x888888 } );

    sun = new THREE.InstancedMesh( geometry, material, count );

    scene.add( sun );
    

 
      
    
    //



    renderer = new THREE.WebGLRenderer({
        antialias: true,
        canvas,
        logarithmicDepthBuffer: true,
        alpha:true
    })
    renderer.setPixelRatio( window.devicePixelRatio );
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    controls = new OrbitControls( camera, renderer.domElement );
    controls.enableDamping = true;
    controls.enableZoom = true;
    controls.enablePan = false;

    
    

    window.addEventListener( 'resize', onWindowResize );
    document.addEventListener( 'click', onMouseMove );

}

let axes = new THREE.AxesHelper(5.0)
    scene.add(axes)

function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );

}

function onMouseMove( event ) {

    event.preventDefault();

    mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
    mouse.y = - ( event.clientY / window.innerHeight ) * 2 + 1;

}

function animate() {
  mercury.obj.rotateY(0.02)
  earth.obj.rotateY(0.01)
  mars.obj.rotateY(0.05)
  coruscant.obj.rotateY(0.03)
   

    controls.update();

    raycaster.setFromCamera( mouse, camera );

    const intersection = raycaster.intersectObject( mercury.obj );
    
    if ( intersection.length > 0 ) {

        const instanceId = intersection[ 0 ].instanceId;
        
        
      

    }

    render();


}
renderer.setAnimationLoop(animate)
function render() {
    
    renderer.render( scene, camera );

}
window.addEventListener('resize', function() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});



function planete(size, texture, position, ){
    const geo = new THREE.SphereGeometry(size, 30, 30);
    const map = new THREE.TextureLoader().load("/js/threejs/resources/Gaseous1.png")
    //const material = new THREE.PointsMaterial( { color: 0x888888 } );
    const material = new THREE.MeshBasicMaterial( {map:map, } ); 
    const mesh = new THREE.Mesh(geo, material);
    const obj = new THREE.Object3D();
    obj.add(mesh);
    scene.add(obj);
    mesh.position.x = position;
    return {mesh, obj}
}