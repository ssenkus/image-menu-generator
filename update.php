<?php
require_once 'menu.class.php';
$menu = new MenuGenerator(array(
    'genre' => 'abstract',
    'menu_params' => array(
        "width_main_img" => 400, // Width of the featured image, in px
        "height_main_img" => 400, // Height of the featured image, in px 
        "width_menubar" => 300, // Width of menu bars, in px
        "num_menubars" => 8, // NOTE: Limit of 10 items from lorempixel.com placeholder image service
        )));
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
