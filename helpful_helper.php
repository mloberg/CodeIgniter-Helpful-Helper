<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Name: Helpful
 * URL: http://playground.teafueled.com/ci/helpers/helpful
 * Author: Matthew Loberg
 * Author URL: http://mloberg.com
 * Version: 0.3
 * Licence: Copyright (c) 2011 Matthew Loberg under the MIT Licence (licence.txt)
 * Understandable Licence: http://creativecommons.org/licenses/MIT/
 *
 * This is a CodeIgniter helper I created for myself.
 * There are some functions that already exist that do pretty much the same thing,
 * but I created this class for myself and to work with the development style of me.
 * If you are using this, I hope you find it useful.
 */

/**
 * These first functions are css function. There is already a similar function in the HTML helper,
 * but I know I store all of my css files in a folder called css, so I can eleminate that from the helper
 */

if(!function_exists('stylesheet_link_tag')){
	function stylesheet_link_tag($stylesheet,$path='css/'){
		return '<link rel="stylesheet" href="' . base_url() . $path . $stylesheet .'.css" />';
	}   
}

/**
 * I always include a css reset stylesheet, so it makes sense for me to include a helper for it.
 */

if(!function_exists('stylesheet_reset')){
	function stylesheet_reset($path='css/'){
		return '<link rel="stylesheet" href="' . base_url() . $path . 'reset.css" />';
	}
}

/**
 * I also find myself using the 960 grid system in a lot of my sites, so let's add a helper for this too.
 */

if(!function_exists('stylesheet_grid')){
	function stylesheet_grid($path='css/'){
		return '<link rel="stylesheet" href="' . base_url() . $path . '960.css" />';
	}
}

/**
 * I also find myself having to include multiple stylesheets (because of various jQuery plugins I'm using
 * so lets add all of them in one function
 */

if(!function_exists('stylesheet_link_multi')){
	function stylesheet_link_multi($stylesheets,$path='css/'){
		$css = '';
		if(is_array($stylesheets)){
			foreach($stylesheets as $stylesheet){
				$css .= "<link rel=\"stylesheet\" href=\"".base_url()."$path/$stylesheet.css\" />\n";
			}
		}
		// we return this outside of the if statement to fail silently, if it's not an array
		return $css;
	}
}

/**
 * And just to make life a little easier, let's make a function to add all stylesheets in the css dir
 */

if(!function_exists('stylesheet_link_all')){
	function stylesheet_link_all($path='css/'){
		// scan the dir for all the files
		$dir = './' . $path;
		$files = scandir($dir);
		//print_r($files);
		// set up the var to store the files in
		$css = '';
		foreach($files as $file){
			// then find out if they have the css extension
			if(preg_match('/^\S+\.(css)$/',$file)){
				// it's a css file, append to return string
				$css .= "<link rel=\"stylesheet\" href=\"" . base_url() . "$path/$file\" />\n";
			}
		}
		return $css;
	}
}

/**
 * Yes, there is already a function that adds an image tag, but I like to make my own.
 * I store all of my images in /img, so no need to pass where the images are, just the filename
 * This also automatically gets the image size, and requires an alt tag so you are valid.
 * I've also included an optional scale function that allows you to scale the image. It uses decimal (eg. .5 is 50%)
 */

if(!function_exists('image_tag')){
	function image_tag($img,$alt,$scale='',$path='img/'){
		// get the image size
		$img = base_url() . $path . $img;
		list($w,$h,$type,$attr) = getimagesize($img);
		// if scale is set, scale the image
		if($scale){
			$w = $w * $scale;
			$h = $h * $scale;
		}
		return '<img src="'.$img.'" alt="'.$alt.'" width="'.$w.'" height="'.$h.'" />';
	}
}

/**
 * Returns a <script> tag.
 * You can send a single file, an array, or ":all" (for all js)
 */

if(!function_exists('javascript_link_tag')){
	function javascript_link_tag($js,$path='js/'){
		$javascript_tags = '';
		if(is_array($js)){
			foreach($js as $j){
				$javascript_tags .= "<script src=\"".base_url()."$path$j.js\"></script>\n";
			}
		}elseif($js == ':all'){
			// scan the dir for all the files
			$dir = './' . $path;
			$files = scandir($dir);
			foreach($files as $file){
				// find out if they have the css extension
				if(preg_match('/^\S+\.(js)$/',$file)){
					// it's a javascript file, append to return string
					$javascript_tags .= "<script src=\"" . base_url() . "$path$file\"></script>\n";
				}
			}
		}else{
			$javascript_tags = "<script src=\"".base_url()."$path$js.js\"></script>";
		}
		return $javascript_tags;
	}
}

/**
 * This is a simple internal link function.
 */

if(!function_exists('href')){
	function href($l,$title,$other=''){
		$link = base_url() . $l;
		return "<a href=\"$link\" $other>$title</a>";
	}
}

/**
 * A simple external link function
 */

if(!function_exists('href_ext')){
	function href_ext($link,$title){
		return "<a href=\"$link\">$title</a>";
	}
}

/**
 * A Lorem Ipsum generator. You can generate sentences or paragraphs.
 */

if(!function_exists('LoremIpsum')){
	function LoremIpsum($type='',$num=''){
		$lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac lacus lectus. Duis ultrices bibendum tristique. Etiam vel est porta turpis hendrerit placerat at non mauris. Maecenas augue odio, dapibus eget auctor sit amet, rutrum nec nisl. Praesent tincidunt adipiscing auctor. Sed sollicitudin lobortis arcu, sit amet malesuada mi auctor varius. Duis eleifend pretium felis quis lobortis. Nam posuere arcu quis magna vestibulum nec pellentesque enim imperdiet. Aenean nunc augue, sodales varius molestie faucibus, tincidunt a odio. Curabitur cursus ante metus. Fusce tristique ante id magna rhoncus lobortis a sit amet risus.';
		if($type == 'sentence'){
			return 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.';
		}elseif($type == 'paragraphs'){
			$return = '';
			if($num == ''){
				$return .= "<p>$lorem</p>";
			}else{
				for($i=0;$i<$num;$i++){
					if($num == $i){
						$return .= $lorem;
					}else{
						$return .= $lorem.' <br />';
					}
				}
			}
			return $return;
		}else{
			// return just a sentence if the type was undifined
			return 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.';
		}
	}
}