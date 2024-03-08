import * as THREE from 'three'
import { getFirstObjectWithName } from '/js/threejs/RayCastHelper.js';
// Data and visualization
import { CompositionShader } from '/js/threejs/shaders/CompositionShader.js'
import { BASE_LAYER, BLOOM_LAYER, BLOOM_PARAMS, OVERLAY_LAYER } from "/js/threejs/config/renderConfig.js";


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

let canvas, renderer, camera, orbit, baseComposer, bloomComposer, overlayComposer

export let scene

const btn = document.querySelector(".btn")

// test click object var
const raycaster = new THREE.Raycaster()
const mouse = new THREE.Vector2()




function initThree() {

    // grab canvas
    canvas = document.querySelector('#canvas');

    // scene
    scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0xEBE2DB, 0.00003);

    // camera
    camera = new THREE.PerspectiveCamera( 60, window.innerWidth / window.innerHeight, 0.1, 5000000 );
    camera.position.set(0, 500, 500);
    camera.up.set(0, 0, 1);
    camera.lookAt(0, 0, 0);

    // map orbit
    orbit = new OrbitControls(camera, canvas)
    orbit.enableDamping = true; // an animation loop is required when either damping or auto-rotation are enabled
    orbit.dampingFactor = 0.05;
    orbit.screenSpacePanning = false;
    orbit.minDistance = 1;
    orbit.maxDistance = 16384;
    orbit.maxPolarAngle = (Math.PI / 2) - (Math.PI / 360)

    initRenderPipeline()

}

function initRenderPipeline() {

    // Assign Renderer
    renderer = new THREE.WebGLRenderer({
        antialias: true,
        canvas,
        logarithmicDepthBuffer: true,
    })
    renderer.setPixelRatio( window.devicePixelRatio )
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.outputEncoding = THREE.sRGBEncoding
    renderer.toneMapping = THREE.ACESFilmicToneMapping
    renderer.toneMappingExposure = 0.5

    // General-use rendering pass for chaining
    const renderScene = new RenderPass( scene, camera )

    // Rendering pass for bloom
    const bloomPass = new UnrealBloomPass( new THREE.Vector2( window.innerWidth, window.innerHeight ), 1.5, 0.4, 0.85 )
    bloomPass.threshold = BLOOM_PARAMS.bloomThreshold
    bloomPass.strength = BLOOM_PARAMS.bloomStrength
    bloomPass.radius = BLOOM_PARAMS.bloomRadius

    // bloom composer
    bloomComposer = new EffectComposer(renderer)
    bloomComposer.renderToScreen = false
    bloomComposer.addPass(renderScene)
    bloomComposer.addPass(bloomPass)

    // overlay composer
    overlayComposer = new EffectComposer(renderer)
    overlayComposer.renderToScreen = false
    overlayComposer.addPass(renderScene)

    // Shader pass to combine base layer, bloom, and overlay layers
    const finalPass = new ShaderPass(
        new THREE.ShaderMaterial( {
            uniforms: {
                baseTexture: { value: null },
                bloomTexture: { value: bloomComposer.renderTarget2.texture },
                overlayTexture: { value: overlayComposer.renderTarget2.texture }
            },
            vertexShader: CompositionShader.vertex,
            fragmentShader: CompositionShader.fragment,
            defines: {}
        } ), 'baseTexture'
    );
    finalPass.needsSwap = true;

    // base layer composer
    baseComposer = new EffectComposer( renderer )
    baseComposer.addPass( renderScene )
    baseComposer.addPass(finalPass)
}

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

async function render() {

    orbit.update()

    // fix buffer size
    if (resizeRendererToDisplaySize(renderer)) {
        const canvas = renderer.domElement;
        camera.aspect = canvas.clientWidth / canvas.clientHeight;
        camera.updateProjectionMatrix();
    }

    // fix aspect ratio
    const canvas = renderer.domElement;
    camera.aspect = canvas.clientWidth / canvas.clientHeight;
    camera.updateProjectionMatrix();

    galaxy.updateScale(camera)

    // Run each pass of the render pipeline
    renderPipeline()

    requestAnimationFrame(render)
    
}

function renderPipeline() {

    // Render bloom
    camera.layers.set(BLOOM_LAYER)
    bloomComposer.render()

    // Render overlays
    camera.layers.set(OVERLAY_LAYER)
    overlayComposer.render()

    // Render normal
    camera.layers.set(BASE_LAYER)
    baseComposer.render()

}

initThree()
let axes = new THREE.AxesHelper(5.0)
scene.add(axes)

let galaxy = new Galaxy(scene)

requestAnimationFrame(render)


const pointer = new THREE.Vector2();


const geometry = new THREE.SphereGeometry( 15, 32, 16 ); 
const map = new THREE.TextureLoader().load( 'resources/Gaseous1.png' );
const material = new THREE.MeshBasicMaterial( {map:map } ); 

const sphere = new THREE.Mesh( geometry, material );
sphere.name ="sphere"
 sphere.position.x = 150
 console.log(sphere)
scene.add( sphere );

window.addEventListener("click", function(e){
    pointer.x = ( e.clientX / window.innerWidth ) ;
	pointer.y = - ( e.clientY / window.innerHeight ) ;
    raycaster.setFromCamera( pointer, camera );
    const intersects = raycaster.intersectObjects( circle );

    console.log(intersects)
})
function planet(){
    const geometry = new THREE.SphereGeometry( 15, 32, 16 ); 
    const map = new THREE.TextureLoader().load( 'resources/Gaseous1.png' );
    const material = new THREE.MeshBasicMaterial( {map:map } ); 
    
    const sphere = new THREE.Mesh( geometry, material );
    sphere.name ="sphere"
     sphere.position.x = 150
     console.log(sphere)
    scene.add( sphere );

}


const geometry2 = new THREE.CircleGeometry( 50, 32 ); 
const material2 = new THREE.MeshBasicMaterial( { color: 0xFF5733, transparent:false,opacity:1,side:THREE.DoubleSide } ); 
const circle = new THREE.Mesh( geometry2, material2 ); scene.add( circle );
circle.position.z = 15
circle.position.x = 210
scene.add(circle)

console.log(galaxy)



