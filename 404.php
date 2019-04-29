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

<head>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<style type="text/css">
	#bodycontent {
		width:100%;
		height:100%;
		overflow:hidden;
		margin:0px;
		padding:0px;
		font-family:'Open Sans',sans-serif;
		font-size:16px
	}
	#imgageline{
		width: 100%;
		text-align:right;
	}
	#imgageline img{
		max-width: 25%;
	}
	#error{
		padding-top: 50px;
		color: #0088e2;
	}
	</style>
</head>

<div id="bodycontent">
	<div id="imgageline">
		<img src="<?php echo get_stylesheet_directory_uri().'/img/404.jpg'; ?>" />
	</div>
	<div id="error">
		<center><h3>404 Not Found</h3></center>
	</div>
</div>

<?php get_footer(); ?>
