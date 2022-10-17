create table movies
( id int unsigned not null auto_increment primary key,
  name char(100) not null,
  starting_date date not null,
  ending_date date not null,
  location char(30) not null,
  details text not null,
  pic_url text not null,
  trailer_url text not null
);

create table seatingPlan
( id int unsigned not null auto_increment primary key,
  movie char(100) not null,
  time char(100) not null,
  seat_map int unsigned not null
);



create table order_items
( orderid int unsigned not null,
  email char(13) not null,
  first_name char(50) not null,
  last_name char(50) not null,
  checkout_time TIMESTAMP not null,
  movie char(50) not null,
  location char(50) not null,
  detail text not null,

);

