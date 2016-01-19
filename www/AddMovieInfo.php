<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>+Movie Information</title>
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
	<form action="AddMovieInfo.php" method="get">
		<p>Add a new movie information: 
		<br /><p>Movie Title:
		<input type="text" name="title" maxlength="100"/>
		<br /><p>Release Year:
		<input type="text" name="year"/>
        <br /><p>MPAA rating:
		<input type="text" name="rating" maxlength="10"/>
        <br /><p>Production Company:
		<input type="text" name="company" maxlength="50"/>
        <br /><p>Movie Genre:
		<br />
		<input type="checkbox" name="genre_action" value="Action">Action</input>
		<input type="checkbox" name="genre_adult" value="Adult">Adult</input>
		<input type="checkbox" name="genre_adventure" value="Adventure">Adventure</input>
		<input type="checkbox" name="genre_animation" value="Animation">Animation</input>
		<input type="checkbox" name="genre_comedy" value="Comedy">Comedy</input>
		<input type="checkbox" name="genre_crime" value="Crime">Crime</input>
		<br />
		<input type="checkbox" name="genre_documentary" value="Documentary">Documentary</input>
		<input type="checkbox" name="genre_drama" value="Drama">Drama</input>
		<input type="checkbox" name="genre_family" value="Family">Family</input>
		<input type="checkbox" name="genre_fantasy" value="Fantasy">Fantasy</input>
		<input type="checkbox" name="genre_horror" value="Horror">Horror</input>
		<input type="checkbox" name="genre_musical" value="Musical">Musical</input>
		<br />
		<input type="checkbox" name="genre_mystery" value="Mystery">Mystery</input>
		<input type="checkbox" name="genre_romance" value="Romance">Romance</input>
		<input type="checkbox" name="genre_scifi" value="Sci-Fi">Sci-Fi</input>
		<input type="checkbox" name="genre_short" value="Short">Short</input>
		<input type="checkbox" name="genre_thriller" value="Thriller">Thriller</input>
		<input type="checkbox" name="genre_war" value="War">War</input>
		<input type="checkbox" name="genre_western" value="Western">Western</input>
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
		$sql="INSERT INTO Movie (title, year, rating, company) VALUES ('$_GET[title]','$_GET[year]','$_GET[rating]','$_GET[company]')";
		mysql_query($sql,$db_connection);	
		$sql2="UPDATE Movie SET id = (select id from MaxMovieID) + 1 where id=0";
		mysql_query($sql2,$db_connection);
		$sql3="UPDATE MaxMovieID SET id = id + 1 ";
		mysql_query($sql3,$db_connection);
		if ($_GET[genre_action]=="Action")
			{
				$sql4="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_action]')";
				mysql_query($sql4,$db_connection);
			}
		if ($_GET[genre_adult]=="Adult")
			{
				$sql5="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_adult]')";
				mysql_query($sql5,$db_connection);
			}
		if ($_GET[genre_adventure]=="Adventure")
			{
				$sql6="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_adventure]')";
				mysql_query($sql6,$db_connection);
			}
		if ($_GET[genre_animation]=="Animation")
			{
				$sql7="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_animation]')";
				mysql_query($sql7,$db_connection);
			}
		if ($_GET[genre_comedy]=="Comedy")
			{
				$sql8="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_comedy]')";
				mysql_query($sql8,$db_connection);
			}
		if ($_GET[genre_crime]=="Crime")
			{
				$sql9="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_crime]')";
				mysql_query($sql9,$db_connection);
			}
		if ($_GET[genre_documentary]=="Documentary")
			{
				$sql10="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_documentary]')";
				mysql_query($sql10,$db_connection);
			}
		if ($_GET[genre_drama]=="Drama")
			{
				$sql11="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_documentary]')";
				mysql_query($sql11,$db_connection);
			}
		if ($_GET[genre_family]=="Family")
			{
				$sql12="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_family]')";
				mysql_query($sql12,$db_connection);
			}
		if ($_GET[genre_fantasy]=="Fantasy")
			{
				$sql13="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_fantasy]')";
				mysql_query($sql13,$db_connection);
			}
		if ($_GET[genre_horror]=="Horror")
			{
				$sql14="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_horror]')";
				mysql_query($sql14,$db_connection);
			}
		if ($_GET[genre_musical]=="Musical")
			{
				$sql15="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_musical]')";
				mysql_query($sql15,$db_connection);
			}
		if ($_GET[genre_mystery]=="Mystery")
			{
				$sql16="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_mystery]')";
				mysql_query($sql16,$db_connection);
			}
		if ($_GET[genre_romance]=="Romance")
			{
				$sql17="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_romance]')";
				mysql_query($sql17,$db_connection);
			}
		if ($_GET[genre_scifi]=="Sci-Fi")
			{
				$sql18="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_scifi]')";
				mysql_query($sql18,$db_connection);
			}
		if ($_GET[genre_short]=="Short")
			{
				$sql19="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_short]')";
				mysql_query($sql19,$db_connection);
			}
		if ($_GET[genre_thriller]=="Thriller")
			{
				$sql20="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_thriller]')";
				mysql_query($sql20,$db_connection);
			}
		if ($_GET[genre_war]=="War")
			{
				$sql21="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_war]')";
				mysql_query($sql21,$db_connection);
			}
		if ($_GET[genre_western]=="Western")
			{
				$sql22="INSERT INTO MovieGenre (mid, genre) VALUES ((select id from MaxMovieID),'$_GET[genre_western]')";
				mysql_query($sql22,$db_connection);
			}
		echo '<p>';
		echo "A movie has been added!";
		}
	mysql_close($db_connection);
	?>
    </div>
</div>
</body>
</html>
