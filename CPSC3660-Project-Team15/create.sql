create table VENUE (
    venue_id integer auto_increment not null primary key,
    address varchar(128),
    city varchar(128),
    vname varchar(128),
    seats integer);

create table CONCERT (
    concert_id integer auto_increment not null primary key,
    venue_id integer not null,
    cname varchar(128),
    cdate varchar(128),
    ctime varchar(128),
    foreign key (venue_id) references VENUE(venue_id)
    on delete cascade);

create table BAND (
    band_id integer auto_increment not null primary key,
    name varchar(128),
    manager varchar(128),
    phone varchar(12),
    email varchar(128));

create table TICKET (
    ticket_id integer auto_increment not null primary key,
    concert_id integer not null,
    seat varchar(5),
    cost float,
    foreign key (concert_id) references CONCERT(concert_id)
    on delete cascade);

create table GUEST (
    guest_id integer auto_increment not null primary key,
    name varchar(128),
    phone varchar(12),
    email varchar(128));

create table PLAYS (
    concert_id integer not null,
    band_id integer not null,
    primary key (band_id, concert_id),
    foreign key (band_id) references BAND(band_id)
    on delete cascade,
    foreign key (concert_id) references CONCERT(concert_id)
    on delete cascade);

create table HOLDS (
    guest_id integer not null,
    ticket_id integer not null,
    primary key (guest_id, ticket_id),
    foreign key (guest_id) references GUEST(guest_id)
    on delete cascade,
    foreign key (ticket_id) references TICKET(ticket_id)
    on delete cascade);

insert into VENUE (address, city, vname, seats) values
    ('2510 Scenic Dr S', 'Lethbridge', 'ENMAX Centre', 5900);
insert into VENUE (address, city, vname, seats) values
    ('6240 99 St NW', 'Edmonton', 'Union Hall', 2000);
insert into VENUE (address, city, vname, seats) values
    ('10030 102 St NW', 'Edmonton', 'The Starlite Room', 1300);
insert into VENUE (address, city, vname, seats) values
    ('William Hawrelak Park', 'Edmonton', 'Heritage Amphitheatre', 800);
insert into VENUE (address, city, vname, seats) values
    ('219 8 Ave SW', 'Calgary', 'The Palace Theatre', 5600);
insert into VENUE (address, city, vname, seats) values
    ('18 Mt Royal Cir SW', 'Calgary', 'Bella Concert Hall', 3800);

insert into CONCERT (venue_id, cname, cdate, ctime)
  values (1, 'RockFest', '2021-11-19', '18:00');
insert into CONCERT (venue_id, cname, cdate, ctime)
  values (3, 'Symphony Night', '2021-12-07', '18:30');
insert into CONCERT (venue_id, cname, cdate, ctime)
  values (5, 'HouseJam', '2022-09-19', '18:00');
insert into CONCERT (venue_id, cname, cdate, ctime)
  values (4, 'Superpalooza', '2022-03-07', '18:30');

insert into TICKET (concert_id, seat, cost)
  values (1, 'A34', '60.00');
insert into TICKET (concert_id, seat, cost)
  values (1, 'A35', '60.00');
insert into TICKET (concert_id, seat, cost)
  values (1, 'A36', '60.00');
insert into TICKET (concert_id, seat, cost)
  values (1, 'A37', '60.00');

insert into GUEST (name, phone, email) values
    ('Tom Morello', '555-555-4567', 'tom@rage.com');
insert into GUEST (name, phone, email) values
    ('Roger Waters', '555-555-0936', 'pink@wall.com');
insert into GUEST (name, phone, email) values
    ('Carlos Santana', '555-555-5783', 'carlos@blackmagic.com');

insert into BAND (name, manager, phone, email) values
    ('King Crimson', 'David Singleton', '555-555-8754', 'dave@kingcrimson.com');
insert into BAND (name, manager, phone, email) values
    ('Pink Floyd', 'Steve O''Rourke', '555-555-2384', 'steve@pink.com');
insert into BAND (name, manager, phone, email) values
    ('Talking Heads', 'Gary Kurfist', '555-555-6021', 'steve@talkingheads.com');
insert into BAND (name, manager, phone, email) values
    ('Black Sabbath', 'Don Arden', '555-555-0987', 'don@blacksabbath.com');

insert into HOLDS (guest_id, ticket_id)
  values (1, 1);

insert into PLAYS (guest_id, ticket_id)
  values (1, 1);
