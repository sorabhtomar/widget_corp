<?php require_once( '../inc/db_connection.php' ); ?>
<?php require_once( '../inc/functions.php' ); ?>
<?php include( '../inc/layouts/header.php' ); ?>

<?php
	if (isset($_GET["subject"])) {
		$selected_subject_id = $_GET["subject"];
		$selected_page_id = null;
	} elseif (isset($_GET["page"])) {
		$selected_page_id = $_GET["page"];
		$selected_subject_id = null;
	} else {
		$selected_subject_id = null;
		$selected_page_id = null;
	}
?>
	
	<div id="main">
		<div id="navigation">
			<?php navigation( $selected_subject_id, $selected_page_id ); ?>
		</div>
		<div id="page">
			<h2>Manage Content</h2>
			<?php if ($selected_subject_id) { ?>
			
				<?php $current_subject = get_subject_by_id( $selected_subject_id ); ?>
				Menu name: <?php echo $current_subject["menu_name"]; ?>

			<?php } elseif ($selected_page_id) { ?>
				<?php echo $selected_page_id; ?>
			<?php } else { ?>
				Please select a subject or a page.
			<?php } ?>
		</div>
	</div>

<?php include( '../inc/layouts/footer.php' ); ?>