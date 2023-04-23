--create tables
CREATE TABLE Users (
	userId INTEGER,
	dob CHAR(20),
	gender CHAR(20),
	password CHAR(20),
	firstName CHAR(20),
	lastName CHAR(20),
	email CHAR(20),
	hometown CHAR(20),
	contributions INTEGER 
	PRIMARY KEY(userId));

CREATE TABLE Friends (
	friendUserId INTEGER,
	userId INTEGER,
	friendshipDate CHAR(20),
	PRIMARY KEY (friendUserId, userId),
	FOREIGN KEY (friendUserId) REFERENCES Users(userId),
	FOREIGN KEY (userId) REFERENCES Users(userId));

CREATE TABLE Albums (
	albumId INTEGER,
	userId INTEGER,
	name CHAR(20),
	createdDate CHAR(20),
	PRIMARY KEY (albumId));

CREATE TABLE Photos (
	photoId INTEGER,
	caption CHAR(20),
	albumId CHAR(20),
	data CHAR(20),
	PRIMARY KEY (photoId));

CREATE TABLE Likes (
	userId INTEGER,
	photoId INTEGER,
	PRIMARY KEY (userId, PhotoId),
	FOREIGN KEY (userId) REFERENCES Users(userId),
	FOREIGN KEY (photoId) REFERENCES Photos(photoId));

CREATE TABLE Comments (
	commentId INTEGER,
	userId INTEGER,
	photoId INTEGER,
	text CHAR(20),
	commentDate CHAR(20),
	PRIMARY KEY (commentId));

CREATE TABLE Tags (
	photoId Integer,
	text CHAR(20),
	PRIMARY KEY (text));

--USER MANAGEMENT QUERIES 
--check duplicate email
SELECT 
	CASE WHEN [email] = users.email THEN "duplicate email"
	END
FROM Users AS users

--add user to table
INSERT INTO Users (userId, dob, gender, password, firstName, lastName, email)
VALUES(1010, "10-24-1992", "Male", "vjs6ujsac!", "Alex", "Walker", "Alex.walker@gmail.com");

--find user
SELECT * FROM users WHERE username = "x";

--display fiend list of user
SELECT friendUserId
FROM Users
JOIN Friends ON Friends.userId = Users.userId
WHERE Users.userId = "x";

--add friend to friend list 
INSERT INTO friends (userId, friendUserId)
VALUES ([userId], [friendUserId]);

--update user contributions 
UPDATE Users
SET contributions = contributions+1
WHERE userId = "x"

--list top ten users
SELECT contributions 
FROM Users
GROUP BY contributions
ORDER BY count(*) DESC
LIMIT 10;

--ALBUMN AND PHOTO MANAGEMENT
--display photos
SELECT data 
FROM Photos;

--display phots that belong to a particular user
SELECT Photos.data
FROM Users
JOIN Albums ON Users.userId = Albums.UserId
JOIN Photos ON Albums.albumId = Photos.photoId
WHERE Users.userId = "x";

--view user's albums
SELECT Photos.data
FROM Photos
JOIN Albums ON Photos.albumID =	Albums.albumID
WHERE albumId = "x" AND Photos.userID = "y";

--delete photo
DELETE FROM Photos WHERE photoId = "x"
DELETE FROM Comments WHERE photoId = "x"
DELETE FROM Likes WHERE photoId = "x";

--delete album
DELETE 
FROM Albums 
WHERE albumId = "x";
DELETE 
FROM Photos
WHERE albumId = "x";

--TAG MANAGEMENT
--photos with tag
SELECT Photo.data 
FROM Photo
WHERE Photo.photoId IN ( 
	SELECT photoId 
	FROM Tags
	WHERE tag="x" );

--show users photos with tag
SELECT Photos.photoId, Photos.caption, Photos.data 
FROM 
   (SELECT Photos.caption, Photos.data, Photos.photoId, Tags.photoId, Tags.text 
   FROM Photos 
   INNER JOIN Tags ON Photos.photoId=Tags.photoId) AS photos
WHERE photoId IN ('a','b','c', '..') AND text="x"

--popular tag
SELECT text 
FROM Tag
GROUP BY text
ORDER BY count(text) DESC
LIMIT 1;

--search photos with tags
SELECT Photos.data 
FROM Photos
WHERE Photos.photoId IN
	(SELECT Tags.photoId 
	FROM Tags 
	WHERE text IN ("x", "y", "..."));

--search user's photos with tags
SELECT Photos.data
FROM Photos
INNER JOIN Albums ON Albums.albumId = Photos.photoId
INNER JOIN Users ON Albums.userId = Users.userId
INNER JOIN Tags ON Photos.photoId = Tags.photoId
WHERE Tags.text IN ("x", "y", "...");



--COMMENTS AND LIKES
--photos likes
SELECT count(*)
FROM Likes
WHERE photoId = "x";

--users who liked
SELECT userId
FROM Likes
WHERE photoId = "x";

--users comments
SELECT firstName, lastName, email, userId 
FROM 
   (SELECT Users.userId, Users.firstName, Users.lastName, Users.email, Comments.userId, Comments.text 
   FROM Users 
   INNER JOIN Comments ON Users.userId=Comments.userId)  AS users
   WHERE text="x"

--RECOMENDATIONS
--common friends
SELECT firstName, lastName
FROM Friends
INNER JOIN Friends ON friendId = userId

--users top 5 tags
SELECT data
FROM Photos 
WHERE photoId IN 
	(SELECT photo.id, count(Tags.text) AS count
	FROM Tags
	INNER JOIN Photos ON Tags.photoId = Photos.photoId
	WHERE Photos.albumId IN
		(SELECT Albums.albumId
		FROM Albums
		INNER JOIN Users ON Users.userId = Albums.userId)
		LIMIT 5);

