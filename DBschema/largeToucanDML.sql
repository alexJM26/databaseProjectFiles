-- CUSTOMER INSERTS
insert into customer values ('c12345','Bob','Smith','7014 Smith Blvd.','Stow','Ohio','44224','bsmith@gmail.com','password',2341478529,'2001-07-02',100);
insert into customer values ('c19202','John','Jones','1090 Howe Ave.','Stow','Ohio','44224','jjones@gmail.com','!#$DSFSR#6545',3309991020,'2005-09-10',0);
insert into customer values ('c42212','Steven','Daniels','199 Green St.','Cuyahoga Falls','Ohio','44220','sdaniels@gmail.com','spoingle',9270010288,'1972-01-22',700);
insert into customer values ('c71828','Alice','Lane','17 Boulder Dr.','Stow','Ohio','44224','alane@gmail.com','me1999',3301240012,'1999-04-24',1000);
insert into customer values ('c19929','Jane','Austin','498 Strawberry Blvd.','Stow','Ohio','44224','jaustin@gmail.com','bingus',3309241102,'1985-01-02',0);
insert into customer values ('c56789','Michael','Johnson','803 Oak St.','Cuyahoga Falls','Ohio','44221','mjohnson@gmail.com','scrunkle',3307775555,'1990-06-15',0);
insert into customer values ('c34567','Emily','Davis','234 Elm St.','Akron','Ohio','44301','edavis@gmail.com','secretsecret',3304443333,'1988-03-18',50);
insert into customer values ('c89012','David','Brown','512 Maple Ave.','Hudson','Ohio','44236','dbrown@gmail.com','123654789a',2349998888,'1975-11-25',250);
insert into customer values ('c45678','Sarah','Wilson','701 Pine St.','Stow','Ohio','44224','swilson@gmail.com','pine09',3302221111,'2000-09-09',750);
insert into customer values ('c67890','Matthew','Clark','909 Cedar St.','Cuyahoga Falls','Ohio','44221','mclark@gmail.com','mycedar20',3306667777,'1995-05-20',9000);
insert into customer values ('c98765','Kevin','Taylor','601 Walnut St.','Cuyahoga Falls','Ohio','44221','ktaylor@gmail.com','help',3305556666,'1997-11-08',50);
insert into customer values ('c54321','Lauren','Perez','803 Chestnut St.','Hudson','Ohio','44236','lperez@gmail.com','randomwords',2349876543,'1993-07-12',0);
insert into customer values ('c13579','Brandon','Harris','2000 Pine St.','Stow','Ohio','44224','bharris@gmail.com','stuffandthings',3302223333,'1986-04-04',200);
insert into customer values ('c86420','Rachel','Gonzalez','404 Oak St.','Akron','Ohio','44301','rgonzalez@gmail.com','ohno',3304445555,'1980-10-30',300);
insert into customer values ('c24680','Eric','King','1101 Maple St.','Cuyahoga Falls','Ohio','44221','eking@gmail.com','what?who?',3307778888,'1974-02-18',10);

-- ROLE INSERTS
insert into role values ("Manager",20.00);
insert into role values ("Cashier",15.00);
insert into role values ("Customer Service Representative",17.00);
insert into role values ("Shopping Cart Attendant",14.00);
insert into role values ("Stock Clerk",17.00);
insert into role values ("Website Engineer",50.00);

-- EMPLOYEE INSERTS
insert into employee values ('e11101','Manager','John','Will','Green','1555 Stone St.','Kent','Ohio',44240,'jgreen@largetoucan.com','adsa545aa',3309874256,'1992-05-27','2016-11-16');
insert into employee values ('e11102','Cashier','Bob','Robert','Evans','88152 Kent Rd.','Kent','Ohio',44240,'revans@largetoucan.com','secretstuff',6507356301,'1984-04-17', '2022-06-23');
insert into employee values ('e11103','Customer Service Representative','Colt','John','Nicolas','9213 Summit St.','Kent','Ohio',44240,'cnicolas@largetoucan.com','morepasswords',3307945341,'1995-07-18','2015-01-18');
insert into employee values ('e11104','Shopping Cart Attendant','Abby','James','Smith','1724 Graham Rd.','Stow','Ohio',44221,'asmith@largetoucan.com','hello',3301256720,'2005-07-13','2023-09-10');
insert into employee values ('e11105','Stock Clerk','Lily','Mary','Mark','14689 Elm Rd.','Stow','Ohio',44221,'lmark@largetoucan.com','goodbye',3303489921,'2002-08-11','2018-06-24');
insert into employee values ('e11106','Cashier','Henry','Lee','Joseph','87 Newberry St.','Cuyahoga Falls','Ohio',44221,'hlee@largetoucan.com','8941dsda',3301218856,'1994-04-13','2017-02-16');
insert into employee values ('e11107','Manager','Louise','Ann','Sue','Center Ave.','Cuyahoga Falls','Ohio',44221,'lsue@largetoucan.com','!dog',3305942131,'1977-02-02','2016-03-01');
insert into employee values ('e11108','Shopping Cart Attendant','Scott','John','Edward','7240 Stokes Ln.','Hudson','Ohio',44224,'sedward@largetoucan.com','!cat',3304429310,'2004-05-13','2023-12-12');
insert into employee values ('e11109','Cashier','Marie','Wayne','Alan','72 Stoney Hill Dr.','Hudson','Ohio',44224,'malan@largetoucan.com','helloworld',2169942240,'1981-09-07','2021-01-16');
insert into employee values ('e11110','Stock Clerk','Andrew','James','David','Franklin St.','Aurora','Ohio',44202,'adavid@largetoucan.com','foobar',2161028456,'1999-02-01','2015-10-08');
insert into employee values ('e11111','Customer Service Representative','Grace','Maria','Jane','1122 Elm St.','Aurora','Ohio',44202,'gjane@largetoucan.com','anotherone',3309874256,'1992-05-27','2016-11-16');
insert into employee values ('e11112','Manager','Jonathan','Ryan','Taylor','144 Strawberry Rd.','Kent','Ohio',44240,'jtaylor@largetoucan.com','lastone',3301121975,'1997-01-18','2018-09-21');

--PRODUCT INSERTS
INSERT INTO product VALUES ('pr00001', 'Apple', 'Fruit', 100, 1, 0.45);
INSERT INTO product VALUES ('pr00002', 'Banana', 'Fruit', 120, 1, 0.45);
INSERT INTO product VALUES ('pr00003', 'Strawberries', 'Fruit', 75, 1, 4.20);
INSERT INTO product VALUES ('pr00004', 'Oranges', 'Fruit', 85, 1, 2.30);
INSERT INTO product VALUES ('pr00005', 'Grapes', 'Fruit', 50, 1, 3.05);
INSERT INTO product VALUES ('pr00006', 'Carrot', 'Vegetable', 65, 2, 0.80);
INSERT INTO product VALUES ('pr00007', 'Broccoli', 'Vegetable', 100, 2, 2.30);
INSERT INTO product VALUES ('pr00008', 'Honeydew', 'Fruit', 30, 3, 3.00);
INSERT INTO product VALUES ('pr00009', 'Iceberg Lettuce', 'Vegetable', 80, 2, 1.00);
INSERT INTO product VALUES ('pr00010', 'Tomatoes', 'Fruit', 95, 3, 2.50);
INSERT INTO product VALUES ('pr00011', 'Kiwi', 'Fruit', 100, 3, 0.40);
INSERT INTO product VALUES ('pr00012', 'Lemon', 'Fruit', 100, 3, 0.30);
INSERT INTO product VALUES ('pr00013', 'Mango', 'Fruit', 70, 3, 1.50);
INSERT INTO product VALUES ('pr00014', 'Nectarine', 'Fruit', 90, 3, 0.90);
INSERT INTO product VALUES ('pr00015', 'Orange', 'Fruit', 100, 3, 0.30);
INSERT INTO product VALUES ('pr00016', 'Raspberry', 'Fruit', 50, 3, 2.00);
INSERT INTO product VALUES ('pr00017', 'Chicken', 'Protein', 40, 4, 5.10);
INSERT INTO product VALUES ('pr00018', 'Beef', 'Protein', 60, 4, 6.20);
INSERT INTO product VALUES ('pr00019', 'Pork', 'Protein', 100, 4, 3.20);
INSERT INTO product VALUES ('pr00020', 'Lamb', 'Protein', 100, 4, 12.15);
INSERT INTO product VALUES ('pr00021', 'Turkey', 'Protein', 30, 4, 5.25);
INSERT INTO product VALUES ('pr00022', 'Duck', 'Protein', 15, 5, 15.30);
INSERT INTO product VALUES ('pr00023', 'Veal', 'Protein', 20, 5, 14.00);
INSERT INTO product VALUES ('pr00024', 'Rabbit', 'Protein', 20, 5, 25.25);
INSERT INTO product VALUES ('pr00025', 'Salmon', 'Protein', 70, 5, 15.35);
INSERT INTO product VALUES ('pr00026', 'Toucan', 'Protein', 10, 5, 51.35);
INSERT INTO product VALUES ('pr00027', 'Cheese', 'Dairy', 80, 6, 4.50);
INSERT INTO product VALUES ('pr00028', 'Yogurt', 'Dairy', 100, 6, 1.50);
INSERT INTO product VALUES ('pr00029', 'Butter', 'Dairy', 30, 6, 3.00);
INSERT INTO product VALUES ('pr00030', 'Cream', 'Dairy', 70, 6, 1.50);
INSERT INTO product VALUES ('pr00031', 'Buttermilk', 'Dairy', 25, 6, 3.00);
INSERT INTO product VALUES ('pr00032', 'Milk', 'Dairy', 100, 7, 3.50);
INSERT INTO product VALUES ('pr00033', 'Brown Rice', 'Grain', 20, 7, 1.50);
INSERT INTO product VALUES ('pr00034', 'Buckwheat', 'Grain', 100, 7, 2.50);
INSERT INTO product VALUES ('pr00035', 'Barley', 'Grain', 10, 7,1.50);
INSERT INTO product VALUES ('pr00036', 'Quinoa', 'Grain', 100, 7, 4.00);
INSERT INTO product VALUES ('pr00037', 'Amaranth', 'Grain', 100, 7, 4.25);
INSERT INTO product VALUES ('pr00038', 'White Rice', 'Grain', 80, 7, 3.00);
INSERT INTO product VALUES ('pr00039', 'Rye', 'Grain', 70, 8, 2.10);
INSERT INTO product VALUES ('pr00040', 'Oats', 'Grain', 60, 8, 0.90);
INSERT INTO product VALUES ('pr00041', 'Corn', 'Grain', 100, 8, 3.30);

-- PURCHASE INSERTS
INSERT INTO purchase VALUES ('p00001', 'c12345', 20.00, '2020-11-30');
INSERT INTO purchase VALUES ('p00035', 'c42212', 22.30, '2024-04-25');
INSERT INTO purchase VALUES ('p00121', 'c12345', 20.00, '2016-07-05');
INSERT INTO purchase VALUES ('p00341', 'c56789', 57.35, '2023-04-21');
INSERT INTO purchase VALUES ('p00561', 'c86420', 4.50, '2022-12-24');
INSERT INTO purchase VALUES ('p00452', 'c56789', 9.90, '2015-02-14');
INSERT INTO purchase VALUES ('p00634', 'c86420', 26.10, '2024-04-20');
INSERT INTO purchase VALUES ('p03921', 'c24680', 22.50, '2024-04-15');
INSERT INTO purchase VALUES ('p29592', 'c86420', 27.60, '2020-10-16');
INSERT INTO purchase VALUES ('p00456', 'c86420', 51.35, '2016-03-28');
INSERT INTO purchase VALUES ('p00563', 'c45678', 15.30, '2017-08-03');
INSERT INTO purchase VALUES ('p00321', 'c56789', 33.60, '2018-07-22');
INSERT INTO purchase VALUES ('p00851', 'c71828', 9.00, '2024-04-21');

-- DISCOUNT INSERTS
INSERT INTO discount VALUES ('d00001', 'pr00008', 'percent_off', 0.20, '2024-04-25', '2024-04-30');
INSERT INTO discount VALUES ('d00002', 'pr00011', 'new_value', 0.30, '2024-04-30', '2024-05-30');
INSERT INTO discount VALUES ('d00003', 'pr00015', 'percent_off', 0.30, '2024-03-10', '2024-05-10');
INSERT INTO discount VALUES ('d00004', 'pr00018', 'percent_off', 0.10, '2024-04-20', '2024-06-20');
INSERT INTO discount VALUES ('d00005', 'pr00024', 'percent_off', 0.15, '2024-02-01', '2024-06-01');
INSERT INTO discount VALUES ('d00006', 'pr00026', 'new_value', 40.00, '2023-12-01','2024-01-01');
INSERT INTO discount VALUES ('d00007', 'pr00030', 'new_value', 1.00, '2022-01-01','2022-02-01');
INSERT INTO discount VALUES ('d00008', 'pr00032', 'percent_off', 0.20, '2024-02-10', '2024-07-10');
INSERT INTO discount VALUES ('d00009', 'pr00036', 'percent_off', 0.50, '2021-11-20','2022-11-20');
INSERT INTO discount VALUES ('d00010', 'pr00040', 'new_value', 0.50, '2024-02-05', '2024-06-30');

-- COUPON INSERTS
INSERT INTO coupon VALUES ('cp00001', 200, "20% off");
INSERT INTO coupon VALUES ('cp00092', 800, "70% off");
INSERT INTO coupon VALUES ('cp91822', 100, "10% off");
INSERT INTO coupon VALUES ('cp99914', 1000, "Buy one get one free.");
INSERT INTO coupon VALUES ('cp18841', 1100, "80% off");
INSERT INTO coupon VALUES ('cp93814', 2000, "Buy one get two free.");

-- REVIEW INSERTS
INSERT INTO review VALUES ('r00001','pr00001',5,'Very fresh!','2024-05-03');
INSERT INTO review VALUES ('r00002','pr00026',2,'Kind of disturbing honestly.','2022-07-25');
INSERT INTO review VALUES ('r00003','pr00019',4,'Pretty good quality.','2020-11-07');
INSERT INTO review VALUES ('r00004','pr00005',5,NULL,'2015-05-01');
INSERT INTO review VALUES ('r00005','pr00013',5,'High quality produce.','2016-09-20');
INSERT INTO review VALUES ('r00006','pr00027',3,'Had a very close experation date.','2020-03-27');
INSERT INTO review VALUES ('r00007','pr00030',5,NULL,'2018-12-03');
INSERT INTO review VALUES ('r00008','pr00017',1,'I was expecting to bring home dinner, but I brought home a pet chicken instead.','2015-02-12');
INSERT INTO review VALUES ('r00009','pr00009',5,'Great quality!','2019-06-04');

-- USES INSERTS
INSERT INTO uses VALUES ('c12345','cp00001');
INSERT INTO uses VALUES ('c19202','cp00001');
INSERT INTO uses VALUES ('c19202','cp00092');
INSERT INTO uses VALUES ('c89012','cp00092');
INSERT INTO uses VALUES ('c89012','cp91822');
INSERT INTO uses VALUES ('c24680','cp91822');
INSERT INTO uses VALUES ('c12345','cp91822');
INSERT INTO uses VALUES ('c67890','cp91822');
INSERT INTO uses VALUES ('c89012','cp99914');
INSERT INTO uses VALUES ('c45678','cp18841');
INSERT INTO uses VALUES ('c71828','cp00001');
INSERT INTO uses VALUES ('c54321','cp00092');

-- CONTAINS INSERTS
INSERT INTO contains VALUES ('pr00009','p00001',20);
INSERT INTO contains VALUES ('pr00007','p00035',3);
INSERT INTO contains VALUES ('pr00032','p00035',2);
INSERT INTO contains VALUES ('pr00036','p00121',5);
INSERT INTO contains VALUES ('pr00025','p00341',1);
INSERT INTO contains VALUES ('pr00003','p00341',10);
INSERT INTO contains VALUES ('pr00040','p00561',5);
INSERT INTO contains VALUES ('pr00041','p00452',3);
INSERT INTO contains VALUES ('pr00015','p00634',2);
INSERT INTO contains VALUES ('pr00006','p00634',30);
INSERT INTO contains VALUES ('pr00013','p00634',1);
INSERT INTO contains VALUES ('pr00028','p03921',15);
INSERT INTO contains VALUES ('pr00018','p29592',3);
INSERT INTO contains VALUES ('pr00027','p29592',2);
INSERT INTO contains VALUES ('pr00026','p00456',1);
INSERT INTO contains VALUES ('pr00022','p00563',1);
INSERT INTO contains VALUES ('pr00011','p00321',9);
INSERT INTO contains VALUES ('pr00016','p00321',15);
INSERT INTO contains VALUES ('pr00038','p00851',3);