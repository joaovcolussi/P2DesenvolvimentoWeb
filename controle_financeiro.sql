CREATE DATABASE IF NOT EXISTS controle_financeiro;

USE controle_financeiro;

CREATE TABLE IF NOT EXISTS meses (
id INT AUTO_INCREMENT PRIMARY KEY,
mes VARCHAR(10) NOT NULL,
ano INT NOT NULL
);

CREATE TABLE IF NOT EXISTS categorias (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS despesas (
id INT AUTO_INCREMENT PRIMARY KEY,
mes_id INT NOT NULL,
categoria_id INT NOT NULL,
valor DECIMAL(10, 2) NOT NULL,
tipo ENUM('entrada', 'saida') NOT NULL,
FOREIGN KEY (mes_id) REFERENCES meses(id),
FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);