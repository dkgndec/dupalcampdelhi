
<?php if($thisTitle != "") : ?>
<div class="side-mod">
	<div class="module-header"><div class="module-header2"><div class="module-header3"><h3 class="module-title"><?php echo $thisTitle; ?> Menu</h3></div></div></div>        									
	<div class="module">
	<?php
		
		foreach($menus as $menu) {
		    if(!empty($menu['link']['in_active_trail']))
		        echo menu_tree_output($menu['below']);
		}
	?>
	</div>
</div>
<?php endif; ?>