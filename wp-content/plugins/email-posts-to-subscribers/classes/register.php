<?php
class elp_cls_registerhook
{
	public static function elp_activation()
	{
		global $wpdb;
		
		add_option('email-posts-to-subscribers', "3.0");

		// Plugin tables
		$array_tables_to_plugin = array('elp_templatetable','elp_emaillist','elp_sendsetting','elp_sentdetails','elp_deliverreport','elp_pluginconfig');
		$errors = array();
		
		// loading the sql file, load it and separate the queries
		$sql_file = ELP_DIR.'sql'.DS.'createDB.sql';
		$prefix = $wpdb->prefix;
        $handle = fopen($sql_file, 'r');
        $query = fread($handle, filesize($sql_file));
        fclose($handle);
        $query=str_replace('CREATE TABLE IF NOT EXISTS ','CREATE TABLE IF NOT EXISTS '.$prefix, $query);
        $queries=explode('-- SQLQUERY ---', $query);

        // run the queries one by one
        $has_errors = false;
        foreach($queries as $qry)
		{
            $wpdb->query($qry);
        }
		
		// list the tables that haven't been created
        $missingtables=array();
        foreach($array_tables_to_plugin as $table_name)
		{
			if(strtoupper($wpdb->get_var("SHOW TABLES like  '". $prefix.$table_name . "'")) != strtoupper($prefix.$table_name))  
			{
                $missingtables[]=$prefix.$table_name;
            }
        }
		
		// add error in to array variable
        if($missingtables) 
		{
			$errors[] = __('These tables could not be created on installation ' . implode(', ',$missingtables), 'email-posts-to-subscribers');
            $has_errors=true;
        }
		
		// if error call wp_die()
        if($has_errors) 
		{
			wp_die( __( $errors[0] , 'email-posts-to-subscribers' ) );
			return false;
		}
		else
		{
			elp_cls_dbinsert::elp_template_default();
			elp_cls_dbinsert::elp_pluginconfig_default();
			elp_cls_dbinsert::elp_sendsetting_default();
			elp_cls_dbinsert::elp_subscriber_default();
		}
        return true;
	}
	
	public static function elp_synctables()
	{
		$elp_c_plugin_ver = get_option('email-posts-to-subscribers');
		if($elp_c_plugin_ver <> "3.0")
		{
			global $wpdb;
			
			// loading the sql file, load it and separate the queries
			$sql_file = ELP_DIR.'sql'.DS.'createDB.sql';
			$prefix = $wpdb->prefix;
			$handle = fopen($sql_file, 'r');
			$query = fread($handle, filesize($sql_file));
			fclose($handle);
			$query=str_replace('CREATE TABLE IF NOT EXISTS ','CREATE TABLE '.$prefix, $query);
			$query=str_replace('ENGINE=MyISAM /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci*/','', $query);
			$queries=explode('-- SQLQUERY ---', $query);
	
			// includes db upgrade file
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			
			// run the queries one by one
			foreach($queries as $sSql)
			{
				dbDelta( $sSql );
			}
			elp_cls_dbinsert::elp_db_value_sync();
			
			update_option('email-posts-to-subscribers', "3.0" );
			add_option('elp_cron_mailcount', "75");
		}
	}
	
	public static function elp_deactivation()
	{
		// do not generate any output here
	}
	
	public static function elp_adminmenu()
	{
		add_menu_page( __( 'Email Posts', 'email-posts-to-subscribers' ), 
			__( 'Email Posts', 'email-posts-to-subscribers' ), 'admin_dashboard', 'email-post', 'elp_admin_option', ELP_URL.'images/mail.png', 53 );
			
		add_submenu_page('email-post', __( 'Subscribers', 'email-posts-to-subscribers' ), 
			__( 'Subscribers', 'email-posts-to-subscribers' ), 'administrator', 'elp-view-subscribers', array( 'elp_cls_intermediate', 'elp_subscribers' ));
						
		add_submenu_page('email-post', __( 'Templates', 'email-posts-to-subscribers' ), 
			__( 'Templates', 'email-posts-to-subscribers' ), 'administrator', 'elp-email-template', array( 'elp_cls_intermediate', 'elp_template' ));
			
		add_submenu_page('email-post', __( 'Mail Configuration', 'email-posts-to-subscribers' ), 
			__( 'Mail Configuration', 'email-posts-to-subscribers' ), 'administrator', 'elp-configuration', array( 'elp_cls_intermediate', 'elp_configuration' ));	
					
		add_submenu_page('email-post', __( 'Cron Details', 'email-posts-to-subscribers' ), 
			__( 'Cron Details', 'email-posts-to-subscribers' ), 'administrator', 'elp-crondetails', array( 'elp_cls_intermediate', 'elp_crondetails' ));
		
		add_submenu_page('email-post', __( 'Send Email', 'email-posts-to-subscribers' ), 
			__( 'Send Email', 'email-posts-to-subscribers' ), 'administrator', 'elp-sendemail', array( 'elp_cls_intermediate', 'elp_sendemail' ));
			
		add_submenu_page('email-post', __( 'Sent Mail', 'email-posts-to-subscribers' ), 
			__( 'Sent Mail', 'email-posts-to-subscribers' ), 'administrator', 'elp-sentmail', array( 'elp_cls_intermediate', 'elp_sentmail' ));	
				
		add_submenu_page('email-post', __( 'Settings', 'email-posts-to-subscribers' ), 
			__( 'Settings', 'email-posts-to-subscribers' ), 'administrator', 'elp-settings', array( 'elp_cls_intermediate', 'elp_settings' ));	
			
		add_submenu_page('email-post', __( 'Help & Info', 'email-posts-to-subscribers' ), 
			__( 'Help & Info', 'email-posts-to-subscribers' ), 'administrator', 'elp-general-information', array( 'elp_cls_intermediate', 'elp_information' ));
			
		//add_submenu_page('email-post', __( 'Schedule Email', 'email-posts-to-subscribers' ), 
//			__( 'Schedule Email', 'email-posts-to-subscribers' ), 'administrator', 'elp-schedule', array( 'elp_cls_intermediate', 'elp_schedule' ));			
	}
	
	public static function elp_widget_loading()
	{
		register_widget( 'elp_widget_register' );
	}
}

class elp_widget_register extends WP_Widget 
{
	function __construct() 
	{
		$widget_ops = array('classname' => 'widget_text elp-widget', 'description' => __(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'), ELP_PLUGIN_NAME);
		parent::__construct(ELP_PLUGIN_NAME, __(ELP_PLUGIN_DISPLAY, 'email-posts-to-subscribers'), $widget_ops);
	}
	
	function widget( $args, $instance ) 
	{
		extract( $args, EXTR_SKIP );
		
		$elp_title 	= apply_filters( 'widget_title', empty( $instance['elp_title'] ) ? '' : $instance['elp_title'], $instance, $this->id_base );
		$elp_desc	= $instance['elp_desc'];
		$elp_name	= $instance['elp_name'];
		$elp_group	= $instance['elp_group'];

		echo $args['before_widget'];
		if ( ! empty( $elp_title ) )
		{
			echo $args['before_title'] . $elp_title . $args['after_title'];
		}
		// Call widget method
		$arr = array();
		$arr["elp_title"] 	= $elp_title;
		$arr["elp_desc"] 	= $elp_desc;
		$arr["elp_name"] 	= $elp_name;
		$arr["elp_group"] 	= $elp_group;
		echo elp_cls_widget::elp_widget_int($arr);
		// Call widget method
		
		echo $args['after_widget'];
	}
	
	function update( $new_instance, $old_instance ) 
	{
		$instance 				= $old_instance;
		$instance['elp_title'] 	= ( ! empty( $new_instance['elp_title'] ) ) ? strip_tags( $new_instance['elp_title'] ) : '';
		$instance['elp_desc'] 	= ( ! empty( $new_instance['elp_desc'] ) ) ? strip_tags( $new_instance['elp_desc'] ) : '';
		$instance['elp_name'] 	= ( ! empty( $new_instance['elp_name'] ) ) ? strip_tags( $new_instance['elp_name'] ) : '';
		$instance['elp_group'] 	= ( ! empty( $new_instance['elp_group'] ) ) ? strip_tags( $new_instance['elp_group'] ) : '';
		return $instance;
	}
	
	function form( $instance ) 
	{
		$defaults = array(
			'elp_title' => '',
            'elp_desc' 	=> '',
            'elp_name' 	=> ''
        );
		$instance 		= wp_parse_args( (array) $instance, $defaults);
		$elp_title 		= $instance['elp_title'];
        $elp_desc 		= $instance['elp_desc'];
        $elp_name 		= $instance['elp_name'];
		$elp_group 		= $instance['elp_group'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('elp_title'); ?>"><?php _e('Widget Title', 'email-posts-to-subscribers'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('elp_title'); ?>" name="<?php echo $this->get_field_name('elp_title'); ?>" type="text" value="<?php echo $elp_title; ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('elp_name'); ?>"><?php _e('Name Field', 'email-posts-to-subscribers'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('elp_name'); ?>" name="<?php echo $this->get_field_name('elp_name'); ?>">
				<option value="YES" <?php $this->elp_selected($elp_name == 'YES'); ?>>YES</option>
				<option value="NO" <?php $this->elp_selected($elp_name == 'NO'); ?>>NO</option>
			</select>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('elp_desc'); ?>"><?php _e('Short Description', 'email-posts-to-subscribers'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('elp_desc'); ?>" name="<?php echo $this->get_field_name('elp_desc'); ?>" type="text" value="<?php echo $elp_desc; ?>" />
			Short description about your widget.
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('elp_group'); ?>"><?php _e('Subscriber Group', 'email-posts-to-subscribers'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('elp_group'); ?>" name="<?php echo $this->get_field_name('elp_group'); ?>" type="text" maxlength="20" value="<?php echo $elp_group; ?>" />
        </p>
		<?php
	}
	
	function elp_selected($var) 
	{
		if ($var==1 || $var==true) 
		{
			echo 'selected="selected"';
		}
	}
}
?>