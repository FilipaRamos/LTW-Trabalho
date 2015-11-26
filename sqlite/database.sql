--BASE DE DADOS DE UMA APLICAÇÃO QUE GERE EVENTOS
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Event;
DROP TABLE IF EXISTS AttendEvent;
DROP TABLE IF EXISTS Comentario;
DROP TABLE IF EXISTS EventType;

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
	name NVARCHAR2(50) NOT NULL,
	image NVARCHAR2(500),
	eventDate DATE,
	startHour TIME,
	description NVARCHAR2(250),
	local NVARCHAR2(100) NOT NULL,
	type NVARCHAR2(20) NOT NULL
);

CREATE TABLE AttendEvent(
	idEvent INTEGER,
	username INTEGER,
	type NVARCHAR2(20),
	PRIMARY KEY (idEvent, username),
	FOREIGN KEY (idEvent) REFERENCES Event(idEvent) ON DELETE CASCADE,
	FOREIGN KEY (username) REFERENCES User(username) ON DELETE CASCADE,
	CHECK (type = 'admin' OR type = 'attender')
);

CREATE TABLE Comentario(
	idComentario INTEGER,
	username NVARCHAR2(20),
	idEvent INTEGER,
	comentario NVARCHAR2(200),
	PRIMARY KEY (username, idEvent),
	FOREIGN KEY (username) REFERENCES User(username),
	FOREIGN KEY (idEvent) REFERENCES Event(idEvent)
);

/*CREATE TABLE EventType(
	idType INTEGER PRIMARY KEY,
	idEvent INTEGER REFERENCES  Event(idEvent)
);*/

