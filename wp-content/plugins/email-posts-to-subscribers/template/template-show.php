<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
if ($elp_c_plugin_ver <> "3.0")
{
	?>
	<div class="error fade">
		<p>
		Note: You have recently upgraded the plugin and your tables are not sync. 
		Please <a title="Sync plugin tables." href="<?php echo ELP_ADMINURL; ?>?page=elp-settings&amp;ac=sync"><?php _e('Click Here', 'email-posts-to-subscribers'); ?></a> to sync the table. 
		This is mandatory and it will not affect your data.
		</p>
	</div>
	<?php
}

// Form submitted, check the data
if (isset($_POST['frm_elp_display']) && $_POST['frm_elp_display'] == 'yes')
{
	$did = isset($_GET['did']) ? sanitize_text_field($_GET['did']) : '0';
	if(!is_numeric($did)) { die('<p>Are you sure you want to do this?</p>'); }
	
	$elp_success = '';
	$elp_success_msg = FALSE;
	
	// First check if ID exist with requested ID
	$result = elp_cls_dbquery::elp_template_count($did);
	if ($result != '1')
	{
		?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'email-posts-to-subscribers'); ?></strong></p></div><?php
	}
	else
	{
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
		{
			//	Just security thingy that wordpress offers us
			check_admin_referer('elp_form_show');
			
			//	Delete selected record from the table
			elp_cls_dbquery::elp_template_delete($did);
			
			//	Set success message
			$elp_success_msg = TRUE;
			$elp_success = __('Selected record was successfully deleted.', 'email-posts-to-subscribers');
		}
	}
	
	if ($elp_success_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $elp_success; ?></strong></p></div><?php
	}
}
?>
<script language="javaScript" src="<?php echo ELP_URL; ?>template/template.js"></script>
<div class="wrap">
  <div id="icon-plugins" class="icon32"></div>
    <h2><?php _e(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'); ?></h2>
	<h3><?php _e('Mail Template', 'email-posts-to-subscribers'); ?>  
	<a class="add-new-h2" href="<?php echo ELP_ADMINURL; ?>?page=elp-email-template&amp;ac=add"><?php _e('Add New', 'email-posts-to-subscribers'); ?></a></h3>
    <div class="tool-box">
	<?php
	$myData = array();
	$myData = elp_cls_dbquery::elp_template_select(0);
	?>
	<form name="frm_elp_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
			<th scope="col"><?php _e('Sno', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Template Heading', 'email-posts-to-subscribers'); ?></th>
            <th scope="col"><?php _e('Template Status', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Template Type', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Template ID', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Action', 'email-posts-to-subscribers'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
			<th scope="col"><?php _e('Sno', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Template Heading', 'email-posts-to-subscribers'); ?></th>
            <th scope="col"><?php _e('Template Status', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Template Type', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Template ID', 'email-posts-to-subscribers'); ?></th>
			<th scope="col"><?php _e('Action', 'email-posts-to-subscribers'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			$displayisthere = FALSE;
			if(count($myData) > 0)
			{
				$i = 1;
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
					  	<td align="left"><?php echo $i; ?></td>
						<td><?php echo esc_html(stripslashes($data['elp_templ_heading'])); ?></td>
						<td><?php echo $data['elp_templ_status']; ?></td>
						<td><?php if($data['elp_email_type'] == "") { echo "System"; } else { echo $data['elp_email_type']; } ?></td>
						<td><?php echo $data['elp_templ_id']; ?></td>
						<td>
						<span class="edit">
						<a title="Edit" href="<?php echo ELP_ADMINURL; ?>?page=elp-email-template&amp;ac=edit&amp;did=<?php echo $data['elp_templ_id']; ?>">
						<?php _e('Edit', 'email-posts-to-subscribers'); ?>
						</a> | 
						<a title="Preview" href="<?php echo ELP_ADMINURL; ?>?page=elp-email-template&amp;ac=preview&amp;did=<?php echo $data['elp_templ_id']; ?>">
						<?php _e('Preview', 'email-posts-to-subscribers'); ?>
						</a>
						<?php if($data['elp_templ_id'] > 8) { ?>
						| <a onClick="javascript:_elp_delete('<?php echo $data['elp_templ_id']; ?>')" href="javascript:void(0);">
						<?php _e('Delete', 'email-posts-to-subscribers'); ?>
						</a>
						<?php } ?>
						</span>
						</td>
					</tr>
					<?php
					$i = $i+1;
				}
			}
			else
			{
				?><tr><td colspan="6" align="center"><?php _e('No records available.', 'email-posts-to-subscribers'); ?></td></tr><?php 
			}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('elp_form_show'); ?>
		<input type="hidden" name="frm_elp_display" value="yes"/>
      </form>	
	  <div class="tablenav">
		  <h2>
			<a class="button add-new-h2" href="<?php echo ELP_ADMINURL; ?>?page=elp-email-template&amp;ac=add"><?php _e('Create New Template', 'email-posts-to-subscribers'); ?></a>
			<a class="button add-new-h2" target="_blank" href="<?php echo ELP_FAV; ?>"><?php _e('Help', 'email-posts-to-subscribers'); ?></a>
		  </h2>
	  </div>
	  <div style="height:10px;"></div>
	  <p class="description"><?php echo ELP_OFFICIAL; ?></p>
	</div>
</div>