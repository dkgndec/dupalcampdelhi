<div class="block">
<div class="moduletable">

	<?php if ($block->subject) : ?>
		<div class="module-header"><div class="module-header2"><div class="module-header3"><h3 class="module-title"><?php print $block->subject; ?></h3></div></div></div>
	<?php endif; ?>
	<div class="module">
		<?php print $block->content; ?>
	</div>

</div>
</div>
