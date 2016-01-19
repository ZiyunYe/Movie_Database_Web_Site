<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>+Movie/Director Relation</title>
</head>
<body>
<div class="container">
<div class="sidebar1">
		<p>&nbsp; </p>
		<p> Welcome to MOVIE! </p>
		<ul class="nav">
			<li>
			<div align="right"><a href="index.php"> INDEX</a></div>
			</li>
		</ul>
		<p>Add New Content: </p>
		<ul class="nav">
			<li>
			<div align="right"><a href="AddActorDirector.php"> +Actor/Director</a></div>
			</li>
			<li>
			<div align="right"><a href="AddMovieInfo.php">+Movie Information</a></div>
			</li>
			<li>
			<div align="right"><a href="AddMovieActor.php">+Movie/Actor Relation</a></div>
			</li>
			<li>
			<div align="right"><a href="AddMovieDirector.php">+Movie/Director Relation</a></div>
			</li>
			<li>
			<div align="right"><a href="AddReview.php">+Movie Review</a></div>
			</li>
		</ul>
		<p> Browsering Content: </p>
		<ul class="nav">
			<li>
			<div align="right"><a href="ShowActorInfo.php?id=25722"> Show Actor Information</a></div>
			</li>
			<li>
			<div align="right"><a href="ShowMovieInfo.php?id=1694">Show Movie Information</a></div>
			</li>
		</ul>
		<p>Search Interface: </p>
		<ul class="nav">
			<li>
			<div align="right"><a href="search.php"> Search Actor/Movie</a></div>
			</li>
		</ul>
    </div>
	<div class="content">
	<form action="AddMovieDirector.php" method="get">
		<p>Add a new "director to movie" relation: 
		<br /><p>Movie Title:
		<input type="text" name="title" maxlength="100"/>
		<br /><p>Director's First Name:
		<input type="text" name="first" maxlength="20" />
		<br /><p>Director's Last Name:
		<input type="text" name="last" maxlength="20" />
		<br /><p>
		<input type="submit" value="ADD!"/>
		</form>  
	<?php
	if($_GET[title]){
		$db_connection = mysql_connect("localhost", "cs143", "");
		if(!$db_connection) {
			$errmsg = mysql_error($db_connection);
			print "Connection failed <br />";
			exit(1);
		}
		mysql_select_db("CS143", $db_connection);
		$sql2="select id from Movie where title='$_GET[title]'";
		$rs2=mysql_query($sql2,$db_connection);
		$row2 = mysql_fetch_row($rs2);
		$sql3="select id from Director where first='$_GET[first]' and last='$_GET[last]'";
		$rs3=mysql_query($sql3,$db_connection);
		$row3 = mysql_fetch_row($rs3);
		if ($row2[0]==NULL)
			{
				echo '<p>';
				echo "Sorry, there is no match movie.";
			}
		else if ($row3[0]==NULL)
			{
				echo '<p>';
				echo "Sorry, there is no match director.";
			}
		else
			{
				$sql="INSERT INTO MovieDirector (mid, did) VALUES ((select id from Movie where title='$_GET[title]'),(select id from Director where first='$_GET[first]' and last='$_GET[last]'))";
				if (!mysql_query($sql,$db_connection))
					{
						die('Error: ' . mysql_error());
					}
				echo '<p>';
				echo "A director to movie relation has been added!";
			}
		}
	mysql_close($db_connection);
	?>
    </div>
</div>
</body>
</html>
