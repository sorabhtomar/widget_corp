<?php require_once( '../inc/db_connection.php' ); ?>
<?php require_once( '../inc/functions.php' ); ?>

<?php include( '../inc/layouts/header.php' ); ?>
	
	<div id="main">
		<div id="navigation">
			<ul class="subjects">
			<?php
				$query  = "SELECT * ";
				$query .= "FROM subjects ";
				$query .= "WHERE visible = 1 ";
				$query .= "ORDER BY position ASC";
				$subject_set = mysqli_query($connection, $query);
				confirm_query( $subject_set );

				while ( $subject = mysqli_fetch_assoc($subject_set) ) {
					// output data from each subject
					echo "<li class=\"menu-item-" . $subject["id"] . "\">" . $subject["menu_name"];
					?>
						<?php
							$query  = "SELECT * ";
							$query .= "FROM pages ";
							$query .= "WHERE visible = 1 ";
							$query .= "AND subject_id = " . $subject["id"] . " ";
							$query .= "ORDER BY position ASC";
							$page_set = mysqli_query($connection, $query);
							confirm_query( $page_set );
						?>
						<ul class="pages">
							<?php
								while ($page = mysqli_fetch_assoc($page_set)) {
									echo "<li class=\"page-item-" . $page["id"] . "\">" . $page["menu_name"] . "</li>";
								}

								mysqli_free_result($page_set);
							?>
						</ul>
					<?php
					echo "</li>";
				}

				mysqli_free_result($subject_set);
			?>
			</ul>
		</div>
		<div id="page">
			<h2>Manage Content</h2>
			
		</div>
	</div>

<?php include( '../inc/layouts/footer.php' ); ?>