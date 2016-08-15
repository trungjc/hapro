<?php


function whispli_custom_nav_menu($location) {
	global $wp_rewrite;
	$_root_relative_current = untrailingslashit( $_SERVER['REQUEST_URI'] );
	$current_url            = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_root_relative_current );
	$_indexless_current     = untrailingslashit( preg_replace( '/' . preg_quote( $wp_rewrite->index, '/' ) . '$/', '', $current_url ) );
	$locations              = get_nav_menu_locations();
	if (isset($locations[$location])) {
		$primary_menu           = wp_get_nav_menu_object( $locations[$location] );
		if ( $primary_menu ) {
			$primary_menu_items = wp_get_nav_menu_items( $primary_menu->term_id, array( 'update_post_term_cache' => false ) );
			//	_wp_menu_item_classes_by_context( $primary_menu_items );
			$sorted_menu_items = $parent_items = $sub_items = $menu_items_with_children = array();
			$menu_item_active  = false;
			foreach ( (array) $primary_menu_items as $menu_item ) {
				$sorted_menu_items[$menu_item->menu_order] = $menu_item;
				if ( $menu_item->menu_item_parent ) {
					$menu_items_with_children[$menu_item->menu_item_parent] = true;
				} elseif ( 0 == $menu_item->menu_item_parent ) {
					$parent_items[$menu_item->ID] = $menu_item;
				}
				$raw_item_url = strpos( $menu_item->url, '#' ) ? substr( $menu_item->url, 0, strpos( $menu_item->url, '#' ) ) : $menu_item->url;
				$item_url     = set_url_scheme( untrailingslashit( $raw_item_url ) );
				if ( $raw_item_url && in_array( $item_url, array( $current_url, $_indexless_current, $_root_relative_current ) ) ) {
					$menu_item_active = $menu_item->ID;
					$menu_item->classes[] = 'current-menu-item';
				}
			}
			if ( $menu_items_with_children ) {
				foreach ( $sorted_menu_items as &$menu_item ) {
					if ( isset( $menu_items_with_children[$menu_item->ID] ) ) {
						$menu_item->classes[] = 'parent-menu';
					}
					if ( isset( $menu_items_with_children[$menu_item->menu_item_parent] ) ) {
						$sub_items[$menu_item->menu_item_parent][] = $menu_item;
					}
					if ( $menu_item->ID == $menu_item_active ) {
						if (!in_array('current-menu-item', $menu_item->classes)) {
							$menu_item->classes[] = 'current-menu-item';
						}
						if ( 0 !== intval($menu_item->menu_item_parent) ) {
							$parent_items[$menu_item->menu_item_parent]->classes[] = 'current-menu-item';
						}
					}
					if ( get_post_type() == 'product' && get_page_template_slug( $menu_item->object_id ) == 'single-product.php' ) {
						$menu_item->classes[] = 'current-menu-item';
					}
				}
			}
			unset( $menu_items, $menu_item );

			return array( $parent_items, $sub_items, $menu_items_with_children );

		}
	}
	return false;
}