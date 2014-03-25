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

	function get_page_by_id( $page_id ) {
		global $connection;

		$safe_page_id = mysqli_real_escape_string ($connection, $page_id );

		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		$query .= "LIMIT 1";
		$page_set = mysqli_query($connection, $query);
		confirm_query( $page_set );
		if ($page = mysqli_fetch_assoc($page_set)) {
			return $page;
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

	function navigation( $subject_array, $page_array ) { 
		?>
		<ul class="subjects">
			<?php
				$subject_set = get_all_subjects();

				while ( $subject = mysqli_fetch_assoc($subject_set) ) { ?>
					
					<?php 
						echo "<li";
						if ($subject_array && $subject["id"] == $subject_array["id"]) {
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
										if ($page_array && $page["id"] == $page_array["id"]) {
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

	function set_current_page() {
		global $current_subject;
		global $current_page;

		if (isset($_GET["subject"])) {
			$current_subject = get_subject_by_id( $_GET["subject"] );
			$current_page = null;
		} elseif (isset($_GET["page"])) {
			$current_page = get_page_by_id( $_GET["page"] );
			$current_subject = null;
		} else {
			$current_page = null;
			$current_subject = null;
		}
	}

?>