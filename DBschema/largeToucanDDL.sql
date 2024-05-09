create table customer
    (customer_ID    varchar(6) check (customer_ID like 'c_____'),
     first_name     varchar(30),
     last_name      varchar(30),
     street         varchar(50),
     city           varchar(30),
     state          varchar(15),
     zip            numeric(5),
     email          varchar(50) check (email like '%@%'),
     password       varchar(15),
     phone          numeric(10),
     date_of_birth  date,
     reward_points  numeric(65),
     primary key (customer_ID)
    );

create table role
    (role_name      varchar(50),
     hourly_salary  numeric(8,2) check (hourly_salary >= 10.10),
     primary key (role_name)
    );

create table employee
    (employee_ID    varchar(6) check (employee_ID like 'e_____'),
     role_name      varchar(50),
     first_name     varchar(30),
     middle_name    varchar(30),
     last_name      varchar(30),
     street         varchar(50),
     city           varchar(30),
     state          varchar(15),
     zip            numeric(5),
     email          varchar(50) check (email like '%@%'),
     password       varchar(15),
     phone          numeric(10),
     date_of_birth  date,
     start_date     date,
     primary key (employee_ID),
     foreign key (role_name) references role (role_name)
    );

create table product
    (product_ID         varchar(7) check (product_ID like 'pr_____'),
     product_name       varchar(50),
     category           varchar(50),
     quantity_in_stock  numeric(10),
     aisle_location     numeric(2),
     price              numeric(10,2) check (price > 0),
     primary key (product_ID)
    );

create table purchase
    (purchase_ID    varchar(6) check (purchase_ID like 'p_____'),
     customer_ID    varchar(6) check (customer_ID like 'c_____'),
     total_cost     numeric(10,2),
     purchase_date  date,
     primary key (purchase_ID),
     foreign key (customer_ID) references customer (customer_ID)
    );

create table discount
    (discount_ID    varchar(6) check (discount_ID like 'd_____'),
     product_ID     varchar(7) check (product_ID like 'pr_____'),
     type           varchar(20) check (type like 'percent_off' or type like 'new_value'),
     value          numeric(10,2),
     start_date     date,
     end_date       date,
     primary key (discount_ID),
     foreign key (product_ID) references product (product_ID)
    );

create table coupon
    (coupon_ID          varchar(7) check (coupon_ID like 'cp_____'),
     reward_point_cost  numeric(4),
     description        varchar(500),
     primary key (coupon_ID)
    );

create table review
    (review_ID          varchar(6) check (review_ID like 'r_____'),
     product_ID         varchar(7) check (product_ID like 'pr_____'),
     star_rating        numeric(1) check (star_rating > 0 and star_rating < 6),
     text               varchar(1000),
     submission_date    date,
     primary key (review_ID),
     foreign key (product_ID) references product (product_ID)
    );

create table uses
    (customer_ID    varchar(6) check (customer_ID like 'c_____'),
     coupon_ID      varchar(7) check (coupon_ID like 'cp_____'),
     primary key (customer_ID, coupon_ID),
     foreign key (customer_ID) references customer (customer_ID),
     foreign key (coupon_ID) references coupon (coupon_ID)
    );

create table contains
    (product_ID     varchar(7) check (product_ID like 'pr_____'),
     purchase_ID    varchar(6) check (purchase_ID like 'p_____'),
     quantity       numeric(10),
     primary key (product_ID, purchase_ID),
     foreign key (product_ID) references product (product_ID),
     foreign key (purchase_ID) references purchase (purchase_ID)
    );