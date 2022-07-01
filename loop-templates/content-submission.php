<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


//define marker php array
$airports = array();
if(have_rows('airport_locations')) :
	while(have_rows('airport_locations')) : the_row();
		$airports[] = array(
			'lat' => get_sub_field('latitude'),
			'lng' => get_sub_field('longitude'),
			'name' => get_sub_field('name'),
		);		
	endwhile;
?>
	<script>
		//Define Marker JS array
		let go_airports = <?php echo json_encode($airports); ?>
	</script>
<?php endif;


?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="entry-content row justify-content-center align-items-end" id="go-airports-entry-content">
		<div id="go-airports-bg" class="px-0 position-absolute top-0 start-0 bottom-0 end-0 w-100 h-100">
			<div id="map" class="w-100 h-100"></div>
		</div>
		<div id="go-airports-share" class="col-12 col-sm-10 col-md-8 col-lg-5">
			<div id="go-airports-share_box" class="d-flex justify-content-between align-items-center bg-primary bg-opacity-50 rounded-8 p-3 position-relative">
				<?php if(have_rows('airport_locations')) : ?>
					<p id="go-airports-share_box_text" class="text-white mb-0"><strong class="fw-semibold">Nice airports!</strong> Your sharable URL is:</p>
					<div id="go-airports-share_box_link" class="d-flex justify-content-between rounded-3 p-2 bg-white">
						<span id="go-airports-share_box_link_val" class="d-block px-1 me-2"><?php the_permalink(); ?></span>
						<button id="go-airports-share_box_link_a" class="d-block px-1 py-0 ms-2 btn btn-light" onclick="goClipboard()">
							<img id="go-airports-share_box_link_img" src="<?php echo get_stylesheet_directory_uri(); ?>/inc/img/copy-icon.png" />
						</button>
					</div>
				<?php else: ?>
					<p id="go-airports-share_box_text" class="text-white mb-0"><strong class="fw-semibold">Oops!</strong> You didn't include any airports.</p>
					<a id="go-airports-share_box_back" class="btn btn-light" href="<?php echo esc_url(home_url()); ?>" role="button">Try Again</a>
				<?php endif; ?>
			</div> <!-- #go-airports-share_box -->
		</div> <!-- #go-airports-share -->
	</div><!-- .entry-content #go-airports-entry-content -->
</article><!-- #post-## -->