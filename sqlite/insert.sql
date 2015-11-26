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

INSERT INTO Event(idEvent, name, image, eventDate, startHour, description, local, type) 
			VALUES(1, 'Churrasco dos Cerqueiras', 'churrasco.png', '2015-12-10', '12:00:00', 'Vamos juntar-nos para fazer alta churrascada!!', 'Casa dos Cerqueiras', 'party'); 

INSERT INTO Event(idEvent, name, image, eventDate, startHour, description, local, type) 
			VALUES(2, 'Discussao das Contas Publicas 2015', 'contas.jpg', '2015-11-20', '15:30:00', 'Discussao das contas divulgadas pelo estado em 2015.', 'Camara Municipal', 'conference'); 

INSERT INTO Event(idEvent, name, image, eventDate, startHour, description, local, type) 
			VALUES(3, 'Gamers Heaven', 'game.jpg', '2015-11-29', '19:59:20', 'MEGA LAN PARTY PESSOAL!!!', 'Casa dos Fixes', 'party'); 


-- ATTEND EVENT

INSERT INTO AttendEvent(idEvent, username, type)
			VALUES(3, 'inspGamer', 'admin');

INSERT INTO AttendEvent(idEvent, username, type)
			VALUES(2, 'workGirl', 'admin');

INSERT INTO AttendEvent(idEvent, username, type)
			VALUES(1, 'XxuserxX', 'admin');

INSERT INTO AttendEvent(idEvent, username, type)
			VALUES(1, 'grannyO32', 'attender');

INSERT INTO AttendEvent(idEvent, username, type)
			VALUES(1, 'inspGamer', 'attender');

INSERT INTO AttendEvent(idEvent, username, type)
			VALUES(2, 'grannyO32', 'attender');

INSERT INTO AttendEvent(idEvent, username, type)
			VALUES(3, 'XxuserxX', 'attender');

-- COMMENT

INSERT INTO Comentario(idComentario, username, idEvent, comentario)
			VALUES(1, 'XxuserxX', 1, 'askfjhsadfkjshadflasjd');

INSERT INTO Comentario(idComentario, username, idEvent, comentario)
			VALUES(2, 'grannyO32', 2, 'AAAAAAAAAAAAAAAAAAAAA');

INSERT INTO Comentario(idComentario, username, idEvent, comentario)
			VALUES(3, 'XxuserxX', 3, 'CCCCCCCCCCCCCCCCCCCCCCCCCC!!!!!!!');



