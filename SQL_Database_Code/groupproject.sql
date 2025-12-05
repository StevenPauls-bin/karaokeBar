DROP TABLE IF EXISTS contribution;
DROP TABLE IF EXISTS signUp;
DROP TABLE IF EXISTS contributor;
DROP TABLE IF EXISTS karaokeFile;
DROP TABLE IF EXISTS song;
DROP TABLE IF EXISTS user;


-- User table
CREATE TABLE user (
    username VARCHAR(50) PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL
);

-- Song table
CREATE TABLE song (
    title VARCHAR(50) PRIMARY KEY NOT NULL,
    artist VARCHAR(50) NOT NULL
);

-- KaraokeFile table
CREATE TABLE karaokeFile  (
    id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
    version VARCHAR(50) NOT NULL,
    title VARCHAR(50) NOT NULL,
	FOREIGN KEY (title) REFERENCES song(title)
);

-- Contributor table
CREATE TABLE contributor (
    name VARCHAR(50) PRIMARY KEY NOT NULL
);

-- SignUp table
CREATE TABLE signUp (
    username VARCHAR(50),
	  id int,
    qType CHAR(1) NOT NULL,
    time TIME NOT NULL,
    payment INT,
    PRIMARY KEY (username, id),
    FOREIGN KEY (username) REFERENCES user(username),
	  FOREIGN KEY (id) REFERENCES karaokeFile(id)
);


-- Contribution table
CREATE TABLE contribution (
    contributorName VARCHAR(50),
    title VARCHAR(50),
    contrType VARCHAR(50),
    PRIMARY KEY (contributorName, title),
    FOREIGN KEY (contributorName) REFERENCES contributor(name),
    FOREIGN KEY (title) REFERENCES song(title)
);
