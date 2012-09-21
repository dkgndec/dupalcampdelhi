<?php

	$thisTitle = "";
	$menus = menu_tree_page_data('primary-links'); 
	foreach($menus as $menu) {
	    if(!empty($menu['link']['in_active_trail']) && $menu['link']['has_children'])
	        $thisTitle = $menu['link']['title'];
	       
	}


	
	// set left column width
	if(((theme_get_setting(splitmenu_col) == "leftcol") and $affinity_menu_type == "splitmenu" AND $thisTitle != "") or $left) {
		$current_leftcolumn_width = theme_get_setting('leftcolumn_width');
	}
	else {
		$current_leftcolumn_width = 0;
	}
	// set right column width
	if(((theme_get_setting(splitmenu_col) == "rightcol") and $affinity_menu_type == "splitmenu" AND $thisTitle != "") or $right) {
		$current_rightcolumn_width = theme_get_setting('rightcolumn_width');
	}
	else {
		$current_rightcolumn_width = 0;
	}
	// set insetwidth
	if($inset) {
		//$current_left_inset_width = theme_get_setting('leftinset_width');
		$current_left_inset_width = 0;
	}
	else {
		$current_left_inset_width = 0;
	}
	
	if($inset2) {
		//$current_right_inset_width = theme_get_setting('rightinset_width');
		$current_right_inset_width = 0;
	}
	else {
		$current_right_inset_width = 0;
	}
	
	// set template width
	$current_template_width = theme_get_setting('template_width');
	
	$col_mode = "s-c-s";
	if ($current_leftcolumn_width==0 and $current_rightcolumn_width>0) $col_mode = "x-c-s";
	if ($current_leftcolumn_width>0 and $current_rightcolumn_width==0) $col_mode = "s-c-x";
	if ($current_leftcolumn_width==0 and $current_rightcolumn_width==0) $col_mode = "x-c-x";

?>