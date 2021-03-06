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

<?php get_header(); ?>

<div id="bodycontent">
	<?php
		echo apply_filters('the_content', get_post()->post_content);
	?>
</div>

<?php get_footer(); ?>
