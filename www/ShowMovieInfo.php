<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Show Movie Information</title>
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
		$sql="select title,year,company,rating,id from Movie where id = $_GET[id] ";
		if (!mysql_query($sql,$db_connection))
			{
				die('Error: ' . mysql_error());
			}
		
		$rs = mysql_query($sql,$db_connection);
		$row = mysql_fetch_row($rs);
		echo '<p>';
		echo '--Show Movie Information--';
		echo '<br />';
		echo '<p>';
		
		echo "Title: ";
		echo $row[0].'('.$row[1].')';
		echo '<br />';
		echo '<p>';
		echo "Producer: ";
		echo $row[2];
		echo '<br />';
		echo '<p>';
		echo "MPAA Rating: ";
		echo $row[3];
		echo '<br />';
		echo '<p>';
		echo "Director: ";
		$sql2="select did from MovieDirector where mid = $row[4]";
		$rs2=mysql_query($sql2,$db_connection);
		while ($row2 = mysql_fetch_row($rs2))
			{
				$sql3="select first,last,dob from Director where id = $row2[0]";
				$rs3=mysql_query($sql3,$db_connection);
				$row3 = mysql_fetch_row($rs3);
				echo $row3[0].' '.$row3[1].'('.$row3[2].') ';
			}
		echo '<br />';
		echo '<p>';
		echo "Genre: ";
		$sql4="select genre from MovieGenre where mid = $row[4]";
		$rs4=mysql_query($sql4,$db_connection);
		while ($row4 = mysql_fetch_row($rs4))
			{
				echo $row4[0].' ';	
			}	
		echo '<br />';
		echo '<br />';
		echo "-- Actor in this movie --";
		echo '<br />';
		$sql5="select aid,role from MovieActor where mid = $row[4] ";
		$rs5 = mysql_query($sql5,$db_connection);
		while($row5 = mysql_fetch_row($rs5))
			{
				$sql6="select first,last from Actor where id = $row5[0]";
				$rs6 = mysql_query($sql6,$db_connection);
				$row6 = mysql_fetch_row($rs6);
				$save[0]=$row6[0].' '.$row6[1];
				echo "<a href=ShowActorInfo.php?id=$row5[0]>$save[0]</a>";
				echo " act as "."\"".$row5[1]."\"";
				echo '<br />';
			}
		echo '<br />';
		echo '<br />';
		echo "-- User Review --";
		echo '<br />';
		echo "Average score: ";	
		$sql6="select avg(rating),count(*),time,name,rating,comment from Review where mid = $row[4] GROUP BY mid ";
		$rs6=mysql_query($sql6,$db_connection);
		if (!mysql_query($sql6,$db_connection))
			{
				die('Error: ' . mysql_error());
			}
		$row6 = mysql_fetch_row($rs6);
		if($row6[1]==0)
			{
				echo "(Sorry, none review this movie)";
				echo '<br />';
				echo "<a href=AddComment.php?mid=$row[4]>Add your review now!!</a>";
				echo '<br />';
				echo "All Comments in Details:";
			}
		else
			{
				echo $row6[0]."/"."5(5.0 is the best) by ";
				echo $row6[1];
				echo " review(s).";
				echo '<br />';
				echo "<a href=AddComment.php?mid=$row[4]>Add your review now!!</a>";
				echo '<br />';
				echo "All Comments in Details:";
				$sql7="select time,name,rating,comment from Review where mid = $row[4]";
				$rs7=mysql_query($sql7,$db_connection);
				for($i=0;$i<$row6[1]&&$row7 = mysql_fetch_row($rs7);$i++)
					{
						echo '<br />';
						echo "In ";
						echo $row7[0].", ".$row7[1]." said: I rate this move score ".$row7[2]." point(s), here is my comment. ";
						echo '<br />';
						echo $row7[3];
					}
				
				
			}
		
		
	}
	mysql_close($db_connection);
	?>
    </div>
</div>
</body>
</html>
