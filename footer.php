<?php
/**
 * Основная тема для сайта itpharma.by
 *
 * @package ITPharma
 * @subpackage ITPharma
 * @since 1.0
 * @version 1.0
 * @author Siarhei Dudko
 * @license MIT
 */
?>
<?php 
	if(is_active_sidebar('itpharma-over-window-widget')) { dynamic_sidebar( 'itpharma-over-window-widget' ); }
	if(is_active_sidebar('itpharma-before-bottom-widget')) { dynamic_sidebar( 'itpharma-before-bottom-widget' ); } 
?>
<?php wp_footer() ?>
<?php 
	$headercode = get_theme_mod('itpharma_footer_code');
	if($headercode)
		echo $headercode;
?>
</body>
</html> 