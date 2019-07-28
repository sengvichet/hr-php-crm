<?php
$query = "select * from blogPosts order by post_ID DESC LIMIT 3";
$result = mysqli_query( $link, $query );
	if ( $result && mysqli_num_rows( $result ) != 0 ) {
		print "<hr>\n
						</div><!-- pageTitle column -->\n
					</div><!-- pageTitle row -->\n
				</div><!-- pageContent -->\n
			</div><!-- pageContain -->\n
		</div><!-- container -->\n
		<div class='container'>
			<div class='row blogBoxUpper popContainer'>\n";
			while ( $row = mysqli_fetch_row( $result ) ) {
				list( $post_ID, $post_Title, $post_Date, $post_Author, $post_StaticDate, $post_Content, $post_Gallery, $post_Status ) = $row;
				//if($post_Status == 1)
				//{
				$post_Title = unfixstring( $post_Title );
				$post_Content = unfixstring( $post_Content );
					if(strlen($post_Content) > 460)
					{
						$post_Content = Text::truncate("blog", $post_ID, $post_Content);
					}
				$post_Date = date_create( $post_Date );
				$friendlyDate = date_format( $post_Date, 'F jS\, Y' );
				print "<div class='col-md-4 postPop' id='postPop$post_ID'>\n
							<div class='postDate'>$post_StaticDate</div>\n
							<div class='postTitle'><h3 class='blogHeader'><a href='blog.php?post=$post_ID'>$post_Title</a></h3></div>\n
							<div class='postContent blogPost$post_ID'>$post_Content</div>\n
						</div>\n
					<hr class='blogBoxUpperHR'>\n";
				//}
			}
				print "
				</div><!-- popContainer -->\n 
				
					<div class='pageContain'>\n
						<div class='pageContent'>\n";
	}
?>