create table users(
    id int unsigned primary key auto_increment,
    user_name varchar(50) not null default '',
    password varchar(50) not null default '',
    roles varchar(20) not null default '1'
);

create table articles(
    id int unsigned primary key auto_increment,
    code varchar(7) unique not null default '',
    title varchar(50) not null default '',
    purchase_price float not null default 0,
    sale_price  float not null default 0,
    discount_price  float not null default 0,
    in_discount tinyint(1) unsigned default 0,
    image varchar(250) default '',
    description text,
    created timestamp default CURRENT_TIMESTAMP
);

create table stock(
    id int primary key auto_increment,
    article_id int unsigned not null,
    
    qty1_s1 int default 0,
    qty2_s1 int default 0,
    qty3_s1 int default 0,
    qty4_s1 int default 0,
    qty5_s1 int default 0,
    qty6_s1 int default 0,
    qty7_s1 int default 0,
    qty8_s1 int default 0,
    qty9_s1 int default 0,
    qty10_s1 int default 0,
    qty11_s1 int default 0,
    qty12_s1 int default 0,
    qty13_s1 int default 0,
    
    qty1_s2 int default 0,
    qty2_s2 int default 0,
    qty3_s2 int default 0,
    qty4_s2 int default 0,
    qty5_s2 int default 0,
    qty6_s2 int default 0,
    qty7_s2 int default 0,
    qty8_s2 int default 0,
    qty9_s2 int default 0,
    qty10_s2 int default 0,
    qty11_s2 int default 0,
    qty12_s2 int default 0,
    qty13_s2 int default 0,
    
    qty1_s3 int default 0,
    qty2_s3 int default 0,
    qty3_s3 int default 0,
    qty4_s3 int default 0,
    qty5_s3 int default 0,
    qty6_s3 int default 0,
    qty7_s3 int default 0,
    qty8_s3 int default 0,
    qty9_s3 int default 0,
    qty10_s3 int default 0,
    qty11_s3 int default 0,
    qty12_s3 int default 0,
    qty13_s3 int default 0,
    
    created timestamp default CURRENT_TIMESTAMP
);


create table orders(
    id int primary key auto_increment,
    customer varchar(100) not null default '',
    sub_total float not null default 0,
    total float not null default 0,
    created timestamp default CURRENT_TIMESTAMP
);


create table order_articles(
    id int primary key auto_increment,
    article_id int unsigned not null,
    `size` int not null default 1,    
    sale_price float not null default 0,
    comment text
);