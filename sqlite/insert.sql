.bail ON
.mode columns
.headers ON
.nullvalue NULL
PRAGMA foreign_keys = ON;

-- USER

INSERT INTO User(idUser, username, password, name, email) 
			VALUES(1,'XxuserxX', 'password', 'Manuel Cerqueira', 'manuelc@hotmail.com'); 

INSERT INTO User(idUser, username, password, name, email) 
			VALUES(2,'grannyO32', 'granny', 'Idalina Pontes', 'granny@hotmail.com'); 

INSERT INTO User(idUser, username, password, name, email) 
			VALUES(3,'inspGamer', 'pcgamer', 'Joao Alves', 'ja@gmail.com'); 

INSERT INTO User(idUser, username, password, name, email) 
			VALUES(4,'workGirl', 'financas2015', 'Margarida Rebelo', 'magr@gmail.com'); 

INSERT INTO User(idUser, username, password, name, email) 
			VALUES(5,'panados', 'panados', 'Ines Carneiro', 'magr@gmail.com'); 


-- EVENT
	
INSERT INTO Event(idEvent, idUser, name, image, eventDate, startHour, description, local, type) 
			VALUES(1, 1,'Churrasco dos Cerqueiras', 'churrasco.png', '2015-12-10', '12:00:00', 'Vamos juntar-nos para fazer alta churrascada!!', 'Casa dos Cerqueiras', 'party'); 

INSERT INTO Event(idEvent, idUser, name, image, eventDate, startHour, description, local, type) 
			VALUES(2, 1, 'Discussao das Contas Publicas 2015', 'contas.jpg', '2015-11-20', '15:30:00', 'Discussao das contas divulgadas pelo estado em 2015.', 'Camara Municipal', 'conference'); 

INSERT INTO Event(idEvent, idUser, name, image, eventDate, startHour, description, local, type) 
			VALUES(3, 3,'Gamers Heaven', 'game.jpg', '2015-11-29', '19:59:20', 'MEGA LAN PARTY PESSOAL!!!', 'Casa dos Fixes', 'party'); 


-- ATTEND EVENT
	
INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(3, 3, 'yes');

INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(2, 4, 'yes');

INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(1, 1, 'yes');

INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(1, 2, 'yes');

INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(1, 3, 'no');

INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(2, 2, 'yes');

INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(3, 1, 'yes');

-- COMMENT

INSERT INTO Comentario(idComentario, idUser, idEvent, comentario)
			VALUES(1, 1, 1, 'askfjhsadfkjshadflasjd');

INSERT INTO Comentario(idComentario, idUser, idEvent, comentario)
			VALUES(2, 2, 2, 'AAAAAAAAAAAAAAAAAAAAA');

INSERT INTO Comentario(idComentario, idUser, idEvent, comentario)
			VALUES(3, 1, 1, 'CCCCCCCCCCCCCCCCCCCCCCCCCC!!!!!!!');



