<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GlowFab
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<figure class="<?php if ( is_single() && has_post_thumbnail() ) { echo "featured-image"; } else { echo "index-featured-image"; } ?>">
			<?php if ( !is_single() ) { ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
				<?php
					the_post_thumbnail();
				?>
				</a>
			<?php } else { ?>
				<?php
					the_post_thumbnail();
				?>
			<?php } ?>
		</figure>

		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		<?php if ( 'post' === get_post_type() ) { ?>
			<div class="entry-meta">
				<?php
				  $categories_list = get_the_category_list( esc_html__( ', ', 'glowfab' ) );
					if ( $categories_list && glowfab_categorized_blog() ) {
						printf( '<span class="entry-meta">' . glowfab_posted_on() . ' / ' . $categories_list . '</span>'); // WPCS: XSS OK.
					}
				?>

			</div>
		<?php } ?>
	</header><!-- .entry-header -->


	<?php if ( is_single() ) { ?>
	<div class="entry-content">
		<?php
		if ( is_single() && has_excerpt( $post->ID ) ) {
			echo '<div class="post-excerpt">';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '</div><!-- .deck -->';
		}
		?>
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'glowfab' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'glowfab' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php } else { ?>
		<?php
		echo '<div class="index-excerpt">';
		the_excerpt();
		echo '</div>';
		?>
	<?php } ?>

	<?php if (!is_single()) { ?>
		<div class="continue-reading">
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
	<?php } else { ?>
		<footer class="entry-footer entry-meta">
			<?php glowfab_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php } ?>

<!--	Author Information -->
	<?php if ( is_single() ) { ?>
		<?php
			$author_id_for_this_post = get_the_author_meta( 'ID' );
			$author_avatar_size = 96;
		?>
		<div class="author-information">
			<div class="inner">
				<section class="authorpage">
					<div class="avatar-small"> <?php echo get_avatar( $author_id_for_this_post, $author_avatar_size ); ?> </div>
					<div class="author-content">
						<h1>
							<?php the_author_posts_link(); ?><br/>
							<small> <?php echo get_the_author_meta('profession'); ?> </small>
						</h1>
						<p><?php echo get_the_author_meta('description'); ?></p>
					</div>
					<div class="author-social-medias">
						<ul id="author-social-medias">
						<?php
							if (get_the_author_meta('rss_url')) {
								echo '<li><a href="' . get_the_author_meta('rss_url') . '" class="ico-rss fa fa-2x fa-rss-square"></a></li>';
							}
							if (get_the_author_meta('twitter_profile')) {
								echo '<li><a href="' . get_the_author_meta('twitter_profile') . '" class="ico-twitter fa fa-2x fa-twitter-square"></a></li>';
							}
							if (get_the_author_meta('facebook_profile')) {
								echo '<li><a href="' . get_the_author_meta('facebook_profile') . '" class="ico-facebook fa fa-2x fa-facebook-square"></a></li>';
							}
							if (get_the_author_meta('google_profile')) {
								echo '<li><a href="' . get_the_author_meta('google_profile') . '" class="ico-google fa fa-2x fa-google-plus-square"></a></li>';
							}
							if (get_the_author_meta('linkedin_profile')) {
								echo '<li><a href="' . get_the_author_meta('linkedin_profile') . '" class="ico-linkedin fa fa-2x fa-linkedin-square"></a></li>';
							}
						?>
						</ul>
					</div>
				</section>
			</div>
		</div>
	<?php } ?>

</article><!-- #post-## -->
