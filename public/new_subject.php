<?php require_once( '../inc/db_connection.php' ); ?>
<?php require_once( '../inc/functions.php' ); ?>
<?php include( '../inc/layouts/header.php' ); ?>
<?php set_current_page(); ?>
	
	<div id="main">
		<div id="navigation">
			<?php navigation( $current_subject, $current_page ); ?>
		</div>
		<div id="page">
			<h2>Create Subject</h2>

			<form action="create_subject.php" method="post">
				<p>Subject Name:
					<input type="text" name="menu_name" value="" />
				</p>
				<p>Position:
					<select name="position">
						<?php 
							$subject_set = get_all_subjects();
							$subject_count = mysqli_num_rows($subject_set);
							for ($i=1; $i <= $subject_count + 1; $i++) { ?>
								<option value="<?php echo $i ?>"><?php echo $i ?></option>
							<?php }
						?>
					</select>
				</p>
				<p>Visible:
					<input type="radio" name="visible" value="0" /> No
					&nbsp;
					<input type="radio" name="visible" value="1" /> Yes
				</p>
				<input type="submit" value="Create Subject" />
			</form>
			<br />
			<a href="manage_content.php">Cancel</a>
		</div>
	</div>

<?php include( '../inc/layouts/footer.php' ); ?>