<?php defined('SYSPATH') or die('No direct script access.');
require_once('phpflickr/phpFlickr.php');

class Flickrwijit_PhpFlickr 
{
	public $php_flickr;
	
	public function __construct($api_key) {
		$php_flickr = new phpFlickr($api_key);
	}
}