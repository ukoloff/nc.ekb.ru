Create Table Mig(
 No	Integer Primary Key AutoIncrement,
 IP	VarChar(15),
 Time	DateTime	Default Current_TimeStamp,
 Room	VarChar(15),
 Phone	VarChar(31),
 uD	VarChar(31),
 u	VarChar(31),
 Host	VarChar(31),
 Directum	Boolean,
 dsig		Boolean,
 C1		Boolean,
 winVer	VarChar(255),
 uDN	VarChar(255),
 cDN	VarChar(255),
 appData	VarChar(255),
 Notes	Text
);

Create Index iTime On Mig(Time);
