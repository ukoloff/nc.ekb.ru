USE [master]
GO
/****** Object:  Database [Video]    Script Date: 07/28/2017 19:59:13 ******/
CREATE DATABASE [Video] ON  PRIMARY 
( NAME = N'Video', FILENAME = N'Q:\MSSQL\DB\Video.mdf' , SIZE = 3072KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'Video_log', FILENAME = N'Q:\MSSQL\DB\Video_1.ldf' , SIZE = 10240KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [Video] SET COMPATIBILITY_LEVEL = 90
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Video].[dbo].[sp_fulltext_database] @action = 'disable'
end
GO
ALTER DATABASE [Video] SET ANSI_NULL_DEFAULT OFF
GO
ALTER DATABASE [Video] SET ANSI_NULLS OFF
GO
ALTER DATABASE [Video] SET ANSI_PADDING OFF
GO
ALTER DATABASE [Video] SET ANSI_WARNINGS OFF
GO
ALTER DATABASE [Video] SET ARITHABORT OFF
GO
ALTER DATABASE [Video] SET AUTO_CLOSE OFF
GO
ALTER DATABASE [Video] SET AUTO_CREATE_STATISTICS ON
GO
ALTER DATABASE [Video] SET AUTO_SHRINK OFF
GO
ALTER DATABASE [Video] SET AUTO_UPDATE_STATISTICS ON
GO
ALTER DATABASE [Video] SET CURSOR_CLOSE_ON_COMMIT OFF
GO
ALTER DATABASE [Video] SET CURSOR_DEFAULT  GLOBAL
GO
ALTER DATABASE [Video] SET CONCAT_NULL_YIELDS_NULL OFF
GO
ALTER DATABASE [Video] SET NUMERIC_ROUNDABORT OFF
GO
ALTER DATABASE [Video] SET QUOTED_IDENTIFIER OFF
GO
ALTER DATABASE [Video] SET RECURSIVE_TRIGGERS OFF
GO
ALTER DATABASE [Video] SET  DISABLE_BROKER
GO
ALTER DATABASE [Video] SET AUTO_UPDATE_STATISTICS_ASYNC OFF
GO
ALTER DATABASE [Video] SET DATE_CORRELATION_OPTIMIZATION OFF
GO
ALTER DATABASE [Video] SET TRUSTWORTHY OFF
GO
ALTER DATABASE [Video] SET ALLOW_SNAPSHOT_ISOLATION OFF
GO
ALTER DATABASE [Video] SET PARAMETERIZATION SIMPLE
GO
ALTER DATABASE [Video] SET READ_COMMITTED_SNAPSHOT OFF
GO
ALTER DATABASE [Video] SET HONOR_BROKER_PRIORITY OFF
GO
ALTER DATABASE [Video] SET  READ_WRITE
GO
ALTER DATABASE [Video] SET RECOVERY SIMPLE
GO
ALTER DATABASE [Video] SET  MULTI_USER
GO
ALTER DATABASE [Video] SET PAGE_VERIFY CHECKSUM
GO
ALTER DATABASE [Video] SET DB_CHAINING OFF
GO
USE [Video]
GO
/****** Object:  User [Video]    Script Date: 07/28/2017 19:59:13 ******/
CREATE USER [Video] FOR LOGIN [Video] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  Table [dbo].[vendors]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[vendors](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [Name] [nvarchar](50) NOT NULL,
    [path] [varchar](50) NOT NULL,
    [comment] [ntext] NULL,
 CONSTRAINT [PK_vendors] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[userIni]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[userIni](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [u] [nvarchar](31) NOT NULL,
    [First] [datetime] NOT NULL,
    [b] [smallint] NOT NULL,
    [s] [smallint] NOT NULL,
    [c] [smallint] NOT NULL,
 CONSTRAINT [PK_userIni] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
CREATE UNIQUE NONCLUSTERED INDEX [userIni_u] ON [dbo].[userIni] 
(
    [u] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[user](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [user] [nvarchar](50) NOT NULL,
    [hash] [char](32) NOT NULL,
    [block] [tinyint] NOT NULL,
    [porn] [tinyint] NOT NULL,
    [cameras] [varchar](50) NULL,
    [lists] [varchar](50) NULL,
    [comment] [ntext] NULL,
 CONSTRAINT [PK_user] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE UNIQUE NONCLUSTERED INDEX [IX_user] ON [dbo].[user] 
(
    [user] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Имя пользователя' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'hash'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'hash'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=5175 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'hash'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Хэш пароля пользователя' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'hash'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'block'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'block'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'block'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Запретить доступ к сайту' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'block'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Частое обновление камер' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'porn'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Список камер, которые пользователь видит' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'lists'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'lists'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'lists'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Список списков камер' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'lists'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=2670 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Просто комментарий' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DefaultView', @value=0x02 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Filter', @value=NULL , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_OrderBy', @value=NULL , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_OrderByOn', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Orientation', @value=0x00 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_TableMaxRecords', @value=10000 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'user'
GO
/****** Object:  Table [dbo].[orders]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[orders](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [name] [nvarchar](50) NOT NULL,
    [skip] [tinyint] NOT NULL,
    [customer] [nvarchar](50) NULL,
    [comment] [ntext] NULL,
 CONSTRAINT [PK_orders] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Имя заказа' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'orders', @level2type=N'COLUMN',@level2name=N'name'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Не использовать этот заказ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'orders', @level2type=N'COLUMN',@level2name=N'skip'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Заказчик' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'orders', @level2type=N'COLUMN',@level2name=N'customer'
GO
/****** Object:  Table [dbo].[Auth]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Auth](
    [hash] [char](4) NOT NULL,
    [xtime] [datetime] NOT NULL,
    [u] [varchar](50) NOT NULL,
    [porn] [tinyint] NOT NULL,
    [IP] [ntext] NULL,
    [D] [tinyint] NOT NULL,
    [Method] [char](1) NULL,
    [mail] [varchar](50) NULL,
 CONSTRAINT [PK_Auth] PRIMARY KEY CLUSTERED 
(
    [hash] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE NONCLUSTERED INDEX [IX_xtime] ON [dbo].[Auth] 
(
    [xtime] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Время истечения записи об авторизации' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Auth', @level2type=N'COLUMN',@level2name=N'xtime'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Учётная запись, прошедшая авторизацию' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Auth', @level2type=N'COLUMN',@level2name=N'u'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Частое обновление камер' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Auth', @level2type=N'COLUMN',@level2name=N'porn'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'С какого IP прошла авторизация' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Auth', @level2type=N'COLUMN',@level2name=N'IP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Уровень доступа' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Auth', @level2type=N'COLUMN',@level2name=N'D'
GO
/****** Object:  Table [dbo].[login]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[login](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [login] [varchar](50) NOT NULL,
    [cameras] [varchar](50) NULL,
    [lists] [varchar](50) NULL,
    [comment] [ntext] NULL,
 CONSTRAINT [PK_login] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE UNIQUE NONCLUSTERED INDEX [IX_login] ON [dbo].[login] 
(
    [login] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Учётная запись в домене' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Список камер, просмотр которых разрешён' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'cameras'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Список списков камер' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'lists'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=1995 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DefaultView', @value=0x02 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Filter', @value=NULL , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_OrderBy', @value=NULL , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_OrderByOn', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Orientation', @value=0x00 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_TableMaxRecords', @value=10000 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'login'
GO
/****** Object:  Table [dbo].[list]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[list](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [name] [nvarchar](50) NOT NULL,
    [show] [bit] NOT NULL,
    [cameras] [varchar](50) NULL,
    [comment] [ntext] NULL,
 CONSTRAINT [PK_list] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE UNIQUE NONCLUSTERED INDEX [IX_list] ON [dbo].[list] 
(
    [name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Название списка камер' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'list', @level2type=N'COLUMN',@level2name=N'name'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Использовать в выпадающем списке' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'list', @level2type=N'COLUMN',@level2name=N'show'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Список (номеров) камер' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'list', @level2type=N'COLUMN',@level2name=N'cameras'
GO
/****** Object:  Table [dbo].[customer]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[customer](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [u] [varchar](50) NOT NULL,
    [hash] [char](32) NOT NULL,
    [block] [tinyint] NOT NULL,
    [org] [nvarchar](50) NULL,
    [contact] [nvarchar](50) NULL,
    [mail] [nvarchar](50) NULL,
    [phone] [nvarchar](50) NULL,
    [comment] [ntext] NULL,
 CONSTRAINT [PK_customer] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
CREATE UNIQUE NONCLUSTERED INDEX [IX_customer] ON [dbo].[customer] 
(
    [u] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Учётная запись' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'customer', @level2type=N'COLUMN',@level2name=N'u'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Хэш пароля' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'customer', @level2type=N'COLUMN',@level2name=N'hash'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Заблокирован?' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'customer', @level2type=N'COLUMN',@level2name=N'block'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Организация' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'customer', @level2type=N'COLUMN',@level2name=N'org'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Контактное лицо' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'customer', @level2type=N'COLUMN',@level2name=N'contact'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Адрес электронной почты' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'customer', @level2type=N'COLUMN',@level2name=N'mail'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Телефон' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'customer', @level2type=N'COLUMN',@level2name=N'phone'
GO
/****** Object:  Table [dbo].[cam]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cam](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [Host] [nvarchar](50) NOT NULL,
    [vendor] [int] NOT NULL,
    [user] [nvarchar](50) NOT NULL,
    [pass] [nvarchar](50) NOT NULL,
    [skip] [tinyint] NOT NULL,
    [name] [nvarchar](50) NOT NULL,
    [lon] [float] NULL,
    [lat] [float] NULL,
    [comment] [ntext] NULL,
 CONSTRAINT [PK_cam] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'id'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'Host'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'Host'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'Host'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'IP-адрес или DNS-имя камеры' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'Host'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Имя пользователя, имеющего право на просмотр камеры' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'user'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'pass'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'pass'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=1695 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'pass'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Пароль для просмотра камеры' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'pass'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'skip'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'skip'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'skip'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Не отображать камеру никому' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'skip'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'name'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'name'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=-1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'name'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Подпись для камеры' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'name'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Долгота' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'lon'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Широта' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'lat'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnHidden', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnOrder', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_ColumnWidth', @value=2820 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Комментарий к имени камеры' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam', @level2type=N'COLUMN',@level2name=N'comment'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DefaultView', @value=0x02 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Filter', @value=NULL , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_OrderBy', @value=NULL , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_OrderByOn', @value=0 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Orientation', @value=0x00 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_TableMaxRecords', @value=10000 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cam'
GO
/****** Object:  Table [dbo].[c2o]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[c2o](
    [customer] [int] NOT NULL,
    [order] [int] NOT NULL,
 CONSTRAINT [PK_c2o] PRIMARY KEY CLUSTERED 
(
    [customer] ASC,
    [order] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [IX_c2o] ON [dbo].[c2o] 
(
    [order] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[o2c]    Script Date: 07/28/2017 19:59:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[o2c](
    [order] [int] NOT NULL,
    [cam] [int] NOT NULL,
 CONSTRAINT [PK_o2c] PRIMARY KEY CLUSTERED 
(
    [order] ASC,
    [cam] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
CREATE NONCLUSTERED INDEX [IX_o2c] ON [dbo].[o2c] 
(
    [cam] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
GO
/****** Object:  Default [DF__userIni__First__0D7A0286]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[userIni] ADD  CONSTRAINT [DF__userIni__First__0D7A0286]  DEFAULT (getdate()) FOR [First]
GO
/****** Object:  Default [DF__userIni__noBanne__0E6E26BF]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[userIni] ADD  CONSTRAINT [DF__userIni__noBanne__0E6E26BF]  DEFAULT ((0)) FOR [b]
GO
/****** Object:  Default [DF_userIni_s]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[userIni] ADD  CONSTRAINT [DF_userIni_s]  DEFAULT ((0)) FOR [s]
GO
/****** Object:  Default [DF_userIni_c]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[userIni] ADD  CONSTRAINT [DF_userIni_c]  DEFAULT ((4)) FOR [c]
GO
/****** Object:  Default [DF_user_block]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[user] ADD  CONSTRAINT [DF_user_block]  DEFAULT ((0)) FOR [block]
GO
/****** Object:  Default [DF_user_porn]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[user] ADD  CONSTRAINT [DF_user_porn]  DEFAULT ((0)) FOR [porn]
GO
/****** Object:  Default [DF_orders_block]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[orders] ADD  CONSTRAINT [DF_orders_block]  DEFAULT ((0)) FOR [skip]
GO
/****** Object:  Default [DF_Auth_porn]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[Auth] ADD  CONSTRAINT [DF_Auth_porn]  DEFAULT ((0)) FOR [porn]
GO
/****** Object:  Default [DF_Auth_D]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[Auth] ADD  CONSTRAINT [DF_Auth_D]  DEFAULT ((0)) FOR [D]
GO
/****** Object:  Default [DF_list_show]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[list] ADD  CONSTRAINT [DF_list_show]  DEFAULT ((0)) FOR [show]
GO
/****** Object:  Default [DF_customer_block]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[customer] ADD  CONSTRAINT [DF_customer_block]  DEFAULT ((0)) FOR [block]
GO
/****** Object:  Default [DF_cam_vendor]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[cam] ADD  CONSTRAINT [DF_cam_vendor]  DEFAULT ((1)) FOR [vendor]
GO
/****** Object:  Default [DF_cam_skip]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[cam] ADD  CONSTRAINT [DF_cam_skip]  DEFAULT ((0)) FOR [skip]
GO
/****** Object:  ForeignKey [FK_cam_vendors]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[cam]  WITH CHECK ADD  CONSTRAINT [FK_cam_vendors] FOREIGN KEY([vendor])
REFERENCES [dbo].[vendors] ([id])
GO
ALTER TABLE [dbo].[cam] CHECK CONSTRAINT [FK_cam_vendors]
GO
/****** Object:  ForeignKey [FK_c2o_customer]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[c2o]  WITH CHECK ADD  CONSTRAINT [FK_c2o_customer] FOREIGN KEY([customer])
REFERENCES [dbo].[customer] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[c2o] CHECK CONSTRAINT [FK_c2o_customer]
GO
/****** Object:  ForeignKey [FK_c2o_orders]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[c2o]  WITH CHECK ADD  CONSTRAINT [FK_c2o_orders] FOREIGN KEY([order])
REFERENCES [dbo].[orders] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[c2o] CHECK CONSTRAINT [FK_c2o_orders]
GO
/****** Object:  ForeignKey [FK_o2c_cam]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[o2c]  WITH CHECK ADD  CONSTRAINT [FK_o2c_cam] FOREIGN KEY([cam])
REFERENCES [dbo].[cam] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[o2c] CHECK CONSTRAINT [FK_o2c_cam]
GO
/****** Object:  ForeignKey [FK_o2c_orders]    Script Date: 07/28/2017 19:59:14 ******/
ALTER TABLE [dbo].[o2c]  WITH CHECK ADD  CONSTRAINT [FK_o2c_orders] FOREIGN KEY([order])
REFERENCES [dbo].[orders] ([id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[o2c] CHECK CONSTRAINT [FK_o2c_orders]
GO
