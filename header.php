<!DOCTYPE html>
<!--[if IE 9 ]> <html <?php language_attributes(); ?> class="ie9 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if IE 8 ]> <html <?php language_attributes(); ?> class="ie8 <?php flatsome_html_classes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="<?php flatsome_html_classes(); ?>"> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
	<?php 
		$none_copy = get_field('none_copy','option');
			if ($none_copy == 0) {
				?>
				<style>
					body{
					-webkit-touch-callout: none;
					-webkit-user-select: none;
					-moz-user-select: none;
					-ms-user-select: none;
					-o-user-select: none;
					user-select: none;
					}
				</style>
				<script type=”text/JavaScript”>
					function killCopy(e){
					return false
					}
					function reEnable(){
					return true
					}
					document.onselectstart=new Function (“return false”)
					if (window.sidebar){
					document.onmousedown=killCopy
					document.onclick=reEnable
					}
				</script>
				<?php
			}
		$none_right = get_field('none_right','option');	
		if ($none_right == 0) {
			?>
			<script language="JavaScript">
			    window.onload = function() {
			        document.addEventListener("contextmenu", function(e) {
			            e.preventDefault();
			        }, false);
			        document.addEventListener("keydown", function(e) {
			            //document.onkeydown = function(e) {
			            // "I" key
			            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
			                disabledEvent(e);
			            }
			            // "J" key
			            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
			                disabledEvent(e);
			            }
			            // "S" key + macOS
			            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
			                disabledEvent(e);
			            }
			            // "U" key
			            if (e.ctrlKey && e.keyCode == 85) {
			                disabledEvent(e);
			            }
			            // "F12" key
			            if (event.keyCode == 123) {
			                disabledEvent(e);
			            }
			        }, false);
			 
			        function disabledEvent(e) {
			            if (e.stopPropagation) {
			                e.stopPropagation();
			            } else if (window.event) {
			                window.event.cancelBubble = true;
			            }
			            e.preventDefault();
			            return false;
			        }
			    };
			</script>


			<?php
		}
	?>	
</head>

<body <?php body_class(); // Body classes is added from inc/helpers-frontend.php ?>>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'flatsome' ); ?></a>

<div id="wrapper">

<?php do_action('flatsome_before_header'); ?>

<header id="header" class="header <?php flatsome_header_classes();  ?>">
   <div class="header-wrapper">
	<?php
		get_template_part('template-parts/header/header', 'wrapper');
	?>
   </div><!-- header-wrapper-->
</header>
<?php
	if (is_home() || is_front_page() ) {
		?> <h1 class="title-name hidden"><?= the_title() ?></h1><?php
	}
?>

<?php do_action('flatsome_after_header'); ?>

<main id="main" class="<?php flatsome_main_classes();  ?>">
