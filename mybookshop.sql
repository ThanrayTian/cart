create database bookshop;
use bookshop;

create table customers
(
    customerid int unsigned not null auto_increment,
    name char(30) not null,
    phone char(15) not null,
    address char(80) not null,
    city char(20) not null,
    province char(20) not null,
    mailcode char(10) not null,
    primary key (customerid)
) ENGINE=InnoDB;

create table categories
(
    catid int unsigned not null auto_increment,
    catname char(30) not null,
    primary key (catid)
) ENGINE=InnoDB;

create table books
(
    isbn char(13) not null,
    title char(100) not null,
    author char(100) not null,
    catid int unsigned not null,
    price float(4,2) not null,
    description varchar(255),
    primary key (isbn),
    foreign key (catid) references categories(catid)
) ENGINE=InnoDB;

create table orders
(
    orderid int unsigned not null auto_increment,
    customerid int unsigned not null,
    amount float(6,2) not null,
    date date not null,
    ship_name char(30) not null,
    ship_phone char(15) not null,
    ship_address char(80) not null,
    ship_city char(20) not null,
    ship_province char(20) not null,
    ship_mailcode char(10) not null,
    primary key (orderid),
    foreign key (customerid) references customers(customerid)
) ENGINE=InnoDB;

create table order_item
(
    orderid int unsigned not null,
    isbn char(13) not null,
    item_price float(4,2) not null,
    quantity int unsigned not null,
    primary key (orderid, isbn),
    foreign key (orderid) references orders(orderid),
    foreign key (isbn) references books(isbn)
) ENGINE=InnoDB;

grant select,insert,delete,update
on bookshop.*
to bs_user@localhost identified by 'password';
