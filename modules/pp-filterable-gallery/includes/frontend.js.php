
;(function($) {

	<?php if($settings->click_action == 'lightbox') : ?>
	<?php if($settings->gallery_layout == 'masonry') {
			$selector = '.pp-masonry-content'; ?>
		<?php } else {
			$selector = '.pp-photo-gallery'; ?>
		<?php } ?>
		var gallery_selector = $( '.fl-node-<?php echo $id; ?> <?php echo $selector; ?>' );
		if( gallery_selector.length && typeof $.fn.magnificPopup !== 'undefined') {
			gallery_selector.magnificPopup({
				delegate: '.pp-gallery-item:visible .pp-photo-gallery-content a',
				closeBtnInside: true,
				type: 'image',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
				},
				'image': {
					titleSrc: function(item) {
						<?php if($settings->show_captions == 'below') : ?>
							return item.el.parent().next('.fl-node-<?php echo $id; ?> .pp-photo-gallery-caption').html();
						<?php elseif($settings->show_captions == 'hover') : ?>
							return item.el.next('.fl-node-<?php echo $id; ?> .pp-photo-gallery-caption').html();
						<?php endif; ?>
					}
				},
				mainClass: 'mfp-<?php echo $id; ?>'
			});
		}
	<?php endif; ?>

	var options = {
		id: '<?php echo $id ?>',
		layout: '<?php echo $settings->gallery_layout; ?>',
		masonry: 'yes'
	};

	new PPFilterableGallery(options);

	// expandable row fix.
	var state = 0;
	$(document).on('pp_expandable_row_toggle', function(e, selector) {
		if ( selector.is('.pp-er-open') && state === 0 ) {
			new PPFilterableGallery(options);
			state = 1;
		}
	});

})(jQuery);
