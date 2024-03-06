<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>

        <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.150.0/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.150.0/examples/jsm/"
            }
        }
        </script>
</head>

<body>
<button class="test ">test</button>
<button class="back position-absolute">Retour</button>
<canvas id="canvas" data-engine="three.js r146">

</canvas> 
<script src="/js/index.js" type="module"></script>
</body>
</html>