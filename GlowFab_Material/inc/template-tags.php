<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package GlowFab_-_Material
 */

if ( ! function_exists( 'glowfab_material_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function glowfab_material_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'glowfab_material' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'glowfab_material' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . /*$byline .*/ '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'glowfab_material_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function glowfab_material_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'glowfab_material' ) );
		if ( $categories_list && glowfab_material_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'glowfab_material' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'glowfab_material' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'glowfab_material' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'glowfab_material' ), esc_html__( '1 Comment', 'glowfab_material' ), esc_html__( '% Comments', 'glowfab_material' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'glowfab_material' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function glowfab_material_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'glowfab_material_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'glowfab_material_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so glowfab_material_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so glowfab_material_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in glowfab_material_categorized_blog.
 */
function glowfab_material_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'glowfab_material_categories' );
}
add_action( 'edit_category', 'glowfab_material_category_transient_flusher' );
add_action( 'save_post',     'glowfab_material_category_transient_flusher' );




/*
*
* Custom methods for GlowFab_Material
*
*/

if ( ! function_exists( 'glowfab_material_posted_on_custom' ) ) :
/**
 * Custom method to print post's meta info
 */
function glowfab_material_posted_on_custom() {
	
	$categories_list = get_the_category_list( esc_html__( ', ', 'glowfab_material' ) );
	
	if ( $categories_list && glowfab_material_categorized_blog() ) {
		echo '<span class="entry-meta">' . glowfab_material_posted_on() . ' / ' . $categories_list . '</span>'; // WPCS: XSS OK.
	}
	
}
endif;


if ( ! function_exists( 'glowfab_material_post_featured_image_custom' ) ) :
/**
 * Custom method to display featured image
 */
function glowfab_material_post_featured_image_custom() {
	
  if (has_post_thumbnail()) {
		$featuredImageLink = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) );
		$featuredImageLink = $featuredImageLink['0'];
		echo '<div class="mdl-card__media mdl-color-text--grey-50 featured_image_sizes_control" style="background-image: url(' . $featuredImageLink . ');">';
	} else {
		echo '<div class="mdl-card__media mdl-color-text--grey-50 featured_image_sizes_control default_fallback_featured_image">';
	}
	
}
endif;


if ( ! function_exists( 'glowfab_material_post_author_custom' ) ) :
/**
 * Custom method to print post's author info
 */
function glowfab_material_post_author_custom() {
	
	$author_id_for_this_post = get_the_author_meta( 'ID' );
	$author_avatar_size = 96;
	
	echo
	'<div class="mdl-card mdl-shadow--4dp mdl-cell mdl-cell--12-col">
		<div class="author-basic-info">
			<div class="author-avatar">';
				echo get_avatar( $author_id_for_this_post, $author_avatar_size );
	echo
			'</div>
			<div class="author-info">
				<div id="author-info-name">';
					the_author_posts_link();
	echo
				'</div>
				<div id="author-info-profession">';
					echo get_the_author_meta('profession');
	echo
				'</div>
				<div id="author-info-description">';
					echo get_the_author_meta('description');
	echo
				'</div>
			</div>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<div class="author-social-medias">
				<ul id="author-social-medias-list">';
				
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
	echo
				'</ul>
			</div>
		</div>
	</div>';
	
}
endif;


if ( ! function_exists( 'glowfab_material_entry_footer_custom' ) ) :
/**
 * Custom method to print HTML with meta information for the categories, tags and comments.
 */
function glowfab_material_entry_footer_custom() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tags($post->ID);
		
		if ( $tags_list ) {
			foreach (get_the_tags() as $tag) {
				echo '<div class="single-footer-tag">';
				echo '<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="' . get_tag_link($tag->term_id) . '">';
				echo $tag->name;
				echo '</a>';
				echo '</div>';
			}
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'glowfab_material' ), esc_html__( '1 Comment', 'glowfab_material' ), esc_html__( '% Comments', 'glowfab_material' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'glowfab_material' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;
