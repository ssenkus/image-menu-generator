<?php
require_once 'menu.class.php';
$menu = new MenuGenerator();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image-based menu generator</title>
        <link rel="stylesheet" href="css/style.css" />
        <?php $menu->generateCSS(); ?>
        <?php $menu->generateJS(); ?>        
    </head>

    <body>
        <?php $menu->createMenu(); ?>
        <?php $menu->generateImagePreload(); ?>
    </body>
</html>
