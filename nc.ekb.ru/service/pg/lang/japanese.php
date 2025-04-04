<?php

	/**
	 * Japanese language file for phpPgAdmin.
	 * @maintainer Tadashi Jokagi [elf2000@users.sourceforge.net]
	 *
	 * $Id: japanese.php,v 1.16.4.1 2007/01/19 04:27:10 xzilla Exp $
	 */

	// Language and character set
	$lang['applang'] = '日本語(EUC-JP)';
	$lang['appcharset'] = 'EUC-JP';
	$lang['applocale'] = 'ja_JP';
  	$lang['appdbencoding'] = 'EUC_JP';
	$lang['applangdir'] = 'ltr';
  
	// Welcome  
	$lang['strintro'] = 'ようこそ phpPgAdmin へ。';
	$lang['strppahome'] = 'phpPgAdmin ホームページ';
	$lang['strpgsqlhome'] = 'PostgreSQL ホームページ';
	$lang['strpgsqlhome_url'] = 'http://www.postgresql.org/';
	$lang['strlocaldocs'] = 'PostgreSQL ドキュメント (ローカル)';
	$lang['strreportbug'] = 'バグレポート';
	$lang['strviewfaq'] = 'FAQ を見る';
	$lang['strviewfaq_url'] = 'http://phppgadmin.sourceforge.net/?page=faq';
	
	// Basic strings
	$lang['strlogin'] = 'ログイン';
	$lang['strloginfailed'] = 'ログインに失敗';
	$lang['strlogindisallowed'] = 'ログインが許可されませんでした。';
	$lang['strserver'] = 'サーバー';
	$lang['strservers'] = 'サーバー';
	$lang['strintroduction'] = '導入';
	$lang['strhost'] = 'ホスト';
	$lang['strport'] = 'ポート';
	$lang['strlogout'] = 'ログアウト';
	$lang['strowner'] = '所有者';
	$lang['straction'] = 'アクション';
	$lang['stractions'] = '操作';
	$lang['strname'] = '名前';
	$lang['strdefinition'] = '定義';
	$lang['strproperties'] = 'プロパティ';
	$lang['strbrowse'] = '表示';
	$lang['strdrop'] = '破棄';
	$lang['strdropped'] = '破棄しました。';
	$lang['strnull'] = 'NULL';
	$lang['strnotnull'] = 'NOT NULL';
	$lang['strprev'] = '前に';
	$lang['strnext'] = '次に';
	$lang['strfirst'] = '<< 最初';
	$lang['strlast'] = '最後 >>';
	$lang['strfailed'] = '失敗';
	$lang['strcreate'] = '作成';
	$lang['strcreated'] = '作成しました。';
	$lang['strcomment'] = 'コメント';
	$lang['strlength'] = '長さ';
	$lang['strdefault'] = 'デフォルト';
	$lang['stralter'] = '変更';
	$lang['strok'] = 'OK';
	$lang['strcancel'] = '取り消し';
	$lang['strsave'] = '保存';
	$lang['strreset'] = 'リセット';
	$lang['strinsert'] = '挿入';
	$lang['strselect'] = '選択';
	$lang['strdelete'] = '削除';
	$lang['strupdate'] = '更新';
	$lang['strreferences'] = '参照';
	$lang['stryes'] = 'はい';
	$lang['strno'] = 'いいえ';
	$lang['strtrue'] = '真';
	$lang['strfalse'] = '偽';
	$lang['stredit'] = '編集';
	$lang['strcolumn'] = 'カラム';
	$lang['strcolumns'] = 'カラム';
	$lang['strrows'] = 'レコード';
	$lang['strrowsaff'] = '影響を受けたレコード';
	$lang['strobjects'] = 'オブジェクト';
	$lang['strback'] = '戻る';
	$lang['strqueryresults'] = 'クエリ結果';
	$lang['strshow'] = '表示';
	$lang['strempty'] = '空にする';
	$lang['strlanguage'] = '言語';
	$lang['strencoding'] = 'エンコード';
	$lang['strvalue'] = '値';
	$lang['strunique'] = 'ユニーク';
	$lang['strprimary'] = 'プライマリ';
	$lang['strexport'] = 'エクスポート';
	$lang['strimport'] = 'インポート';
	$lang['strallowednulls']  =  'NULL 文字を許可する';
	$lang['strbackslashn']  =  '\N';
	$lang['strnull']  =  'Null';
	$lang['stremptystring']  =  '空の文字列/項目';
	$lang['strsql'] = 'SQL';
	$lang['stradmin'] = '管理';
	$lang['strvacuum'] = 'バキューム';
	$lang['stranalyze'] = '解析';
	$lang['strclusterindex']  =  'クラスター';
$lang['strclustered'] = 'Clustered?';
	$lang['strreindex'] = '再インデックス';
	$lang['strrun'] = '実カラム';
	$lang['stradd'] = '追加';
	$lang['strremove']  =  '削除';
	$lang['strevent'] = 'イベント';
	$lang['strwhere'] = 'Where';
	$lang['strinstead'] = '代行';
	$lang['strwhen'] = 'When';
	$lang['strformat'] = 'フォーマット';
	$lang['strdata'] = 'データ';
	$lang['strconfirm'] = '確認';
	$lang['strexpression'] = '評価式';
	$lang['strellipsis'] = '...';
	$lang['strseparator'] = ': ';
	$lang['strexpand'] = '展開';
	$lang['strcollapse'] = '閉じる';
	$lang['strexplain'] = '実行時間';
	$lang['strexplainanalyze'] = '詳細出力解析';
	$lang['strfind'] = '検索';
	$lang['stroptions'] = 'オプション';
	$lang['strrefresh'] = '再表示';
	$lang['strdownload'] = 'ダウンロード';
	$lang['strdownloadgzipped'] = 'gzip で圧縮してダウンロード';
	$lang['strinfo'] = '情報';
	$lang['stroids'] = 'OID ';
	$lang['stradvanced'] = '高度な';
	$lang['strvariables'] = '変数';
	$lang['strprocess'] = 'プロセス';
	$lang['strprocesses'] = 'プロセス';
	$lang['strsetting'] = '設定';
	$lang['streditsql'] = 'SQL 編集';
	$lang['strruntime'] = '総実行時間: %s ミリ秒';
	$lang['strpaginate'] = 'Paginate results';
	$lang['struploadscript'] = 'または SQL スクリプトをアップロード:';
	$lang['strstarttime'] = '開始時間';
	$lang['strfile'] = 'ファイル';
	$lang['strfileimported'] = 'ファイルをインポートしました。';
	$lang['strtrycred']  =  'すべてのサーバーでこの情報を使う';

	// Database Sizes
$lang['strsize']  =  'サイズ';
$lang['strbytes']  =  'バイト';
$lang['strkb']  =  'kB';
$lang['strmb']  =  'MB';
$lang['strgb']  =  'GB';
$lang['strtb']  =  'TB';

	// Error handling
	$lang['strnoframes'] = 'このアプリケーションを使用するためにはフレームが使用可能なブラウザーが必要です。';
	$lang['strnoframeslink'] = 'フレームを除外して使う';
	$lang['strbadconfig'] = 'config.inc.php が旧式です。新しい config.inc.php-dist から再作成する必要があります。';
	$lang['strnotloaded'] = 'データベースをサポートするように PHP のコンパイル・インストールがされていません。configure の --with-pgsql オプションを用いて PHP を再コンパイルする必要があります。';
	$lang['strpostgresqlversionnotsupported'] = 'このバージョンの PostgreSQL はサポートしていません。バージョン %s 以上にアップグレードしてください。';
	$lang['strbadschema'] = '無効のスキーマが指定されました。';
	$lang['strbadencoding'] = 'データベースの中でクライアントエンコードを指定しませんでした。';
	$lang['strsqlerror'] = 'SQL エラー:';
	$lang['strinstatement'] = '文:';
	$lang['strinvalidparam'] = 'スクリプトパラメータが無効です。';
	$lang['strnodata'] = 'レコードが見つかりません。';
	$lang['strnoobjects'] = 'オブジェクトが見つかりません。';
	$lang['strrownotunique'] = 'このレコードには一意識別子がありません。';
	$lang['strnoreportsdb'] = 'レポートデータベースが作成されていません。ディレクトリにある INSTALL ファイルを読んでください。';
	$lang['strnouploads'] = 'ファイルアップロードが無効です。';
	$lang['strimporterror'] = 'インポートエラー';
	$lang['strimporterror-fileformat']  =  'インポートエラー: ファイル形式を自動的に確定できません。.';
	$lang['strimporterrorline'] = '%s 行目がインポートエラーです。';
	$lang['strimporterrorline-badcolumnnum']  =  '%s 行でインポートエラー:  行は正しい列数を持っていません。';
	$lang['strimporterror-uploadedfile']  =  'インポートエラー: サーバーにファイルをアップロードすることができないかもしれません。';
	$lang['strcannotdumponwindows']  =  'Windows 上での複合テーブルとスキーマ名のダンプはサポートしていません。';

	// Tables
	$lang['strtable'] = 'テーブル';
	$lang['strtables'] = 'テーブル';
	$lang['strshowalltables'] = '全テーブルを見る';
	$lang['strnotables'] = 'テーブルが見つかりません。';
	$lang['strnotable'] = 'テーブルが見つかりません。';
	$lang['strcreatetable'] = 'テーブルを作成する';
	$lang['strtablename'] = 'テーブル名';
	$lang['strtableneedsname'] = 'テーブル名を指定する必要があります。';
	$lang['strtableneedsfield'] = '少なくとも一つのフィールドを指定しなければなりません。';
	$lang['strtableneedscols'] = '有効なカラム数を指定しなければなりません。';
	$lang['strtablecreated'] = 'テーブルを作成しました。';
	$lang['strtablecreatedbad'] = 'テーブルの作成に失敗しました。';
	$lang['strconfdroptable'] = 'テーブル「%s」を本当に破棄しますか?';
	$lang['strtabledropped'] = 'テーブルを破棄しました。';
	$lang['strtabledroppedbad'] = 'テーブルの破棄に失敗しました。';
	$lang['strconfemptytable'] = '本当にテーブル「%s」の内容を破棄しますか?';
	$lang['strtableemptied'] = 'テーブルが空になりました.';
	$lang['strtableemptiedbad'] = 'テーブルを空にできませんでした。';
	$lang['strinsertrow'] = 'レコードの挿入';
	$lang['strrowinserted'] = 'レコードを挿入しました。';
	$lang['strrowinsertedbad'] = 'レコードの挿入に失敗しました。';
	$lang['strrowduplicate']  =  'レコードの挿入に失敗し、挿入の複製を試みました。';
	$lang['streditrow'] = 'レコード編集';
	$lang['strrowupdated'] = 'レコードを更新しました。';
	$lang['strrowupdatedbad'] = 'レコードの更新に失敗しました。';
	$lang['strdeleterow'] = 'レコード削除';
	$lang['strconfdeleterow'] = '本当にこのレコードを削除しますか?';
	$lang['strrowdeleted'] = 'レコードを削除しました。';
	$lang['strrowdeletedbad'] = 'レコードの削除に失敗しました。';
	$lang['strinsertandrepeat'] = '挿入と繰り返し';
	$lang['strnumcols'] = 'カラムの数';
	$lang['strcolneedsname'] = 'カラムの名前を指定しなければりません。';
	$lang['strselectallfields'] = 'すべてのフィールドを選択する';
	$lang['strselectneedscol'] = '少なくとも一カラムは必要です。';
	$lang['strselectunary'] = '単項のオペレーターは値を持つことができません。';
	$lang['straltercolumn'] = 'カラムの変更';
	$lang['strcolumnaltered'] = 'カラムを変更しました。';
	$lang['strcolumnalteredbad'] = 'カラムの変更に失敗しました。';
	$lang['strconfdropcolumn'] = '本当にカラム「%s」をテーブル「%s」から破棄していいですか?';
	$lang['strcolumndropped'] = 'カラムを破棄しました。';
	$lang['strcolumndroppedbad'] = 'カラムの破棄に失敗しました。';
	$lang['straddcolumn'] = 'カラムの追加';
	$lang['strcolumnadded'] = 'カラムを追加しました。';
	$lang['strcolumnaddedbad'] = 'カラムの追加に失敗しました。';
	$lang['strcascade'] = 'カスケード';
	$lang['strtablealtered'] = 'テーブルを変更しました。';
	$lang['strtablealteredbad'] = 'テーブルの変更に失敗しました。';
	$lang['strdataonly'] = 'データのみ';
	$lang['strstructureonly'] = '構造のみ';
	$lang['strstructureanddata'] = '構造とデータ';
	$lang['strtabbed'] = 'タブ区切り';
	$lang['strauto'] = '自動';
	$lang['strconfvacuumtable'] = '本当に「%s」をバキュームしますか?';
	$lang['strestimatedrowcount'] = '評価済レコード数';

	// Users
	$lang['struser'] = 'ユーザー';
	$lang['strusers'] = 'ユーザー';
	$lang['strusername'] = 'ユーザー名';
	$lang['strpassword'] = 'パスワード';
	$lang['strsuper'] = 'スーパーユーザーですか?';
	$lang['strcreatedb'] = 'データベースを作成しますか?';
	$lang['strexpires'] = '有効期限';
	$lang['strsessiondefaults'] = 'セッションデフォルト';
	$lang['strnousers'] = 'ユーザーが見つかりません。';
	$lang['struserupdated'] = 'ユーザーを更新しました。';
	$lang['struserupdatedbad'] = 'ユーザーの更新に失敗しました。';
	$lang['strshowallusers'] = '全てのユーザーを見る。';
	$lang['strcreateuser'] = 'ユーザーを作成する';
	$lang['struserneedsname'] = 'ユーザーの名前をが必要です。';
	$lang['strusercreated'] = 'ユーザーを作成しました。';
	$lang['strusercreatedbad'] = 'ユーザーの作成に失敗しました。';
	$lang['strconfdropuser'] = '本当にユーザー「%s」を破棄しますか?';
	$lang['struserdropped'] = 'ユーザーを破棄しました。';
	$lang['struserdroppedbad'] = 'ユーザーの削除に破棄しました';
	$lang['straccount'] = 'アカウント';
	$lang['strchangepassword'] = 'パスワード変更';
	$lang['strpasswordchanged'] = 'パスワードの変更をしました。';
	$lang['strpasswordchangedbad'] = 'パスワードの変更に失敗しました。';
	$lang['strpasswordshort'] = 'パスワードが短すぎます。';
	$lang['strpasswordconfirm'] = 'パスワードの確認が一致しませんでした。';
		
	// Groups
	$lang['strgroup'] = 'グループ';
	$lang['strgroups'] = 'グループ';
	$lang['strnogroup'] = 'グループがありません。';
	$lang['strnogroups'] = 'グループが見つかりません。';
	$lang['strcreategroup'] = 'グループを作成する';
	$lang['strshowallgroups'] = '全グループを見る';
	$lang['strgroupneedsname'] = 'グループ名を指定しなければなりません。';
	$lang['strgroupcreated'] = 'グループを作成しました。';
	$lang['strgroupcreatedbad'] = 'グループの作成に失敗しました。';	
	$lang['strconfdropgroup'] = '本当にグループ「%s」を破棄しますか?';
	$lang['strgroupdropped'] = 'グループを破棄しました。';
	$lang['strgroupdroppedbad'] = 'グループの破棄に失敗しました。';
	$lang['strmembers'] = 'メンバー';
	$lang['straddmember'] = 'メンバーを追加する';
	$lang['strmemberadded'] = 'メンバーを追加しました。';
	$lang['strmemberaddedbad'] = 'メンバーの追加に失敗しました。';
	$lang['strdropmember'] = 'メンバー破棄';
	$lang['strconfdropmember'] = '本当にメンバー「%s」をグループ「%s」から破棄しますか?';
	$lang['strmemberdropped'] = 'メンバーを破棄しました。';
	$lang['strmemberdroppedbad'] = 'メンバーの破棄に失敗しました。';

	// Privileges
	$lang['strprivilege'] = '特権';
	$lang['strprivileges'] = '特権';
	$lang['strnoprivileges'] = 'このオブジェクトは特権を持っていません。';
	$lang['strgrant'] = '権限';
	$lang['strrevoke'] = '廃止';
	$lang['strgranted'] = '特権を与えました。';
	$lang['strgrantfailed'] = '特権を与える事に失敗しました。';
	$lang['strgrantbad'] = '少なくとも一人のユーザーかグループに、少なくともひとつの特権を指定しなければなりません。';
	$lang['strgrantor'] = '譲与';
	$lang['strasterisk'] = '*';

	// Databases
	$lang['strdatabase'] = 'データベース';
	$lang['strdatabases'] = 'データベース';
	$lang['strshowalldatabases'] = '全データベースを見る';
	$lang['strnodatabase'] = 'データベースが見つかりません。';
	$lang['strnodatabases'] = 'データベースが全くありません。';
	$lang['strcreatedatabase'] = 'データベースを作成する';
	$lang['strdatabasename'] = 'データベース名';
	$lang['strdatabaseneedsname'] = 'データベース名を指定しなければなりません。';
	$lang['strdatabasecreated'] = 'データベースを作成しました。';
	$lang['strdatabasecreatedbad'] = 'データベースの作成に失敗しました。';	
	$lang['strconfdropdatabase'] = '本当にデータベース「%s」を破棄しますか?';
	$lang['strdatabasedropped'] = 'データベースを破棄しました。';
	$lang['strdatabasedroppedbad'] = 'データベースの破棄に失敗しました。';
	$lang['strentersql'] = '下に実行するSQLを入力します:';
	$lang['strsqlexecuted'] = 'SQLを実行しました。';
	$lang['strvacuumgood'] = 'バキュームを完了しました。';
	$lang['strvacuumbad'] = 'バキュームに失敗しました。';
	$lang['stranalyzegood'] = '解析を完了しました。';
	$lang['stranalyzebad'] = '解析に失敗しました。';
	$lang['strreindexgood'] = '再インデックスを完了しました。';
	$lang['strreindexbad'] = '再インデックスに失敗しました。';
	$lang['strfull'] = 'すべて';
	$lang['strfreeze'] = 'フリーズ';
	$lang['strforce'] = '強制';
	$lang['strsignalsent'] = 'シグナル送信';
	$lang['strsignalsentbad'] = 'シグナル送信に失敗しました';
	$lang['strallobjects'] = 'すべてのオブジェクト';
	$lang['strdatabasealtered']  =  'データベースを変更しました。';
	$lang['strdatabasealteredbad']  =  'データベースの変更に失敗しました。';

	// Views
	$lang['strview'] = 'ビュー';
	$lang['strviews'] = 'ビュー';
	$lang['strshowallviews'] = '全ビューを表示する';
	$lang['strnoview'] = 'ビューがありません。';
	$lang['strnoviews'] = 'ビューが見つかりません。';
	$lang['strcreateview'] = 'ビューを作成する';
	$lang['strviewname'] = 'ビュー名';
	$lang['strviewneedsname'] = 'ビュー名を指定しなければなりません。';
	$lang['strviewneedsdef'] = '定義名を指定しなければなりません。';
	$lang['strviewneedsfields'] = 'ビューのの中から選択し、希望のカラムを指定しなければなりません。';
	$lang['strviewcreated'] = 'ビューを作成しました。';
	$lang['strviewcreatedbad'] = 'ビューの作成に失敗しました。';
	$lang['strconfdropview'] = '本当にビュー「%s」を破棄しますか?';
	$lang['strviewdropped'] = 'ビューを破棄しました。';
	$lang['strviewdroppedbad'] = 'ビューの破棄に失敗しました。';
	$lang['strviewupdated'] = 'ビューを更新しました。';
	$lang['strviewupdatedbad'] = 'ビューの更新に失敗しました。';
$lang['strviewlink'] = 'Linking Keys';
	$lang['strviewconditions'] = '追加条件';
	$lang['strcreateviewwiz'] = 'ウィザードでビューを作成する';

	// Sequences
	$lang['strsequence'] = 'シーケンス';
	$lang['strsequences'] = 'シーケンス';
	$lang['strshowallsequences'] = '全シーケンスを見る';
	$lang['strnosequence'] = 'シーケンスがありません。';
	$lang['strnosequences'] = 'シーケンスが見つかりません。';
	$lang['strcreatesequence'] = 'シーケンスを作成する';
	$lang['strlastvalue'] = '最終値';
	$lang['strincrementby'] = '増加数';	
	$lang['strstartvalue'] = '開始値';
	$lang['strmaxvalue'] = '最大値';
	$lang['strminvalue'] = '最小値';
	$lang['strcachevalue'] = 'キャッシュ値';
	$lang['strlogcount'] = 'ログカウント';
	$lang['striscycled'] = 'Cycle しますか?';
$lang['striscalled'] = 'Is Called?';
	$lang['strsequenceneedsname'] = 'シーケンス名を指定しなければなりません。';
	$lang['strsequencecreated'] = 'シーケンスを作成しました。';
	$lang['strsequencecreatedbad'] = 'シーケンスの作成に失敗しました。'; 
	$lang['strconfdropsequence'] = '本当にシーケンス「%s」を破棄しますか?';
	$lang['strsequencedropped'] = 'シーケンスを破棄しました。';
	$lang['strsequencedroppedbad'] = 'シーケンスの破棄に失敗しました。';
	$lang['strsequencereset'] = 'シーケンスリセットを行いました。';
	$lang['strsequenceresetbad'] = 'シーケンスのリセットに失敗しました。'; 

	// Indexes
	$lang['strindex'] = 'インデックス';
	$lang['strindexes'] = 'インデックス';
	$lang['strindexname'] = 'インデックス名';
	$lang['strshowallindexes'] = '全インデックスを表示する';
	$lang['strnoindex'] = 'インデックスがありません。';
	$lang['strnoindexes'] = 'インデックスが見つかりません。';
	$lang['strcreateindex'] = 'インデックスを作成する';
	$lang['strtabname'] = 'タブ名';
	$lang['strcolumnname'] = 'カラム名';
	$lang['strindexneedsname'] = '有効なインデックス名を指定しなければいけません。';
	$lang['strindexneedscols'] = '有効なカラム数を指定しなければいけません。';
	$lang['strindexcreated'] = 'インデックスを作成しました。';
	$lang['strindexcreatedbad'] = 'インデックスの作成に失敗しました。';
	$lang['strconfdropindex'] = '本当にインデックス「%s」を破棄しますか?';
	$lang['strindexdropped'] = 'インデックスを破棄しました。';
	$lang['strindexdroppedbad'] = 'インデックスの破棄に失敗しました。';
	$lang['strkeyname'] = 'キー名';
	$lang['struniquekey'] = 'ユニークキー';
	$lang['strprimarykey'] = 'プライマリキー';
 	$lang['strindextype'] = 'インデックスタイプ';
	$lang['strtablecolumnlist'] = 'テーブル中のカラム';
	$lang['strindexcolumnlist'] = 'インデックス中のカラム';
	$lang['strconfcluster'] = '本当に「%s」をクラスターにしますか?';
	$lang['strclusteredgood'] = 'クラスター完了です。';
	$lang['strclusteredbad'] = 'クラスターに失敗しました。';

	// Rules
	$lang['strrules'] = 'ルール';
	$lang['strrule'] = 'ルール';
	$lang['strshowallrules'] = '全ルールを表示する';
	$lang['strnorule'] = 'ルールがありません。';
	$lang['strnorules'] = 'ルールが見つかりません。';
	$lang['strcreaterule'] = 'ルールを作成する';
	$lang['strrulename'] = 'ルール名';
	$lang['strruleneedsname'] = 'ルール名を指定しなければなりません。';
	$lang['strrulecreated'] = 'ルールを作成しました。';
	$lang['strrulecreatedbad'] = 'ルールの作成に失敗しました。';
	$lang['strconfdroprule'] = '本当にルール「%s」をデータベース「%s」から破棄しますか?';
	$lang['strruledropped'] = 'ルールを破棄しました。';
	$lang['strruledroppedbad'] = 'ルールの破棄に失敗しました。';

	// Constraints
	$lang['strconstraint'] = '検査制約';
	$lang['strconstraints'] = '検査制約';
	$lang['strshowallconstraints'] = '全検査制約を表示する';
	$lang['strnoconstraints'] = '検査制約がありません。';
	$lang['strcreateconstraint'] = '検査制約を作成する';
	$lang['strconstraintcreated'] = '検査制約を作成しました。';
	$lang['strconstraintcreatedbad'] = '検査制約の作成に失敗しました。';
	$lang['strconfdropconstraint'] = '本当に検査制約「%s」をデータベース「%s」から破棄しますか?';
	$lang['strconstraintdropped'] = '検査制約を破棄しました。';
	$lang['strconstraintdroppedbad'] = '検査制約の破棄に失敗しました。';
	$lang['straddcheck'] = '検査を追加する';
	$lang['strcheckneedsdefinition'] = '検査制約には定義が必要です。';
	$lang['strcheckadded'] = '検査制約を追加しました。';
	$lang['strcheckaddedbad'] = '検査制約の追加に失敗しました。';
	$lang['straddpk'] = 'プライマリキーを追加する';
	$lang['strpkneedscols'] = 'プライマリキーは少なくとも一カラムを必要とします。';
	$lang['strpkadded'] = 'プライマリキーを追加しました。';
	$lang['strpkaddedbad'] = 'プライマリキーの追加に失敗しました。';
	$lang['stradduniq'] = 'ユニークキーを追加する';
	$lang['struniqneedscols'] = 'ユニークキーは少なくとも一カラムを必要とします。';
	$lang['struniqadded'] = 'ユニークキーを追加しました。';
	$lang['struniqaddedbad'] = 'ユニークキーの追加に失敗しました。';
	$lang['straddfk'] = '外部キーを追加する';
	$lang['strfkneedscols'] = '外部キーは少なくとも一カラムを必要とします。';
	$lang['strfkneedstarget'] = '外部キーはターゲットテーブルを必要とします。';
	$lang['strfkadded'] = '外部キーを追加しました。';
	$lang['strfkaddedbad'] = '外部キーの追加に失敗しました。';
	$lang['strfktarget'] = '対象テーブル';
	$lang['strfkcolumnlist'] = 'キー中のカラム';
	$lang['strondelete'] = 'ON DELETE';
	$lang['stronupdate'] = 'ON UPDATE';	

	// Functions
	$lang['strfunction'] = '関数';
	$lang['strfunctions'] = '関数';
	$lang['strshowallfunctions'] = '全関数を表示する';
	$lang['strnofunction'] = '関数がありません。';
	$lang['strnofunctions'] = '関数が見つかりません。';
	$lang['strcreateplfunction'] = 'SQL/PL 関数を作成する';
	$lang['strcreateinternalfunction'] = '内部関数を作成する';
	$lang['strcreatecfunction'] = 'C 関数を作成する';
	$lang['strfunctionname'] = '関数名';
	$lang['strreturns'] = '返り値';
	$lang['strarguments'] = '引数';
	$lang['strproglanguage'] = 'プログラミング言語';
	$lang['strfunctionneedsname'] = '関数名を指定しなければなりません。';
	$lang['strfunctionneedsdef'] = '関数の定義をしなければなりあせん。';
	$lang['strfunctioncreated'] = '関数を作成しました。';
	$lang['strfunctioncreatedbad'] = '関数の作成に失敗しました。';
	$lang['strconfdropfunction'] = '本当に関数「%s」を破棄しますか?';
	$lang['strfunctiondropped'] = '関数を破棄しました。';
	$lang['strfunctiondroppedbad'] = '関数の破棄に失敗しました。';
	$lang['strfunctionupdated'] = '関数を更新しました。';
	$lang['strfunctionupdatedbad'] = '関数の更新に失敗しました。';
	$lang['strobjectfile'] = 'オブジェクトファイル';
	$lang['strlinksymbol'] = 'リンクシンボル';

	// Triggers
	$lang['strtrigger'] = 'トリガー';
	$lang['strtriggers'] = 'トリガー';
	$lang['strshowalltriggers'] = '全トリガーを表示';
	$lang['strnotrigger'] = 'トリガーがありません。';
	$lang['strnotriggers'] = 'トリガーが見つかりません。';
	$lang['strcreatetrigger'] = 'トリガーを作成する';
	$lang['strtriggerneedsname'] = 'トリガー名を指定する必要があります。';
	$lang['strtriggerneedsfunc'] = 'トリガーのための関数を指定しなければなりません。';
	$lang['strtriggercreated'] = 'トリガーを作成しました。';
	$lang['strtriggercreatedbad'] = 'トリガーの作成に失敗しました。';
	$lang['strconfdroptrigger'] = '本当にトリガー「%s」をデータベース「%s」から破棄しますか?';
	$lang['strtriggerdropped'] = 'トリガーを破棄しました。';
	$lang['strtriggerdroppedbad'] = 'トリガーの破棄に失敗しました。';
	$lang['strtriggeraltered'] = 'トリガーを変更しました。';
	$lang['strtriggeralteredbad'] = 'トリガーの変更に失敗しました。';
$lang['strforeach']  =  'For each';

	// Types
	$lang['strtype'] = 'データ型';
	$lang['strtypes'] = 'データ型';
	$lang['strshowalltypes'] = '全データ型を表示する';
	$lang['strnotype'] = 'データ型がありません。';
	$lang['strnotypes'] = 'データ型が見つかりませんでした。';
	$lang['strcreatetype'] = 'データ型を作成する';
	$lang['strcreatecomptype'] = '複合型を作成する';
	$lang['strtypeneedsfield'] = '少なくとも 1 つのフィールドを指定しなければなりません。';
	$lang['strtypeneedscols'] = '有効なフィールドの数を指定しなければなりません。';
	$lang['strtypename'] = 'データ型名';
	$lang['strinputfn'] = '入力関数';
	$lang['stroutputfn'] = '出力関数';
$lang['strpassbyval'] = 'Passed by val?';
	$lang['stralignment'] = 'アライメント';
	$lang['strelement'] = '要素';
	$lang['strdelimiter'] = 'デミリタ';
	$lang['strstorage'] = 'ストレージ';
	$lang['strfield'] = 'フィールド';
	$lang['strnumfields'] = 'フィールド数';
	$lang['strtypeneedsname'] = '型名を指定しなければなりません。';
	$lang['strtypeneedslen'] = 'データ型の長さを指定しなければなりません。';
	$lang['strtypecreated'] = 'データ型を作成しました。';
	$lang['strtypecreatedbad'] = 'データ型の作成に失敗しました。';
	$lang['strconfdroptype'] = '本当にデータ型「%s」を破棄しますか?';
	$lang['strtypedropped'] = 'データ型を破棄しました。';
	$lang['strtypedroppedbad'] = 'データ型の破棄に失敗しました。';
	$lang['strflavor'] = '種類';
	$lang['strbasetype'] = '基本';
	$lang['strcompositetype'] = '複合型';
	$lang['strpseudotype'] = '擬似データ';

	// Schemas
	$lang['strschema'] = 'スキーマ';
	$lang['strschemas'] = 'スキーマ';
	$lang['strshowallschemas'] = '全スキーマを表示する';
	$lang['strnoschema'] = 'スキーマがありません。';
	$lang['strnoschemas'] = 'スキーマが見つかりません。';
	$lang['strcreateschema'] = 'スキーマを作成する';
	$lang['strschemaname'] = 'スキーマ名';
	$lang['strschemaneedsname'] = 'スキーマ名を指定する必要があります。';
	$lang['strschemacreated'] = 'スキーマを作成しました。';
	$lang['strschemacreatedbad'] = 'スキーマの作成に失敗しました。';
	$lang['strconfdropschema'] = '本当にスキーマ「%s」を破棄しますか?';
	$lang['strschemadropped'] = 'スキーマを破棄しました。';
	$lang['strschemadroppedbad'] = 'スキーマの破棄に失敗しました。';
	$lang['strschemaaltered'] = 'スキーマを変更しました。';
	$lang['strschemaalteredbad'] = 'スキーマの変更に失敗しました。';
	$lang['strsearchpath'] = 'スキーマ検索パス';

	// Reports
	$lang['strreport'] = 'レポート';
	$lang['strreports'] = 'レポート';
	$lang['strshowallreports'] = '全レポートを見る';
	$lang['strnoreports'] = 'レポートが見つかりません。';
	$lang['strcreatereport'] = 'レポートを作成する';
	$lang['strreportdropped'] = 'レポートを破棄しました。';
	$lang['strreportdroppedbad'] = 'レポートの破棄に失敗しました。';
	$lang['strconfdropreport'] = '本当にレポート「%s」を破棄しますか?';
	$lang['strreportneedsname'] = 'レポート名を指定する必要があります。';
	$lang['strreportneedsdef'] = 'レポート用のSQLを指定する必要があります。';
	$lang['strreportcreated'] = 'レポートの保存をしました。';
	$lang['strreportcreatedbad'] = 'レポートの保存に失敗しました。';

	// Domains
	$lang['strdomain'] = 'ドメイン';
	$lang['strdomains'] = 'ドメイン';
	$lang['strshowalldomains'] = '全ドメインを見る';
	$lang['strnodomains'] = 'ドメインがありません。';
	$lang['strcreatedomain'] = 'ドメイン作成';
	$lang['strdomaindropped'] = 'ドメインを破棄しました。';
	$lang['strdomaindroppedbad'] = 'ドメインの破棄に失敗しました。';
	$lang['strconfdropdomain'] = '本当にドメイン「%s」を破棄しますか?';
	$lang['strdomainneedsname'] = 'ドメイン名を指定する必要があります。';
	$lang['strdomaincreated'] = 'ドメインを作成しました。';
	$lang['strdomaincreatedbad'] = 'ドメインの作成に失敗しました。';	
	$lang['strdomainaltered'] = 'ドメインを変更しました。';
	$lang['strdomainalteredbad'] = 'ドメインの変更に失敗しました。';	

	// Operators
	$lang['stroperator'] = '演算子';
	$lang['stroperators'] = '演算子';
	$lang['strshowalloperators'] = '全演算子を見る';
	$lang['strnooperator'] = '演算子が見つかりません。';
	$lang['strnooperators'] = '演算子クラスが見つかりません。';
	$lang['strcreateoperator'] = '演算子を作成しました。';
	$lang['strleftarg'] = '左引数タイプ';
	$lang['strrightarg'] = '右引数タイプ';
	$lang['strcommutator'] = '交代';
	$lang['strnegator'] = '否定';
	$lang['strrestrict'] = '制限';
	$lang['strjoin'] = '結合';
	$lang['strhashes'] = 'ハッシュ';
	$lang['strmerges'] = '併合';
	$lang['strleftsort'] = '左ソート';
	$lang['strrightsort'] = '右ソート';
	$lang['strlessthan'] = '未満';
	$lang['strgreaterthan'] = '以上';
	$lang['stroperatorneedsname'] = '演算子名を指定する必要があります。';
	$lang['stroperatorcreated'] = '演算子を作成しました。';
	$lang['stroperatorcreatedbad'] = '演算子の作成に失敗しました。';
	$lang['strconfdropoperator'] = '本当に演算子「%s」を破棄しますか?';
	$lang['stroperatordropped'] = '演算子を破棄しました。';
	$lang['stroperatordroppedbad'] = '演算子の破棄に失敗しました。';

	// Casts
	$lang['strcasts'] = 'キャスト';
	$lang['strnocasts'] = 'キャストが見つかりません。';
	$lang['strsourcetype'] = 'ソースタイプ';
	$lang['strtargettype'] = 'ターゲットタイプ';
	$lang['strimplicit'] = '暗黙';
$lang['strinassignment'] = 'In assignment';
	$lang['strbinarycompat'] = '(バイナリ互換)';
	
	// Conversions
	$lang['strconversions'] = '変換';
	$lang['strnoconversions'] = '変換が見つかりません。';
	$lang['strsourceencoding'] = '変換元エンコード';
	$lang['strtargetencoding'] = '変換先エンコード';
	
	// Languages
	$lang['strlanguages'] = '言語';
	$lang['strnolanguages'] = '言語が存在しません。';
$lang['strtrusted'] = 'Trusted';
	
	// Info
	$lang['strnoinfo'] = '有効な情報がありません。';
	$lang['strreferringtables'] = '参照テーブル';
	$lang['strparenttables'] = '親テーブル';
	$lang['strchildtables'] = '子テーブル';

	// Aggregates
	$lang['straggregates'] = '集計';
	$lang['strnoaggregates'] = '集計がありません。';
	$lang['stralltypes'] = '(全てのタイプ)';

	// Operator Classes
	$lang['stropclasses'] = '演算子クラス';
	$lang['strnoopclasses'] = '演算子クラスが見つかりません。';
	$lang['straccessmethod'] = 'アクセス方法';

	// Stats and performance
	$lang['strrowperf'] = '行パフォーマンス';
	$lang['strioperf'] = 'I/O パフォーマンス';
	$lang['stridxrowperf'] = 'インデックス行パフォーマンス';
	$lang['stridxioperf'] = 'インデックス I/O パフォーマンス';
	$lang['strpercent'] = '%';
	$lang['strsequential'] = 'シーケンシャル';
	$lang['strscan'] = '検索';
	$lang['strread'] = '読込';
	$lang['strfetch'] = '取得';
	$lang['strheap'] = 'ヒープ';
	$lang['strtoast'] = 'TOAST';
	$lang['strtoastindex'] = 'TOAST インデックス';
	$lang['strcache'] = 'キャッシュ';
	$lang['strdisk'] = 'ディスク';
	$lang['strrows2'] = '行';

	// Tablespaces
	$lang['strtablespace'] = 'テーブル空間';
	$lang['strtablespaces']  =  'テーブル空間';
	$lang['strshowalltablespaces'] = 'すべてのテーブルスペースを表示';
	$lang['strnotablespaces'] = 'テーブル空間が見つかりません。';
	$lang['strcreatetablespace'] = 'テーブル空間を作成する';
	$lang['strlocation'] = 'ロケーション';
	$lang['strtablespaceneedsname'] = 'テーブル空間名を指定する必要があります。';
	$lang['strtablespaceneedsloc'] = 'テーブル空間作成をするディレクトリを指定する必要があります。';
	$lang['strtablespacecreated'] = 'テーブル空間を作成しました。';
	$lang['strtablespacecreatedbad'] = 'テーブル空間の作成に失敗しました。';
	$lang['strconfdroptablespace'] = '本当にテーブル空間「%s」を破棄しますか?';
	$lang['strtablespacedropped'] = 'テーブル空間を破棄しました。';
	$lang['strtablespacedroppedbad'] = 'テーブル空間の破棄に失敗しました。';
	$lang['strtablespacealtered'] = 'テーブル空間を変更しました。';
	$lang['strtablespacealteredbad'] = 'テーブル空間の変更に失敗しました。';

	// Slony clusters
	$lang['strcluster']  =  'クラスター';
	$lang['strnoclusters']  =  'クラスターが見つかりません。';
	$lang['strconfdropcluster']  =  '本当にクラスター「%s」を破棄しますか?';
	$lang['strclusterdropped']  =  'クラスターを破棄しました。';
	$lang['strclusterdroppedbad']  =  'クラスターの破棄に失敗しました。';
	$lang['strinitcluster']  =  'クラスターを初期化する';
	$lang['strclustercreated']  =  'クラスターを初期化しました。';
	$lang['strclustercreatedbad']  =  'クラスターの初期化に失敗しました。';
	$lang['strclusterneedsname']  =  'クラスターの名前を与える必要があります。';
	$lang['strclusterneedsnodeid']  =  'ローカルノードの ID を与える必要があります。';
	
	// Slony nodes
	$lang['strnodes']  =  'Nodes';
	$lang['strnonodes']  =  'ノードが見つかりません。';
	$lang['strcreatenode']  =  'ノードを作成する';
	$lang['strid']  =  'ID';
	$lang['stractive']  =  'アクティブ';
	$lang['strnodecreated']  =  'ノードを作成しました。';
	$lang['strnodecreatedbad']  =  'ノードの作成に失敗しました。';
	$lang['strconfdropnode']  =  '本当にノード「%s」を破棄しますか?';
	$lang['strnodedropped']  =  'ノードを破棄しました。';
	$lang['strnodedroppedbad']  =  'ノードの破棄に失敗しました。';
	$lang['strfailover']  =  'フェイルオーバーする';
	$lang['strnodefailedover']  =  'ノードをフェイルオーバーしました。';
	$lang['strnodefailedoverbad']  =  'ノードのフェイルオーバーに失敗しました。';
	
	// Slony paths	
	$lang['strpaths']  =  'パス';
	$lang['strnopaths']  =  'パスが見つかりません。';
	$lang['strcreatepath']  =  'パスを作成する';
	$lang['strnodename']  =  'ノード名';
	$lang['strnodeid']  =  'ノード ID';
	$lang['strconninfo']  =  '接続文字列';
	$lang['strconnretry']  =  '接続の再実行までの秒数';
	$lang['strpathneedsconninfo']  =  'パスの接続文字列を与える必要があります。';
	$lang['strpathneedsconnretry']  =  '接続の再実行までの秒数を与える必要があります。';
	$lang['strpathcreated']  =  'パスを作成しました。';
	$lang['strpathcreatedbad']  =  'パスの作成に失敗しました。';
	$lang['strconfdroppath']  =  '本当にパス「%s」を破棄しますか?';
	$lang['strpathdropped']  =  'パスを破棄しました。';
	$lang['strpathdroppedbad']  =  'パスの破棄に失敗しました。';

	// Slony listens
	$lang['strlistens']  =  'リッスン';
	$lang['strnolistens']  =  'リッスンが見つかりません。';
	$lang['strcreatelisten']  =  'リッスンを作成する';
	$lang['strlistencreated']  =  'リッスンを作成しました。';
	$lang['strlistencreatedbad']  =  'リッスンの作成に失敗しました。';
	$lang['strconfdroplisten']  =  '本当にリッスン「%s」を破棄しますか?';
	$lang['strlistendropped']  =  'リッスンを破棄しました。';
	$lang['strlistendroppedbad']  =  'リッスンの破棄に失敗しました。';

	// Slony replication sets
	$lang['strrepsets']  =  'レプリケーションセット';
	$lang['strnorepsets']  =  'レプリケーションセットが見つかりません。';
	$lang['strcreaterepset']  =  'レプリケーションセットを作成する';
	$lang['strrepsetcreated']  =  'レプリケーションセットを作成しました。';
	$lang['strrepsetcreatedbad']  =  'レプリケーションセットの作成に失敗しました。';
	$lang['strconfdroprepset']  =  '本当にレプリケーションセット「%s」を破棄しますか?';
	$lang['strrepsetdropped']  =  'レプリケーションセットを破棄しました。';
	$lang['strrepsetdroppedbad']  =  'レプリケーションセットの破棄に失敗しました。';
	$lang['strmerge']  =  '統合する';
	$lang['strmergeinto']  =  '統合先';
	$lang['strrepsetmerged']  =  'レプリケーションセットを統合しました。';
	$lang['strrepsetmergedbad']  =  'レプリケーションセットの統合に失敗しました。';
	$lang['strmove']  =  '移動する';
	$lang['strneworigin']  =  '新規オリジン';
	$lang['strrepsetmoved']  =  'レプリケーションセットを移動しました。';
	$lang['strrepsetmovedbad']  =  'レプリケーションセットの移動に失敗しました。';
	$lang['strnewrepset']  =  '新規レプリケーションセット';
	$lang['strlock']  =  'ロック';
	$lang['strlocked']  =  'ロック済';
	$lang['strunlock']  =  'ロック解除';
	$lang['strconflockrepset']  =  '本当にレプリケーションセット「%s」をロックしますか?';
	$lang['strrepsetlocked']  =  'レプリケーションセットをロックしました。';
	$lang['strrepsetlockedbad']  =  'レプリケーションセットのロックに失敗しました。';
	$lang['strconfunlockrepset']  =  '本当にレプリケーションセット「%s」のロックを解除しますか?';
	$lang['strrepsetunlocked']  =  'レプリケーションセットを解除しました。';
	$lang['strrepsetunlockedbad']  =  'レプリケーションセットの解除に失敗しました。';
	$lang['strexecute']  =  '実行する';
	$lang['stronlyonnode']  =  'ノードでのみ';
	$lang['strddlscript']  =  'DDL スクリプト';
	$lang['strscriptneedsbody']  =  'すべてのノード上で実行されるスクリプトを提供しなければなりません。';
	$lang['strscriptexecuted']  =  'レプリケーションセットで DDL スクリプトを実行しました。';
	$lang['strscriptexecutedbad']  =  'レプリケーションセットでの DDL スクリプトの実行に失敗しました。';
	$lang['strtabletriggerstoretain']  =  '次のトリガーは Slony により無効にならないでしょう:';

	// Slony tables in replication sets
	$lang['straddtable']  =  'テーブルを追加する';
	$lang['strtableneedsuniquekey']  =  '追加されるテーブルはプライマリかユニークキーを要求します。';
	$lang['strtableaddedtorepset']  =  'レプリケーションセットにテーブルを追加しました。';
	$lang['strtableaddedtorepsetbad']  =  'レプリケーションセットへのテーブル追加に失敗しました。';
	$lang['strconfremovetablefromrepset']  =  '本当にレプリケーションセット「%s」からテーブル「%s」を削除しますか?';
	$lang['strtableremovedfromrepset']  =  'レプリケーションセットからテーブルを削除しました。';
	$lang['strtableremovedfromrepsetbad']  =  'レプリケーションセットからテーブルの削除に失敗しました。';

	// Slony sequences in replication sets
	$lang['straddsequence']  =  'シーケンスを追加する';
	$lang['strsequenceaddedtorepset']  =  'レプリケーションセットにシーケンスを追加しました。';
	$lang['strsequenceaddedtorepsetbad']  =  'レプリケーションセットへのシーケンスの追加に失敗しました。';
	$lang['strconfremovesequencefromrepset']  =  '本当にレプリケーションセット「%s」からシーケンス「%s」を削除しますか?';
	$lang['strsequenceremovedfromrepset']  =  'レプリケーションセットからシーケンスを削除しました。';
	$lang['strsequenceremovedfromrepsetbad']  =  'レプリケーションセットからシーケンスの削除に失敗しました。';

	// Slony subscriptions
	$lang['strsubscriptions']  =  'サブスクリプション';
	$lang['strnosubscriptions']  =  'サブスクリプションが見つかりません。';

	// Miscellaneous
	$lang['strtopbar'] = 'サーバー %2$s のポート番号 %3$s で実行中の %1$s に接続中 -- ユーザー「%4$s」としてログイン中(%5$s)';
	$lang['strtimefmt'] = 'Y 年 n 月 j 日 G:i';
	$lang['strhelp'] = 'ヘルプ';
	$lang['strhelpicon'] = '?';
	$lang['strlogintitle'] = '%s にログイン';
	$lang['strlogoutmsg'] = '%s をログアウトしました。';
	$lang['strloading'] = '読み込み中...';
	$lang['strerrorloading'] = '読み込み中のエラーです。';
	$lang['strclicktoreload'] = 'クリックで再読み込み';
?>
