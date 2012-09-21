<?php

// This information has been pulled out to make the template more readible.
//
// This data goes between the <head></head> tags of the template
$theme_path = path_to_theme();
?>

<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />


<link href="<?php echo base_path() . path_to_theme(); ?>/css/template.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_path() . path_to_theme(); ?>/css/<?php echo $affinity_style; ?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_path() . path_to_theme(); ?>/css/typography.css" rel="stylesheet" type="text/css" />



<?php if($affinity_menu_type=="moomenu" or $affinity_menu_type=="suckerfish") :?>
<link href="<?php echo base_path() . path_to_theme(); ?>/css/rokmoomenu.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php 
	$current_mainbody_width = ($current_template_width - $current_rightcolumn_width) - 20;
	$current_maincol_width = ($current_mainbody_width - $current_leftcolumn_width) - 45;
?>
<style type="text/css">
	div.wrapper { margin: 0 auto; width: <?php echo $current_template_width; ?>px;padding:0;}
	#leftcol { width:<?php echo $current_leftcolumn_width; ?>px;padding:0;float:left;}
	#rightcol { width:<?php echo $current_rightcolumn_width; ?>px;padding:0;}
	#main-body { width:<?php echo $current_mainbody_width; ?>px;padding:0;float:left;}
	#maincol { width:<?php echo $current_maincol_width; ?>px;padding:0;float:right;}
	#inset-block-left { width:<?php echo $current_left_inset_width; ?>px;padding:0;}
	#inset-block-right { width:<?php echo $current_right_inset_width; ?>px;padding:0;}
	#maincontent-block { margin-right:<?php echo $current_right_inset_width; ?>px;margin-left:<?php echo $current_left_inset_width; ?>px;}
	
</style>	



<!-- If JS_COMPAT IS OFF AND NOT IN THE DRUPAL ADMIN, USE MOOTOOLS JS SCRIPTS -->
<?php if(theme_get_setting(js_compatibility) == 0 AND arg(0) != "admin" AND arg(1) != "add" AND arg(2) != "edit" AND arg(0) != "user") : ?>
	<?php include $theme_path . "/rt_mootools.php"; ?>
<?php endif; ?>



<?php if($affinity_menu_type=="suckerfish" or $affinity_menu_type=="splitmenu") :
  echo "<script type=\"text/javascript\" src=\"" . base_path() . path_to_theme() . "/js/ie_suckerfish.js\"></script>\n";
endif; ?>