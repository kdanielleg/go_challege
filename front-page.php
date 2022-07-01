<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="index-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
		<div class="row">
			<main class="site-main" id="main">
				<div id="go-airports-submit-bg" class="px-0 position-absolute top-0 start-0 bottom-0 end-0 w-100 h-100">
					<div id="map" class="w-100 h-100"></div>
				</div><!-- #go-airports-submit-bg -->
				<div id="go-airports-submit" class="row justify-content-center align-items-center text-center">
					<form id="go-airports-submit_box_form" method="post" action="" enctype="multipart/form-data" class="d-none">
						<input type="file" name="airport_file_upload" id="airport_file_upload" accept=".csv, text/csv" class="" />
						<input type="submit" name="airport_file_submit" id="airport_file_submit" value="Upload" class="" />
						<?php include get_stylesheet_directory() . '/inc/airport_form_submit.php'; ?>
					</form><!-- form#go-airports-submit-form -->
					<div id="go-airports-submit_box" class="col-xs-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
						<h2 id="go-airports-submit_box_title" class="text-white">Share your favorite airports!</h2>
						<h4 id="go-airports-submit_box_sub" class="text-white fw-normal my-3">Upload a CSV document with your favorite airports. We'll put them on a map, and provide a sharable url.</h4>
						<div id="go-airports-submit_box_form_drop" class="d-flex flex-xs-column flex-sm-row justify-content-start align-items-center p-3 text-white bg-primary bg-opacity-50  rounded-8 position-relative" ondrop="go_dropHandler(event);" ondragover="go_dragOverHandler(event);" ondragleave="go_dragLeaveHandler(event);">
							<button type="button" class="btn btn-light px-4 mb-0 mb-xs-3 mb-sm-0" onclick="document.getElementById('airport_file_upload').click();">Select File</button>
							<p class="mb-0 ps-4"><small>Drag and drop a CSV file, or select one from your computer</small></p>
						</div><!-- #go-airports-submit-box -->
					</div><!-- #go-airports-submit-box -->
				</div><!-- #go-airports-submit -->
			</main><!-- #main -->
		</div><!-- .row -->
	</div><!-- #content -->
</div><!-- #index-wrapper -->

<?php
get_footer();