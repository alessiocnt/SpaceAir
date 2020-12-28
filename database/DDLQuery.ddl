create database spaceair;



create table UTENTE (
     IdUtente int not null auto_increment primary key,
     Nome varchar(20) not null,
     Cognome varchar(20) not null,
     Data_nascita date not null,
     Telefono char(10) not null,
     Img_profilo varchar(100) not null,
     Mail varchar(50) not null,
     Password char(128) not null,
     Salt char(128) not null,
     Tipo tinyint not null,
     Partita_iva char(11),
     Newsletter tinyint,
     constraint Tipo_utenteCHK check(Tipo in (1,2)), /*Controllo su tipo utente 1-Admin 2-Utente Normale*/
     constraint NewsletterCHK check(Newsletter in (0,1)) /*Trasformo in boolean*/
);

create table INDIRIZZO (
     Cod_indirizzo int not null auto_increment primary key,
     Via varchar(40) not null,
     Civico varchar(6) not null,
     Citta varchar(20) not null,
     Provincia varchar(20) not null,
     Cap varchar(10) not null,
     IdUtente int not null,
     foreign key(IdUtente) references UTENTE(IdUtente)
        on delete restrict
        on update cascade
);

create table PIANETA (
     Cod_pianeta int not null auto_increment primary key,
     Nome varchar(20) not null,
     Temperatura int not null,
     Massa float not null,
     Superficie float not null,
     Distanza_sole float not null,
     Composizione varchar(10) not null,
     Durata_giorno int not null, /*Minuti*/
     Img varchar(100) not null,
     Descrizione varchar(1000) not null,
     Visibile tinyint not null,
     constraint VisibileCHK check(Visibile in (0,1)), /*Trasformo in boolean*/
     constraint Composizione check(Newsletter in ("Solido", "Liquido", "Gassoso", "Lava")) /*Check su composizione*/
);

create table PACCHETTO (
     Cod_pacchetto int not null auto_increment primary key,
     Img_brochure varchar(100),
     Data_ora_partenza datetime not null,
     Data_ora_arrivo datetime not null,
     Prezzo float not null,
     Posti_max tinyint not null,
     Descrizione varchar(1000) not null,
     Cod_pianeta int not null,
     foreign key(Cod_pianeta) references PIANETA(Cod_pianeta)
        on delete restrict
        on update cascade,
     constraint DataCHK check(Data_ora_partenza<Data_ora_arrivo),
     constraint PrezzoCHK check(Prezzo>0),
     constraint PostiCHK check(Posti>0)
);

/*
0-Carrello
1-Accettato
2-In consegna
3-Consegnato
*/
create table STATO_ORDINE (
     Cod_stato int not null auto_increment primary key,
     Descrizione varchar(100) not null
);

create table ORDINE (
     Cod_ordine int not null auto_increment primary key,
     Data_acquisto datetime,
     Totale float not null,
     Cod_indirizzo_dest int,
     Stato int not null,
     IdUtente int not null,
     foreign key(Cod_indirizzo_dest) references INDIRIZZO(Cod_indirizzo)
        on delete restrict
        on update cascade,
     foreign key(Stato) references STATO_ORDINE(Cod_stato)
        on delete restrict
        on update cascade,
     foreign key(IdUtente) references UTENTE(IdUtente)
        on delete restrict
        on update cascade,
    constraint TotaleCHK check(Totale>0)
);

/*
Quando metto dataacquisto, mi va lo stato automaticamente
ad accettato
*/
delimiter $$
create trigger data_acquisto_UPDATE after update on ORDINE
for each row
begin
	if new.Data_acquisto not null
	then
		new.Stato = 1;
	end if;
end;$$

create table TRACK (
     Cod_ordine int not null,
     Data_ora datetime not null,
     Latitudine Decimal(8,6) not null,
     Longitudine Decimal(9,6) not null,
     Descrizione varchar(200) not null,
     primary key(Cod_ordine, Data_ora),
     foreign key(Cod_ordine) references ORDINE(Cod_ordine)
        on delete restrict
        on update cascade
);

create table PACCHETTO_IN_ORDINE (
     Cod_pacchetto int not null,
     Cod_ordine int not null,
     Quantita smallint not null,
     primary key (Cod_ordine, Cod_pacchetto),
     foreign key(Cod_ordine) references ORDINE(Cod_ordine)
        on delete restrict
        on update cascade,
    foreign key(Cod_pacchetto) references PACCHETTO(Cod_pacchetto)
        on delete restrict
        on update cascade,
    constraint QuantitaCHK check(Quantita>0)
);

create table RECENSIONE (
     Data datetime not null,
     Titolo varchar(50) not null,
     Descrizione varchar(1000) not null,
     Valutazione tinyint not null,
     IdUtente int not null,
     Cod_pianeta int not null,
     primary key (IdUtente, Cod_pianeta),
     foreign key(IdUtente) references UTENTE(IdUtente)
        on delete restrict
        on update cascade,
     foreign key(Cod_pianeta) references PIANETA(Cod_pianeta)
        on delete restrict
        on update cascade,
    constraint ValutazioneCHK check(Valutazione between 1 and 5)
);

create table INTERESSE (
     Data_interesse datetime not null,
     IdUtente int not null,
     Cod_pianeta int not null,
     primary key (IdUtente, Cod_pianeta),
     foreign key(IdUtente) references UTENTE(IdUtente)
        on delete restrict
        on update cascade,
     foreign key(Cod_pianeta) references PIANETA(Cod_pianeta)
        on delete restrict
        on update cascade
);

/*
0-Notifica Generale
1-Notifica Interesse
2-Notifica Viaggio Generico
3-Notifica Pacchetto ordinato
*/
create table NOTIFICA (
     Cod_notifica int not null auto_increment primary key,
     Data_ora datetime not null,
     Titolo varchar(50) not null,
     Descrizione varchar(500) not null,
     Tipo_notifica tinyint not null,
     IdUtente int,
     Cod_pianeta int,
     Cod_pacchetto int,
     Cod_ordine int,
     Cod_pacchetto_ordine int,
     foreign key(IdUtente, Cod_pianeta) references INTERESSE(IdUtente, Cod_pianeta)
		on delete restrict
        on update cascade,
     foreign key(Cod_pacchetto) references PACCHETTO(Cod_pacchetto)
		on delete restrict
        on update cascade,
     foreign key(Cod_ordine, Cod_pacchetto_ordine) references PACCHETTO_IN_ORDINE(Cod_ordine, Cod_pacchetto)
		on delete restrict
        on update cascade,
     constraint TipoCHK check(Tipo_notifica between 0 and 3)
);

create table NOTIFICA_UTENTE (
     IdUtente int not null,
     Vista tinyint not null,
     Cod_notifica int not null,
     primary key (IdUtente, Cod_notifica),
     foreign key(IdUtente) references UTENTE(IdUtente)
        on delete restrict
        on update cascade,
     foreign key(Cod_notifica) references NOTIFICA(Cod_notifica)
        on delete restrict
        on update cascade
     constraint VistaCHK check(Vista in (0,1)), /*Trasformo in boolean*/
);