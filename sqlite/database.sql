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
	idEvent INTEGER PRIMARY KEY,
	username INTEGER REFERENCES User(username),
	name NVARCHAR2(50) NOT NULL,
	eventDateStart DATE,
	eventDateEnd DATE,
	description NVARCHAR2(250),
	local NVARCHAR2(100) NOT NULL,
	type NVARCHAR2(20) NOT NULL
);


-- TABLE JOIN

/*CREATE TABLE Belong(
	userID NVARCHAR2(20) REFERENCES User(username) ON DELETE CASCADE,
	idEvent INTEGER REFERENCES Event(id) ON DELETE CASCADE,
	Usertype NVARCHAR2(20) NOT NULL,
	PRIMARY KEY (userID, idEvent),
	CHECK (Usertype = 'admin' OR Usertype = 'watcher')
);*/


-- TABLE EVENT

CREATE TABLE AdminEvent(
	idEvent INTEGER REFERENCES  Event(idEvent),
	username INTEGER REFERENCES User(username)
);


CREATE TABLE AttendEvent(
	idEvent INTEGER REFERENCES  Event(idEvent),
	username INTEGER REFERENCES User(username)
);


CREATE TABLE Comentario(
	idComentario INTEGER PRIMARY KEY,
	username REFERENCES User(username),
	idEvent INTEGER REFERENCES  Event(idEvent),
	comentario  NVARCHAR2(200) 
);

/*CREATE TABLE EventType(
	idType INTEGER PRIMARY KEY,
	idEvent INTEGER REFERENCES  Event(idEvent)
);*/

