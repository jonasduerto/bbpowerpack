;(function($) {

	$(".fl-node-<?php echo $id; ?> .pp-photo-gallery-item, .fl-node-<?php echo $id; ?> .pp-gallery-masonry-item").find('.pp-photo-gallery-caption-below').parent().addClass('has-caption');

	<?php
	$row_height = '' == $settings->row_height ? 0 : $settings->row_height;
	$max_row_height = '' == $settings->max_row_height ? $row_height : $settings->row_height;
	?>

	var options = {
		id: '<?php echo $id ?>',
		layout: '<?php echo $settings->gallery_layout; ?>',
		spacing: <?php echo '' == $settings->justified_spacing ? 0 : $settings->justified_spacing; ?>,
		rowHeight: <?php echo $row_height; ?>,
		maxRowHeight: <?php echo $max_row_height; ?>,
		lastRow: '<?php echo $settings->last_row; ?>',
		lightbox: <?php echo 'lightbox' == $settings->click_action ? 'true' : 'false'; ?>,
		lightboxThumbs: <?php echo 'yes' == $settings->show_lightbox_thumb ? 'true' : 'false'; ?>,
	};

	new PPGallery(options);

	// expandable row fix.
	var state = 0;
	$(document).on('pp_expandable_row_toggle', function(e, selector) {
		if ( selector.is('.pp-er-open') && state === 0 ) {
			new PPGallery(options);
			state = 1;
		}
	});
})(jQuery);
