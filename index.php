<?php
/* Menu Generator - with dummy pictures! */

// Set the size of the main image and the number of linkable menu bars you want
$menu_params = array(
  "width_main_img" 	=> 600,				// Width of the featured image, in px
	"height_main_img"   => 344,				// Height of the featured image, in px 
	"width_menubar" 	=> 100,				// Width of menu bars, in px
	"num_menubars" 		=> 10,				// NOTE: Limit of 10 items from lorempixel.com placeholder image service
);

// Choose the picture genre for your menu...
$genre_choices = array(
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

// ... and put the array index here!
$menu_params["img_genre"] = $genre_choices[10];

// Calculates the height of each menu bar
$menu_params["height_menubar"] = ceil($menu_params["height_main_img"] / $menu_params["num_menubars"]);

// Output the HTML for the menu and image
function createMenu($menu_params) {

	echo '<div id="menu-bar">';
	echo '<ul>';
	
	
	// An array of links can be used here to link to specific pages
	for($i = 1; $i <= $menu_params["num_menubars"]; $i++) {
		$img_src = 'http://lorempixel.com/g/' . $menu_params["width_menubar"] . '/' . $menu_params["height_menubar"] . '/' . $menu_params["img_genre"] . '/' . $i . '/' . $i;
		createMenuBar( '#', $img_src, $i );
	}
	
	echo '</ul>';
	echo '</div>';
	
}	


// Insert list item image with link
function createMenuBar($link, $img_src, $i=0) {
	echo '<li><a href="' . $link . '"><img src="' . $img_src . '" class="menu" id="js_menu0' . $i
		 . '" onMouseOver="changeimage(' . $i . ', ' . $i . ');" onMouseOut="changeimageback(0, ' . $i. ')" /></a></li>';
}					

// preloads images for faster response
function generateImagePreload($menu_params) {

	$height_main_img 	= $menu_params["height_main_img"];
	$width_main_img 	= $menu_params["width_main_img"];
	$height_menubar 	= $menu_params["height_menubar"];
	$width_menubar 		= $menu_params["width_menubar"];
	$num_of_menubars	= $menu_params["num_menubars"];
	$img_genre 			= $menu_params["img_genre"];

	$imgs = array();
	for ($i = 1; $i <= $num_of_menubars; $i++) {
		$imgs[] = 'http://lorempixel.com/g/' . $width_menubar . '/' . $height_menubar . '/' . $img_genre . '/' . $i . '/' . $i; 		// grey menu bar image
		$imgs[] = 'http://lorempixel.com/' . $width_menubar . '/' . $height_menubar . '/' . $img_genre . '/' . $i . '/' . $i; 			// colored menu bar image
		$imgs[] = 'http://lorempixel.com/' . $width_main_img . '/' . $height_main_img . '/' . $img_genre . '/' . $i . '/Image' . $i; 	// colored main image
	}

	// Hides the images from view.  Useful for debugging.
	echo '<div id="hidden">';
		foreach($imgs as $img) {
			echo '<img src="' . $img . '" /><br />';
		}
	echo '</div>';
}

// NEEDS IMPROVEMENT
// Outputs the CSS dimensions for the menu
function generateCSS($menu_params) {

	$height_main_img 	= $menu_params["height_main_img"];
	$width_main_img 	= $menu_params["width_main_img"];
	$height_menubar 	= $menu_params["height_menubar"];
	$width_menubar 		= $menu_params["width_menubar"];
	$num_of_menubars	= $menu_params["num_menubars"];

	$total_height = $height_main_img;
	$total_width = $width_main_img + $width_menubar;
	echo '<style>';
	echo '#wrapper {';
	echo 'width: ' . $total_width . 'px;';
	echo 'height: ' . $total_height . 'px;';
	echo 'margin: ' . ((760-$total_height)/4) . 'px auto 0 auto;';
	echo '}';
 
	echo '.home-menu {';
	echo 'background-image: URL(\'http://placebox.es/' . $width_main_img . '/' . $height_main_img . '/e4754f/ffffff/Default Image,25/\');';
	echo 'width: ' . $width_main_img . 'px;';
	echo 'height: ' . $height_main_img . 'px;';
	echo '}';

	echo 'li {';
	echo 'height: ' . $height_menubar . 'px;';
	echo '}';

	echo '.menu {';
	echo 'width: ' . $width_menubar . 'px;';

	echo '</style>';
}



?>
<!DOCTYPE html>
<html>
<!--
				WHAT NEEDS TO BE DONE:
				
				This will be uploaded to GitHub to use for portfolio work with Javascript & PHP
				Abstract the code so that placekitten, placebox, and other placeholder image services can be used
				Allow option to put CSS, Javascript into PHP generated files
				Allow option to save images locally, zipped!
				Eventually offer jQuery version with effects!
				
				FUTURE PLANS:
				Convert PHP code to Ruby, Python
				
-->
	<head>
		<title>Image-based menu generator</title>
		<link rel="stylesheet" href="css/style.css" />
		<?php generateCSS($menu_params); ?>

		<!-- Convert PHP variable values to javascript to abstract the code -->
		<script type="text/javascript"> 
		var mainBackgroundImageURL = "<?php echo "http://lorempixel.com/" . $menu_params["width_main_img"] . "/" . $menu_params["height_main_img"] . "/" . $menu_params["img_genre"] . "/\" + " . "mainMenuImageNumber + " . "\"/Image\" + mainMenuImageNumber;"; ?>
		</script>

		<script type="text/javascript">
			
			function changeimage(mainMenuImageNumber, mainMenuMenuBarNumber) {
				var mainMenuImageId="home-menu";
				var mainMenuMenuBarId = "js_menu0" + mainMenuMenuBarNumber;
				document.getElementById(mainMenuImageId).style.backgroundImage = "URL('http://lorempixel.com/<?php echo $menu_params["width_main_img"]; ?>/<?php echo $menu_params["height_main_img"]; ?>/<?php echo $menu_params["img_genre"]; ?>/" + mainMenuImageNumber + "/Image" + mainMenuImageNumber + "')";
				document.getElementById(mainMenuMenuBarId).src = "http://lorempixel.com/<?php echo $menu_params["width_menubar"]; ?>/<?php echo $menu_params["height_menubar"]; ?>/<?php echo $menu_params["img_genre"]; ?>/" + mainMenuMenuBarNumber+ "/" + mainMenuMenuBarNumber;
			}

			function changeimageback(mainMenuImageNumber, mainMenuMenuBarNumber) {
				var mainMenuImageId="home-menu";
				var mainMenuMenuBarId = "js_menu0" + mainMenuMenuBarNumber;
				document.getElementById(mainMenuImageId).style.backgroundImage = "URL('http://placebox.es/<?php echo $menu_params["width_main_img"]; ?>/<?php echo $menu_params["height_main_img"]; ?>/e4754f/ffffff/Default Image,25/')";
				document.getElementById(mainMenuMenuBarId).src = "http://lorempixel.com/g/<?php echo $menu_params["width_menubar"]; ?>/<?php echo $menu_params["height_menubar"]; ?>/<?php echo $menu_params["img_genre"]; ?>/" + mainMenuMenuBarNumber+ "/" + mainMenuMenuBarNumber;
			}
		
		</script>
		
	</head>

	<body>
		<div id="wrapper">
		
		<!-- Swap createMenu() and div#home-menu to move menu to the left -->
		<?php createMenu($menu_params); ?>
			<div id="home-menu" class="home-menu">
				<a href="#"></a>
			</div>
		</div>
	
		<?php generateImagePreload($menu_params); ?>
	</body>
</html>

