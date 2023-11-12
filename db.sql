CREATE TABLE usuario(
            id SERIAL PRIMARY KEY,
	        usuario VARCHAR(50),
	        senha VARCHAR(999)
);

CREATE TABLE avaliacao (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    rating INT,
    episodes_watched INT,
    userid INT REFERENCES usuario(id)
);

CREATE TABLE series(
	id SERIAL PRIMARY KEY,
	titulo VARCHAR(900),
	sinopse VARCHAR(900),
	imagem_path VARCHAR(900)
)

UPDATE series SET imagem_path = '../assets/shrek.png' WHERE titulo = 'Shrek';
UPDATE series SET imagem_path = '../assets/breaking-bad.png' WHERE titulo = 'Breaking Bad';
UPDATE series SET imagem_path = '../assets/round6.png' WHERE titulo = 'Round 6';


INSERT INTO series (titulo, sinopse) VALUES ('Shrek', 'Uma animação incrível sobre um ogro verde e suas aventuras inusitadas.')
INSERT INTO series (titulo, sinopse) VALUES ('Round 6', 'Participantes de um jogo misterioso lutam pela sobrevivência em busca de um grande prêmio.');
INSERT INTO series (titulo, sinopse) VALUES ('Breaking Bad', 'A história de um professor de química que se transforma em um poderoso traficante de drogas.');

CREATE EXTENSION IF NOT EXISTS pgcrypto;

INSERT INTO usuario (usuario, senha)
VALUES ('user aqui', ENCODE(DIGEST('senha aqui', 'sha256'), 'hex'));
