<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GlowFab_-_Material
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php glowfab_material_post_featured_image_custom(); ?>
		
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		</div>
		
		<?php if ( 'post' === get_post_type() ) { ?>
		  <div class="post-date-category-holder">
		  	<div class="entry-meta">
		  		<?php glowfab_material_posted_on_custom(); ?>
		  	</div><!-- .entry-meta -->
		  </div><!-- .post-date-category-holder -->
		<?php } ?>
		
	</header><!-- .entry-header -->
	
	<?php if ( is_single() ) { ?>
	<div class="entry-content mdl-color-text--grey-700 mdl-card__supporting-text">
		<?php if ( is_single() && has_excerpt( $post->ID ) ) { ?>
				<div class="post-excerpt">
					<p>
						<?php echo get_the_excerpt(); ?>
					</p>
				</div><!-- .deck -->
		<?php	} ?>
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'glowfab_material' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'glowfab_material' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php } else { ?>
		<div class="index-post-link-block mdl-color-text--grey-700 mdl-card__supporting-text">
			<div class="index-excerpt">
				<?php the_excerpt(); ?>
			</div>
			<div class="continue-reading mdl-color-text--grey-700 mdl-card__supporting-text">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php
					printf(
						/* Translators: %s = Name of the current post. */
						wp_kses( __( 'Continue reading %s', 'glowfab' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					);
					?>
				</a>
			</div>
		</div>
	<?php } ?>
	
	<!--	Author Information -->
	<div id="post-author-meta">
	<?php 
		if (is_single()) {
			glowfab_material_post_author_custom();
		} 
	?>
	</div>

	<footer class="entry-footer">
		<?php 
			if ( is_single() ) {
				glowfab_material_entry_footer_custom();
			} 
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
