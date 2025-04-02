-- Коммутаторы, подлежащие осмотру
CREATE TABLE Switch(
    No		Integer Primary Key AutoIncrement, 
    Pri		Integer Unique, 
    Name	VarChar(255),
    Host	VarChar(255) Not Null,
    Disabled	Integer
);

-- Журнал запуска программы
Create Table Run(
    No		Integer Primary Key AutoIncrement, 
    Start	VarChar(255) Not Null Default CURRENT_TIMESTAMP,
    Time	Integer,
    PID		Integer Not Null,
    Status	Integer Default 0
);
Create Index iRun On Run(Status, Time);
Create Index iRunTime On Run(Time);

-- Все найденные когда-либо IP-адреса
CREATE TABLE IPs(
    No		Integer Primary Key AutoIncrement, 
    IP		VarChar(15) Not Null Unique,
    First	Integer Not Null,
    Last	Integer Not Null
);

-- Все найденные когда-либо MAC-адреса
CREATE TABLE MACs(
    No		Integer Primary Key AutoIncrement, 
    MAC		VarChar(17) Not Null Unique,
    First	Integer Not Null,
    Last	Integer Not Null 
);

-- Сведения о коммутаторах, полученные от них же
Create Table SwInfo(
    No		Integer Primary Key,
    IP		Integer,
    Name	VarChar(255),
    Location	VarChar(255),
    Contact	VarChar(255),
    Descr	VarChar(255)
);

-- Какие MAC-адреса на каких портах каких коммутаторов
Create Table Comm(
    No		Integer Primary Key,
    Sw		Integer,
    Port	Integer,
    MAC		Integer
);
Create Index iComm on Comm(SW, Port);
Create Index iCMac on Comm(MAC, SW);

-- Связки MAC<=>IP
Create Table ARP(
    No		Integer Primary Key,
    IP		Integer,
    MAC		Integer
);
Create Unique Index iARP1 On ARP(IP, MAC);
Create Index iARP2 On ARP(MAC);

-- Всё, что известно о коммутаторах
Create View SwitchX
As Select S.*,
    (Select IP From IPs Where IPs.No=X.IP) As IP,
    (Select MACs.MAC From ARP, MACs Where ARP.IP=X.IP And ARP.Mac=MACs.No Limit 1) As Mac,
    X.Name As snmpName, X.Location As Location, X.Contact As Contact, X.Descr As Descr,
    (Select Count(Distinct Port) From Comm Where Comm.Sw=S.No) As Ports,
    (Select Count(Distinct MAC) From Comm Where Comm.Sw=S.No) As Macs
From Switch As S, SwInfo As X
Where S.No=X.No;

-- Связка портов коммутаторов - какие порты видят общие MACи
Create Table CrossX(SA Integer, PA Integer, SB Integer, PB Integer);
Create Index iXA On CrossX(SA, PA);
Create Index iXB On CrossX(SB, PB);

-- На каком порту видны MACи других коммутаторов
Create Table CrossY(No Integer, SW Integer, Port Integer);
Create Index iY1 On CrossY(No, SW);
Create Index iY2 On CrossY(Sw, Port);

-- То же, что CrossX, за вычетом CrossY
Create Table CrossZ(SA Integer, PA Integer, SB Integer, PB Integer);
Create Index iZA On CrossZ(SA, PA);
Create Index iZB On CrossZ(SB, PB);
