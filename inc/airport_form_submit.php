<?php 

if(isset($_POST['airport_file_submit'])):
	//Set New Post Values
	$submission_arr = array(
		'post_title' => time(),
		'post_status' => 'publish',
		'post_type' => 'submission',
	);

	//Create New Submission Post
	$submission_id = wp_insert_post($submission_arr);

	//Require WP media files to write to library
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	//Create new media post attached to submission post
	$attachment_id = media_handle_upload( 'airport_file_upload', $submission_id);

	//add attachment to CSV field for backup reference
	update_field('airport_csv', $attachment_id, $submission_id);

	//open and parse attached CSV
	$submission_csv = fopen(wp_get_attachment_url($attachment_id), 'r');
	$submission_airports = array();
	$submission_header = fgetcsv($submission_csv);
	while ($submission_row = fgetcsv($submission_csv)) :
		$submission_airports[] = array_combine($submission_header, $submission_row);
	endwhile;
	fclose($submission_csv);

	//add CSV values as repeater rows to post
	foreach ($submission_airports as $airport):
		$airport_row = array(
			'id' => $airport['ID'],
			'name' => $airport['Airport Name'],
			'city' => $airport['City'],
			'country' => $airport['Country'],
			'iata-faa' => $airport['IATA/FAA'],
			'icao' => $airport['ICAO'],
			'latitude' => $airport['Latitude'],
			'longitude' => $airport['Longitude'],
			'altitude' => $airport['Altitude'],
			'timezone' => $airport['Timezone'],
		);

		add_row('airport_locations', $airport_row, $submission_id);
	endforeach;

	//redirect to new post
	$submission_url = get_permalink($submission_id);

	?>
	<script>
		window.location.replace("<?php echo $submission_url; ?>");
	</script>
<?php 

endif;