<?php

	function confirm_query( $result_set ) {
		if(!$result_set) {
			die("Database query failed.");
		}
	}

	function get_all_subjects() {
		global $connection;

		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		// $query .= "WHERE visible = 1 ";
		$query .= "ORDER BY position ASC";
		$subject_set = mysqli_query($connection, $query);
		confirm_query( $subject_set );
		return $subject_set;
	}

	function get_subject_by_id( $subject_id ) {
		global $connection;

		$safe_subject_id = mysqli_real_escape_string ($connection, $subject_id );

		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id = {$safe_subject_id} ";
		$query .= "LIMIT 1";
		$subject_set = mysqli_query($connection, $query);
		confirm_query( $subject_set );
		if ($subject = mysqli_fetch_assoc($subject_set)) {
			return $subject;
		} else {
			return null;
		}

	}

	function get_pages_for_subject( $subject_id ) {
		global $connection;

		$safe_subject_id = mysqli_real_escape_string ($connection, $subject_id );

		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE visible = 1 ";
		$query .= "AND subject_id = " . $safe_subject_id . " ";
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($connection, $query);
		confirm_query( $page_set );
		return $page_set;
	}

	function navigation( $subject_id, $page_id ) { 
		?>
		<ul class="subjects">
			<?php
				$subject_set = get_all_subjects();

				while ( $subject = mysqli_fetch_assoc($subject_set) ) { ?>
					
					<?php 
						echo "<li";
						if ($subject["id"] == $subject_id) {
							echo " class=\"selected\""; 
						}
						echo ">";
					?>
						<a href="manage_content.php?subject=<?php echo urlencode($subject["id"]) ?>">
							<?php echo $subject["menu_name"] ?>
						</a>
						<?php $page_set = get_pages_for_subject( $subject["id"] ); ?>
						<ul class="pages">
							<?php
								while ($page = mysqli_fetch_assoc($page_set)) { ?>
									<?php 
										echo "<li";
										if ($page["id"] == $page_id) {
											echo " class=\"selected\""; 
										}
										echo ">";
									?>
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
		<?php 
	}


?>