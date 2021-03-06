<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
//include( '/includes1/application_top.php');     
get_header(); ?>
 <div class="well">
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				<small><?php wosci_entry_meta(); ?>
<?php edit_post_link( __( 'Edit', 'wosci-language' ), '<span class="edit-link">', '</span>' ); ?></small>


				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Product navigation', 'wosci-language' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous product link', 'wosci-language' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next product link', 'wosci-language' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
				

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- .well -->


<?php get_template_part( 'also_purchased', get_post_format() ); ?>


<div class="well" style="margin-top:-12px;">
<?php comments_template( '', true ); ?>
</div><!-- .well -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>