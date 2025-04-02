Create Table Z(
 No	Integer		Primary Key,
 X	VarChar(5)	Unique Not Null,
 Expire	DateTime	Not Null,
 tAccpt	Integer		Not Null	Default 10,
 tData	Integer		Not Null	Default 1800
);

Create Index iZ on Z(Expire);

Create Table Log(
 No	Integer		Primary Key,
 s	VarChar(255)	Not Null,
 u	VarChar(31)	Not Null,
 IP	VarChar(15)	Not Null,
 Start	DateTime	Default CURRENT_TIMESTAMP,
 Port	Integer
);

Create Index iU		On Log(u, Start);

Create Table Data(
 No	Integer	Primary Key,
 logNo	Integer	Not Null,
 IP	VarChar(15)	Not Null,
 Start	DateTime	Default CURRENT_TIMESTAMP,
 iBytes	Integer	Not Null Default 0,
 oBytes	Integer	Not Null Default 0,
 Time	Integer	Not Null Default 0
);

Create Index iD	On Data(logNo);
