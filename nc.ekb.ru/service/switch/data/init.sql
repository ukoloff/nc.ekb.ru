BEGIN TRANSACTION;

CREATE TABLE Switch(
    No		Integer Primary Key AutoIncrement, 
    Pri		Integer Unique, 
    Host	VarChar(255) Not Null,
    Name	VarChar(255),
    Disabled	Integer
);

INSERT INTO "Switch" VALUES(1,1,'gig.server.switch.uxm','Серверный гигабит',NULL);
INSERT INTO "Switch" VALUES(2,2,'server.switch.uxm','Серверный',NULL);
INSERT INTO "Switch" VALUES(3,3,'ltk2.switch.uxm','2 этаж ЛТК',NULL);
INSERT INTO "Switch" VALUES(4,4,'utk.switch.uxm','АТС-21/310',NULL);
INSERT INTO "Switch" VALUES(5,5,'ltk1.switch.uxm','1 этаж ЛТК',NULL);
INSERT INTO "Switch" VALUES(6,6,'ltk3.switch.uxm','3 этаж ЛТК',NULL);
INSERT INTO "Switch" VALUES(7,7,'ltk4.switch.uxm','4 этаж ЛТК',NULL);
INSERT INTO "Switch" VALUES(8,8,'911.switch.uxm','Служба техподдержки',NULL);
INSERT INTO "Switch" VALUES(9,9,'umz.switch.uxm','УМЗ',NULL);
INSERT INTO "Switch" VALUES(10,10,'z15.switch.uxm','Цех 15',NULL);
INSERT INTO "Switch" VALUES(11,11,'z23.switch.uxm','Цех 23',NULL);
INSERT INTO "Switch" VALUES(12,12,'z40.switch.uxm','Цех 40',NULL);
INSERT INTO "Switch" VALUES(13,13,'z11.switch.uxm','Цех 11',NULL);
INSERT INTO "Switch" VALUES(14,14,'z3.switch.uxm','Цех 3',NULL);
INSERT INTO "Switch" VALUES(15,15,'oit.switch.uxm','ОИТ',NULL);
INSERT INTO "Switch" VALUES(16,16,'iu.switch.uxm','ИУ',NULL);
INSERT INTO "Switch" VALUES(17,17,'dir.switch.uxm','Дирекция',NULL);
INSERT INTO "Switch" VALUES(18,18,'bug.switch.uxm','Бухгалтерия',NULL);
INSERT INTO "Switch" VALUES(19,19,'adsl.switch.uxm','АДСЛ',NULL);
INSERT INTO "Switch" VALUES(20,20,'sko.switch.uxm','СКО',NULL);
INSERT INTO "Switch" VALUES(21,NULL,'x01.switch.uxm','Свободный 3COM',1);
INSERT INTO "Switch" VALUES(22,NULL,'x02.switch.uxm','Свободный D-Link',1);
INSERT INTO "Switch" VALUES(23,NULL,'x03.switch.uxm','Свободный 3COM',1);
INSERT INTO "Switch" VALUES(24,NULL,'x04.switch.uxm','Свободный 3COM',1);
INSERT INTO "Switch" VALUES(25,NULL,'x05.switch.uxm','Свободный 3COM',1);

COMMIT;
