.bail ON
.mode columns
.headers ON
.nullvalue NULL
PRAGMA foreign_keys = ON;

-- USER

INSERT INTO User(idUser, username, password, name, email) 
			VALUES(1,'panados', '$2a$08$2hE1fAZIIK3mnqBauj06hOSKBKQuvLOQ3S7myOOAoTh15NPbsmYMO', 'Ines Carneiro', 'manuelc@hotmail.com'); 

INSERT INTO User(idUser, username, password, name, email) 
			VALUES(2,'moura', '$2a$08$yQVg96pMbuWlr5mDjGqL2.Pf9a/aIp82YneGDCv11RBDH3rJjHtz.', 'Diogo Moura', 'granny@hotmail.com'); 

		
-- EVENT
	
INSERT INTO Event
			VALUES(1, 1,'Churrasco dos Cerqueiras', '../images/holi1.jpg', '2015-12-10', '12:00:00', 'Vamos juntar-nos para fazer alta churrascada!!', 'Casa dos Cerqueiras', 'party', 'public'); 

INSERT INTO Event
			VALUES(2, 1, 'Discussao das Contas Publicas 2015', '../images/holi1.jpg', '2015-11-20', '15:30:00', 'Discussao das contas divulgadas pelo estado em 2015.', 'Camara Municipal', 'conference', 'private'); 

INSERT INTO Event
			VALUES(3, 2,'Gamers Heaven', '../images/holi1.jpg', '2015-11-29', '19:59:20', 'MEGA LAN PARTY PESSOAL!!!', 'Casa dos Fixes', 'party', 'public'); 


-- ATTEND EVENT

INSERT INTO AttendEvent(idEvent, idUser, attend)
			VALUES(2, 2, -1);

-- COMMENT

INSERT INTO Comentario(idComentario, idUser, idEvent, comentario)
			VALUES(1, 1, 1, 'askfjhsadfkjshadflasjd');

INSERT INTO Comentario(idComentario, idUser, idEvent, comentario)
			VALUES(2, 2, 3, 'AAAAAAAAAAAAAAAAAAAAA');





