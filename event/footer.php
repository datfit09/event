<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package event
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" style="<?php footer_style(); ?>">
		<div class="site-info">
            <div class="join-now" style="<?php event_page_footer_background(); ?>">
                <div class="container">
                    <p><?php echo esc_html( get_option( 'footer_description' ) ); ?></p>
                    <h3><?php echo esc_html( get_option( 'footer_title' ) ); ?></h3>
                    <button>RESERVE MY SEAT!</button>
                </div>
            </div>

			<div class="ft-end" style="<?php footer_end_style(); ?>">
                <div class="container">
                    <div class="ft-copyright">
                        <div class="copyright">
                            <?php echo esc_html( get_option( 'footer_left', 'Copyright' ) ); ?>
                        </div>
                        <div class="FAQ">
                            <?php echo wp_kses_post( get_option( 'footer_right', 'FAQ' ) ); ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
