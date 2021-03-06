<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();

?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
<div class="well">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h3 class="page-title"><?php printf( __( 'Search Results for: %s', 'wosci-language' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
			</header>

			<?php wosci_content_nav( 'nav-above' ); ?>
<div class="row">
   <div class="col-xs-18">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content-search', get_post_format() ); ?>
			<?php endwhile; ?>
   </div><!-- .row -->
</div><!-- .col-xs-18 -->
			<?php wosci_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'wosci-language' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'wosci-language' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>
			</div><!-- .well -->
		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>