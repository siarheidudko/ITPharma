<?php
/**
 * Основная тема для сайта itpharma.by
 *
 *
 * @package ITPharma
 * @subpackage ITPharma
 * @since 1.0
 * @version 1.0
 */
?>

<?php get_header(); ?>

<?php
	echo apply_filters('the_content', get_post()->post_content);
?>

<?php get_footer(); ?>
