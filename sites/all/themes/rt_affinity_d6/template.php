<?php

/**
 * Comment out for production!
 * For development only. Defeats theme register caching.
 * Changes to theme show immediately, but performance is effected.
 * Comment out for production.
 */
drupal_rebuild_theme_registry();

/*
* Initialize theme settings
*/
if (is_null(theme_get_setting('preset_style'))) {  

  global $theme_key;

	if (!(function_exists('affinity_settings_defaults'))){
		include('theme-settings.php');
	}
	
	
  $defaults = affinity_settings_defaults();

  // Get default theme settings.
  $settings = theme_get_settings($theme_key);
  // Don't save the toggle_node_info_ variables.
  if (module_exists('node')) {
    foreach (node_get_types() as $type => $name) {
      unset($settings['toggle_node_info_' . $type]);
    }
  }
  // Save default theme settings.
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, $settings)
  );

  // Force refresh of Drupal internals.
  theme_get_setting('', TRUE);

}



/**
* Override or insert PHPTemplate variables into the search_block_form template.
*
* @param $vars
*   A sequential array of variables to pass to the theme template.
* @param $hook
*   The name of the theme function being called (not used in this case.)
*/
function affinity_preprocess_search_block_form(&$variables) {
  $variables['form']['search_block_form']['#title'] = '';
  $variables['form']['search_block_form']['#size'] = 20;
  $variables['form']['search_block_form']['#value'] = 'Search...';
  $variables['form']['search_block_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = '".$variables['form']['search_block_form']['#value']."';}", 'onfocus' => "if (this.value == '".$variables['form']['search_block_form']['#value']."') {this.value = '';}" );
  unset($variables['form']['search_block_form']['#printed']);

  $variables['search']['search_block_form'] = drupal_render($variables['form']['search_block_form']);

  $variables['search_form'] = implode($variables['search']);
}

function affinity_blocks($region) {
  $output = '';

  if ($list = block_list($region)) {
    $blockcounter = 1; // there is at least one block in this region
    foreach ($list as $key => $block) {
      // $key == <i>module</i>_<i>delta</i>
      $block->extraclass = ''; // add the 'extracclass' key to the $block object
      $block->num_count = 0;
      if ($blockcounter == 1){ // is this the first block in this region?
        $block->extraclass .= 'first'; 
      }
      elseif ($blockcounter == count($list)){ // is this the last block in this region?
        $block->extraclass .= 'last';
      }
      else {
      	$block->extraclass .= 'middle';
      }
      
      
      $output .= theme('block', $block);
      $blockcounter++;
    }
   
  }

  // Add any content assigned to this region through drupal_set_content() calls.
  $output .= drupal_get_content($region);

  return $output;
}




function affinity_preprocess_block(&$variables){
	
	static $user123_count;
	if($variables['block']->region == 'user123'){
		$user123_count++;
	}
	$variables['user123_count'] = $user123_count;
	
	static $main123_count;
	if($variables['block']->region == 'main123'){
		$main123_count++;
	}
	$variables['main123_count'] = $main123_count;
	
	static $main456_count;
	if($variables['block']->region == 'main456'){
		$main456_count++;
	}
	$variables['main456_count'] = $main456_count;
	
	static $user456_count;
	if($variables['block']->region == 'user456'){
		$user456_count++;
	}
	$variables['user456_count'] = $user456_count;
	
	static $user789_count;
	if($variables['block']->region == 'user789'){
		$user789_count++;
	}
	$variables['user789_count'] = $user789_count;
	
	static $showcase_count;
	if($variables['block']->region == 'showcase'){
		$showcase_count++;
	}
	$variables['showcase_count'] = $showcase_count;
	
	static $bottom_count;
	if($variables['block']->region == 'bottom'){
		$bottom_count++;
	}
	$variables['bottom_count'] = $bottom_count;
}


function affinity_preprocess_maintenance_page(&$vars) {
	affinity_preprocess_page($vars);
}


function affinity_preprocess_page(&$variables) {
	
	//$theme_settings = variable_get('theme_affinity_settings', array());
	
	$variables['path'] = base_path() . path_to_theme();
	$css_path = path_to_theme().'/css/';
	$js_path = path_to_theme() . '/js/';
	$variables['file_path'] = base_path().file_directory_path();
	$variables['url'] = "http://" . $_SERVER['HTTP_HOST'] . url();
    $variables['uri'] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    $variables['tabs2'] = menu_secondary_local_tasks();
	
	
	
	if( isset( $_COOKIE['affinity_style'] ) )
		$variables['affinity_style'] = $_COOKIE['affinity_style']; 
	else
		$variables['affinity_style'] = theme_get_setting(preset_style);
	
		
	if( isset( $_COOKIE['affinity_fontfamily'] ) )
		$variables['affinity_fontfamily'] = $_COOKIE['affinity_fontfamily']; 
	else
		$variables['affinity_fontfamily'] = theme_get_setting(font_family);
	
	if( isset( $_COOKIE['affinity_defaultfont'] ) )
		$variables['affinity_defaultfont'] = $_COOKIE['affinity_defaultfont']; 
	else
		$variables['affinity_defaultfont'] = theme_get_setting(default_font);
	

		
	
	// set global for menu style if exists
	if( isset( $_COOKIE['affinity_menu_type'] ) )
		$variables['affinity_menu_type'] = $_COOKIE['affinity_menu_type']; 
	else
		$variables['affinity_menu_type'] = theme_get_setting('menu_type');
	
		
	if($variables['affinity_menu_type'] == "moomenu" or $variables['affinity_menu_type'] == "suckerfish"){
		drupal_add_css($css_path . 'rokmoomenu.css', 'theme', 'all', FALSE);	
	}
	

	
	//$theme_variation = theme_get_setting('preset_style');
	
	// populate the header variable




	//drupal_add_js($js_path.'featured-modules.js', 'theme');
	
	$variables['scripts'] = drupal_get_js();
	$variables['head'] = drupal_get_html_head();
	$variables['styles'] = drupal_get_css();
	

	
	// get widths for block regions
	
	$block_regions = array('user123', 'main123', 'main456', 'user456', 'user789', 'showcase', 'bottom');
	
	$block_region_widths = array(
		1 => 'w99',
		2 => 'w49',
		3 => 'w33',
		4 => 'w24'
	);
	
 	foreach($block_regions as $block_region){
		$blocks = block_list($block_region);	
		$variables[$block_region.'_width'] = ($block_region_widths[count($blocks)] ? $block_region_widths[count($blocks)] : $block_region_widths[4]);
		$variables[$block_region.'_number'] = count($blocks);
	} 

	if (strpos(request_uri(), 'wrapper') != false){
		$variables['template_file'] = 'page-wrapper';
	}

}




function affinity_change_theme($change, $changeVal, $page=''){
	
	$theme_settings = variable_get('theme_affinity_settings', array());
	
	$cookie_prefix = "affinity_";
	$cookie_time = time()+31536000;
	//print_r($theme_settings);
	
	
	if($change && $changeVal){
		//print $change . " " . $changeVal;
		
		switch ($change){
			
			case 'fontfamily':
			
				$cookie_name = $cookie_prefix . "fontfamily";
				setcookie($cookie_name, $changeVal, $cookie_time);
				//$theme_settings['font_family'] = $changeVal;
			
			break;
			
			case 'tstyle':
	
				$cookie_name = $cookie_prefix . "style";
				setcookie($cookie_name, $changeVal, $cookie_time);
				//$theme_settings['default_style'] = $changeVal;
				

				
			break;		

			case 'mtype':
				
				$cookie_name = $cookie_prefix . "menu_type";
				setcookie($cookie_name, $changeVal, $cookie_time);
				//$theme_settings['menu_type'] = $changeVal;
			
			break;

		}


		
	}
	
	 //print_r($theme_settings);
	if ($page){
		drupal_goto("node/$page");
	}
	else {
		drupal_goto('<front>');
	}
	
}


function change_font($change, $page=''){

	$cookie_prefix = "affinity_";
	$cookie_time = time()+31536000;
	
	$cookie_name = $cookie_prefix . "defaultfont";
	setcookie($cookie_name, $change, $cookie_time);
	
	if ($page){
		drupal_goto("node/$page");
	}
	else {
		drupal_goto('<front>');
	}
	
}

//********************************************
// PRIMARY LINK MENU ITEM INFO
//********************************************

/**
 * Returns a rendered menu tree.
 *
 * @param $tree
 *   A data structure representing the tree as returned from menu_tree_data.
 * @return
 *   The rendered HTML of that data structure.
 */
function main_menu_tree_output($tree) {
  $output = '';
  $items = array();

  if( isset( $_COOKIE['affinity_menu_type'] ) )
	$this_mtype = $_COOKIE['affinity_menu_type']; 
  else
	$this_mtype = theme_get_setting('menu_type');
  // Pull out just the menu items we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
    
    $extra_class = NULL;
    //$extra_class = get_link_color($items[$i]['title']);
    
    if (stristr($i, 'active')) {
        $extra_class .= " active";
      }
    
    
    if ($i == 0) {
      //$extra_class = 'first';
    }
    if ($i == $num_items - 1) {
      //$extra_class = 'last';
    }
    $link = main_menu_item_link($data['link'], $data['link']['has_children']);
   
    if ($data['below']) {
      $extra_class = "parent ";
      if($this_mtype == "splitmenu") {
      	$output .= main_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
      }	
      else {	
      	$output .= main_menu_item($link, $data['link']['has_children'], sub_menu_tree_output($data['below']), $data['link']['in_active_trail'], $extra_class);
      }
    }
    
    else {
      $output .= main_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
    }
  }
  return $output ? main_menu_tree($output) : '';
}



function sub_menu_tree_output($tree) {
  $output = '';
  $items = array();

  // Pull out just the menu items we are going to render so that we
  // get an accurate count for the first/last classes.
  foreach ($tree as $data) {
    if (!$data['link']['hidden']) {
      $items[] = $data;
    }
  }

  $num_items = count($items);
  foreach ($items as $i => $data) {
    
    $extra_class = NULL;
    //$extra_class = get_link_color($items[$i]['title']);
    
    if (stristr($i, 'active')) {
        $extra_class .= " active";
      }
    
    
    if ($i == 0) {
      //$extra_class = 'first';
    }
    if ($i == $num_items - 1) {
      //$extra_class = 'last';
    }
    $link = sub_menu_item_link($data['link'], $data['link']['has_children']);
    if ($data['below']) {
      $extra_class = " parent ";
      $output .= sub_menu_item($link, $data['link']['has_children'], sub_menu_tree_output($data['below']), $data['link']['in_active_trail'], $extra_class);
    }
    else {
      $output .= sub_menu_item($link, $data['link']['has_children'], '', $data['link']['in_active_trail'], $extra_class);
    }
  }
  return $output ? sub_menu_tree($output) : '';
}

/**
 * FULL MENU TREE
 */
function main_menu_tree($tree) {
  	return '<ul class="menutop">'. $tree .'</ul>';
}

/**
 * SUB MENU TREE
 */
function sub_menu_tree($tree) {
  	return '<div class="drop-wrap columns-' . theme_get_setting(menu_columns) . '"><div class="png drop1"><div class="drop2"><div class="drop3"></div></div></div><ul class="png columns-' . theme_get_setting(menu_columns) . '">'. $tree .'</ul></div>';
}

function affinity_more_link($url, $title) {

  return '<div class="clr"></div><div class="readon-wrap1"><div class="readon1-l"></div><a class="readon-main" href="' . check_url($url) . '"><span class="readon1-m"><span class="readon1-r">Read More</span></span></a></div><div class="clr"></div>';
}







/**
  * MENU ITEM 
 */
function main_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  //$class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  $class = "item1";
  $id = "";
  if (!empty($extra_class)) {
    $class .= " " . $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active';
    $id .= 'current';
  }
  return '<li class="'. $class .'" id="' . $id . '">'. $link . $menu . "</li>\n";
}

/**
  * SUB MENU ITEM 
 */
function sub_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  //$class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  $class = "";
  if (!empty($extra_class)) {
    $class .= $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active';
  }
  return '<li class="'. $class .' coltop">'. $link . $menu . "</li>\n";
}


/**
 * Generate the HTML output for a single menu link.
 *
 * @ingroup themeable
 */
function main_menu_item_link($link, $has_children = FALSE) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if(strlen(strstr($link['href'],"http"))>0) {
  	$href = $link['href'];	
  }
  else {
  	if(variable_get('clean_url', 0)) {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . drupal_get_path_alias($link['href']);
  	}
  	else {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . "?q=" . drupal_get_path_alias($link['href']);
  	}
  }
  $this_link = "<a class='topdaddy link' href='" . $href . "'><span>" . $link['title'] . "</span></a>"; 	
  //return l($link['title'], $link['href'], $link['localized_options']);
  return $this_link;
}

function sub_menu_item_link($link, $has_children = FALSE) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }
  if(strlen(strstr($link['href'],"http"))>0) {
  	$href = $link['href'];	
  }
  else {
  	if(variable_get('clean_url', 0)) {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . drupal_get_path_alias($link['href']);
  	}
  	else {
  		$href = $link['href'] == "<front>" ? base_path() : base_path() . "?q=" . drupal_get_path_alias($link['href']);
  	}
  }	
  
  $class = "";
  
  if($has_children) {
  	$class .= "daddy ";
  }
  
  $class .= "link";
  
  $this_link = "<a class='" . $class . "' href='" . $href . "'><span>" . $link['title'] . "</span></a>"; 	
  //return l($link['title'], $link['href'], $link['localized_options']);
  return $this_link;
}


//******************************************************************************




/**
 * Sets the body-tag class attribute.
 <body id="ff-<?php echo $fontfamily; ?>" class="<?php echo $fontstyle; ?> <?php echo $tstyle; ?> iehandle">
 */
//function affinity_body_class($body_style_variation, $header_footer_variation) {
function affinity_body_class() {
	
	if( isset( $_COOKIE['affinity_fontfamily'] ) )
		$this_fontfamily = $_COOKIE['affinity_fontfamily']; 
	else
		$this_fontfamily = theme_get_setting('font_family');
		
	if( isset( $_COOKIE['affinity_fontsize'] ) )
		$this_fontsize = $_COOKIE['affinity_fontsize']; 
	else
		$this_fontsize = theme_get_setting('default_font');
	
	if( isset( $_COOKIE['affinity_style'] ) )
		$this_style = $_COOKIE['affinity_style']; 
	else
		$this_style = theme_get_setting('default_style');
	
	$id = 'ff-' . $this_fontfamily;	
	$class = 'f-' . $this_fontsize . ' ' . $this_style;	
	$class .= ' iehandle';
	
  print ' id="' . $id . '"' .  ' class="' . $class . '"';

}


/**
* Implementation of hook_theme.
*
* Register custom theme functions.
*/
function affinity_theme() {
  return array(
    // The form ID.
    'user_login_block' => array(
      // Forms always take the form argument.
      'arguments' => array('form' => NULL),
    ),
	'user_login_top_section' => array(
    // Forms always take the form argument.
    'arguments' => array(),
  ),
  );
}


function affinity_user_login_block($form) {
  $form['name']['#title'] = t(''); //wrap any text in a t function
  $form['name']['#value'] = t('Username');
  $form['pass']['#title'] = t('');
  $form['submit']['#title'] = t('submit');  
  //unset($form['links']['#value']); //remove links under fields
  return (drupal_render($form));
}

/*
function affinity_user_login_block(&$form){

	$form['links'] = array('#value' => '<div id="sl_lostpass"><a href="/user/password">Request new password</a></div>');

	return drupal_render($form);
	
}
*/

function affinity_button($element) {
  // Make sure not to overwrite classes.
  if (isset($element['#attributes']['class'])) {
    $element['#attributes']['class'] = 'Button form-' . $element['#button_type'] . ' ' . $element['#attributes']['class'];
  }
  else {
    $element['#attributes']['class'] = 'Button form-' . $element['#button_type'];
  }

  // Skip admin pages due to some issues with ajax not being able to find buttons.
  if (arg(0) == 'admin') {
    //return '<input type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name'] .'" ') .'id="'. $element['#id'] .'" value="'. check_plain($element['#value']) .'" '. drupal_attributes($element['#attributes']) ." />\n";
  }
  
  if ($element['#value'] == 'Search') {
    return '<input type="submit" '. (empty($element['#name']) ? '' : 'name="'. $element['#name'] .'" ') .'id="'. $element['#id'] .'" value="'. check_plain($element['#value']) .'" '. drupal_attributes($element['#attributes']) ." />\n";
  }

  return '<button type="submit" ' . (empty($element['#name']) ? '' : 'name="' . $element['#name']
         . '" ')  . 'id="' . $element['#id'] . '" value="' . check_plain($element['#value']) . '" ' . drupal_attributes($element['#attributes']) . '>'
         
         /*
         . '<span class="btn">'
         . '<span class="l"></span>'
         . '<span class="r"></span>'
         . '<span class="t">' . check_plain($element['#value']) . '</span>'
         . '</span></button>';
         */
         
        . '<div class="readon-wrap1"><div class="readon1-l"></div><a class="readon-main"><span class="readon1-m"><span class="readon1-r">'  . check_plain($element['#value']) .  '</span></span></a></div>'
		. '</button>';

}




function affinity_get_theme_headers($theme){
	
	$themes = array (
		2 => 10,
		3 => 2,
		6 => 3
	);

	return $themes[$theme];
	
}



/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
 /*
function affinity_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
		$breadcrumb[$_GET['q']] = drupal_get_title(); 
    return '<span class="breadcrumbs pathway">'. implode('<img src="/jul09/templates/rt_affinity_j15/images/arrow.png" />', $breadcrumb) .'</span>';
  }
}
*/

function affinity_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
	$breadcrumb_new = array();
	// Create new breadcrumb array without the top level image gallery link
	foreach ($breadcrumb as $crumb) {
		if (strstr($crumb, '<a href="/image">') != TRUE) {
			$breadcrumb_new[] = $crumb;
		}
	}
	$breadcrumb_new[] = '<span class="no-link">'. drupal_get_title() .'</span>';

	return '<span class="breadcrumbs pathway">' . implode('<img src="' . base_path() . path_to_theme() .  '/images/arrow.png" alt="" />', $breadcrumb_new) . '</span>';

  }
}

/**
 * Allow themable wrapping of all comments.
 */
function affinity_comment_wrapper($content, $node) {
  if (!$content || $node->type == 'forum') {
    return '<div id="comments">'. $content .'</div>';
  }
  else {
    return '<div id="comments"><h2 class="comments">'. t('Comments') .'</h2>'. $content .'</div>';
  }
}



/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function affinity_menu_local_tasks() {
  return menu_primary_local_tasks();
}

function affinity_comment_submitted($comment) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}

function affinity_node_submitted($node) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}