--BASE DE DADOS DE UMA APLICAÇÃO QUE GERE EVENTOS
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Event;
DROP TABLE IF EXISTS Belong;

-- TABLE USER

CREATE TABLE User(
	username NVARCHAR2(20) PRIMARY KEY,
	password NVARCHAR2(50) NOT NULL,
	name NVARCHAR2(50) NOT NULL,
	email NVARCHAR2(50) NOT NULL
);

-- TABLE EVENT

CREATE TABLE Event(
	id INTEGER PRIMARY KEY,
	name NVARCHAR2(50) NOT NULL,	
	image NVARCHAR2(50) NOT NULL,
	eventDate DATE,
	description NVARCHAR2(250),
	type NVARCHAR2(20) NOT NULL
);


-- TABLE JOIN

CREATE TABLE Belong(
	userID NVARCHAR2(20) REFERENCES User(username) ON DELETE CASCADE,
	idEvent INTEGER REFERENCES Event(id) ON DELETE CASCADE,
	Usertype NVARCHAR2(20) NOT NULL,
	PRIMARY KEY (userID, idEvent),
	CHECK (Usertype = 'admin' OR Usertype = 'watcher')
);