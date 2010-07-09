<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Flickrwijit Hook - Load All Events
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */

class flickrwijit {

	/**
	 * Registers the main event add method
	 */
	public function __construct()
	{
		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}

	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
		// Add a Sub-Nav Link
		Event::add('ushahidi_action.nav_admin_settings', array($this, '_settings_link'));	
		// Only add the events if we are on the main controller
		if (Router::$controller == 'main')
		{
			switch (Router::$method)
			{
				// Hook into the Report Add/Edit Form in Admin
				case 'edit':
					// Hook into the form itself
					Event::add('ushahidi_action.report_form_admin', array($this, '_report_form'));
					// Hook into the report_submit_admin (post_POST) event right before saving
					Event::add('ushahidi_action.report_submit_admin', array($this, '_report_validate'));
					// Hook into the report_edit (post_SAVE) event
					Event::add('ushahidi_action.setting_form_admin', array($this, '_report_form_submit'));
					break;

				// Hook into the Report view (front end)
				case 'index':
					Event::add('ushahidi_action.main_sidebar', array($this, '_display_flickrwiji'));
					break;
			}
		}
		elseif (Router::$controller == 'settings')
		{
			// Add Flickrwijit to settings page
			switch(Router::$method) 
			{
				case 'site':
					//Hook into settings/site form
					Event::add('ushahidi_action.settings_site_form_admin', array($this, '_site_form'));
					
					//Hook into settings retreival
					Event::add('ushahidi_action.settings_site_retreive', array($this, '_site_setting_view')); 
					
					// Hook into the settings/site (post_SAVE) event
					Event::add('ushahidi_action.settings_site_form_submit', array($this, '_site_form_submit'));
					break;					
			}
		}
	}
	
	public function _settings_link() 
	{
		$this_sub_page = Event::$data;
		
		echo ($this_sub_page == "flickrwijit") ? Kohana::lang('flickrwijit.flickrwijit_link') : 
			"<a href=\"".url::site()."admin/flickrwijit\">".Kohana::lang('flickrwijit.flickrwijit_link')."</a>";	
	}
	
	public function _display_flickrwiji() {
		//fetch flickrwijit settings from db
		$flickrwijit_settings = ORM::factory('flickrwijit',1);
		
		$flickrwijit_view = View::factory('flickrwijit_view');
		
		$flickrwijit_view->images = "http://lh4.ggpht.com/_SnaF3sehqPA/TDXZ1kusM8I/AAAAAAAAFJA/OJzyn75v-GI/s144/2010-07-04%2012.56.19.jpg";
		$flickrwijit_view->image_width = $flickrwijit_settings->image_width;
		$flickrwijit_view->image_height = $flickrwijit_settings->image_height;
		$flickrwijit_view->block_position = $flickrwijit_settings->block_position;
		$flickrwijit_view->block_width = $flickrwijit_settings->block_width;
		$flickrwijit_view->block_height = $flickrwijit_settings->block_height;
		$flickrwijit_view->num_of_photos = $flickrwijit_settings->num_of_photos;
		$flickrwijit_view->render(TRUE);
	
	}

}

new flickrwijit;
