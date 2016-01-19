CREATE TABLE Movie(
	id int, 
	title varchar(100) NOT NULL, 
	year int NOT NULL, 
	rating varchar(10) NOT NULL, 
	company varchar(50) NOT NULL, 
	primary key(id))/*A primary key constraint. Make sure that Every movie has a unique identification number*/
	ENGINE=INNODB;
CREATE TABLE Actor(
	id int, 
	last varchar(20) NOT NULL, 
	first varchar(20) NOT NULL, 
	sex varchar(6) NOT NULL, 
	dob date NOT NULL, 
	dod date, 
	primary key(id),/*A primary key constraint. Make sure that Every Actor has a unique identification number*/
	check(sex='Male'or sex='Female'),/*A check constraint. Make sure that every actor's sex is Male or Female.*/
	check(dod='NULL'or dod>dob)) ENGINE=INNODB;/*A check constraint. Make sure that an actor's date of death is after date of birth.*/
CREATE TABLE Director(
	id int, 
	last varchar(20) NOT NULL, 
	first varchar(20) NOT NULL, 
	dob date NOT NULL, 
	dod date, 
	primary key(id), /*A primary key constraint. Make sure that Every Director has a unique identification number*/
	check(dod='NULL'or dod>dob)) ENGINE=INNODB; /*A check constraint. Make sure that a director's date of death is after date of birth.*/
CREATE TABLE MovieGenre(
	mid int NOT NULL, 
	genre varchar(20) NOT NULL,
	foreign key (mid) references Movie(id)) ENGINE=INNODB;/*A foreign key constraint. Make sure that every movie in the MovieGenre table has already been in Movie table*/
CREATE TABLE MovieDirector(
	mid int NOT NULL, 
	did int NOT NULL, 
	foreign key (mid) references Movie(id), /*A foreign key constraint. Make sure that every movie in the MovieDirector table has already been in Movie table*/
	foreign key (did) references Director(id)) ENGINE=INNODB;/*A foreign key constraint. Make sure that every Director in the MovieDirector table has already been in Director table*/
CREATE TABLE MovieActor(
	mid int NOT NULL, 
	aid int NOT NULL, 
	role varchar(50) NOT NULL, 
	foreign key (mid) references Movie(id), /*A foreign key constraint. Make sure that every movie in the MovieActor table has already been in Movie table*/
	foreign key (aid) references Actor(id)) ENGINE=INNODB;/*A foreign key constraint. Make sure that every Actor in the MovieActor table has already been in Actor table*/
CREATE TABLE Review(
	name varchar(20) NOT NULL, 
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
	mid int NOT NULL, 
	rating int NOT NULL, 
	comment varchar(500), 
	foreign key (mid) references Movie(id),/*A foreign key constraint. Make sure that every movie in the Review table has already been in Movie table*/
	check(rating>=0 and rating<=5)) ENGINE=INNODB;/*A check constraint. Make sure that a rating is x out of 5.*/
CREATE TABLE MaxPersonID(id int);
CREATE TABLE MaxMovieID(id int);