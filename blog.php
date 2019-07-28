<?php
include( '_dbConnect.php' );
$link = connectDB( $host, $user, $pass, $db );
include( "_functions.php" );
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include( "_headerdata1.php" );
	print "\n";
	?>
	<title>HR Done Right Inc. - Sacramento, CA | Blog</title>
	<?php
	include( "_headerdata2.php" );
	print "\n";
	?>
</head>

<body>
	<?php
	include( "_pageheader.php" );
	print "\n";
	?>
	<div class="container">
		<div class="pageContain">
			<?php
			$noPad       = ""; // not page 1, pad normally
			$currentPage = 0;
			$numPages    = 0;
			if ( isset( $_GET[ 'page' ] ) ) {
				if ( is_numeric( $_GET[ 'page' ] ) ) {
					$currentPage = $_GET[ 'page' ];
					if ( $currentPage == 1 ) {
						$noPad = "noBottomPad";
					}
				}
			} else {
				$noPad = "noBottomPad";
			}
			?>
			<div class="pageContent <?php print " $noPad "; ?> ">
				<div class="row">
					<div class="col-md-12"><a id='blogPage' class='pageAnchor'></a>
						<div class="pageTitle"><a href="blog.php">Blog</a></div>
						<?php
						if ( isset( $_GET[ 'post' ] ) ) {
							if ( is_numeric( $_GET[ 'post' ] ) ) {
								$currentPost = $_GET[ 'post' ];
								$query = "select * from blogPosts where post_ID = '$currentPost'";
								$result = mysqli_query( $link, $query );
							}

							if ($result && mysqli_num_rows( $result ) != 0) {
								while ( $row = mysqli_fetch_row( $result ) ) {
									list( $post_ID, $post_Title, $post_Date, $post_Author, $post_StaticDate, $post_Content, $post_Gallery, $post_Status ) = $row;
									//if($post_Status == 1)
									//{
									$post_Title = unfixstring( $post_Title );
									$post_Content = unfixstring( $post_Content );
									$post_Date = date_create( $post_Date );
									$friendlyDate = date_format( $post_Date, 'F jS\, Y' );
									print " <hr>
								<div class='container-fluid blogPost blogPost$post_ID'>
									<div class='row'>
										<div class='postDate'>$post_StaticDate</div>
										<div class='postTitle'><h3 class='blogHeader'>$post_Title</h3></div>
										<!--<hr class='blogTitleHR'>-->
									</div>
									<div class='row blogPost$post_ID'>
										$post_Content
									</div>
								</div>";
									//}
								}
							} else {
								print "Blog post not found.";
							}

						} else //not displaying a specific post
						{
							$query = "select * from blogPosts";
							$result = mysqli_query( $link, $query );
							if ($result && mysqli_num_rows( $result ) != 0) {
								$totalPosts = mysqli_num_rows( $result );
								$numPages = 0;
								if ( ( $totalPosts % 5 == 0 ) && ( $totalPosts != 0 ) ) {
									$numPages = $totalPosts / 5;
								} elseif ( $totalPosts != 0 ) {
									$numPages = floor( $totalPosts / 5 + 1 );
								} else {
									$numPages = 1;
								}
								if ( isset( $_GET[ 'page' ] ) ) {
									if ( is_numeric( $_GET[ 'page' ] ) ) {
										$currentPage = $_GET[ 'page' ];
										if ( $currentPage == 1 ) {
											$offset = "OFFSET 3";
											include( '_blogPostsPop.php' ); //display first 3 posts
										} else {
											$offset = " OFFSET " . ( $currentPage - 1 ) * 5;
										}
										//setup query for rest of posts
										$limit = "LIMIT 5";
										$query = "select * from blogPosts order by post_ID DESC $limit $offset";
										$result = mysqli_query( $link, $query );
									}
								} else {
									$currentPage = 1;
									$limit = "LIMIT 5";
									$offset = "OFFSET 3";
									include( '_blogPostsPop.php' ); //display first 3 posts
									//setup query for rest of posts
									$query = "select * from blogPosts order by post_ID DESC $limit $offset";
									$result = mysqli_query( $link, $query );
								}
							}

							if ($result && mysqli_num_rows( $result ) != 0) {
								while ( $row = mysqli_fetch_row( $result ) ) {
									list( $post_ID, $post_Title, $post_Date, $post_Author, $post_StaticDate, $post_Content, $post_Gallery, $post_Status ) = $row;
									//if($post_Status == 1)
									//{
									$post_Title = unfixstring( $post_Title );
									$post_Content = unfixstring( $post_Content );
									if ( strlen( $post_Content ) > 460 ) {
										$post_Content = Text::truncate( "blog", $post_ID, $post_Content );
									}
									$post_Date = date_create( $post_Date );
									$friendlyDate = date_format( $post_Date, 'F jS\, Y' );
									print " <hr>
								<div class='container-fluid blogPost'>
									<div class='row'>
										<div class='postDate'>$post_StaticDate</div>
										<div class='postTitle'><h3 class='blogHeader'><a href='blog.php?post=$post_ID'>$post_Title</a></h3></div>
										<!--<hr class='blogTitleHR'>-->
									</div>
									<div class='row blogPost$post_ID'>
										$post_Content
									</div>
								</div>";
									//}
								}
							} else {
								//print "There are no posts to display.";
							}
						}
						?>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="paginationContain">
									<?php
									$pagesToDisplay = 7;
									if ( $currentPage - 1 > 0 ) {
										$prevPage = $currentPage - 1;
									} else {
										$prevPage = $currentPage;
									}

									if ( $currentPage + 1 <= $numPages ) {
										$nextPage = $currentPage + 1;
									} else {
										$nextPage = $currentPage;
									}
									if ( $prevPage != $currentPage ) {
										print "<a href='blog.php?page=$prevPage'>Previous</a>\n";
									}
									if ( $numPages > $pagesToDisplay ) {
										$buttonsBefore = 3;
										$buttonsAfter = 3;
										if ( $currentPage - 3 > 1 ) {
											print "<a class='firstPage' href='blog.php?page=1'>&laquo;</a>";
										}
										for ( $i = $currentPage - 3; $i <= $currentPage + 3; $i++ ) {
											if ( $i < 1 ) {
												$buttonsAfter++;
												$buttonsBefore--;
											}
											if ( $i > $numPages ) {
												$buttonsAfter--;
												$buttonsBefore++;
											}
										}
										for ( $i = $currentPage - $buttonsBefore; $i <= $currentPage + $buttonsAfter; $i++ ) {
											$isActive = "";
											if ( $i == $currentPage ) {
												$isActive = "blogButtonActive";
											}
											print "<a href='blog.php?page=$i' id='page$i" . "button" . "' class='$isActive'>$i</a>";
										}
										if ( $currentPage + 3 < $numPages ) {
											print "<a class='lastPage' href='blog.php?page=$numPages'>&raquo;</a>";
										}
									} else {
										for ( $i = 1; $i <= $numPages; $i++ ) {
											$isActive = "";
											if ( $i == $currentPage ) {
												$isActive = "blogButtonActive";
											}
											print "<a href='blog.php?page=$i' id='page$i" . "button" . "' class='$isActive'>$i</a>";
										}
									}

									if ( $nextPage != $currentPage ) {
										print "<a href='blog.php?page=$nextPage'>Next</a>\n";
									}

									if ( $currentPage != 1 ) {
										print "			</div>\n
											</div>\n
										</div>\n
									</div>\n
								</div>\n"; //pagecontain pagecontent close
									} else {
										print "</div></div></div>\n"; //container/pagination/something else close
									}

									?>
			</div>
		</div>
	</div>
	<?php
	include( "_pagefooter.php" );
	print "\n";
	?>
</body>

</html>