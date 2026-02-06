<?php
global $shopstar_demo_slides;

if ( get_theme_mod( 'shopstar-slider-type', customizer_library_get_default( 'shopstar-slider-type' ) ) == 'shopstar-slider-plugin' ) :
?>
    <div class="slider-container">
		<?php
		if ( get_theme_mod( 'shopstar-slider-plugin-shortcode', customizer_library_get_default( 'shopstar-slider-plugin-shortcode' ) ) != '' ) {
			echo do_shortcode( sanitize_text_field( get_theme_mod( 'shopstar-slider-plugin-shortcode' ) ) );
		}
		?>
	</div>
<?php
else :
    
    $slider_categories = '';

    if ( get_theme_mod( 'shopstar-slider-categories' ) != '' ) {
        $slider_categories = get_theme_mod( 'shopstar-slider-categories' );

        $slider_query = new WP_Query( 'cat=' . implode(',', $slider_categories) . '&posts_per_page=-1&orderby=date&order=DESC&id=slider' );
         
        if ( $slider_query->have_posts() ) :
?>
	
			<div class="slider-container default loading <?php echo ( get_theme_mod( 'shopstar-slider-text-shadow', customizer_library_get_default( 'shopstar-slider-text-shadow' ) ) ) ? 'text-shadow' : ''; ?>">
	            <div class="prev"></div>
	            <div class="next"></div>
			            				
				<ul class="slider">
					                    
					<?php
					$slide_i = 0;

					while ( $slider_query->have_posts() ) : $slider_query->the_post();
						$is_first = ( 0 === $slide_i );

						$thumb_attrs = array(
							'decoding'      => 'async',
							'loading'       => $is_first ? 'eager' : 'lazy',
							'fetchpriority' => $is_first ? 'high' : 'low',
							'sizes'         => '100vw',
						);
					?>

					<li class="slide">
						<?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'full', $thumb_attrs );
						endif;
						?>
			                            
						<div class="overlay">
							<?php
								the_content();
							?>
						</div>
					</li>
			                    
					<?php
						$slide_i++;
					endwhile;
					?>
			                    
				</ul>
				
				<div class="pagination"></div>
				
			</div>
	
<?php
		endif;
		wp_reset_query();
		
	} else {
?>

		<div class="slider-container default loading <?php echo ( get_theme_mod( 'shopstar-slider-text-shadow', customizer_library_get_default( 'shopstar-slider-text-shadow' ) ) ) ? 'text-shadow' : ''; ?>">
            <div class="prev"></div>
            <div class="next"></div>
		            				
			<ul class="slider">
				                    
				<?php
				$slide_i = 0;
				foreach ( $shopstar_demo_slides as $slide ) {
					$is_first = ( 0 === $slide_i );
				?>
					                    
				<li class="slide">
					<img
						src="<?php echo esc_url( $slide['image'] ); ?>"
						alt="<?php echo esc_attr__( 'Demo Slide', 'shopstar' ); ?>"
						decoding="async"
						loading="<?php echo $is_first ? 'eager' : 'lazy'; ?>"
						fetchpriority="<?php echo $is_first ? 'high' : 'low'; ?>"
					/>

					<div class="overlay">
						<?php
							echo ( trim( $slide['text'] ) );
						?>
					</div>
				</li>
		                    
				<?php
					$slide_i++;
				}
				?>
		                    
			</ul>
			
			<div class="pagination"></div>
			
		</div>

<?php
	}
    
endif;
?>