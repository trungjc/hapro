<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$elp_errors = array();
$elp_success = '';
$elp_error_found = FALSE;
$cron_adminmail = "";

// Form submitted, check the data
if (isset($_POST['elp_form_submit']) && $_POST['elp_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('elp_form_add');
	
	$elp_cron_mailcount = isset($_POST['elp_cron_mailcount']) ? wp_filter_post_kses($_POST['elp_cron_mailcount']) : '';
	if($elp_cron_mailcount == "0" && strlen ($elp_cron_mailcount) > 0)
	{
		$elp_errors[] = __('Please enter valid mail count.', 'email-posts-to-subscribers');
		$elp_error_found = TRUE;
	}
	
	$elp_cron_adminmail = isset($_POST['elp_cron_adminmail']) ? wp_filter_post_kses($_POST['elp_cron_adminmail']) : '';

	//	No errors found, we can add this Group to the table
	if ($elp_error_found == FALSE)
	{
		update_option('elp_cron_mailcount', $elp_cron_mailcount );
		update_option('elp_cron_adminmail', $elp_cron_adminmail );
		$elp_success = __('Cron details successfully updated.', 'email-posts-to-subscribers');
	}
}

$elp_cron_url = get_option('elp_c_cronurl', 'nocronurl');
if($elp_cron_url == "nocronurl")
{
	$guid = elp_cls_common::elp_generate_guid(60);
	$home_url = home_url('/');
	$cronurl = $home_url . "?elp=cron&guid=". $guid;
	add_option('elp_c_cronurl', $cronurl);
	$elp_cron_url = get_option('elp_c_cronurl');
}

$elp_cron_mailcount = get_option('elp_cron_mailcount', '0');
if($elp_cron_mailcount == "0")
{
	add_option('elp_cron_mailcount', "75");
	$elp_cron_mailcount = get_option('elp_cron_mailcount');
}
$elp_cron_adminmail = get_option('elp_cron_adminmail', '');
if($elp_cron_adminmail == "")
{
	add_option('elp_cron_adminmail', "Hi Admin, \r\n\r\nCron URL has been triggered successfully on ###DATE### for the mail ###SUBJECT###. And the mail has been sent to ###COUNT### recipient. \r\n\r\nThank You");
	$elp_cron_adminmail = get_option('elp_cron_adminmail');
}

if ($elp_error_found == TRUE && isset($elp_errors[0]) == TRUE)
{
	?><div class="error fade"><p><strong><?php echo $elp_errors[0]; ?></strong></p></div><?php
}
if ($elp_error_found == FALSE && strlen($elp_success) > 0)
{
	?>
	<div class="updated fade">
		<p><strong><?php echo $elp_success; ?></strong></p>
	</div>
	<?php
}
?>
<script language="javaScript" src="<?php echo ELP_URL; ?>cron/cron.js"></script>
<div class="form-wrap">
	<div id="icon-plugins" class="icon32"></div>
	<h2><?php _e(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'); ?></h2>
	<h3><?php _e('Cron Details', 'email-posts-to-subscribers'); ?></h3>
	<form name="elp_form" method="post" action="#" onsubmit="return _elp_submit()"  >
      
      <label for="tag-link"><?php _e('Cron job URL', 'email-posts-to-subscribers'); ?></label>
      <input name="elp_cron_url" type="text" id="elp_cron_url" value="<?php echo $elp_cron_url; ?>" maxlength="225" size="75"  />
      <p><?php _e('Please find your cron job URL. This is read only field not able to modify from admin.', 'email-posts-to-subscribers'); ?></p>
	  
	  <label for="tag-link"><?php _e('Mail Count', 'email-posts-to-subscribers'); ?></label>
      <input name="elp_cron_mailcount" type="text" id="elp_cron_mailcount" value="<?php echo $elp_cron_mailcount; ?>" maxlength="3" />
      <p><?php _e('Enter number of mails you want to send per hour/trigger.', 'email-posts-to-subscribers'); ?></p>
	  
	  <label for="tag-link"><?php _e('Admin Report', 'email-posts-to-subscribers'); ?></label>
	  <textarea size="100" id="elp_cron_adminmail" rows="6" cols="73" name="elp_cron_adminmail"><?php echo esc_html(stripslashes($elp_cron_adminmail)); ?></textarea>
	  <p><?php _e('Send above mail to admin whenever cron URL triggered in your server.', 'email-posts-to-subscribers'); ?><br />(Keywords: ###DATE###, ###SUBJECT###, ###COUNT###)</p>

      <input type="hidden" name="elp_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Submit', 'email-posts-to-subscribers'); ?>" type="submit" />
        <input name="publish" lang="publish" class="button add-new-h2" onclick="_elp_redirect()" value="<?php _e('Cancel', 'email-posts-to-subscribers'); ?>" type="button" />
        <input name="Help" lang="publish" class="button add-new-h2" onclick="_elp_help()" value="<?php _e('Help', 'email-posts-to-subscribers'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('elp_form_add'); ?>
    </form>
</div>
<div class="tool-box">
	<h3><?php _e('How to setup auto emails?', 'email-posts-to-subscribers'); ?></h3>
	<p><?php _e('You have to trigger/schedule this URL from your server once every hour(Once every hour is recommended for this plugin) . Plugin will send/schedule the newsletter whenever your URL is triggered. Step-by-step tutorial on how you can setup cron task on your own server through the cPanel or Plesk available.', 'email-posts-to-subscribers'); ?></p>
	<p><?php _e('How to setup auto emails (cron job) in Plesk', 'email-posts-to-subscribers'); ?> <a target="_blank" href="http://www.gopiplus.com/work/2014/03/30/how-to-setup-auto-emails-for-email-posts-to-subscribers-plugin/"><?php _e('Click here', 'email-posts-to-subscribers'); ?></a>.</p>
	<p><?php _e('How to setup auto emails (cron job) in cPanal', 'email-posts-to-subscribers'); ?> <a target="_blank" href="http://www.gopiplus.com/work/2014/03/30/how-to-setup-auto-emails-for-email-posts-to-subscribers-plugin-cpanal/"><?php _e('Click here', 'email-posts-to-subscribers'); ?></a>.</p>
	<p><?php _e('Hosting doesnt support cron jobs?', 'email-posts-to-subscribers'); ?> <a target="_blank" href="http://www.gopiplus.com/work/2014/03/31/schedule-auto-mails-cron-jobs-for-email-posts-to-subscribers-plugin/"><?php _e('Click here', 'email-posts-to-subscribers'); ?></a> for solution.</p>
</div>
</div>