Begin;

Create Table Attrs(
    No Integer Primary Key AutoIncrement, 
    id VarChar(15) Not Null Unique, 
    Name VarChar(31) Not Null, 
    Notes VarChar(255), 
    ctime Integer, 
    mtime Integer
);

Create Table Tests(
    No Integer Primary Key AutoIncrement, 
    ParentNo Integer, 
    ctime Integer);

Create Index iTests On Tests(ParentNo);

Create Table AttrVals(
    No Integer Primary Key,
    TestNo Integer, 
    AttrNo Integer, 
    Value VarChar(255) Not Null, 
    ctime Integer, 
    mtime Integer,
    Foreign Key(AttrNo) References Attrs(No),
    Foreign Key(TestNo) References Tests(No)
);

Create Index iAV On AttrVals(TestNo, AttrNo);

Create Table Status(
    No Integer Primary Key,
    State Char(1) Not Null,
    TestNo Integer,
    btime Integer,
    etime Integer,
    Foreign Key(TestNo) References Tests(No)
);

Create Index iStatusB On Status(TestNo, btime);
Create Index iStatusE On Status(TestNo, etime);

Create Trigger insAV
    After Insert On AttrVals
Begin 
    Update AttrVals Set ctime=strftime('%s', 'now') Where No=New.No; 
End;

Create Trigger updAV
    After Update On AttrVals 
Begin
    Update AttrVals Set mtime=strftime('%s', 'now') Where No=New.No; 
End;

Create Trigger insAttrs
    After Insert On Attrs
Begin
    Update Attrs Set ctime=strftime('%s', 'now') Where No=New.No;
End;

Create Trigger updAttrs
    After Update On Attrs
Begin
    Update Attrs Set mtime=strftime('%s', 'now') Where No=New.No;
End;

Create Trigger insTest
    After Insert On Tests
Begin
    Update Tests Set ctime=strftime('%s', 'now') Where No=New.No;
End;

Create Trigger delTests
    Before Delete On Tests
Begin
    Delete From AttrVals Where TestNo=Old.No;
    Delete From Status Where TestNo=Old.No;
End;

Insert Into Attrs(id, Name) Values('host', 'Адрес');
Insert Into Attrs(id, Name) Values('name', 'Название');
Insert Into Attrs(id, Name) Values('description', 'Заметки');
Insert Into Attrs(id, Name) Values('off', 'Неактивный');
Insert Into Attrs(id, Name, Notes) Values('method', 'Тип', 'Если опущено, подразумевается ping');
Insert Into Attrs(id, Name, Notes) Values('port', 'Порт', 'Порт для типа connect');

Commit;
