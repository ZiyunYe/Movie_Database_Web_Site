<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Search Actor/Movie</title>
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
		<p>Search for actors/movies:
		<br /><p>Please enter actor's name or movie title:
		<input type="text" name="name" maxlength="100" />
		<br /><p>
		<input type="submit" value="Search!"/>
		</form>  
	<?php
	if($_GET['name']){
		$db_connection = mysql_connect("localhost", "cs143", "");
		if(!$db_connection) {
			$errmsg = mysql_error($db_connection);
			print "Connection failed <br />";
			exit(1);
			}
		mysql_select_db("CS143", $db_connection);
		echo '<p>';
		echo "You are searching for:";
		echo $_GET[name];
		echo '<br />';
		$arr=split(' ',$_GET['name']);
		$length=count($arr);
		echo '<br />';
		if ($length==1)
			{
			$sql1="select last,first,dob,id from Actor where first like '%$arr[0]%' or last like '%$arr[0]%'";
			$sql2="select title,year,id from Movie where title like '%$_GET[name]%' ";
			if (!mysql_query($sql1,$db_connection))
				{
					die('Error: ' . mysql_error());
				}
			$rs1 = mysql_query($sql1,$db_connection);
			$rows1=mysql_affected_rows();
			if ($rows1!=0)
				{
					echo "Searching match records in Actor database:";
					echo '<br />';
					for ($i=0;$i<$rows1&&$row = mysql_fetch_row($rs1);$i++)
						{
							$save[$i]=$row[1].' '.$row[0].'('.$row[2].')';				
							echo "<a href=ShowActorInfo.php?id=$row[3]>$save[$i]</a>";
							echo '<br />';
						}
					echo '<br />';
					echo '<br />';
				}
			else 
				{
					echo "Searching match records in Actor database:";
					echo '<br />';
					echo "No match Actor";
					echo '<br />';
				}
			$rs2 = mysql_query($sql2,$db_connection);
			$rows2=mysql_affected_rows();
			if ($rows2!=0)
				{
					echo "Searching match records in Movie database:";
					echo '<br />';
					for ($j=0;$j<$rows2&&$row = mysql_fetch_row($rs2);$j++)
						{
							$save2[$j]=$row[0].'('.$row[1].')';				
							echo "<a href=ShowMovieInfo.php?id=$row[2]>$save2[$j]</a>";
							echo '<br />';
						}
			
				}
			else 
				{
					echo "Searching match records in Movie database:";
					echo '<br />';
					echo "No match Movie";
					echo '<br />';
				}	
			}
		else if ($length==2)
			{
				$sql1="select last,first,dob,id from Actor where (first like '%$arr[0]%' and last like '%$arr[1]%') or (first like '%$arr[1]%' and last like '%$arr[0]%')";
				$sql2="select title,year,id from Movie where title like '%$_GET[name]%' ";
				if (!mysql_query($sql1,$db_connection))
					{
						die('Error: ' . mysql_error());
					}
				$rs1 = mysql_query($sql1,$db_connection);
				$rows1=mysql_affected_rows();
				if ($rows1!=0)
					{
						echo "Searching match records in Actor database:";
						echo '<br />';
						for ($i=0;$i<$rows1&&$row = mysql_fetch_row($rs1);$i++)
							{
								$save[$i]=$row[1].' '.$row[0].'('.$row[2].')';				
								echo "<a href=ShowActorInfo.php?id=$row[3]>$save[$i]</a>";
								echo '<br />';
							}
						echo '<br />';
						echo '<br />';
					}
				else 
					{
						echo "Searching match records in Actor database:";
						echo '<br />';
						echo "No match Actor";
						echo '<br />';
					}
				$rs2 = mysql_query($sql2,$db_connection);
				$rows2=mysql_affected_rows();
				if ($rows2!=0)
					{
						echo "Searching match records in Movie database:";
						echo '<br />';
						for ($j=0;$j<$rows2&&$row = mysql_fetch_row($rs2);$j++)
							{
								$save2[$j]=$row[0].'('.$row[1].')';				
								echo "<a href=http:ShowMovieInfo.php?id=$row[2]>$save2[$j]</a>";
								echo '<br />';
							}
			
					}
				else 
					{
						echo "Searching match records in Movie database:";
						echo '<br />';
						echo "No match Movie";
						echo '<br />';
					}
			}
		else
			{
				$sql2="select title,year,id from Movie where title like '%$_GET[name]%' ";
				if (!mysql_query($sql2,$db_connection))
					{
						die('Error: ' . mysql_error());
					}
				echo "Searching match records in Actor database:";
				echo '<br />';
				echo "No match Actor";
				echo '<br />';
				echo '<br />';
				$rs2 = mysql_query($sql2,$db_connection);
				$rows2=mysql_affected_rows();
				if ($rows2!=0)
					{
						echo "Searching match records in Movie database:";
						echo '<br />';
						for ($j=0;$j<$rows2&&$row = mysql_fetch_row($rs2);$j++)
							{
								$save2[$j]=$row[0].'('.$row[1].')';				
								echo "<a href=http:ShowMovieInfo.php?id=$row[2]>$save2[$j]</a>";
								echo '<br />';
							}
			
					}
				else 
					{
						echo "Searching match records in Movie database:";
						echo '<br />';
						echo "No match Movie";
						echo '<br />';
					}
			}
		
	}
	mysql_close($db_connection);
	?>
    </div>
</div>
</body>
</html>
