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

CREATE TABLE think_staff (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    position TEXT,
	mobile TEXT,
	email TEXT,
	queue INTEGER,
	lang CHAR(5)
);

CREATE TABLE think_config (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    value TEXT
);

CREATE TABLE think_blog (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    author TEXT,
    createtime TEXT,
    content TEXT,
    cover TEXT,
    lang CHAR(5)
);

CREATE TABLE think_attachment (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    filename TEXT,
    filetype TEXT,
    date TIMESTAMP,
    filesize INTEGER,
    filepath TEXT
);

CREATE TABLE think_album (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    createtime TIMESTAMP,
    hide INTEGER DEFAULT 0
);

CREATE TABLE think_photo (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    filename TEXT,
    aid INTEGER,
    createtime TIMESTAMP
);

CREATE TABLE think_content (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    key TEXT,
    value TEXT
);

CREATE TABLE think_sponsor (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    gtype INTEGER,
	content TEXT,
    lang CHAR(5)
);

CREATE TABLE think_member (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    gtype INTEGER,
	name TEXT,
	face TEXT,
	text TEXT,
    lang CHAR(5)
);

CREATE TABLE think_group (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    gtype INTEGER,
	name TEXT,
	children TEXT,
	lang CHAR(5)
);

CREATE TABLE think_fse (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    content TEXT,
    img TEXT,
    lang CHAR(5)
);