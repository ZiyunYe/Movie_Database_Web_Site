<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Add Comment</title>
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
	<p>Add new comment: 
		
		<form action="AddComment.php" method="GET">			
			<p>Movie:	<select name="mid">
            			<option value=<?php echo $_GET[mid]?> selected="selected">
						<?php
							$db_connection = mysql_connect("localhost", "cs143", "");
							if(!$db_connection) 
								{
									$errmsg = mysql_error($db_connection);
									print "Connection failed <br />";
									exit(1);
								}
							mysql_select_db("CS143", $db_connection);
							$sql1="select title from Movie where id = $_GET[mid]";
							$rs1=mysql_query($sql1,$db_connection);
							$row1 = mysql_fetch_row($rs1);
							echo $row1[0];
						?></option>
					</select>
			<br/>
			Your Name:	<input type="text" name="username" value="Mr. Anonymous" maxlength="40"><br/>
			Rating:	<select name="rating">
						<option value="5"> 5 - Excellent </option>
						<option value="4"> 4 - Good </option>
						<option value="3"> 3 - It's ok~ </option>
						<option value="2"> 2 - Not worth </option>
						<option value="1"> 1 - I hate it </option>
					</select>
			<br/>
			Comments: <br/>
			<textarea name="comment" cols="70" rows="10"></textarea>
			<br/><p>
			<input type="submit" value="Rate it!!"/>
		</form>
		<p>
		<?php
			if($_GET['username'])
				{
					$db_connection = mysql_connect("localhost", "cs143", "");
					if(!$db_connection) 
						{
							$errmsg = mysql_error($db_connection);
							print "Connection failed <br />";
							exit(1);
						}
					mysql_select_db("CS143", $db_connection);
					$sql2="insert into Review (name,mid,rating,comment) values ('$_GET[username]',$_GET[mid],$_GET[rating],'$_GET[comment]')";
					$rs2=mysql_query($sql2,$db_connection);
					echo "Thank you for your comment!";
					echo '<br />';
				}
		
		
			mysql_close($db_connection);
		?>
    <a href="ShowMovieInfo.php?id=<?php echo $_GET[mid]?>">Back to Movie Information</a>
    </div>
</div>
</body>
</html>




