<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>+Actor/Director</title>
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
		<form action="AddActorDirector.php" method="get">
		<p>Add new actor/director: 
		<br /><p>Identity 
		<input type="radio" checked="checked" name="Identity" value="Actor" />Actor
		<input type="radio" name="Identity" value="Director" />Director
		<br /><p>First Name:
		<input type="text" name="first" maxlength="20" />
		<br /><p>Last Name:
		<input type="text" name="last" maxlength="20" />
		<br /><p>Sex 
		<input type="radio" checked="checked" name="sex" value="Male" />Male
		<input type="radio" name="sex" value="Female" />Female
		<br /><p>Date of Birth:
		<input type="text" name="dob"/>
		<br /><p>Date of Death:
		<input type="text" name="dod"/>
        <input type="checkbox" name="alive" value="1">Please click if still alive.</input>
		<br /><p>
		<input type="submit" value="ADD!"/>
		</form>  
	<?php
	if($_GET['Identity']){
		$db_connection = mysql_connect("localhost", "cs143", "");
		if(!$db_connection) {
			$errmsg = mysql_error($db_connection);
			print "Connection failed <br />";
			exit(1);
		}
		mysql_select_db("CS143", $db_connection);
		if($_GET[Identity]=='Actor'){
		$sql="INSERT INTO Actor (first, last, sex, dob, dod) VALUES ('$_GET[first]','$_GET[last]','$_GET[sex]','$_GET[dob]','$_GET[dod]')";
			mysql_query($sql,$db_connection);		
			if($_GET[alive]=="1")
			{
				$sql4="update Actor SET dod = NULL where id = 0";
				mysql_query($sql4,$db_connection);
			}
			$sql2="UPDATE Actor SET id = (select id from MaxPersonID) + 1 where id=0";
			mysql_query($sql2,$db_connection);
			$sql3="UPDATE MaxPersonID SET id = id + 1 ";
			mysql_query($sql3,$db_connection);
			echo '<p>';
			echo "An actor has been added!";
		}
	if($_GET[Identity]=='Director'){
		$sql="INSERT INTO Director (first, last, dob, dod) VALUES ('$_GET[first]','$_GET[last]','$_GET[dob]','$_GET[dod]')";
		mysql_query($sql,$db_connection);
			
		if($_GET[alive]=="1")
			{
				$sql4="update Director SET dod = NULL where id = 0";
				mysql_query($sql4,$db_connection);
			}
		$sql2="UPDATE Director SET id = (select id from MaxPersonID) + 1 where id=0";
		mysql_query($sql2,$db_connection);
		$sql3="UPDATE MaxPersonID SET id = id + 1 ";
		mysql_query($sql3,$db_connection);
		echo '<p>';
		echo "A director has been added!";
	}
	mysql_close($db_connection);
	}
	?>
    </div>
</div>
</body>
</html>
