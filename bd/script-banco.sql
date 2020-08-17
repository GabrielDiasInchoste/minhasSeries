
CREATE TABLE genero (
                id INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(500) NOT NULL,
                PRIMARY KEY (id)
);


CREATE TABLE serie (
                id INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(100) NOT NULL,
                ano_lancamento INT NOT NULL,
                id_genero INT NOT NULL,
                completa BOOLEAN NOT NULL,
                PRIMARY KEY (id)
);


CREATE TABLE temporada (
                id INT AUTO_INCREMENT NOT NULL,
                numero INT NOT NULL,
                ano_lancamento INT NOT NULL,
                assistido BOOLEAN DEFAULT false NOT NULL,
                id_serie INT NOT NULL,
                PRIMARY KEY (id)
);


CREATE TABLE epsodio (
                id INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(100) NOT NULL,
                resumo VARCHAR(500) NOT NULL,
                id_temporada INT NOT NULL,
                assistido BOOLEAN NOT NULL,
                PRIMARY KEY (id)
);

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE serie ADD CONSTRAINT genero_serie_fk
FOREIGN KEY (id_genero)
REFERENCES genero (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE temporada ADD CONSTRAINT serie_temporada_fk
FOREIGN KEY (id_serie)
REFERENCES serie (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE epsodio ADD CONSTRAINT temporada_epsodios_fk
FOREIGN KEY (id_temporada)
REFERENCES temporada (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
