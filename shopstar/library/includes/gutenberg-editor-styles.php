<?php

$fonts = array();

// Heading Font
$font = 'shopstar-heading-font';
$fontmod = get_theme_mod( $font, customizer_library_get_default( $font ) );
$fontstack = customizer_library_get_font_stack( $fontmod );

if ( $fontmod != customizer_library_get_default( $font ) ) {
    
	Customizer_Library_Styles()->add( array(
    	'selectors' => array(
    		'.editor-post-title__block .editor-post-title__input,
			.edit-post-visual-editor .editor-block-list__block h1.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h2.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h3.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h4.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h5.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h6.mce-content-body,
			.edit-post-visual-editor h1,
			.edit-post-visual-editor h2,
			.edit-post-visual-editor h3,
			.edit-post-visual-editor h4,
			.edit-post-visual-editor h5,
			.edit-post-visual-editor h6'
    	),
    	'declarations' => array(
    		'font-family' => $fontstack
    	)
    ) );

}

// Heading Font Weight
$fontweight = 'shopstar-heading-font-weight';
$fontweightmod = get_theme_mod( $fontweight, customizer_library_get_default( $fontweight ) );

if ( $fontweightmod != customizer_library_get_default( $fontweight ) ) {

	Customizer_Library_Styles()->add( array(
		'selectors' => array(
			'.editor-post-title__block .editor-post-title__input,
			.edit-post-visual-editor .editor-block-list__block h1.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h2.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h3.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h4.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h5.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h6.mce-content-body,
			.edit-post-visual-editor h1,
			.edit-post-visual-editor h2,
			.edit-post-visual-editor h3,
			.edit-post-visual-editor h4,
			.edit-post-visual-editor h5,
			.edit-post-visual-editor h6'
		),
		'declarations' => array(
			'font-weight' => $fontweightmod
		)
	) );

}

// Heading Font Color
$fontcolor = 'shopstar-heading-font-color';
$fontcolormod = get_theme_mod( $fontcolor, customizer_library_get_default( $fontcolor ) );

if ( $fontcolormod !== customizer_library_get_default( $fontcolor ) ) {

	$sanfontcolor = esc_html( $fontcolormod );

	Customizer_Library_Styles()->add( array(
		'selectors' => array(
			'.editor-post-title__block .editor-post-title__input,
			.edit-post-visual-editor .editor-block-list__block h1.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h2.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h3.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h4.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h5.mce-content-body,
			.edit-post-visual-editor .editor-block-list__block h6.mce-content-body,
			.edit-post-visual-editor h1,
			.edit-post-visual-editor h2,
			.edit-post-visual-editor h3,
			.edit-post-visual-editor h4,
			.edit-post-visual-editor h5,
			.edit-post-visual-editor h6'
		),
		'declarations' => array(
			'color' => $sanfontcolor
		)
	) );
}

// Body Font
$font = 'shopstar-body-font';
$fontmod = get_theme_mod( $font, customizer_library_get_default( $font ) );
$fontstack = customizer_library_get_font_stack( $fontmod );

if ( $fontmod != customizer_library_get_default( $font ) ) {

	Customizer_Library_Styles()->add( array(
		'selectors' => array(
			'.edit-post-visual-editor .editor-block-list__block-edit,
			.edit-post-visual-editor,
			.editor-styles-wrapper div.wp-block,
			.editor-styles-wrapper div.wp-block p,
			.editor-styles-wrapper div.wp-block-post-content p,
			.editor-styles-wrapper ul.wp-block'
		),
		'declarations' => array(
			'font-family' => $fontstack
		)
	) );

}

// Body Font Color
$fontcolor = 'shopstar-body-font-color';
$fontcolormod = get_theme_mod( $fontcolor, customizer_library_get_default( $fontcolor ) );

if ( $fontcolormod !== customizer_library_get_default( $fontcolor ) ) {

	$sanfontcolor = esc_html( $fontcolormod );
	$sanfontcolor_rgb = customizer_library_hex_to_rgb( $sanfontcolor );

	Customizer_Library_Styles()->add( array(
		'selectors' => array(
			'.edit-post-visual-editor .editor-block-list__block-edit,
			.edit-post-visual-editor,
			.editor-styles-wrapper div.wp-block,
			.editor-styles-wrapper div.wp-block p,
			.editor-styles-wrapper div.wp-block-post-content p,
			.editor-styles-wrapper ul.wp-block'
		),
		'declarations' => array(
			'color' => $sanfontcolor
		)
	) );

}

/**
 * Enqueue Google Fonts for the Gutenberg editor
 */
$fonts = array(
	get_theme_mod( 'shopstar-body-font', customizer_library_get_default( 'shopstar-body-font' ) ),
	get_theme_mod( 'shopstar-heading-font', customizer_library_get_default( 'shopstar-heading-font' ) )
);

$font_uri = customizer_library_get_google_font_uri( $fonts );

wp_enqueue_style( 'shopstar_gutenberg_editor_fonts', $font_uri, array(), null, 'screen' );


if ( ! function_exists( 'shopstar_gutenberg_editor_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function shopstar_gutenberg_editor_styles() {

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Gutenberg Editor Custom CSS -->\n<style type=\"text/css\" id=\"out-the-box-gutenberg-editor-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}
}
endif;

add_action( 'admin_head', 'shopstar_gutenberg_editor_styles', 11 );    
?>
