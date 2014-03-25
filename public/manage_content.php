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
			<ul class="subjects">
			<?php
				$subject_set = get_all_subjects();

				while ( $subject = mysqli_fetch_assoc($subject_set) ) { ?>
					
					<li class="menu-item-<?php echo $subject["id"] ?>">
						<a href="manage_content.php?subject=<?php echo urlencode($subject["id"]) ?>">
							<?php echo $subject["menu_name"] ?>
						</a>
						<?php $page_set = get_pages_for_subject( $subject["id"] ); ?>
						<ul class="pages">
							<?php
								while ($page = mysqli_fetch_assoc($page_set)) { ?>
									<li class="page-item-<?php echo $page["id"] ?>">
										<a href="manage_content.php?page=<?php echo urlencode($page["id"]) ?>">
											<?php echo $page["menu_name"] ?>
										</a>
									</li>
								<?php }
								mysqli_free_result($page_set);
							?>
						</ul>
					</li>
				<?php }
				mysqli_free_result($subject_set);
			?>
			</ul>
		</div>
		<div id="page">
			<h2>Manage Content</h2>
			<?php echo $selected_subject_id; ?>
			<br />
			<?php echo $selected_page_id; ?>
		</div>
	</div>

<?php include( '../inc/layouts/footer.php' ); ?>