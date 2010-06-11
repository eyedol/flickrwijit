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
		$this->flickr_tags = "";
		$this->flickr_photoset = "";
		$this->block_position = "";
		$this->image_width = "";
		$this->image_height = "";
		$this->block_width = "";
		$this->block_height = "";

		// Hook into routing
		Event::add('system.pre_controller', array($this, 'add'));
	}

	/**
	 * Adds all the events to the main Ushahidi application
	 */
	public function add()
	{
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
					Event::add('ushahidi_action.report_edit', array($this, '_report_form_submit'));
					break;

				// Hook into the Report view (front end)
				case 'view':
					Event::add('ushahidi_action.project_display', array($this, '_report_view'));
					break;
			}
		}
		elseif (Router::$controller == 'settings')
		{
			// Add Flickrwijit to settings page
			
			Event::add('ushahidi_action.feed_rss_item', array($this, '_feed_rss'));
		}
	}

	/**
	 * Add Flickrwijit to settings form 
	 */
	public function _settings_form()
	{
		// Load the View
		$form = View::factory('flickrwijit_form');
		// Get the ID of the Incident (Report)
		$id = Event::$data;

		if ($id)
		{
			// Do We have an Existing Actionable Item for this Report?
			$action_item = ORM::factory('actionable')
				->where('incident_id', $id)
				->find();
			if ($action_item->loaded)
			{
				$this->actionable = $action_item->actionable;
				$this->action_taken = $action_item->action_taken;
				$this->action_summary = $action_item->action_summary;
			}
		}

		$form->flickr_tags = $this->flickr_tags;
		$form->flickr_position = $this->flickr_position;
		$form->image_width = $this->image_width;
		$form->image_height = $this->image_height;
		$form->block_position = $this->block_position;
		$form->block_width = $this->block_width;
		$form->block_height = $this->block_height;
		$form->render(TRUE);
	}

	/**
	 * Validate Form Submission
	 */
	public function _report_validate()
	{

	}

	/**
	 * Handle Form Submission and Save Data
	 */
	public function _settings_form_submit()
	{
		$incident = Event::$data['incident'];
		$post = Event::$data['post'];
		$id = Event::$data['id'];

		if ($post)
		{
			$flickrwijit = ORM::factory('flickrwijit')
				->where('flickrwijit_id', $id)
				->find();
			$action_item->incident_id = $incident->id;
			$action_item->actionable = isset($post['actionable']) ? 
				$post['actionable'] : "";
			$action_item->action_taken = isset($post['action_taken']) ?
				$post['action_taken'] : "";
			$action_item->action_summary = $post['action_summary'];
			$action_item->save();

		}
	}

	/**
	 * Render the Action Taken Information to the Report
	 * on the front end
	 */
	public function _main_view()
	{

	}

	
}

new flickrwijit;

