				<?php
				$args      = get_query_var('args');
				$count     = get_query_var('count');
					
				$the_query = new WP_Query( $args );
				
				if ( $the_query->have_posts() ) :
				
					//echo '<pre style="text-align: left;">'; var_dump($the_query->query['tax_query'][0]['taxonomy']); echo '</pre>';

					$number    = sprintf( "%02d", $count );
					$item_id   = $the_query->posts[0]->ID;
					$tax_type  = $the_query->query['tax_query'][0]['taxonomy'];
					
					//var_dump( $terms );
					
					if ( 'supporter_option' == $tax_type ) {
						
						$add_name = 'opt' . $number;
						
					} else {
						
						$add_name = $number;
						
					}
					
				?>
					<div class="supporter-contents">
						<div class="clearfix">
							<h3 class="supporter-title supporter-<?php echo esc_html( $add_name ); ?> col-sm-3">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/images/supporter/title-sup-' . $add_name . '.png' ); ?>" alt="" />
							</h3>
							<div class="colmun-row col-sm-9 clearfix">
							<?php
							while ( $the_query->have_posts() ):
								$the_query->the_post();
								$add_class = ( 'draft' == $post->post_status ) ? ' draft' : '';
								$add_class .= ' sup-' . $add_name;
								$image     = wp_get_attachment_image_src( get_field( 'pdc-supporter-banner' ), 'full' );
								
								$term      = array_shift( get_the_terms( get_the_ID(), 'supporter_type' ) );
								$term_slug = $term->slug;
								
								if ( 'sup-type-02' == $term_slug ) {
									
									$width = 'col-sm-4';
									
								} else {
									
									$width = 'col-sm-6';
									
								}
		
								//echo '<!-- <pre>'; var_dump( $term ); echo '</pre> -->';
								
								//var_dump($image);
							?>
								
								<?php //echo '<pre>'; var_dump( get_post_custom() ); echo '</pre>'; ?>
								
									<div class="colmun <?php echo esc_attr( $width ); ?> text-center<?php echo esc_attr( $add_class ); ?>">
										<a href="<?php echo esc_url( get_field( 'pdc-supporter-link' ) ) ?>" target="_blank" title="<?php the_title(); ?>">
										<?php if ( $image ): ?>
										<?php //var_dump($image); ?>
											<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title(); ?>" class="img-responsive">
										<?php else: ?>
											<p class="no-image"><span class="title"><?php the_title(); ?></span></p>
										<?php endif; ?>
										</a>
									</div>
							<?php
							endwhile; ?>
							</div>
						</div>
					</div>
		
				<?php
				else:
				?>
		
				<?php
				endif;
				wp_reset_query();
				?>
