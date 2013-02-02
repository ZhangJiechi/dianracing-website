CREATE TABLE think_account (
    account VARCHAR(14)
	password VARCHAR(32)
);

CREATE TABLE think_activities (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    place TEXT,
    date_start TIMESTAMP,
    date_end TIMESTAMP,
	lang CHAR(5)
);

CREATE TABLE think_star (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    year TEXT,
    major TEXT,
	hobby TEXT,
	respon TEXT,
	intro TEXT,
	faceimg TEXT,
	facenote TEXT,
	lang CHAR(5)
);