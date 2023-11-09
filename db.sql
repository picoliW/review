CREATE TABLE usuario(
            id SERIAL PRIMARY KEY,
	        usuario VARCHAR(50),
	        senha VARCHAR(999)
);

CREATE TABLE series (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    rating INT,
    episodes_watched INT,
    userid INT REFERENCES usuario(id)
);

CREATE EXTENSION IF NOT EXISTS pgcrypto;

INSERT INTO usuario (usuario, senha)
VALUES ('user aqui', ENCODE(DIGEST('senha aqui', 'sha256'), 'hex'));
