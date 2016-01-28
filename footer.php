<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
$odin_general_opts = get_option( 'config' );

$cor = $odin_general_opts['cor'];

?>


		</div><!-- #main -->

		<footer style="border:3px solid <?php echo $cor?>" id="footer" role="contentinfo">
			
		</footer><!-- #footer -->
	</div><!-- .container -->

	<?php wp_footer(); ?>
</body>
</html>
