
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php print $head_title ?></title>
		<?php
				$rt_utils_includes = path_to_theme() . "/rt_utils.php";
				include $rt_utils_includes;
				$style_switcher = path_to_theme() . "/rt_styleswitcher.php";
				include $style_switcher;
		?>
		<?php print $head ?>
		<?php print $styles ?>		
		<?php print $scripts ?>
		
		<?php
			$head_includes = path_to_theme() . "/rt_head_includes.php";
			include $head_includes;
		?>	
		
		<?php
			if (isset($_GET['tstyle']) ) {
				$change = "tstyle";
				$styleVar = $_GET['tstyle'];
				affinity_change_theme($change, $styleVar);
			}
		?>
		
		<link href="<?php echo base_path() . path_to_theme(); ?>/css/general.css" rel="stylesheet" type="text/css" />
		
		
		<!--[if IE 8]>
		<link href="<?php echo base_path() . path_to_theme(); ?>/css/template_ie8.css" rel="stylesheet" type="text/css" />	
		<![endif]-->
		
		<!--[if IE 7]>
		<link href="<?php echo base_path() . path_to_theme(); ?>/css/template_ie7.css" rel="stylesheet" type="text/css" />	
		<![endif]-->	
		
		<!--[if lte IE 6]>
		<link href="<?php echo base_path() . path_to_theme(); ?>/css/template_ie6.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_path() . path_to_theme(); ?>/js/DD_belatedPNG.js"></script>
		<script type="text/javascript">
			var pngClasses = ['.png', '.roksearch_wrapper1', '.roksearch_wrapper2', '.feature-arrow-l', '.feature-arrow-r', '.feature-block-tl', '.feature-block-tr', '.feature-block-bl', '.feature-block-br', '.rokstories-tip', '.feature-block-title2', '.feature-block-title3', '.roksearch_odd', '.roksearch_even'];
			
			pngClasses.each(function(fixMePlease) {
				DD_belatedPNG.fix(fixMePlease);
			});
		</script>
		<![endif]-->
		


		
	</head>
	<body id="ff-<?php echo $affinity_fontfamily; ?>" class="f-<?php echo $affinity_defaultfont; ?> <?php echo $affinity_style; ?> iehandle">

		<!--Begin Top Bar-->
		<?php if (theme_get_setting(show_date) or theme_get_setting(show_textsizer) or $top_left or $login or $top_right): ?>
		<div id="top-bar">
			<div class="wrapper">
				<div class="top-bar-padding">
					<div class="topbar-strip">
						<?php if (theme_get_setting(show_date)) : ?>
						<div class="date-block">
							<?php echo date("l, F j, Y"); ?>
							<!--
							<span class="date1"><?php //$now = &JFactory::getDate(); echo $now->toFormat('%A'); ?></span>,
							<span class="date2"><?php //$now = &JFactory::getDate(); echo $now->toFormat('%B'); ?></span>
							<span class="date3"><?php //$now = &JFactory::getDate(); echo $now->toFormat('%d'); ?></span>,
							<span class="date4"><?php //$now = &JFactory::getDate(); echo $now->toFormat('%Y'); ?></span>
							-->
						</div>
						<?php endif; ?>
						<?php if (theme_get_setting(show_textsizer)) : ?>
						<div id="accessibility">
							<div id="buttons">
								<a href="?fontsize=larger&page=<?php print arg(1); ?>" title="" class="large"><span class="button png">&nbsp;</span></a>
								<a href="?fontsize=smaller&page=<?php print arg(1); ?>" title="" class="small"><span class="button png">&nbsp;</span></a>
							</div>
							<div class="textsizer-desc">Text Size</div>
						</div>
						<?php endif; ?>
						
						<?php if (!$user->uid) : ?>
						<a href="?q=user" id="lock-button"><span id="lock-icon" class="login"></span><span>Login</span></a>
						<?php else : ?>
						<a href="?q=logout" id="lock-button"><span id="lock-icon"></span><span>Logout</span></a>
						<?php endif; ?>
						
					</div>
					<?php if ($top_left) : ?>
					<div class="topbar-left-mod">
						<?php print $top_left; ?>
					</div>
					<?php endif; ?>
					<?php if ($top_right) : ?>
					<div class="topbar-right-mod">
						<?php print $top_right; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<!--End Top Bar-->
		<!--Begin Header-->
		<div id="header">
			<div id="header-overlay">
				<div class="wrapper">
					<?php if ($logo_region) : ?>
						<div class="logo-module"><?php print $logo_region; ?></div>
					<?php elseif ($logo) : ?>
						<a href="<?php echo check_url($front_page); ?>" id="logo" class="png"></a>
					<?php endif; ?>
					
					<?php if ($search) : ?>
						<?php print $search; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!--End Header-->
		<div id="page-bg"><div id="page-bg2">
			<div class="wrapper">
				<!--Begin Horizontal Menu-->
				<?php if($affinity_menu_type != "none") : ?>
					<div id="horiz-menu" class="<?php echo $affinity_menu_type; ?>"><div id="horiz-menu2"><div id="horiz-menu3">
				<?php if($affinity_menu_type != "module") : ?>
					<?php
						$tree = menu_tree_page_data('primary-links');  
						$main_menu = main_menu_tree_output($tree, 1);
					   	print $main_menu;	
					?>
				<?php else: ?>
					<?php print $toolbar; ?>
				<?php endif; ?>
				<div class="clr"></div>
				</div></div></div>
				<?php endif; ?>
				<!--End Horizontal Menu-->
				<div id="vertical-sort">
				
					<!--echo $section_rows->render();-->
					
					<!-- Showcase -->
					<?php if($showcase) : ?>
						
						<div id="section-row1" class="section-row">
							<div id="showcase-surround">
								<div id="showcase" class="png"><div id="showcase2" class="png"><div id="showcase3" class="png">
									<div class="showcase-inner">
										<div id="showmodules" class="spacer <?php echo $showcase_width; ?>">
											<?php print $showcase; ?>
										</div>
									</div>
								</div></div></div>
							</div>
						</div>
						
					<?php endif; ?>
					<!-- End Showcase -->
					
					<!-- User 123 -->
					<div id="section-row2" class="section-row">
						<div id="mainmodules" class="spacer <?php echo $user123_width; ?>">
							<?php print $user123; ?>
						</div>
					</div>
					<!-- End User 123 -->
					
					<div id="section-row3" class="section-row">
					<div id="section-row3-inner">
					<div id="main-body-surround" class="spacer">
					
					<div id="main-body" class="spacing">
						<div class="module-<?php echo theme_get_setting(mainbody_color); ?>">
						
							<div class="body-surround-top"><div class="body-surround-top2"><div class="body-surround-top3"></div></div></div>

							<div class="body-surround"><div class="body-surround2"><div class="body-surround3">

							
							<div id="main-content">
						
							<?php if ($current_leftcolumn_width != 0) : ?>
								<div id="maincol">
							<?php else: ?>
								<div id="maincol2">
							<?php endif; ?>
						
									<div class="maincol-padding">
						
										
										<?php if($main123) : ?>
							
											<div id="mainmodules2" class="spacer <?php echo $main123_width; ?>">
												<?php print $main123; ?>
											</div>
											
										<?php endif; ?>
						
										<?php if (theme_get_setting(show_breadcrumb)) : ?>
        									<div id="breadcrumbs"><div id="breadcrumbs2"><div id="breadcrumbs3">
        										<a href="<?php echo check_url($front_page); ?>" id="breadcrumbs-home"></a>
        										<?php print $breadcrumb; ?>
        									</div></div></div>
										<?php endif; ?>

									
							
			  							<div class="bodycontent">
											<div class="mainbody-surround">
												
												<!-- Print Section Heading -->
												<?php
													if (!$is_front) {
														
														if (arg(0) == 'aggregator') {
															echo "<h1 class='componentheading'><span class='bg'>News</span></h1>";
														}
														
														elseif (arg(0) == 'node' && arg(1)) {
															echo "<h2 class='contentheading'>" . $title . "</h2>";
														}
														else {
															echo "<h2 class='contentheading'>" . $title . "</h2>";
														}
													}
												?>
												<!--
												<?php if($inset2) : ?>
													<div id="inset-block-right"><div class="right-padding">
														<?php //print $inset2; ?>
													</div></div>
			   									<?php endif; ?>
						
												<?php if($inset) : ?>
			   										<div id="inset-block-left"><div class="left-padding">
														<?php //print $inset; ?>
			   										</div></div>
			   									<?php endif; ?>
												-->
						
			   									<div id="maincontent-block">
													<!-- Begin Messages -->
													<?php if ($messages and arg(0) == "admin"): ?>
														<div class="messages">
															<?php print $messages; ?>
														</div>
													<?php endif; ?>			
													<!-- End Messages -->

													<?php if($is_front AND theme_get_setting(frontpage_component)) : ?>
																	
														<!-- Begin Admin Tabs -->
														<?php if ($tabs): print '<ul class="primary png">' . $tabs .'</ul>'; print "<br>"; endif; ?>
														<?php if ($tabs2): print '<ul class="secondary">' . $tabs2 .'</ul>'; print "<br>"; endif; ?>
													  	<!-- End Admin Tabs -->
													  	
														<?php print $content; ?>
														<br /><br />
														
													<?php elseif(!$is_front) : ?>
														
														<!-- Begin Admin Tabs -->
														<?php if ($tabs): print '<ul class="primary png">' . $tabs .'</ul>'; print "<br>"; endif; ?>
														<?php if ($tabs2): print '<ul class="secondary">' . $tabs2 .'</ul>'; print "<br>"; endif; ?>
													  	<!-- End Admin Tabs -->
														
														<?php print $content; ?>
														
													<?php endif; ?>
						
						
			   									</div>
												<div class="mainbody-tl"></div><div class="mainbody-tr"></div><div class="mainbody-bl"></div><div class="mainbody-br"></div>
											</div>
			  							</div>	
							
													
							
										<?php if ($main456) : ?>
											<div id="mainmodules3" class="spacer <?php echo $main456_width; ?>">
												<?php print $main456; ?>
											</div>
										<?php endif; ?>
						
							
			  						</div>
			  					</div>    
							</div>
						
							<!-- Begin Left Column -->
						
							<?php if ($current_leftcolumn_width != 0) : ?>
								<div id="leftcol">
					                <div id="leftcol-bg">
										
										<?php if ($affinity_menu_type == "splitmenu" and theme_get_setting(splitmenu_col) == "leftcol") : ?>
											<?php include 'subnav.php'; ?>
        								<?php endif; ?>
							
										<?php print $left; ?>
							
					                </div>
								</div>
							<?php endif; ?>
							
							<!-- End Left Column -->
							
							
						
						
							<!--$tmp .= body_surround($t->joomla, $main);-->
			
							</div></div></div>
							
							<div class="body-surround-bottom"><div class="body-surround-bottom2"><div class="body-surround-bottom3"></div></div></div>

			
						</div><!-- module-light -->
						
							
		
					</div><!-- main-body -->
					
					<!-- Begin Right Column -->
							
							<?php if ($current_rightcolumn_width != 0) : ?>
				
								<div id="rightcol">
									<div class="rightcol-padding">
										<div class="module-<?php echo theme_get_setting(mainbody_color); ?>">
											<div class="body-surround-top"><div class="body-surround-top2"><div class="body-surround-top3"></div></div></div>
												<div class="body-surround"><div class="body-surround2"><div class="body-surround3">
													<?php if ($affinity_menu_type == "splitmenu" and theme_get_setting(splitmenu_col) == "rightcol") : ?>
														<?php include 'subnav.php'; ?>
			        								<?php endif; ?>
													
													<?php print $right; ?>
												
												</div></div></div>
											<div class="body-surround-bottom"><div class="body-surround-bottom2"><div class="body-surround-bottom3"></div></div></div>
										</div>
									</div>
									
								</div>
					
				
							<?php endif; ?>
						
							<!-- End Right Column -->
					
					</div></div></div>
					
					
					<!-- User 456 -->
					<div id="section-row4" class="section-row">
						<div id="mainmodules" class="spacer <?php echo $user456_width; ?>">
							<?php print $user456; ?>
						</div>
					</div>
					
					<!-- End User 456 -->
					
					
					<!-- User 789 -->
					<div id="section-row5" class="section-row">
						<div id="mainmodules" class="spacer <?php echo $user789_width; ?>">
							<?php print $user789; ?>
						</div>
					</div>
					
					<!-- End User 789 -->
					
				
				
				</div>
			</div>
			
			
			<!--Begin Bottom Section-->
			<div id="bottom-bg">
				<div class="wrapper">
					<?php if ($bottom_menu) : ?>
					<div id="bottom-menu"><div id="bottom-menu2"><div id="bottom-menu3"><div id="bottom-menu-overlay">
						<?php print $bottom_menu; ?>
					</div></div></div></div>
					<?php endif; ?>
					<?php if (theme_get_setting(show_topbutton)) : ?>
					<div id="top-button"><a href="#" id="top-scroll" class="top-button-desc">Top</a></div>
					<?php endif; ?>
				</div>
			</div>
			<?php if (theme_get_setting(show_copyright) or theme_get_setting(show_defaultsettings) or $footer or $bottom) : ?>
			<div id="bottom">
				<div class="wrapper">
					<?php if ($bottom) : ?>
					<div id="bottommodules" class="spacer <?php echo $bottom_width; ?>">
						<?php if ($bottom) : ?>
							<?php print $bottom; ?>
						<?php endif; ?>
						
					</div>
					<?php endif; ?>
					<?php if (theme_get_setting(show_copyright)) : ?>
					<div class="copyright-block">
						<div id="copyright">
							<?php print $copyright_block; ?>
							<!-- <a href="http://www.rockettheme.com/" title="RocketTheme" id="rocket"></a> -->
						</div>
						
					</div>
					<?php else: ?>
					<div class="footer-mod">
						<?php print $footer; ?>
					</div>
					<?php endif; ?>
					<?php if (theme_get_setting(show_defaultsettings)) : ?>
						<!--<a href="#" id="clear-cookies">Default Settings</a>-->
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			<!--End Bottom Section-->
		</div></div>
		<?php if ($debug) : ?>
		<div id="debug-mod">
			<?php print $debug; ?>
		</div>
		<?php endif; ?>
		<?php if ($login) : ?>
		<div id="login-module">
			<?php if (!$user->uid) : ?>
				<?php print $login; ?>
			<?php else : ?>
				<div class="logout">
					<?php print $login; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		
		<?php print $closure;?>
	</body>
</html>
