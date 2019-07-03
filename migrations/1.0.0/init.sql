PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Таблица: post
CREATE TABLE post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, slug VARCHAR (255) UNIQUE NOT NULL, name VARCHAR (255) NOT NULL);
INSERT INTO post (id, slug, name) VALUES (1, 'first', 'First');
INSERT INTO post (id, slug, name) VALUES (2, 'test', 'Test');

-- Таблица: tag
CREATE TABLE tag (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR (45) NOT NULL UNIQUE, title VARCHAR (45));
INSERT INTO tag (id, name, title) VALUES (1, 'php', NULL);
INSERT INTO tag (id, name, title) VALUES (2, 'phalcon', NULL);

-- Таблица: post_tag
CREATE TABLE post_tag (post_id INTEGER NOT NULL REFERENCES post (id) ON DELETE CASCADE ON UPDATE CASCADE, tag_id INTEGER NOT NULL REFERENCES tag (id) ON DELETE CASCADE ON UPDATE CASCADE, PRIMARY KEY (post_id, tag_id), UNIQUE (post_id, tag_id));
INSERT INTO post_tag (post_id, tag_id) VALUES (1, 1);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
