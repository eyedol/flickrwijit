<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This is the controller for the main site.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Main Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL)
 */
class Flickrwijit_Controller extends Main_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index() 
	{
		$this->template->content = new View('flickrwijit_front');
		//fetch flickrwijit settings from db
		$flickrwijit_settings = ORM::factory('flickrwijit',1);
		// include phpflickr library
		include Kohana::find_file('libraries/phpflickr','phpFlickr');
		
		$f = new phpFlickr(Kohana::config('flickrwijit.flick_api_key'));
		
		$photos = $f->photos_search( array(
			'tags' => $flickrwijit_settings->flickr_tag,
			'per_page' => $flickrwijit_settings->num_of_photos,
			'user_id' => $flickrwijit_settings->flickr_id ) );
		
		$this->template->content->image_width = $flickrwijit_settings->image_width;
		$this->template->content->image_height = $flickrwijit_settings->image_height;
		
		$this->template->content->block_position = $flickrwijit_settings->block_position;
		$this->template->content->block_width = $flickrwijit_settings->block_width;
		$this->template->content->block_height = $flickrwijit_settings->block_height;
		$this->template->content->num_of_photos = $flickrwijit_settings->num_of_photos;
		$this->template->content->f = $f;
		$this->template->content->photos = $photos;
		
	}
}
