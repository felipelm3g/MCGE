/* Criar o banco de dados */
CREATE DATABASE IF NOT EXISTS DB_COMBUSTON CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Criando usuario de sistema */
CREATE USER 'ac_system'@'localhost' IDENTIFIED BY '12345@Flm';
GRANT INSERT ON DB_COMBUSTON . * TO 'ac_system'@'localhost';
GRANT SELECT ON DB_COMBUSTON . * TO 'ac_system'@'localhost';
GRANT UPDATE ON DB_COMBUSTON . * TO 'ac_system'@'localhost';
GRANT DELETE ON DB_COMBUSTON . * TO 'ac_system'@'localhost';

/* Reload permisões */
FLUSH PRIVILEGES;

/* Tabela dos usuarios */
CREATE TABLE IF NOT EXISTS T_USER (
    USER_CPF  BIGINT(11) UNSIGNED ZEROFILL NOT NULL, #ID Usuario
    USER_NOME VARCHAR(60) NOT NULL, #Nome
    USER_PASS VARCHAR(100) NOT NULL, #Senha
    USER_TYP  TINYINT(1) ZEROFILL NOT NULL DEFAULT 0, #Status 0-Amigo 1-Membro 2-Staff
    USER_STT  TINYINT(1) ZEROFILL NOT NULL DEFAULT 0, #Status 0-Liberado 1-Bloqueado 2-Alterar Senha
    PRIMARY KEY (USER_CPF)
);

INSERT INTO T_USER (USER_CPF, USER_NOME, USER_PASS, USER_TYP)
VALUES (01625439210, 'Felipe L.', 'ODgzODczMTM=', 2);
INSERT INTO T_USER (USER_CPF, USER_NOME, USER_PASS, USER_TYP)
VALUES (58074317315, 'Robson', 'NTgwNzQzMTczMTU=', 1);
SELECT * FROM T_USER;

/* Tabela das mensalidades */
CREATE TABLE IF NOT EXISTS T_MENSALIDADES (
	MENS_ID   BIGINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, #ID Gasto
    MENS_USER BIGINT(11) UNSIGNED ZEROFILL NOT NULL, #ID User
    MENS_DATA DATE DEFAULT NOW(), #Data do vencimento
    MENS_PAGT DATE, #Data do pagamento
    MENS_VLR  DECIMAL(8,2) NOT NULL DEFAULT '0.0', #Valor do abastecimento
    MENS_DES  DECIMAL(8,2) NOT NULL DEFAULT '0.0', #Valor do desconto
    MENS_OBS  VARCHAR(500) , #Observação
    MENS_STT  TINYINT(1) ZEROFILL NOT NULL DEFAULT 0, #Status 0-Pendente 1-Atrasado 2-Pago
    
    PRIMARY KEY (MENS_ID),
    FOREIGN KEY (MENS_USER) REFERENCES T_USER(USER_CPF)
);

SELECT * FROM T_MENSALIDADES;



/* Tabela dos serviços */
CREATE TABLE IF NOT EXISTS T_EVENTOS (
	EVENT_ID    BIGINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, #ID Agenda
    EVENT_TTLO  VARCHAR(100) NOT NULL, #Titulo
    EVENT_DESC  VARCHAR(500) NOT NULL, #Descrição
    EVENT_LAT   DECIMAL(8,8) NOT NULL DEFAULT '0.0', #Latitude
    EVENT_LNG   DECIMAL(8,8) NOT NULL DEFAULT '0.0', #Longitude
    EVENT_DATA  DATE DEFAULT NOW(), #Data do evento
    PRIMARY KEY (EVENT_ID)
);

INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_DATA)
VALUES ('Evento 1', 'O evento 1 foi criado exclusivamente para teste','2020-01-05');
INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_DATA)
VALUES ('Evento 2', 'O evento 2 foi criado exclusivamente para teste','2020-01-06');
INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_DATA)
VALUES ('Evento 3', 'O evento 3 foi criado exclusivamente para teste','2020-01-13');
INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_DATA)
VALUES ('Evento 4', 'O evento 4 foi criado exclusivamente para teste','2020-01-13');
INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_DATA)
VALUES ('Evento 5', 'O evento 5 foi criado exclusivamente para teste','2020-01-16');
INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_DATA)
VALUES ('Evento 6', 'O evento 6 foi criado exclusivamente para teste','2020-02-08');
INSERT INTO T_EVENTOS (EVENT_TTLO, EVENT_DESC, EVENT_DATA)
VALUES ('Evento 7', 'O evento 7 foi criado exclusivamente para teste','2020-01-03');

SELECT * FROM T_EVENTOS;

/* Tabela avisos */
CREATE TABLE IF NOT EXISTS T_AVISOS (
	AVISO_ID  BIGINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, #ID Aviso
    AVISO_TIT VARCHAR(100) NOT NULL, #Titulo Aviso
    AVISO_DES VARCHAR(700) NOT NULL, #Descrição Aviso
    PRIMARY KEY (AVISO_ID)
);

INSERT INTO T_AVISOS (AVISO_TIT, AVISO_DES)
VALUES ('Informação','Nosso aplicativo está em fase de teste. Dúvidas ou Bugs, por favor reportar para diretoria.');

/* Tabela dos Posto serviço */
CREATE TABLE IF NOT EXISTS T_POST_SERV (
	POST_SERV_PID BIGINT UNSIGNED ZEROFILL NOT NULL, #ID Posto
    POST_SERV_SID BIGINT UNSIGNED ZEROFILL NOT NULL, #ID Serviço
    
    PRIMARY KEY (POST_SERV_PID, POST_SERV_SID)
);

INSERT INTO T_POST_SERV (POST_SERV_PID, POST_SERV_SID)
VALUES (3, 1);
INSERT INTO T_POST_SERV (POST_SERV_PID, POST_SERV_SID)
VALUES (3, 2);
INSERT INTO T_POST_SERV (POST_SERV_PID, POST_SERV_SID)
VALUES (2, 3);
INSERT INTO T_POST_SERV (POST_SERV_PID, POST_SERV_SID)
VALUES (1, 4);

delete from T_POST_SERV where POST_SERV_PID = 3;

/* Tabela dos usuarios */
CREATE TABLE IF NOT EXISTS T_CLIENT (
	CLIENT_ID      BIGINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, #ID Usuario
	CLIENT_NOME    VARCHAR(60) NOT NULL, #Nome do cliente
    CLIENT_END     VARCHAR(100), #Endereço
    
    PRIMARY KEY (CLIENT_ID)
);

INSERT INTO T_CLIENT (CLIENT_NOME, CLIENT_END)
VALUES ('João Marcos', 'Av. Rua dos bobos, 320');

/* Tabela dos historico do Posto */
CREATE TABLE IF NOT EXISTS T_HISTP (
	HISTP_ID      BIGINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, #ID Historico
    HISTP_POSTO   BIGINT UNSIGNED ZEROFILL NOT NULL, #ID cliente
    HISTP_CLIENT  BIGINT UNSIGNED ZEROFILL NOT NULL, #ID cliente
    HISTP_SERV    BIGINT UNSIGNED ZEROFILL NOT NULL, #ID Serviço
    HISTP_DATA    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, #Data
    HISTP_VLR     DECIMAL(10,2) UNSIGNED NOT NULL, # Valor
    
    PRIMARY KEY (HISTP_ID),
    FOREIGN KEY (HISTP_POSTO) REFERENCES T_POSTO(POSTO_ID),
    FOREIGN KEY (HISTP_CLIENT) REFERENCES T_CLIENT(CLIENT_ID),
    FOREIGN KEY (HISTP_SERV) REFERENCES T_SERV(SERV_ID)
);

INSERT INTO T_HISTP (HISTP_POSTO, HISTP_CLIENT, HISTP_SERV, HISTP_VLR)
VALUES (1, 1, 1, '100.5');
INSERT INTO T_HISTP (HISTP_POSTO, HISTP_CLIENT, HISTP_SERV, HISTP_VLR)
VALUES (1, 1, 4, '10.5');

/* Tabela dos historico do Posto */
CREATE TABLE IF NOT EXISTS T_HISTC (
	HISTC_ID      BIGINT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, #ID Historico
    HISTC_CLIENT  BIGINT UNSIGNED ZEROFILL NOT NULL, #ID cliente
    HISTC_POSTO   BIGINT UNSIGNED ZEROFILL NOT NULL, #ID POSTO
    HISTC_SERV    BIGINT UNSIGNED ZEROFILL NOT NULL, #ID Serviço
    HISTC_DATA    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, #Data
    HISTC_VLR     DECIMAL(10,2) UNSIGNED NOT NULL, # Valor
    
    PRIMARY KEY (HISTC_ID),
    FOREIGN KEY (HISTC_CLIENT) REFERENCES T_CLIENT(CLIENT_ID),
    FOREIGN KEY (HISTC_POSTO) REFERENCES T_POSTO(POSTO_ID),
    FOREIGN KEY (HISTC_SERV) REFERENCES T_SERV(SERV_ID)
);

INSERT INTO T_HISTC (HISTC_CLIENT, HISTC_POSTO, HISTC_SERV, HISTC_VLR)
VALUES (1, 1, 4, '10.5');


SELECT * FROM T_USER;
SELECT * FROM T_GASTOS;
SELECT * FROM T_POST;
SELECT * FROM T_POST_SERV;

