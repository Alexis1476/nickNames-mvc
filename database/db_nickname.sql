CREATE DATABASE IF NOT EXISTS db_nickname;
USE db_nickname;

CREATE TABLE t_section
(
    idSection int(11) NOT NULL AUTO_INCREMENT,
    secName   varchar(20) NOT NULL,
    PRIMARY KEY (idSection)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_teacher
(
    idTeacher    int(11) NOT NULL AUTO_INCREMENT,
    teaFirstname varchar(50) NOT NULL,
    teaName      varchar(50) NOT NULL,
    teaGender    char(1)     NOT NULL,
    teaNickname  varchar(50) NOT NULL,
    teaOrigine   text        NOT NULL,
    fkSection    int(11) NOT NULL,
    PRIMARY KEY (idTeacher),
    FOREIGN KEY (fkSection) REFERENCES t_section (idSection)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_user
(
    idUser           int(11) NOT NULL AUTO_INCREMENT,
    useLogin         varchar(20)  NOT NULL,
    usePassword      varchar(255) NOT NULL,
    useAdministrator int(2) NOT NULL,
    PRIMARY KEY (idUser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE t_session
(
    idSession       int(11) NOT NULL AUTO_INCREMENT,
    fkUser          int(11) NOT NULL,
    PRIMARY KEY (idSession),
    FOREIGN KEY (fkUser) REFERENCES t_user (idUser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Création utilisateur
CREATE USER IF NOT EXISTS 'dbNicknameUser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON db_nickname.* TO 'dbNicknameUser'@'localhost';

-- Insertion de données
INSERT INTO t_section (idSection, secName) VALUES(NULL,'Informatique');
INSERT INTO t_section (idSection, secName) VALUES(NULL,'Electronique');

INSERT INTO t_teacher (idTeacher, teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection)
VALUES (NULL, 'Grégory', 'Charmier', 'M', 'GCR', 'Origine', '1');

INSERT INTO t_teacher (idTeacher, teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection)
VALUES (NULL, 'Laurent', 'Duding', 'M', 'LDG', 'Origine', '1');
