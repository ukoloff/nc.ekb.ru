-- CTEs (With clauses)

-- fiz: 
-- ����������.��������������	_Reference562
Select
  _IDRRef As id,
  _Code As tabNo,
  _Description As FIO,
  DATEADD(YYYY, -2000, Cast(_Fld41457 As date)) as bdate,
  _Fld41458RRef	As sex_ref,		-- _Enum1046
  _Fld41459	As INN,
  _Fld41460	As SNILS,
  DATEADD(YYYY, -2000, Cast(_Fld41467 As date)) as regdate,
  _Fld41471	As F,
  _Fld41472	As I,
  _Fld41473	As O
From _Reference562

-- rab:
-- ����������.����������	_Reference458
Select
  _IDRRef As id,
  _Code As tabNo,
  _Description As FIO,
  _Fld39756RRef	As fiz_id,		-- _Reference562
  _Fld39757RRef	As morg_id,		-- _Reference265
  _Fld39761RRef	As mrab_id,		-- _Reference458
  _Fld45806	As [user]
From _Reference458	

-- org:
-- ����������.�����������	_Reference265
Select 
  _IDRRef As id,
  _Description As nickname,
  _Fld34752	As longname,
  _Fld34753	As shortname
From _Reference265		

-- dept:
-- ����������.������������������������	_Reference347	
Select
  _IDRRef As id,
  _Code As Kod,
  _Description As name,
  _OwnerIDRRef As org_id,		-- _Reference265
  _ParentIDRRef	As up_id,		-- _Reference347
  _Fld37105RRef	As morg_id 		-- _Reference265
From _Reference347X1

-- hist:
-- ���������������.��������������������������	_InfoRg22039
Select
  DATEADD(YYYY, -2000, _Period) as ctime,
  _Fld22052 As isKey,
  _Fld22047 As Wage,
  _Fld22040RRef As rab_id,		-- _Reference458
  _Fld22041RRef As morg_id,		-- _Reference265
  _Fld22042RRef As fiz_id,		-- _Reference562
  _Fld22043RRef As org_id,		-- _Reference265
  _Fld22044RRef As dept_id,		-- _Reference347
  _Fld22045RRef As pos_id,		-- _Reference137
  _Fld22046RRef As staff_id,	        -- _Reference576
  _Fld22048RRef As event_id,	        -- _Enum893
  _Fld22051RRef As mrab_id,		-- _Reference458
  _Fld22049RRef As agrm_id		-- _Enum880
From _InfoRg22039 As X
Where
  _Period=
  (Select Max(_Period)
  From _InfoRg22039 As Y
  Where Y._Fld22040RRef=X._Fld22040RRef)

-- tit:
-- ����������.���������				_Reference137
Select  
  _IDRRef As id,
  _Description As name
From _Reference137

-- stf:
-- ����������.�����������������			_Reference576
Select 
  _IDRRef As id,
  _Description As name
From _Reference576

-- evnt:
-- ������������.�������������������		_Enum893
Select 
  _IDRRef As id,
  _EnumOrder As value
From _Enum893

-- agmt:
-- ������������.��������������������������		_Enum880
Select 
  _IDRRef As id,
  _EnumOrder As value
From _Enum880

-- sex:
-- ������������.������������������			_Enum1046
Select 
  _IDRRef As id,
  _EnumOrder As [value]
From _Enum1046

-- psp:
-- ���������������.����������������������	_InfoRg20909
Select 
    _Fld20910RRef as fiz_id,
    _Fld20912 As Series,
    _Fld20913 As Number,
    DATEADD(YYYY, -2000, Cast(_Fld20914 As date)) as cdate,
    _Fld20916 As Issuer,
    _Fld20917 As iCode,
    _Fld20919 As Summary
From _InfoRg20909
Where 
    _Fld20917 != ''
