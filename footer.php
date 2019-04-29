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

<?php wp_footer() ?>
<?php 
	$headercode = get_theme_mod('itpharma_foother_code');
	if($headercode)
		echo $headercode;
?>
</body>
</html> 