.bail ON
.mode columns
.headers ON
.nullvalue NULL
PRAGMA foreign_keys = ON;

-- USER

INSERT INTO User(username, password, name, email) 
			VALUES('XxuserxX', 'password', 'Manuel Cerqueira', 'manuelc@hotmail.com'); 

INSERT INTO User(username, password, name, email) 
			VALUES('grannyO32', 'granny', 'Idalina Pontes', 'granny@hotmail.com'); 

INSERT INTO User(username, password, name, email) 
			VALUES('inspGamer', 'pcgamer', 'Joao Alves', 'ja@gmail.com'); 

INSERT INTO User(username, password, name, email) 
			VALUES('workGirl', 'financas2015', 'Margarida Rebelo', 'magr@gmail.com'); 


-- EVENT

INSERT INTO Event(id, name, image, eventDate, description, type) 
			VALUES(1, 'Churrasco dos Cerqueiras', 'churrasco.png', '2015-12-10', 'Vamos juntar-nos para fazer alta churrascada!!', 'party'); 

INSERT INTO Event(id, name, image, eventDate, description, type) 
			VALUES(2, 'Discussao das Contas Publicas 2015', 'contas.jpg', '2015-11-20', 'Discussão das contas divulgadas pelo estado em 2015.', 'conference'); 

INSERT INTO Event(id, name, image, eventDate, description, type) 
			VALUES(3, 'Gamers Heaven', 'game.jpg', '2015-11-29', 'MEGA LAN PARTY PESSOAL!!!', 'party'); 

-- ADMIN EVENT

INSERT INTO AdminEvent(idEvent, username)
			VALUES(1, 'XxuserxX');

INSERT INTO AdminEvent(idEvent, username)
			VALUES(2, 'workGirl');

INSERT INTO AdminEvent(idEvent, username)
			VALUES(3, 'inspGamer');

-- ATTEND EVENT

INSERT INTO AttendEvent(idEvent, username)
			VALUES(1, 'grannyO32');

INSERT INTO AttendEvent(idEvent, username)
			VALUES(1, 'inspGamer');

INSERT INTO AttendEvent(idEvent, username)
			VALUES(2, 'grannyO32');

INSERT INTO AttendEvent(idEvent, username)
			VALUES(3, 'XxuserxX');

-- COMMENT

INSERT INTO Comentario(idComentario, username, idEvent)
			VALUES(1, 'XxuserxX', 1);

INSERT INTO Comentario(idComentario, username, idEvent)
			VALUES(2, 'grannyO32', 2);

INSERT INTO Comentario(idComentario, username, idEvent)
			VALUES(3, 'XxuserxX', 3);



