<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <section id="primary" class="col-md-8 content-area">
                <main id="main" class="site-main">

            		<?php if ( have_posts() ) : ?>

            			<header class="page-header">
            				<h1 class="page-title">
            					<?php
            					/* translators: %s: search query. */
            					printf( esc_html__( 'Search Results for: %s', 'event' ), '<span>' . get_search_query() . '</span>' );
            					?>
            				</h1>
            			</header><!-- .page-header -->

            			<?php
            			/* Start the Loop */
            			while ( have_posts() ) :
            				the_post();

            				/**
            				 * Run the loop for the search to output the results.
            				 * If you want to overload this in a child theme then include a file
            				 * called content-search.php and that will be used instead.
            				 */
            				get_template_part( 'template-parts/content', 'search' );

            			endwhile;

            			event_pagination();

            		else :

            			get_template_part( 'template-parts/content', 'none' );

            		endif;
            		?>

        		</main><!-- #main -->
        	</section><!-- #primary -->

            <div id="sidebar" class="col-md-3 side-bar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php
get_footer();


