create database msw;

use msw;

create table category(
categoryID int auto_increment primary key,
categoryName varchar(30) not null unique
);

create table product(
productID varchar(10) not null primary key,
productName varchar(50) not null,
productPrice int not null default(1),
productImage varchar(20) null,
productDetails varchar(500) null,
categoryID int not null,
constraint fk_catid foreign key (categoryID) references category(categoryID)
);

insert into category (categoryName) values
('LG'), ('Samsung'), ('Apple'), ('Google Pi'),
('Motorola'), ('Sony'), ('Nexus');
select * from category;
insert into product values
('P001', 'Black Kingsnake', 95, 'product001.jpg','Updating..', 3),
('P002', 'Moon Camping', 80, 'product002.jpg','Updating..', 3),
('P003', 'Retro Vending Machine', 65, 'product003.jpg','Updating..', 3),
('P004', 'Poker Card Luffy & Shanks Case', 65, 'product004.jpg','Updating..', 2),
('P005', 'Winter Tale Clear Case', 65, 'product005.jpg','Updating..', 2),
('P006', 'Brotherhood Sticker Case', 65, 'product006.jpg','Updating..', 2),
('P007', 'Groovy Pattern Clear', 75, 'product007.jpg','Updating..', 4),
('P008', 'Wood Case', 55, 'product008.jpg','Updating..', 6),
('P009', 'Motorola Mickey', 65, 'product009.jpg','Updating..', 5),
('P010', 'Nexus wood case', 65, 'product010.jpg','Updating..', 2);
select * from product;

select * from product where productID = 'P001';
create table `admin`
(
	adminID varchar(15) not null primary key,
    adminPass varchar(20) not null,
    adminFullname varchar(50) not null,
    adminEmail varchar(50) not null,
    adminPhoto varchar(50) not null
);
insert into `admin` values
('admin01', '123456', 'Tuan Lam', 'tuanlam@gmail.com', 'admin01.jpg'),
('admin02', '123456', 'Thu Nga', 'thunga@gmail.com', 'admin02.jpg'),
('admin03', '123456', 'Quynh Anh', 'quynhanh@gmail.com', 'admin03.jpg');

select * from `admin`;
CREATE Table
    Customer (
        customerID varchar(100) primary key not null,
        customerName varchar(100) not null,
        age int,
        customerAddress varchar(100) not null,
        customerEmail varchar(50) not null
    );

create table STORE (
storeID varchar(10) primary key not null,
storeAddress varchar(100) not null
);
create table STAFF (
staffID varchar(10) primary key not null,
staffName varchar(100) not null,
staffAddress varchar(100) not null,
storeID varchar(10) not null,
constraint FK_staff foreign key (storeID) references store(storeID)
);
create table STORAGES(
storeID varchar(10) not null,
productID varchar(10) not null,
quantity int not null
);
alter table STORAGES add constraint PK_Storages primary key (storeID, productID);
alter table STORAGES add constraint FK_1 foreign key (storeID) references STORE(storeID);
alter table STORAGES add constraint FK_2 foreign key (productID) references product(productID);

