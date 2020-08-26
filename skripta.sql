create database aboras_19 default character set utf8;

use aboras_19;

create table ontologija(
    sifra int not null primary key auto_increment,
    autor varchar(255) not null,
    dobioNagradu varchar(255) not null,
    rodjenje int not null,
    vrijemeObjavljivanjaKnjige int not null,
    nagradjenaKnjiga varchar(255) not null,
    zanr varchar(255) not null
);