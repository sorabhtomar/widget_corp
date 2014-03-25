<?php require_once( '../inc/db_connection.php' ); ?>
<?php require_once( '../inc/functions.php' ); ?>
<?php include( '../inc/layouts/header.php' ); ?>
<?php set_current_page(); ?>
	
	<div id="main">
		<div id="navigation">
			<?php navigation( $current_subject, $current_page ); ?>
			<br />
			<a href="new_subject.php">+ Add a subject</a>
		</div>
		<div id="page">
			<?php if ($current_subject) { ?>
				<h2>Manage Subject</h2>

				Menu name: <?php echo $current_subject["menu_name"]; ?>

			<?php } elseif ($current_page) { ?>
				<h2>Manage Page</h2>
			
				Menu name: <?php echo $current_page["menu_name"]; ?>

			<?php } else { ?>
				Please select a subject or a page.
			<?php } ?>
		</div>
	</div>

<?php include( '../inc/layouts/footer.php' ); ?>