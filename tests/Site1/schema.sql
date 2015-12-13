DROP TABLE IF EXISTS users;

CREATE TABLE users (
  `id` SERIAL,
  `mail` varchar(20) UNIQUE,
  `pass` varchar(20)
);