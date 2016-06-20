		<div class="main-image">
			
			<div id="signboard">
				
				<h1 class="site-title">
					<img src="<?php echo get_template_directory_uri(); ?>/images/common/img-sitetitle.png" alt="WordPressの森に集おう WordFes Nagoya 2016">
				</h1>
				
				<h2 class="page-title">
					<?php echo esc_html( pdc_get_page_name() ); ?>
					<?php
					if ( is_page() ) {
						echo "<br>\n";
						echo "<span>\n";
						echo "<span>" . esc_html( strtoupper( pdc_get_page_id() ) ) . "</span>\n";
					}
					?>
				</h2>
			</div>
			
			<?php
			if ( is_single() ):
				/* シングルページ用のソーシャルボタン */
				get_template_part( 'template-parts/social', 'single' );
			else:
				/* サイト用のソーシャルボタン */
				get_template_part( 'template-parts/social' );
			endif;
			?>
		</div><!-- .main-image -->