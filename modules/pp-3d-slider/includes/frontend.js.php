(function ($) {
    <?php if ( 'yes' == $settings->autoplay ) { ?>
        $( '.fl-node-<?php echo $id; ?> .pp-3d-slider' ).gallery({ autoplay : true, interval : <?php echo $settings->autoplay_interval * 1000; ?> });
    <?php } else { ?>
        $( '.fl-node-<?php echo $id; ?> .pp-3d-slider' ).gallery();
	<?php } ?>

	<?php if ( 'yes' == $settings->lightbox ) { ?>
		var slide_selector = $( '.fl-node-<?php echo $id; ?> .pp-slider-wrapper' );
		if( slide_selector.length && typeof $.fn.magnificPopup !== 'undefined') {
			slide_selector.magnificPopup({
				delegate: 'a',
				closeBtnInside: true,
				type: 'image',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
				},
				mainClass: 'mfp-<?php echo $id; ?>'
			});
		}
	<?php } ?>
	
})(jQuery);
