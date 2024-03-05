<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ComparoSpace</title>
<link rel="stylesheet" href="/styles/style.css">
<?php

    if($page === "index"){ ?>
        <script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>

        <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.150.0/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.150.0/examples/jsm/"
            }
        }
        </script>
   <?php }

?>