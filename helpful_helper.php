<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Name: Helpful
 * URL: http://playground.teafueled.com/ci/helpers/helpful
 * Author: Matthew Loberg
 * Author URL: http://mloberg.com
 * Version: 0.1
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
	function stylesheet_link_tag($stylesheet){
		return '<link rel="stylesheet" href="' . base_url() . 'css/' . $stylesheet .'.css" />';
	}   
}

/**
 * I always include a css reset stylesheet, so it makes sense for me to include a helper for it.
 */

if(!function_exists('stylesheet_reset')){
	function stylesheet_reset(){
		return '<link rel="stylesheet" href="' . base_url() . 'css/reset.css" />';
	}
}

/**
 * I also find myself using the 960 grid system in a lot of my sites, so let's add a helper for this too.
 */

if(!function_exists('stylesheet_grid')){
	function stylesheet_grid(){
		return '<link rel="stylesheet" href="' . base_url() . 'css/960.css" />';
	}
}

/**
 * I also find myself having to include multiple stylesheets (because of various jQuery plugins I'm using
 * so lets add all of them in one function
 */

if(!function_exists('stylesheet_link_multi')){
	function stylesheet_link_multi($stylesheets){
		$css = '';
		if(is_array($stylesheets)){
			foreach($stylesheets as $stylesheet){
				$css .= "<link rel=\"stylesheet\" href=\"".base_url()."css/$stylesheet.css\" />\n";
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
	function stylesheet_link_all(){
		// scan the dir for all the files
		$dir = './css';
		$files = scandir($dir);
		//print_r($files);
		// set up the var to store the files in
		$css = '';
		foreach($files as $file){
			// then find out if they have the css extension
			if(preg_match('/^\S+\.(css)$/',$file)){
				// it's a css file, append to return string
				$css .= "<link rel=\"stylesheet\" href=\"" . base_url() . "css/$file\" />\n";
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
	function image_tag($img,$alt,$scale=''){
		// get the image size
		$img = base_url() . 'img/' . $img;
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
	function href_ext($link,$title,$other=''){
		return "<a href=\"$link\" $other>$title</a>";
	}
}