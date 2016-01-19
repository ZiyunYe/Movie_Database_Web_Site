<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Show Actor Information</title>
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
	<form action="search.php" method="get">
		<p>Search for other actors/movies:
		<br /><p>Please enter actor's name or movie title:
		<input type="text" name="name" maxlength="100" />
		<br /><p>
		<input type="submit" value="Search!"/>
		</form>  
	<?php
	if($_GET['id']){
		$db_connection = mysql_connect("localhost", "cs143", "");
		if(!$db_connection) {
			$errmsg = mysql_error($db_connection);
			print "Connection failed <br />";
			exit(1);
		}
		mysql_select_db("CS143", $db_connection);
		$sql="select id,last,first,sex,dob,dod from Actor where id = $_GET[id]";
		if (!mysql_query($sql,$db_connection))
			{
				die('Error: ' . mysql_error());
			}
		
		$rs = mysql_query($sql,$db_connection);
		$num = mysql_num_fields($rs);
		$row = mysql_fetch_row($rs);
		echo '<p>';
		echo '--Show Actor Information--';
		echo '<br />';
		echo '<p>';
		
		echo "NAME: ";
		echo $row[2].' '.$row[1];
		echo '<br />';
		echo '<p>';
		echo "SEX: ";
		echo $row[3];
		echo '<br />';
		echo '<p>';
		echo "Date Of Birth: ";
		echo $row[4];
		echo '<br />';
		if ($row[5]!=NULL){
			echo '<p>';
			echo "Date Of Death: ";
			echo $row[5];
			echo '<br />';
			}
		else{
			echo '<p>';
			echo "Date Of Death: --Still Alive--";
			echo '<br />';
			}
		echo '<br />';
		echo '--Act In--';
		echo '<br />';
		$sql2="select mid,role from MovieActor where aid = $row[0] ";
		$rs2 = mysql_query($sql2,$db_connection);
		$num = mysql_num_fields($rs2);	
		$rows2=mysql_affected_rows();
		echo '<br />';
		while ($row2 = mysql_fetch_row($rs2))
			{
				echo "Act \"".$row2[1]."\" in ";
				$sql3="select title from Movie where id = $row2[0]";
				$rs3 = mysql_query($sql3,$db_connection);
				$row3 = mysql_fetch_row($rs3);
				echo "<a href=ShowMovieInfo.php?id=$row2[0]>$row3[0]</a>";
				echo '<br />';
			}
	}
	mysql_close($db_connection);
	?>
    </div>
</div>
</body>
</html>
