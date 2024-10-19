<?php
/**
 * Shopstar Theme Customizer.
 *
 * @package shopstar
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shopstar_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'refresh';
}
add_action( 'customize_register', 'shopstar_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shopstar_customize_preview_js() {
	wp_enqueue_script( 'shopstar_customizer', get_template_directory_uri() . '/library/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'shopstar_customize_preview_js' );

/**
 * Enqueue shopstar custom customizer styling.
 */
function shopstar_load_customizer_script() {
	wp_enqueue_script( 'shopstar-customizer-custom', get_template_directory_uri() . '/customizer/customizer-library/js/customizer-custom.js', array('jquery'), SHOPSTAR_THEME_VERSION, true );
	wp_enqueue_style( 'shopstar-customizer', get_template_directory_uri() . '/customizer/customizer-library/css/customizer.css', array(), SHOPSTAR_THEME_VERSION );

	wp_register_style( 'out-the-box-dynamic', false );
	wp_enqueue_style( 'out-the-box-dynamic' );

	ob_start();
	include( get_template_directory() . '/customizer/customizer-library/includes/dynamic-css.php' );
	$css = ob_get_contents();
	ob_end_clean();

	wp_add_inline_style( 'out-the-box-dynamic', $css );
}
add_action( 'customize_controls_enqueue_scripts', 'shopstar_load_customizer_script' );

/**
 * Function to create Customizer internal linking.
 */
function shopstar_customizer_internal_links() { ?>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				var api = wp.customize;
				api.bind('ready', function() {
					$(['control', 'section', 'panel']).each(function(i, type) {
						$('a[rel="tc-'+type+'"]').click(function(e) {
							e.preventDefault();
							var id = $(this).attr('href').replace('#', '');
							if(api[type].has(id)) {
								api[type].instance(id).focus();
							}
						});
					});
				});
			});
		})(jQuery);
	</script><?php
}

add_action( 'customize_controls_print_scripts', 'shopstar_customizer_internal_links' );
