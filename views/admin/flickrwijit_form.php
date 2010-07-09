<?php 
/**
 * Clean URLs view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     API Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>
<div class="bg">
	<h2>
		<?php admin::settings_subtabs("flickrwijit"); ?>
	</h2>
	<?php print form::open(NULL, array('id' => 'flickrwijitForm', 'name' => 'flickrwijitForm','action'=> url::site().'admin/flickrwijit')); ?>
	<div class="report-form">
	<?php
	if ($form_error) {
	?>
		<!-- red-box -->
		<div class="red-box">
			<h3><?php echo Kohana::lang('ui_main.error');?></h3>
			<ul>
			<?php
				foreach ($errors as $error_item => $error_description)
				{
				print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
				}
	?>
			</ul>
		</div>
	<?php
	}

	if ($form_saved) {
	?>
		<!-- green-box -->
		<div class="green-box">
			<h3><?php echo Kohana::lang('ui_main.configuration_saved');?></h3>
		</div>
	<?php
	}
	?>				
	<div class="head">
		<h3><?php echo Kohana::lang('flickrwijit.flickrwijit_title');?></h3>
		<input type="image" src="<?php echo url::base() ?>media/img/admin/btn-cancel.gif" class="cancel-btn" />
		<input type="image" src="<?php echo url::base() ?>media/img/admin/btn-save-settings.gif" class="save-rep-btn" />
	</div>
	<div class="sms_holder">
		<!-- flickwijit starts -->
		<div class="row">
			<h4><?php echo Kohana::lang('flickrwijit.flickrwijit_title');?></h4>
			<div class="row">
				<h4><a href="#" class="tooltip" title="" ><?php echo Kohana::lang('flickrwijit.form_flickr_tags');?></a></h4>
				<?php print form::input('flickr_tag', $form['flickr_tag'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_flickr_tags');?> </span>
			<div class="row" style="padding-top: 5px;">
				<h4><a href="#" class="tooltip" title=""><?php echo Kohana::lang('flickrwijit.form_flickr_id');?></a></h4>
				<?php print form::input('flickr_id', $form['flickr_id'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_flickr_id');?></span>
			<div class="row" style="padding-top: 5px;">
				<h4><a href="#" class="tooltip" title=""><?php echo Kohana::lang('flickrwijit.form_num_of_photos');?></a></h4>
				<?php print form::input('num_of_photos', $form['num_of_photos'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_num_of_photos');?></span>
			<div class="row" style="padding-top: 5px;">
				<h4><a href="#" class="tooltip" title""><?php echo Kohana::lang('flickrwijit.form_image_width');?></a></h4>
				<?php print form::input('image_width', $form['image_width'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_image_width');?></span>
			<div class="row" style="padding-top: 5px;">
				<h4><a href="#" class="tooltip" title=""><?php echo Kohana::lang('flickrwijit.form_image_height');?></a></h4>
				<?php print form::input('image_height', $form['image_height'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_image_height');?></span>
			<div class="row" style="padding-top: 5px;">
				<h4><a href="#" class="tooltip" title=""><?php echo Kohana::lang('flickrwijit.form_block_position');?></a></h4>
				<?php print form::input('block_position', $form['block_position'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_block_position');?></span>
			<div class="row" style="padding-top: 5px;">
				<h4><a href="#" class="tooltip" title=""><?php echo Kohana::lang('flickrwijit.form_block_width');?></a></h4>
				<?php print form::input('block_width', $form['block_width'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_block_width');?></span>
			<div class="row" style="padding-top: 5px;">
				<h4><a href="#" class="tooltip" title=""><?php echo Kohana::lang('flickrwijit.form_block_height');?></a></h4>
				<?php print form::input('block_height', $form['block_height'], ' class="text"'); ?>
			</div>
			<span><?php echo Kohana::lang('flickrwijit.form_block_height');?></span>
		</div>
		<!-- flickwijit ends -->
	</div>	
	<div class="simple_border"></div>
		
	<input type="image" src="<?php echo url::base() ?>media/img/admin/btn-save-settings.gif" class="save-rep-btn" />
	<input type="image" src="<?php echo url::base() ?>media/img/admin/btn-cancel.gif" class="cancel-btn" />
	</div>
	<?php print form::close(); ?>
</div> 