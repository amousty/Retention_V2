CREATE TABLE usr (
    id		INTEGER PRIMARY KEY AUTOINCREMENT,
    login	TEXT,
    passwd	TEXT);

CREATE TABLE players (
    plid	INTEGER,
    usr		INTEGER,
    color	TEXT,
    food	INTEGER,
    wood	INTEGER,
    stone	INTEGER);
    
CREATE TABLE map (
    x		INTEGER,
    y		INTEGER,
    player	INTEGER,
    champ1	INTEGER DEFAULT 0,
    champ2	INTEGER DEFAULT 0,
    foret1	INTEGER DEFAULT 0,
    foret2	INTEGER DEFAULT 0,
    mine1	INTEGER DEFAULT 0,
    mine2	INTEGER DEFAULT 0,
    caserne	INTEGER DEFAULT 0,
    forge	INTEGER DEFAULT 0,
    archerie	INTEGER DEFAULT 0,
    maison1	INTEGER DEFAULT 0,
    maison2	INTEGER DEFAULT 0,
    maison3	INTEGER DEFAULT 0
);
    
INSERT INTO usr(login,passwd) VALUES ('Albert','pass'),('Bernard','pass'),
    ('Charles','pass'),('David','pass'),('Emile','pass'),('Fabian','pass'),
    ('Georges','pass'),('Hector','pass'),('Isidore','pass'),('Jean','pass');

INSERT INTO players (plid,usr,color,food,wood,stone) VALUES
    (0,null,'',0,0,0),
    (1,2,'B',1000,1000,1000),
    (2,6,'R',200,200,200),
    (3,1,'G',100,200,300),
    (4,8,'P',100000,100000,100000),
    (5,4,'Y',300,900,1200),
    (6,7,'C',1200,900,300),
    (7,3,'W',0,0,0),
    (8,null,'K',0,0,0);

INSERT INTO map(x,y,player) VALUES 
 (0,0,0),(1,0,0),(2,0,0),(3,0,0),(4,0,0),(5,0,0),(6,0,0),(7,0,0),(8,0,0),(9,0,0),
 (0,1,0),(1,1,1),(2,1,0),(3,1,0),(4,1,0),(5,1,0),(6,1,0),(7,1,0),(8,1,3),(9,1,0),
 (0,2,0),(1,2,1),(2,2,4),(3,2,2),(4,2,0),(5,2,0),(6,2,2),(7,2,4),(8,2,0),(9,2,0),
 (0,3,0),(1,3,6),(2,3,6),(3,3,6),(4,3,0),(5,3,5),(6,3,6),(7,3,7),(8,3,0),(9,3,0),
 (0,4,0),(1,4,1),(2,4,6),(3,4,6),(4,4,0),(5,4,0),(6,4,6),(7,4,5),(8,4,4),(9,4,0),
 (0,5,0),(1,5,0),(2,5,4),(3,5,0),(4,5,7),(5,5,0),(6,5,2),(7,5,0),(8,5,5),(9,5,0),
 (0,6,0),(1,6,4),(2,6,3),(3,6,3),(4,6,0),(5,6,3),(6,6,0),(7,6,3),(8,6,2),(9,6,0),
 (0,7,0),(1,7,0),(2,7,0),(3,7,0),(4,7,0),(5,7,8),(6,7,0),(7,7,0),(8,7,0),(9,7,0);
