<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Mariehogebrandt
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'mariehogebrandt_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'mariehogebrandt' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'mariehogebrandt' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'mariehogebrandt' ), 'mariehogebrandt', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>