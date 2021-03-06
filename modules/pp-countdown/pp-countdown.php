<?php
/**
 * @class PPCountdownModule
 */
class PPCountdownModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __( 'Countdown', 'bb-powerpack' ),
			'description'   => __( 'A module for countdown.', 'bb-powerpack' ),
			'group'         	=> pp_get_modules_group(),
			'category'			=> pp_get_modules_cat( 'creative' ),
			'dir'           	=> BB_POWERPACK_DIR . 'modules/pp-countdown/',
			'url'           	=> BB_POWERPACK_URL . 'modules/pp-countdown/',
			'editor_export' => true, // Defaults to true and can be omitted.
			'enabled'       => true, // Defaults to true and can be omitted.
		));
	}

	public function enqueue_scripts() {
		$this->add_js( 'jquery-plugin' );
		$this->add_js( 'jquery-countdown' );
		$this->add_js( 'jquery-cookie' );
	}

	public function render_normal_countdown( $str1, $str2 ) {

		ob_start();

		?><div class="pp-countdown-item <?php echo $this->settings->block_style; ?>"><div class="pp-countdown-digit-wrapper <?php echo $this->settings->block_style; ?>"><<?php echo $this->settings->digit_tag; ?> class="pp-countdown-digit <?php echo $this->settings->block_style; ?>"><?php echo $str1; ?></<?php echo $this->settings->digit_tag; ?>></div><?php if( 'yes' == $this->settings->show_labels ) { ?><div class="pp-countdown-label-wrapper"><<?php echo $this->settings->label_tag; ?> class="pp-countdown-label <?php  echo $this->settings->block_style; ?>"><?php echo $str2; ?></<?php echo $this->settings->label_tag; ?>></div><?php } ?></div><?php

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function render_normal_above_countdown( $str1, $str2, $str3 ) {

		ob_start();

		?><div class="pp-countdown-item <?php echo $this->settings->block_style; ?>"><div class="pp-countdown-digit-wrapper <?php echo $this->settings->block_style; ?>"><?php if( 'yes' == $this->settings->show_labels ) { ?><div class="pp-countdown-label-wrapper"><<?php echo $this->settings->label_tag; ?> class="pp-countdown-label <?php echo $this->settings->block_style; ?>"><?php echo $str2; ?></<?php echo $this->settings->label_tag; ?>></div><?php } ?><<?php echo $this->settings->digit_tag; ?> class="pp-countdown-digit <?php echo $this->settings->block_style; ?>"><?php echo $str1; ?></<?php echo $this->settings->digit_tag; ?>></div><?php echo $str3; ?></div><?php

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function render_inside_below_countdown( $str1, $str2, $str3 ) {

		ob_start();

		?><div class="pp-countdown-item <?php echo $this->settings->block_style; ?>"><div class="pp-countdown-digit-wrapper <?php echo $this->settings->block_style; ?>"><div class="pp-countdown-digit-content"><<?php echo $this->settings->digit_tag; ?> class="pp-countdown-digit <?php echo $this->settings->block_style; ?>"><?php echo $str1; ?></<?php echo $this->settings->digit_tag; ?>></div><?php if( 'yes' == $this->settings->show_labels ) { ?><div class="pp-countdown-label-wrapper"><<?php echo $this->settings->label_tag; ?> class="pp-countdown-label <?php echo $this->settings->block_style; ?>"><?php echo $str2; ?></<?php echo $this->settings->label_tag; ?>></div><?php } ?></div><?php echo $str3; ?></div><?php

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function render_inside_above_countdown( $str1, $str2, $str3 ) {

		ob_start();

		?><div class="pp-countdown-item <?php echo $this->settings->block_style; ?>"><div class="pp-countdown-digit-wrapper <?php echo $this->settings->block_style; ?>"><?php if( 'yes' == $this->settings->show_labels ) { ?><div class="pp-countdown-label-wrapper"><<?php echo $this->settings->label_tag; ?> class="pp-countdown-label <?php echo $this->settings->block_style; ?>"><?php echo $str2; ?></<?php echo $this->settings->label_tag; ?>></div><?php } ?><<?php echo $this->settings->digit_tag; ?> class="pp-countdown-digit <?php echo $this->settings->block_style; ?>"><?php echo $str1; ?></<?php echo $this->settings->digit_tag; ?>></div><?php echo $str3; ?></div><?php

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function render_outside_countdown( $str1, $str2, $str3 ) {

		ob_start();

		?><div class="pp-countdown-item <?php echo $this->settings->block_style; ?>"><?php if( 'yes' == $this->settings->show_labels ) { ?><div class="pp-countdown-label-wrapper"><<?php echo $this->settings->label_tag; ?> class="pp-countdown-label <?php echo $this->settings->block_style; ?>"><?php echo $str2; ?></<?php echo $this->settings->label_tag; ?>></div><?php } ?><div class="pp-countdown-digit-wrapper <?php echo $this->settings->block_style; ?>"><<?php echo $this->settings->digit_tag; ?> class="pp-countdown-digit <?php echo $this->settings->block_style; ?>"><?php echo $str1; ?></<?php echo $this->settings->digit_tag; ?>></div><?php echo $str3; ?></div><?php

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	public function get_gmt_difference() {

		$timezone = get_option('timezone_string');

		if( ! empty( $timezone ) ) {

            $time_zone_kolkata = new DateTimeZone("Asia/Kolkata");
            $time_zone = new DateTimeZone($timezone);

            $time_kolkata = new DateTime("now", $time_zone_kolkata);

            $timeOffset = $time_zone->getOffset($time_kolkata);

            return $timeOffset / 3600;
        }
        else {
            return "NULL";
		}
		
	}
}
?>
<?php
/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPCountdownModule', array(
	'general'       => array( // Tab
		'title'         => __( 'General', 'bb-powerpack' ), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'timer_type'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Timer Type', 'bb-powerpack' ),
						'default'       => 'fixed',
						'options'       => array(
							'fixed'      	=> __( 'Fixed', 'bb-powerpack' ),
							'evergreen'     => __( 'Evergreen', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'fixed'	=> array(
								'fields'	=> array( 'fixed_date', 'fixed_timer_action' ),
							),
							'evergreen'	=> array(
								'fields'	=> array( 'evergreen_date', 'evergreen_timer_action' ),
							),
						),
					),
					'fixed_date' => array(
						'type'          => 'pp-normal-date',
						'label'         => __( 'Select Date & Time', 'bb-powerpack' ),
						'default'       => '',
					),
					'evergreen_date' => array(
						'type'          => 'pp-evergreen-date',
						'label'         => __( 'Expire Countdown In', 'bb-powerpack' ),
						'default'       => '',
					),
				),
			),
			'actions'	=> array(
				'title'		=> __('Action', 'bb-powerpack'),
				'fields'	=> array(
					'fixed_timer_action'   => array(
						'type'          => 'select',
						'label'         => __( 'Action after time expires', 'bb-powerpack' ),
						'default'       => 'none',
						'options'       => array(
							'none'      	=> __( 'None', 'bb-powerpack' ),
							'hide'     		=> __( 'Hide Timer', 'bb-powerpack' ),
							'msg'     		=> __( 'Display Message', 'bb-powerpack' ),
							'redirect'     	=> __( 'Redirect to URL', 'bb-powerpack' ),
						),
						'preview'		=> array(
							'type'			=> 'none'
						)
					),
					'evergreen_timer_action'       => array(
						'type'          => 'select',
						'label'         => __( 'Action After Timer Expires', 'bb-powerpack' ),
						'default'       => 'none',
						'class'         => '',
						'options'       => array(
							'none'			=> __( 'None', 'bb-powerpack' ),
							'hide'          => __( 'Hide Timer', 'bb-powerpack' ),
							'reset'         => __( 'Reset Timer', 'bb-powerpack' ),
							'msg'         	=> __( 'Display Message', 'bb-powerpack' ),
							'redirect'     	=> __( 'Redirect to URL', 'bb-powerpack' ),
						),
						'preview'		=> array(
							'type'			=> 'none'
						)
					),
					'expire_message' => array(
						'type'          => 'textarea',
						'label'         => __('Message', 'bb-powerpack'),
						'default'       => '',
						'placeholder'   => '',
						'rows'          => 5,
					),
					'redirect_link'          => array(
						'type'          => 'link',
						'label'         => __( 'Link', 'bb-powerpack' ),
						'preview'       => array(
							'type'            => 'none',
						),
					),
					'redirect_link_target'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Link Target', 'bb-powerpack' ),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __( 'Same Window', 'bb-powerpack' ),
							'_blank'        => __( 'New Window', 'bb-powerpack' ),
						),
						'preview'         => array(
							'type'            => 'none',
						),
					),
				)
			),
			'timer_structure'	=> array(
				'title'			=> __( 'Structure', 'bb-powerpack' ),
				'fields'		=> array(
					'show_labels'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show Labels', 'bb-powerpack' ),
						'default'       => 'yes',
						'options'       => array(
							'yes'         => __( 'Yes', 'bb-powerpack' ),
							'no'          => __( 'No', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'yes'	=> array(
								'sections'	=> array( 'label_style', 'label_typography' ),
								'fields'	=> array( 'digit_label_spacing' ),
							),
						),
					),
					'field_separator_1'	=> array(
						'type'		=> 'pp-separator',
						'color'		=> 'e6eaed'
					),
					'show_year'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show Years', 'bb-powerpack' ),
						'default'       => 'Y',
						'options'       => array(
							'Y'         => __( 'Yes', 'bb-powerpack' ),
							''          => __( 'No', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'Y'	=> array(
								'fields'	=> array( 'year_label_plural', 'year_label_singular' ),
							),
						),
					),
					'year_label_plural'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Plural', 'bb-powerpack' ),
						'placeholder'   => __( 'Years', 'bb-powerpack' ),
						'description'   => '',
					),
					'year_label_singular'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Singular', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Year', 'bb-powerpack' ),
					),
					'field_separator_2'	=> array(
						'type'		=> 'pp-separator',
						'color'		=> 'e6eaed'
					),

					// Months
					'show_month'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show Months', 'bb-powerpack' ),
						'default'       => 'O',
						'options'       => array(
							'O'         => __( 'Yes', 'bb-powerpack' ),
							''          => __( 'No', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'O'	=> array(
								'fields'	=> array( 'month_label_plural', 'month_label_singular' ),
							),
						),
					),
					'month_label_plural'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Plural', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Months', 'bb-powerpack' ),
					),
					'month_label_singular'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Singular', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Month', 'bb-powerpack' ),
					),
					'field_separator_3'	=> array(
						'type'		=> 'pp-separator',
						'color'		=> 'e6eaed'
					),

					// Days
					'show_day'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show Days', 'bb-powerpack' ),
						'default'       => 'D',
						'options'       => array(
							'D'         => __( 'Yes', 'bb-powerpack' ),
							''          => __( 'No', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'D'	=> array(
								'fields'	=> array( 'day_label_plural', 'day_label_singular' ),
							),
						),
					),
					'day_label_plural'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Plural', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Days', 'bb-powerpack' ),
					),
					'day_label_singular'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Singular', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Day', 'bb-powerpack' ),
					),
					'field_separator_4'	=> array(
						'type'		=> 'pp-separator',
						'color'		=> 'e6eaed'
					),

					// Hours
					'show_hour'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show Hours', 'bb-powerpack' ),
						'default'       => 'H',
						'options'       => array(
							'H'         => __( 'Yes', 'bb-powerpack' ),
							''          => __( 'No', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'H'	=> array(
								'fields'	=> array( 'hour_label_plural', 'hour_label_singular' ),
							),
						),
					),
					'hour_label_plural'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Plural', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Hours', 'bb-powerpack' ),
					),
					'hour_label_singular'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Singular', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Hour', 'bb-powerpack' ),
					),
					'field_separator_5'	=> array(
						'type'		=> 'pp-separator',
						'color'		=> 'e6eaed'
					),

					// Minutes
					'show_minute'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show Minutes', 'bb-powerpack' ),
						'default'       => 'M',
						'options'       => array(
							'M'         => __( 'Yes', 'bb-powerpack' ),
							''          => __( 'No', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'M'	=> array(
								'fields'	=> array( 'minute_label_plural', 'minute_label_singular' ),
							),
						),
					),
					'minute_label_plural'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Plural', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Minutes', 'bb-powerpack' ),
					),
					'minute_label_singular'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Singular', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Minute', 'bb-powerpack' ),
					),
					'field_separator_6'	=> array(
						'type'		=> 'pp-separator',
						'color'		=> 'e6eaed'
					),

					// Seconds
					'show_second'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show Seconds', 'bb-powerpack' ),
						'default'       => 'S',
						'options'       => array(
							'S'         => __( 'Yes', 'bb-powerpack' ),
							''          => __( 'No', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'S'	=> array(
								'fields'	=> array( 'second_label_plural', 'second_label_singular' ),
							),
						),
					),
					'second_label_plural'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Plural', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Seconds', 'bb-powerpack' ),
					),
					'second_label_singular'   => array(
						'type'          => 'text',
						'label'         => __( 'Label in Singular', 'bb-powerpack' ),
						'description'   => '',
						'placeholder'   => __( 'Second', 'bb-powerpack' ),
					),
				),
			),
		),
	),
	'style'	=> array(
		'title'	=> __( 'Style', 'bb-powerpack' ),
		'sections'	=> array(
			'general_style'	=> array(
				'title'	=> '',
				'fields'	=> array(
					'counter_alignment'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Alignment', 'bb-powerpack' ),
						'default'       => 'center',
						'options'       => array(
							'left'         => __( 'Left', 'bb-powerpack' ),
							'center'       => __( 'Center', 'bb-powerpack' ),
							'right'        => __( 'Right', 'bb-powerpack' ),
						),
					),
					'responsive_counter_alignment'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Responsive Alignment', 'bb-powerpack' ),
						'default'       => 'default',
						'options'       => array(
							'default'      => __( 'Default', 'bb-powerpack' ),
							'left'         => __( 'Left', 'bb-powerpack' ),
							'center'       => __( 'Center', 'bb-powerpack' ),
							'right'        => __( 'Right', 'bb-powerpack' ),
						),
					),
					'digit_label_spacing'   => array(
						'type'          => 'text',
						'label'         => __( 'Space between label & digit', 'bb-powerpack' ),
						'description'   => 'px',
						'placeholder'	=> __( '10', 'bb-powerpack' ),
						'size'			=> 5,
					),
					'block_spacing'   => array(
						'type'          => 'text',
						'label'         => __( 'Space between blocks', 'bb-powerpack' ),
						'description'   => 'px',
						'placeholder'	=> __( '10', 'bb-powerpack' ),
						'help'			=> __( 'This option controls the left-right spacing of each countdown block.', 'bb-powerpack' ),
						'size'			=> 5,
					),
				),
			),
			'separator_style'    => array(
				'title'         => __( 'Separator', 'bb-powerpack' ),
				'fields'        => array(
					'show_separator' => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Show separator between blocks', 'bb-powerpack' ),
						'default'       => 'no',
						'options'       => array(
							'yes'			=> __( 'Yes', 'bb-powerpack' ),
							'no'			=> __( 'No', 'bb-powerpack' ),
						),
						'toggle'		=> array(
							'yes'			=> array(
								'fields'		=> array( 'separator_type', 'separator_color', 'hide_separator' ),
							),
						),
					),
					'separator_type' => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Separator Type', 'bb-powerpack' ),
						'default'       => 'line',
						'options'       => array(
							'colon'			=> __( 'Colon', 'bb-powerpack' ),
							'line'			=> __( 'Line', 'bb-powerpack' ),
						),
						'toggle'		=> array(
							'colon'			=> array(
								'fields'		=> array( 'separator_size' ),
							),
						),
					),
					'separator_color'   => array(
						'type'          => 'color',
						'label'         => __( 'Separator Color', 'bb-powerpack' ),
						'show_reset'    => true,
						'show_alpha'    => true,
					),
					'separator_size' => array(
						'type'          => 'text',
						'label'         => __( 'Separator Size', 'bb-powerpack' ),
						'default'       => '15',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					),
					'hide_separator' => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Hide on mobile', 'bb-powerpack' ),
						'default'       => 'no',
						'options'       => array(
							'yes'			=> __( 'Yes', 'bb-powerpack' ),
							'no'			=> __( 'No', 'bb-powerpack' ),
						),
					),
				),
			),
			'block_style'	=> array(
				'title'			=> __( 'Blocks', 'bb-powerpack' ),
				'fields'		=> array(
					'block_style'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Style', 'bb-powerpack' ),
						'default'       => 'default',
						'options'       => array(
							'default'       => __( 'Default', 'bb-powerpack' ),
							'circle'		=> __( 'Circle', 'bb-powerpack' ),
							'square'        => __( 'Square', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'default'	=> array(
								'fields'	=> array( 'default_position' ),
							),
							'circle'	=> array(
								'fields'	=> array( 'block_bg_type', 'block_width', 'block_border_style', 'block_border_width', 'block_border_color', 'show_block_shadow', 'label_position' ),
							),
							'square'	=> array(
								'fields'	=> array( 'block_bg_type', 'block_width', 'block_border_style', 'block_border_width', 'block_border_color', 'show_block_shadow', 'label_position', 'block_border_radius' ),
							),
						),
					),
					'block_width'   => array(
						'type'          => 'text',
						'label'         => __( 'Width', 'bb-powerpack' ),
						'description'   => 'px',
						'placeholder'	=> __( '100', 'bb-powerpack' ),
						'size'			=> 5,
					),
					'block_bg_type'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Background Type', 'bb-powerpack' ),
						'default'       => 'solid',
						'options'       => array(
							'solid'        	=> __( 'Solid', 'bb-powerpack' ),
							'gradient'		=> __( 'Gradient', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'solid'		=> array(
								'fields'	=> array( 'block_bg_color', 'block_bg_color_opc' ),
							),
							'gradient'	=> array(
								'fields'	=> array( 'block_primary_color', 'block_secondary_color', 'block_bg_color_opc' ),
							),
						),
					),
					'block_bg_color'    => array(
						'type'          => 'color',
						'label'         => __( 'Background Color', 'bb-powerpack' ),
						'default'       => 'eaeaea',
						'show_reset'    => true,
					),
					'block_primary_color'    => array(
						'type'          => 'color',
						'label'         => __( 'Primary Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true,
					),
					'block_secondary_color'    => array(
						'type'          => 'color',
						'label'         => __( 'Secondary Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true,
					),
					'block_bg_color_opc'   => array(
						'type'          => 'text',
						'label'         => __( 'Background Opacity', 'bb-powerpack' ),
						'description'   => '%',
						'default'		=> '',
						'size'			=> 5,
					),
					'block_border_radius'   => array(
						'type'          => 'text',
						'label'         => __( 'Round Corners', 'bb-powerpack' ),
						'description'   => 'px',
						'placeholder'	=> __( '5', 'bb-powerpack' ),
						'size'			=> 5,
					),
					'block_border_style'   => array(
						'type'          => 'pp-switch',
						'label'         => __( 'Border Style', 'bb-powerpack' ),
						'default'       => 'solid',
						'options'       => array(
							'solid'        	=> __( 'Solid', 'bb-powerpack' ),
							'dashed'       	=> __( 'Dashed', 'bb-powerpack' ),
							'dotted'        => __( 'Dotted', 'bb-powerpack' ),
						),
					),
					'block_border_width'   => array(
						'type'          => 'text',
						'label'         => __( 'Border Width', 'bb-powerpack' ),
						'description'   => 'px',
						'placeholder'	=> __( '5', 'bb-powerpack' ),
						'size'			=> 5,
					),
					'block_border_color'    => array(
						'type'          => 'color',
						'label'         => __( 'Border Color', 'bb-powerpack' ),
						'default'       => '',
						'show_reset'    => true,
					),
					'show_block_shadow'   => array(
						'type'                 => 'pp-switch',
						'label'                => __( 'Enable Shadow', 'bb-powerpack' ),
						'default'              => 'no',
						'options'              => array(
							'yes'          	=> __( 'Yes', 'bb-powerpack' ),
							'no'            => __( 'No', 'bb-powerpack' ),
						),
						'toggle'    => array(
							'yes'   => array(
								'fields'    => array( 'block_shadow', 'block_shadow_color' ),
							),
						),
					),
					'block_shadow' 		=> array(
						'type'              => 'pp-multitext',
						'label'             => __( 'Shadow', 'bb-powerpack' ),
						'default'           => array(
							'vertical'			=> 0,
							'horizontal'		=> 2,
							'blur'				=> 8,
							'spread'			=> 0,
						),
						'options'			=> array(
							'vertical'			=> array(
								'placeholder'		=> __( 'Vertical', 'bb-powerpack' ),
								'tooltip'			=> __( 'Vertical', 'bb-powerpack' ),
								'icon'				=> 'fa-arrows-v',
							),
							'horizontal'		=> array(
								'placeholder'		=> __( 'Horizontal', 'bb-powerpack' ),
								'tooltip'			=> __( 'Horizontal', 'bb-powerpack' ),
								'icon'				=> 'fa-arrows-h',
							),
							'blur'				=> array(
								'placeholder'		=> __( 'Blur', 'bb-powerpack' ),
								'tooltip'			=> __( 'Blur', 'bb-powerpack' ),
								'icon'				=> 'fa-circle-o',
							),
							'spread'			=> array(
								'placeholder'		=> __( 'Spread', 'bb-powerpack' ),
								'tooltip'			=> __( 'Spread', 'bb-powerpack' ),
								'icon'				=> 'fa-paint-brush',
							),
						),
					),
					'block_shadow_color' => array(
						'type'              => 'color',
						'label'             => __( 'Shadow Color', 'bb-powerpack' ),
						'default'           => '000000',
						'show_alpha'		=> true
					),
				),
			),
			'label_style'	=> array(
				'title'		=> __( 'Labels', 'bb-powerpack' ),
				'fields'	=> array(
					'label_position'   => array(
						'type'          => 'select',
						'label'         => __( 'Label Position', 'bb-powerpack' ),
						'default'       => 'outside',
						'options'       => array(
							'inside'         => __( 'Inside Digit Container', 'bb-powerpack' ),
							'outside'       => __( 'Outside Digit Container', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'inside'	=> array(
								'fields'	=> array( 'label_inside_position' ),
							),
							'outside'	=> array(
								'fields'	=> array( 'label_outside_position' ),
							),
						),
					),
					'label_inside_position'   => array(
						'type'          => 'select',
						'label'         => __( 'Label Inside Position', 'bb-powerpack' ),
						'default'       => 'in_below',
						'options'       => array(
							'in_below'		=> __( 'Below Digit', 'bb-powerpack' ),
							'in_above'      => __( 'Above Digit', 'bb-powerpack' ),
						),
					),
					'label_outside_position'   => array(
						'type'          => 'select',
						'label'         => __( 'Label Outside Position', 'bb-powerpack' ),
						'default'       => 'out_below',
						'options'       => array(
							'out_below'         => __( 'Below Digit', 'bb-powerpack' ),
							'out_above'			=> __( 'Above Digit', 'bb-powerpack' ),
							'out_right'         => __( 'Right Side of Digit', 'bb-powerpack' ),
							'out_left'       	=> __( 'Left Side of Digit', 'bb-powerpack' ),
						),
					),
					'default_position'   => array(
						'type'          => 'select',
						'label'         => __( 'Select Position', 'bb-powerpack' ),
						'default'       => 'normal_below',
						'options'       => array(
							'normal_below'       => __( 'Below Digit', 'bb-powerpack' ),
							'normal_above'       => __( 'Above Digit', 'bb-powerpack' ),
						),
					),
					'label_bg_color'	=> array(
						'type'			=> 'color',
						'label'			=> __( 'Background Color', 'bb-powerpack' ),
						'default'		=> '',
						'show_reset'	=> true,
						'show_alpha'	=> true
					),
					'label_horizontal_padding'	=> array(
						'type'			=> 'text',
						'label'			=> __( 'Horizontal Padding', 'bb-powerpack' ),
						'description'	=> __( 'px', 'bb-powerpack' ),
						'default'		=> '',
						'size'			=> 5,
					),
					'label_vertical_padding'	=> array(
						'type'			=> 'text',
						'label'			=> __( 'Vertical Padding', 'bb-powerpack' ),
						'description'	=> __( 'px', 'bb-powerpack' ),
						'default'		=> 5,
						'size'			=> 5,
					),
				),
			),
		),
	),
	'typography'       => array( // Tab
		'title'         => __( 'Typography', 'bb-powerpack' ), // Tab title
		'sections'      => array( // Tab Sections
			'digit_typography'    => array(
				'title'     => __( 'Digit', 'bb-powerpack' ),
				'fields'    => array(
					'digit_tag'   => array(
						'type'          => 'select',
						'label' => __( 'Select Tag', 'bb-powerpack' ),
						'default'   => 'h3',
						'options'       => array(
							'h1'      => 'h1',
							'h2'      => 'h2',
							'h3'      => 'h3',
							'h4'      => 'h4',
							'h5'      => 'h5',
							'h6'      => 'h6',
							'div'     => 'div',
							'p'       => 'p',
						),
					),
					'digit_font_family'       => array(
						'type'          => 'font',
						'label'         => __( 'Font Family', 'bb-powerpack' ),
						'default'       => array(
							'family'        => 'Default',
							'weight'        => 'Default',
						),
						'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-countdown-fixed-timer .pp-countdown-digit, .pp-countdown-evergreen-timer .pp-countdown-digit',
						),
					),
					'digit_font_size'    => array(
						'type'                      => 'pp-switch',
						'label'                     => __( 'Font Size', 'bb-powerpack' ),
						'default'                   => 'default',
						'options'                   => array(
							'default'                  => __( 'Default', 'bb-powerpack' ),
							'custom'                => __( 'Custom', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array( 'digit_custom_font_size' ),
							),
						),
					),
					'digit_custom_font_size'		=> array(
						'type'			=> 'unit',
						'label' 		=> __( 'Custom Font Size', 'bb-powerpack' ),
						'size'          => 5,
						'default'       => '',
						'responsive' 	=> array(
							'placeholder'	=> array(
								'default'		=> '',
								'medium'		=> '',
								'responsive' 	=> '',
							),
						),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-fixed-timer .pp-countdown-digit, .pp-countdown-evergreen-timer .pp-countdown-digit',
							'property'      => 'font-size',
							'unit'          => 'px',
						),
					),
					'digit_line_height'		=> array(
						'type'			=> 'unit',
						'label' 		=> __( 'Line Height', 'bb-powerpack' ),
						'size'          => 5,
						'default'       => '',
						'responsive' 	=> array(
							'placeholder'	=> array(
								'default'		=> '',
								'medium'		=> '',
								'responsive' 	=> '',
							),
						),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-fixed-timer .pp-countdown-digit, .pp-countdown-evergreen-timer .pp-countdown-digit',
							'property'      => 'line-height',
						),
					),
					'digit_color'        => array(
						'type'       => 'color',
						'label' => __( 'Color', 'bb-powerpack' ),
						'preview'         => array(
							'type'            => 'css',
							'selector'        => '.pp-countdown-fixed-timer .pp-countdown-digit, .pp-countdown-evergreen-timer .pp-countdown-digit',
							'property'        => 'color',
						),
						'default'    => '',
						'show_reset' => true,
					),
				),
			),
			'label_typography'    =>	array(
				'title'     => __( 'Labels', 'bb-powerpack' ),
				'fields'    => array(
					'label_tag'   => array(
						'type'          => 'select',
						'label' => __( 'Select Tag', 'bb-powerpack' ),
						'default'   => 'div',
						'options'       => array(
							'h1'      => 'h1',
							'h2'      => 'h2',
							'h3'      => 'h3',
							'h4'      => 'h4',
							'h5'      => 'h5',
							'h6'      => 'h6',
							'div'     => 'div',
							'p'       => 'p',
						),
					),
					'label_font_family'       => array(
						'type'          => 'font',
						'label'         => __( 'Font Family', 'bb-powerpack' ),
						'default'       => array(
							'family'        => 'Default',
							'weight'        => 'Default',
						),
						'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-countdown-fixed-timer .pp-countdown-label, .pp-countdown-evergreen-timer .pp-countdown-label',
						),
					),
					'label_font_size'    => array(
						'type'                      => 'pp-switch',
						'label'                     => __( 'Font Size', 'bb-powerpack' ),
						'default'                   => 'default',
						'options'                   => array(
							'default'                  => __( 'Default', 'bb-powerpack' ),
							'custom'                => __( 'Custom', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array( 'label_custom_font_size' ),
							),
						),
					),
					'label_custom_font_size'		=> array(
						'type'			=> 'unit',
						'label' 		=> __( 'Custom Font Size', 'bb-powerpack' ),
						'size'          => 5,
						'default'       => '',
						'responsive' 	=> array(
							'placeholder'	=> array(
								'default'		=> '',
								'medium'		=> '',
								'responsive' 	=> '',
							),
						),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-fixed-timer .pp-countdown-label, .pp-countdown-evergreen-timer .pp-countdown-label',
							'property'      => 'font-size',
							'unit'          => 'px',
						),
					),
					'label_line_height'		=> array(
						'type'			=> 'unit',
						'label' 		=> __( 'Line Height', 'bb-powerpack' ),
						'size'          => 5,
						'default'       => '',
						'responsive' 	=> array(
							'placeholder'	=> array(
								'default'		=> '',
								'medium'		=> '',
								'responsive' 	=> '',
							),
						),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-fixed-timer .pp-countdown-label, .pp-countdown-evergreen-timer .pp-countdown-label',
							'property'      => 'line-height',
						),
					),
					'label_letter_spacing'   => array(
						'type'          => 'text',
						'label'         => __( 'Letter Spacing', 'bb-powerpack' ),
						'description'   => __( 'px', 'bb-powerpack' ),
						'size'			=> 5,
						'default'		=> '',
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-fixed-timer .pp-countdown-label, .pp-countdown-evergreen-timer .pp-countdown-label',
							'property'      => 'letter-spacing',
							'unit'          => 'px',
						),
					),
					'label_color'	=> array(
						'type'       	=> 'color',
						'label' 		=> __( 'Color', 'bb-powerpack' ),
						'default'    	=> '',
						'show_reset' 	=> true,
						'preview'       => array(
							'type'      	=> 'css',
							'selector'      => '.pp-countdown-fixed-timer .pp-countdown-label, .pp-countdown-evergreen-timer .pp-countdown-label',
							'property'      => 'color',
						),
					),
					'label_text_transform' => array(
						'type'		=> 'select',
						'label'		=> __( 'Text Transform', 'bb-powerpack' ),
						'default'	=> 'default',
						'options'       => array(
							'default'       => __( 'Default', 'bb-powerpack' ),
							'none'          => __( 'None', 'bb-powerpack' ),
							'lowercase'     => __( 'lowercase', 'bb-powerpack' ),
							'uppercase'     => __( 'UPPERCASE', 'bb-powerpack' ),
						),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-countdown-fixed-timer .pp-countdown-label, .pp-countdown-evergreen-timer .pp-countdown-label',
							'property'	=> 'text-transform'
						)
					),
				),
			),
			'message'	=> array(
				'title'     => __( 'Expire Message', 'bb-powerpack' ),
				'fields'    => array(
					'message_font_family'       => array(
						'type'          => 'font',
						'label'         => __( 'Font Family', 'bb-powerpack' ),
						'default'       => array(
							'family'        => 'Default',
							'weight'        => 'Default',
						),
						'preview'         => array(
							'type'            => 'font',
							'selector'        => '.pp-countdown-expire-message',
						),
					),
					'message_font_size'    => array(
						'type'                      => 'pp-switch',
						'label'                     => __( 'Font Size', 'bb-powerpack' ),
						'default'                   => 'default',
						'options'                   => array(
							'default'                  => __( 'Default', 'bb-powerpack' ),
							'custom'                => __( 'Custom', 'bb-powerpack' ),
						),
						'toggle'	=> array(
							'custom'	=> array(
								'fields'	=> array( 'message_custom_font_size' ),
							),
						),
					),
					'message_custom_font_size'		=> array(
						'type'			=> 'unit',
						'label' 		=> __( 'Custom Font Size', 'bb-powerpack' ),
						'size'          => 5,
						'default'       => '',
						'responsive' 	=> array(
							'placeholder'	=> array(
								'default'		=> '',
								'medium'		=> '',
								'responsive' 	=> '',
							),
						),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-expire-message',
							'property'      => 'font-size',
							'unit'          => 'px',
						),
					),
					'message_line_height'		=> array(
						'type'			=> 'unit',
						'label' 		=> __( 'Line Height', 'bb-powerpack' ),
						'size'          => 5,
						'default'       => '',
						'responsive' 	=> array(
							'placeholder'	=> array(
								'default'		=> '',
								'medium'		=> '',
								'responsive' 	=> '',
							),
						),
						'preview'           => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-expire-message',
							'property'      => 'line-height',
							'unit'          => 'px',
						),
					),
					'message_color'	=> array(
						'type'			=> 'color',
						'label' 		=> __( 'Color', 'bb-powerpack' ),
						'default'		=> '',
						'show_reset'	=> true,
						'preview'       => array(
							'type'			=> 'css',
							'selector'      => '.pp-countdown-expire-message',
							'property'      => 'color',
						),
					),
				),
			),
		),
	),
));

