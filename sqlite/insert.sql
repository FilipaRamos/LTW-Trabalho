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

-- JOIN

INSERT INTO Belong(userID, idEvent, Usertype)
			VALUES('XxuserxX', 1, 'admin');

INSERT INTO Belong(userID, idEvent, Usertype)
			VALUES('grannyO32', 1, 'watcher');

INSERT INTO Belong(userID, idEvent, Usertype)
			VALUES('inspGamer', 1, 'watcher');

INSERT INTO Belong(userID, idEvent, Usertype)
			VALUES('workGirl', 2, 'admin');

INSERT INTO Belong(userID, idEvent, Usertype)
			VALUES('XxuserxX', 2, 'watcher');

INSERT INTO Belong(userID, idEvent, Usertype)
			VALUES('inspGamer', 3, 'admin');

INSERT INTO Belong(userID, idEvent, Usertype)
			VALUES('XxuserxX', 3, 'watcher');
