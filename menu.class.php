<?php

class MenuGenerator {

    public $menu_params = array();
    public $genres;
    public $menu_container;

    public function __construct() {


//$menu_params["height_menubar"] = ceil($menu_params["height_main_img"] / $menu_params["num_menubars"]);        
        $this->menu_params = array(
            "width_main_img" => 600, // Width of the featured image, in px
            "height_main_img" => 344, // Height of the featured image, in px 
            "width_menubar" => 100, // Width of menu bars, in px
            "num_menubars" => 10, // NOTE: Limit of 10 items from lorempixel.com placeholder image service
        );
        $this->menu_params["height_menubar"] = ceil($this->menu_params["height_main_img"] / $this->menu_params["num_menubars"]);

        $this->genres = array(
            "abstract",
            "animals",
            "city",
            "food",
            "nightlife",
            "fashion",
            "people",
            "nature",
            "sports",
            "technics",
            "transport"
        );
        $this->menu_params["img_genre"] = $this->genres[10];
        $this->createMenu();
        $this->generateImagePreload();
    }

    // Output the HTML for the menu and image
    public function createMenu() {

        $width = $this->menu_params['width_menubar'];
        $height = $this->menu_params["height_menubar"];
        $genre = $this->menu_params["img_genre"];
        $num_menubars = $this->menu_params["num_menubars"];

        $list = '';
        for ($i = 1; $i <= $num_menubars; $i++) {
            $img_src = "http://lorempixel.com/g/$width/$height/$genre/$i/$i";
            $list .= $this->createMenuBar('#', $img_src, $i);
        }


        echo <<<MENU
<div> 
    <ul>
$list    
    </ul>
</div>
MENU;
    }

// Insert list item image with link
    public function createMenuBar($link, $img_src, $i = 0) {
        $list = <<<LIS
        <li>
            <a href="$link">
                <img src="$img_src" class="menu" id="js_menu0$i" onMouseOver="changeimage($i,$i)" onMouseOut="changeimageback(0,$i)" />
            </a>
        </li>
LIS;
        return $list;
    }

// preloads images for faster response
    public function generateImagePreload() {
        $menu_params = $this->menu_params;
        $height_main_img = $menu_params["height_main_img"];
        $width_main_img = $menu_params["width_main_img"];
        $height_menubar = $menu_params["height_menubar"];
        $width_menubar = $menu_params["width_menubar"];
        $num_of_menubars = $menu_params["num_menubars"];
        $img_genre = $menu_params["img_genre"];

        $out = '';
        for ($i = 1; $i <= $num_of_menubars; $i++) {
            $out .= <<<IMG
                    
    <img src="http://lorempixel.com/g/$width_menubar/$height_menubar/$img_genre/$i/$i" />
    <img src="http://lorempixel.com/$width_menubar/$height_menubar/$img_genre/$i/$i" />
    <img src="http://lorempixel.com/$width_main_img/$height_main_img/$img_genre/$i/Image$i" />
                    
IMG;
        }

        echo <<<HIDDEN
        
<div id="hidden">
$out        
</div>
HIDDEN;
    }

// Outputs the CSS dimensions for the menu
    public function generateCSS() {
        $menu_params = $this->menu_params;
        $height_main_img = $menu_params["height_main_img"];
        $width_main_img = $menu_params["width_main_img"];
        $height_menubar = $menu_params["height_menubar"];
        $width_menubar = $menu_params["width_menubar"];
        $num_of_menubars = $menu_params["num_menubars"];

        $total_height = $height_main_img;
        $total_width = $width_main_img + $width_menubar;
        echo <<<STYLES
<style>
    #wrapper {
        width: {$total_width}px';
        height: {$total_height}px;
        margin: ' . ((760 - $total_height) / 4) . 'px auto 0 auto;';
    }

    .home-menu {
        background-image: URL(\'http://placebox.es/' . $width_main_img . '/' . $height_main_img . '/e4754f/ffffff/Default Image,25/\');';
        width: ' . $width_main_img . 'px;';
        height: ' . $height_main_img . 'px;';
    }

    li {
        height: {$height_menubar}px;
    }

    .menu {
        width: {$width_menubar}px;
    }
</style>
STYLES;
        
    }

}

$menu = new MenuGenerator();
?>