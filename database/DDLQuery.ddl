create database spaceair;
use spaceair;


create table USERS (
     IdUser int not null auto_increment primary key,
     Name varchar(20) not null,
     Surname varchar(20) not null,
     Borndate date not null,
     Phone char(10) not null,
     ProfileImg varchar(100) not null,
     Mail varchar(50) not null unique,
     Password char(128) not null,
     Salt char(128) not null,
     Type tinyint not null,
     PartitaIva char(11),
     Newsletter tinyint not null
);

alter table USERS add constraint UserTypeCHK check(Type in (1,2)); /*Controllo su tipo USERS 1-Admin 2-USERS Normale*/
alter table USERS add constraint NewsletterCHK check(Newsletter in (0,1)); /*Trasformo in boolean*/

create table ADDRESS (
     CodAddress int not null auto_increment primary key,
     Via varchar(40) not null,
     Civico varchar(6) not null,
     Citta varchar(20) not null,
     Provincia varchar(20) not null,
     Cap varchar(10) not null,
     IdUser int not null,
     foreign key(IdUser) references USERS(IdUser)
        on delete restrict
        on update cascade
);

create table PLANET (
     CodPlanet int not null auto_increment primary key,
     Name varchar(20) not null,
     Temperature int not null,
     Mass float not null,
     Surface float not null,
     SunDistance float not null,
     Composition varchar(10) not null,
     DayLength int not null, /*Minuti*/
     Img varchar(100) not null,
     Description varchar(1000) not null,
     Visible tinyint not null
);

alter table PLANET add constraint VisibleCHK check(Visible in (0,1)); /*Trasformo in boolean*/
alter table PLANET add constraint CompositionCHK check(Composition in ("Solido", "Liquido", "Gassoso", "Lava")); /*Check su composizione*/

create table PACKET (
     CodPacket int not null auto_increment primary key,
     DateTimeDeparture datetime not null,
     DateTimeArrival datetime not null,
     Price float not null,
     MaxSeats tinyint not null,
     Description varchar(1000) not null,
     CodPlanet int not null,
     foreign key(CodPlanet) references PLANET(CodPlanet)
        on delete restrict
        on update cascade
);

alter table PACKET add constraint DateCHK check(DateTimeDeparture<DateTimeArrival);
alter table PACKET add constraint PriceCHK check(Price>0);
alter table PACKET add constraint SeatsCHK check(MaxSeats>0);

/*
0-Carrello
1-Accettato
2-In consegna
3-Consegnato
*/
create table ORDER_STATE (
     CodState int not null auto_increment primary key,
     Description varchar(100) not null
);

create table ORDERS (
     CodOrder int not null auto_increment primary key,
     PurchaseDate datetime,
     Total float,
     DestAddressCode int,
     State int not null,
     IdUser int not null,
     foreign key(DestAddressCode) references ADDRESS(CodAddress)
        on delete restrict
        on update cascade,
     foreign key(State) references ORDER_STATE(CodState)
        on delete restrict
        on update cascade,
     foreign key(IdUser) references USERS(IdUser)
        on delete restrict
        on update cascade
);

/* Viene inserito solo al momento del pagamento, quindi è null finchè gli elementi stanno nel carrello. */
/* alter table ORDERS add constraint TotalCHK check(Total>0); */ 

create table TRACK (
     CodOrder int not null,
     DateTime datetime not null,
     Citta varchar(200) not null,
     Description varchar(200) not null,
     primary key(CodOrder, DateTime),
     foreign key(CodOrder) references ORDERS(CodOrder)
        on delete restrict
        on update cascade
);

create table PACKET_IN_ORDER (
     CodPacket int not null,
     CodOrder int not null,
     Quantity smallint not null,
     primary key (CodOrder, CodPacket),
     foreign key(CodOrder) references ORDERS(CodOrder)
        on delete restrict
        on update cascade,
    foreign key(CodPacket) references PACKET(CodPacket)
        on delete restrict
        on update cascade
);

alter table PACKET_IN_ORDER add constraint QuantityCHK check(Quantity>=0);

create table REVIEW (
     DateTime datetime not null,
     Title varchar(50) not null,
     Description varchar(1000) not null,
     Rating tinyint not null,
     IdUser int not null,
     CodPlanet int not null,
     primary key (IdUser, CodPlanet),
     foreign key(IdUser) references USERS(IdUser)
        on delete restrict
        on update cascade,
     foreign key(CodPlanet) references PLANET(CodPlanet)
        on delete restrict
        on update cascade
);

alter table REVIEW add constraint RatingCHK check(Rating between 1 and 5);

create table INTEREST (
     Date datetime not null,
     IdUser int not null,
     CodPlanet int not null,
     Visible tinyint not null,
     primary key (IdUser, CodPlanet),
     foreign key(IdUser) references USERS(IdUser)
        on delete restrict
        on update cascade,
     foreign key(CodPlanet) references PLANET(CodPlanet)
        on delete restrict
        on update cascade
);

/*
0-Notifica Generale
1-Notifica Pacchetto
2-Notifica Pianeta
*/create table TEMPLATE_NOTIFICATION (
     CodNotification int not null auto_increment primary key,
     DateTime datetime not null,
     Title varchar(1000) not null,
     Description varchar(1000) not null,
     Type tinyint not null,
     CodPlanet int,
     CodPacket int,
     foreign key(CodPacket) references PACKET(CodPacket)
		   on delete restrict
         on update cascade,
      foreign key(CodPlanet) references PLANET(CodPlanet)
         on delete restrict
         on update cascade
);

alter table TEMPLATE_NOTIFICATION add constraint TypeCHK check(Type between 0 and 2);
alter table TEMPLATE_NOTIFICATION add constraint TypeRegularCHK check((Type = 0 and CodPlanet IS NULL and CodPacket IS NULL) or
   (Type = 1 and CodPacket IS NOT NULL and CodPlanet IS NULL) or
   (Type = 2 and CodPlanet IS NOT NULL and CodPacket IS NULL));

create table USER_NOTIFICATION (
     IdUser int not null,
     View tinyint not null,
     CodNotification int not null,
     primary key (IdUser, CodNotification),
     foreign key(IdUser) references USERS(IdUser)
        on delete restrict
        on update cascade,
     foreign key(CodNotification) references TEMPLATE_NOTIFICATION(CodNotification)
        on delete restrict
        on update cascade
);

alter table USER_NOTIFICATION add constraint ViewCHK check(View in (0,1)); /*Trasformo in boolean*/



/*
Trigger
*/

/*
Quando metto dataacquisto, mi va lo stato automaticamente
ad accettato
*/
/*
NOTA: NON FUNZIONA
delimiter $$
create trigger date_purchase_UPDATE after update on ORDERS
for each row
begin
	if new.PurchaseDate is not null
	then
		UPDATE ORDERS set State = 1 where CodOrder = new.CodOrder;
	end if;
end;$$*/