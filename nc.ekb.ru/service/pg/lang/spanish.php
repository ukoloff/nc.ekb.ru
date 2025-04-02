<?php

	/**
	 * Spanish language file for phpPgAdmin.
	 * @maintainer Mart�n Marqu�s (martin@bugs.unl.edu.ar)
	 *
	 * $Id: spanish.php,v 1.35.2.1 2007/01/20 18:06:42 xzilla Exp $
	 */

	// Language and character set
	$lang['applang'] = 'Spanish';
	$lang['appcharset'] = 'ISO-8859-1';
	$lang['applocale'] = 'es_ES';
  	$lang['appdbencoding'] = 'LATIN1';
	$lang['applangdir'] = 'ltr';

    // Bienvenido
	$lang['strintro'] = 'Bienvenido a phpPgAdmin.';
	$lang['strppahome'] = 'P�gina web de phpPgAdmin';
	$lang['strpgsqlhome'] = 'P�gina web de PostgreSQL';
	$lang['strpgsqlhome_url'] = 'http://www.postgresql.org/';
	$lang['strlocaldocs'] = 'Documentaci�n de PostgreSQL (local)';
	$lang['strreportbug'] = 'Reportar problemas';
	$lang['strviewfaq'] = 'Ver Preguntas Frecuentes';
	$lang['strviewfaq_url'] = 'http://phppgadmin.sourceforge.net/?page=faq';

	// Basic strings
	$lang['strlogin'] = 'Autenticar';
	$lang['strloginfailed'] = 'Fall� la autenticaci�n';
	$lang['strlogindisallowed'] = 'Ingreso no autorizado';
	$lang['strserver'] = 'Servidor';
    $lang['strservers']  =  'Servidores';
    $lang['strintroduction']  =  'Introducci�n';
    $lang['strhost']  =  'Host';
    $lang['strport']  =  'Puerto';
	$lang['strlogout'] = 'Salir';
	$lang['strowner'] = 'Due�o';
	$lang['straction'] = 'Acci�n';
	$lang['stractions'] = 'Acciones';
	$lang['strname'] = 'Nombre';
	$lang['strdefinition'] = 'Definici�n';
	$lang['strproperties'] = 'Propiedades';
	$lang['strbrowse'] = 'Examinar';
	$lang['strenable']  =  'Activar';
	$lang['strdisable']  =  'Desactivar';
	$lang['strdrop'] = 'Eliminar';
	$lang['strdropped'] = 'Eliminado';
	$lang['strnull'] = 'Nulo';
	$lang['strnotnull'] = 'No Nulo';
	$lang['strprev'] = 'Previo';
	$lang['strnext'] = 'Pr�ximo';
    $lang['strfirst'] = '<< Principio';
    $lang['strlast'] = 'Final >>';
	$lang['strfailed'] = 'Fall�';
	$lang['strcreate'] = 'Crear';
	$lang['strcreated'] = 'Creado';
	$lang['strcomment'] = 'Comentario';
	$lang['strlength'] = 'Longitud';
	$lang['strdefault'] = 'Predeterminado';
	$lang['stralter'] = 'Modificar';
	$lang['strok'] = 'OK';
	$lang['strcancel'] = 'Cancelar';
$lang['strac']  =  'Enable AutoComplete';
	$lang['strsave'] = 'Guardar';
	$lang['strreset'] = 'Reestablecer';
	$lang['strinsert'] = 'Insertar';
	$lang['strselect'] = 'Seleccionar';
	$lang['strdelete'] = 'Eliminar';
	$lang['strupdate'] = 'Actualizar';
	$lang['strreferences'] = 'Referencia';
	$lang['stryes'] = 'Si';
	$lang['strno'] = 'No';
	$lang['strtrue'] = 'Verdadero';
	$lang['strfalse'] = 'Falso';
	$lang['stredit'] = 'Editar';
    $lang['strcolumn']  =  'Columna';
	$lang['strcolumns'] = 'Columnas';
	$lang['strrows'] = 'fila(s)';
	$lang['strrowsaff'] = 'fila(s) afectadas.';
	$lang['strobjects'] = 'objeto(s)';
	$lang['strback'] = 'Atr�s';
	$lang['strqueryresults'] = 'Resultado de la consulta';
	$lang['strshow'] = 'Mostrar';
	$lang['strempty'] = 'Vaciar';
	$lang['strlanguage'] = 'Idioma';
	$lang['strencoding'] = 'Codificaci�n';
	$lang['strvalue'] = 'Valor';
	$lang['strunique'] = '�nico';
	$lang['strprimary'] = 'Primaria';
	$lang['strexport'] = 'Exportar';
	$lang['strimport'] = 'Importar';
    $lang['strallowednulls']  =  'Valores Nulos (NULL) Permitidos';
	$lang['strbackslashn']  =  '\N';
    $lang['strnull']  =  'Nulo';
    $lang['stremptystring']  =  'Cadena o campo vacio';
	$lang['strsql'] = 'SQL';
	$lang['stradmin'] = 'Admin';
	$lang['strvacuum'] = 'Limpiar';
	$lang['stranalyze'] = 'Analizar';
	$lang['strclusterindex'] = 'Ordenar tabla';
	$lang['strclustered'] = '�Tabla Ordenada?';
	$lang['strreindex'] = 'Reindexar';
	$lang['strrun'] = 'Ejecutar';
	$lang['stradd'] = 'Agregar';
    $lang['strremove']  =  'Remover';
	$lang['strevent'] = 'Evento';
	$lang['strwhere'] = 'D�nde';
	$lang['strinstead'] = 'Hacer en su lugar';
	$lang['strwhen'] = 'Cu�ndo';
	$lang['strformat'] = 'Formato';
	$lang['strdata'] = 'Dato';
	$lang['strconfirm'] = 'Confirmar';
	$lang['strexpression'] = 'Expresi�n';
	$lang['strellipsis'] = '...';
	$lang['strseparator']  =  ': ';
	$lang['strexpand'] = 'Expandir';
	$lang['strcollapse'] = 'Colapsar';
    $lang['strexplain'] = 'Explicar';
	$lang['strexplainanalyze'] = 'Explicar analizando';
    $lang['strfind'] = 'Buscar';
    $lang['stroptions'] = 'Opciones';
	$lang['strrefresh'] = 'Refrescar';
	$lang['strdownload'] = 'Bajar';
	$lang['strdownloadgzipped'] = 'Bajar comprimido con gzip';
	$lang['strinfo'] = 'Informaci�n';
	$lang['stroids'] = 'OIDs';
	$lang['stradvanced'] = 'Avanzado';
	$lang['strvariables'] = 'Variables';
	$lang['strprocess'] = 'Proceso';
	$lang['strprocesses'] = 'Procesos';
	$lang['strsetting'] = 'Setear';
	$lang['streditsql'] = 'Editar SQL';
	$lang['strruntime'] = 'Tiempo total de ejecuci�n: %s ms';
	$lang['strpaginate'] = 'Paginar resultados';
	$lang['struploadscript'] = 'o subir un script SQL:';
	$lang['strstarttime'] = 'Hora de comienzo';
	$lang['strfile'] = 'Archivo';
	$lang['strfileimported'] = 'Archivo importado.';
    $lang['strtrycred']  =  'Usar el mismo par usuario/contrase�a para todos los servidores';

	// Database Sizes
	$lang['strsize'] = 'Tama�o';
	$lang['strbytes'] = 'bytes';
	$lang['strkb'] = 'kB';
	$lang['strmb'] = 'MB';
	$lang['strgb'] = 'GB';
	$lang['strtb'] = 'TB';

	// Error handling
    $lang['strnoframes']  =  'Esta aplicaci�n funciona mejor con un navegador con soporte para marcos, pero puede usarse sin marcos siguiendo el link de abajo.';
    $lang['strnoframeslink']  =  'Usar sin marcos';
	$lang['strbadconfig'] = 'Su archivo config.inc.php est� desactualizado. Deber� regenerarlo a partir del archivo nuevo config.inc.php-dist.';
	$lang['strnotloaded'] = 'Su versi�n de PHP no tiene el soporte correcto de bases de datos.';
    $lang['strpostgresqlversionnotsupported']  =  'Su versi�n de PostgreSQL no est� soportado. Por favor actualice a la versi�n %s o m�s reciente.';
	$lang['strbadschema'] = 'El esquema especificado no es v�lido.';
	$lang['strbadencoding'] = 'No se pudo setear la codificaci�n del cliente en la base de datos.';
	$lang['strsqlerror'] = 'Error de SQL:';
	$lang['strinstatement'] = 'En la declaraci�n:';
	$lang['strinvalidparam'] = 'Par�metros de script no v�lidos.';
	$lang['strnodata'] = 'No se encontraron filas.';
	$lang['strnoobjects'] = 'No se encontraron objetos.';
	$lang['strrownotunique'] = 'No existe un identificador �nico para este registro.';
	$lang['strnoreportsdb'] = 'No ha creado a�n la base de datos para los reportes. Lea las instrucciones del archivo INSTALL.';
	$lang['strnouploads'] = 'Est� deshabilitada la subida de archivos.';
	$lang['strimporterror'] = 'Error de importaci�n.';
    $lang['strimporterror-fileformat']  =  'Error de importacion de datos: Fall� al intentar determinar el formato del archivo.';
	$lang['strimporterrorline'] = 'Error de importaci�n en la l�nea %s.';
    $lang['strimporterrorline-badcolumnnum']  =  'Error de importaci�n en la l�nea %s:  La l�nea no posee la cantidad de columnas correctas.';
    $lang['strimporterror-uploadedfile']  =  'Error de importaci�n: No se ha podido subir el archivo al servidor';
    $lang['strcannotdumponwindows']  =  'Vuelco de datos con nombres complejos de tablas y esquemas no esta soportado en Windows.';

	// Tables
	$lang['strtable'] = 'Tabla';
	$lang['strtables'] = 'Tablas';
	$lang['strshowalltables'] = 'Mostrar Todas las Tablas';
	$lang['strnotables'] = 'No se encontraron tablas.';
	$lang['strnotable'] = 'No se encontr� la tabla.';
	$lang['strcreatetable'] = 'Crear tabla';
	$lang['strtablename'] = 'Nombre de la tabla';
	$lang['strtableneedsname'] = 'Debe darle un nombre a la tabla.';
	$lang['strtableneedsfield'] = 'Debe especificar al menos un campo.';
	$lang['strtableneedscols'] = 'Las tablas requieren un n�mero v�lido de columnas.';
	$lang['strtablecreated'] = 'Tabla creada.';
	$lang['strtablecreatedbad'] = 'Fall� al tratar crear la tabla.';
	$lang['strconfdroptable'] = '�Est� seguro que desea eliminar la tabla "%s"?';
	$lang['strtabledropped'] = 'Tabla eliminada.';
	$lang['strtabledroppedbad'] = 'Fall� al tratar de eliminar la tabla.';
	$lang['strconfemptytable'] = '�Est� seguro que desea vaciar la tabla "%s"?';
	$lang['strtableemptied'] = 'Tabla vaciada.';
	$lang['strtableemptiedbad'] = 'Fall� el vaciado de la tabla.';
	$lang['strinsertrow'] = 'Insertar Fila';
	$lang['strrowinserted'] = 'Fila insertada.';
	$lang['strrowinsertedbad'] = 'Fall� la inserci�n de fila.';
    $lang['strrowduplicate']  =  'Inserci�n de fila fall�, intentado hacer una duplicaci�n de inserci�n.';
	$lang['streditrow'] = 'Editar fila';
	$lang['strrowupdated'] = 'Fila actualizada.';
	$lang['strrowupdatedbad'] = 'Fall� al intentar actualizar la fila.';
	$lang['strdeleterow'] = 'Eliminar Fila';
	$lang['strconfdeleterow'] = '�Est� seguro que quiere eliminar esta fila?';
	$lang['strrowdeleted'] = 'Fila eliminada.';
	$lang['strrowdeletedbad'] = 'Fall� la eliminaci�n de fila.';
    $lang['strinsertandrepeat']  =  'Insertar y Repite';
    $lang['strnumcols']  =  'Cantidad de columnas';
    $lang['strcolneedsname']  =  'Debe especificar un nombre para la columna';
    $lang['strselectallfields'] = 'Seleccionar todos los campos.';
	$lang['strselectneedscol'] = 'Debe elegir al menos una columna';
	$lang['strselectunary'] = 'Operaciones unitarias no pueden tener valores.';
	$lang['straltercolumn'] = 'Modificar Columna';
	$lang['strcolumnaltered'] = 'Columna Modificada.';
	$lang['strcolumnalteredbad'] = 'Fall� la modificaci�n de columna.';
	$lang['strconfdropcolumn'] = '�Est� seguro que quiere eliminar la columna "%s" de la tabla "%s"?';
	$lang['strcolumndropped'] = 'Columna eliminada.';
	$lang['strcolumndroppedbad'] = 'Fall� la eliminaci�n de columna.';
    $lang['straddcolumn'] = 'Agregar Columna';
	$lang['strcolumnadded'] = 'Columna agregada.';
	$lang['strcolumnaddedbad'] = 'Fall� el agregado de columna.';
	$lang['strcascade'] = 'EN CASCADA';
	$lang['strtablealtered'] = 'Tabla modificada.';
	$lang['strtablealteredbad'] = 'Fall� la modificaci�n  de la Tabla.';
    $lang['strdataonly'] = 'Datos solamente';
	$lang['strstructureonly'] = 'Solo la estructura';
	$lang['strstructureanddata'] = 'Estructura y datos';
	$lang['strtabbed'] = 'Tabulado';
	$lang['strauto'] = 'Autom�tico';
    $lang['strconfvacuumtable']  =  'Esta seguro que quiere limpiar "%s"?';
    $lang['strestimatedrowcount']  =  'Estimaci�n de filas';

	// Columns
	$lang['strcolprop'] = 'Propiedades de Columna';

    // Users
	$lang['struser'] = 'Usuario';
	$lang['strusers'] = 'Usuarios';
	$lang['strusername'] = 'Nombre de usuario';
	$lang['strpassword'] = 'Contrase�a';
	$lang['strsuper'] = '�Es administrador?';
	$lang['strcreatedb'] = '�Puede crear BD?';
	$lang['strexpires'] = 'Expira';
	$lang['strsessiondefaults'] = 'Valores predeterminados de la sesi�n.';
	$lang['strnousers'] = 'No se encontraron usuarios.';
    $lang['struserupdated'] = 'Usuario actualizado.';
	$lang['struserupdatedbad'] = 'Fall� la actualizaci�n del usuario.';
	$lang['strshowallusers'] = 'Mostrar Todos los Usuarios';
	$lang['strcreateuser'] = 'Crear Usuario';
	$lang['struserneedsname'] = 'Debe dar un nombre a su usuario.';
	$lang['strusercreated'] = 'Usuario creado.';
	$lang['strusercreatedbad'] = 'Fall� al crear usuario.';
	$lang['strconfdropuser'] = '�Est� seguro que quiere eliminar el usuario "%s"?';
    $lang['struserdropped'] = 'Usuario eliminado.';
	$lang['struserdroppedbad'] = 'Fall� al eliminar el usuario.';
	$lang['straccount'] = 'Cuenta';
	$lang['strchangepassword'] = 'Cambiar Contrase�a';
	$lang['strpasswordchanged'] = 'Contrase�a modificada.';
	$lang['strpasswordchangedbad'] = 'Fall� al modificar contrase�a.';
	$lang['strpasswordshort'] = 'La contrase�a es muy corta.';
	$lang['strpasswordconfirm'] = 'Las contrase�as no coinciden.';

    // Groups
    $lang['strgroup'] = 'Grupo';
	$lang['strgroups']  =  'Grupos';
	$lang['strnogroup'] = 'Grupo no encontrado.';
	$lang['strnogroups'] = 'No se encontraron grupos.';
	$lang['strcreategroup'] = 'Crear Grupo';
	$lang['strshowallgroups'] = 'Mostrar Todos los Grupos';
	$lang['strgroupneedsname'] = 'Debe darle un nombre al grupo.';
	$lang['strgroupcreated'] = 'Grupo creado.';
	$lang['strgroupcreatedbad'] = 'Fall� la creaci�n del grupo.';
	$lang['strconfdropgroup'] = '�Est� seguro que quiere eliminar el grupo "%s"?';
	$lang['strgroupdropped'] = 'Grupo eliminado.';
    $lang['strgroupdroppedbad'] = 'Fall� la eliminaci�n del grupo.';
    $lang['strmembers'] = 'Miembros';
	$lang['strmemberof']  =  'Miembro de';
	$lang['stradminmembers']  =  'Miembros Admin ';
	$lang['straddmember'] = 'Agregar un miembro';
	$lang['strmemberadded'] = 'Miembro agregado.';
	$lang['strmemberaddedbad'] = 'Fall� al intentar agregar nuevo miembro.';
	$lang['strdropmember'] = 'Sacar miembro';
	$lang['strconfdropmember'] = '�Est� seguro que quiere sacra el miembro "%s" del grupo "%s"?';
	$lang['strmemberdropped'] = 'Miembro eliminado.';
	$lang['strmemberdroppedbad'] = 'Fall� al intentar sacar un miembro.';

	// Roles
	$lang['strrole']  =  'Rol';
	$lang['strroles']  =  'Roles';
	$lang['strrolename']  =  'Nombre del Rol';
	$lang['strshowallroles'] = 'Mostrar todas los rols';
    $lang['strinheritsprivs']  =  'Hereda Privilegios?';
	$lang['strcreaterole']  =  'Crear Rol';
	$lang['strcancreaterole']  =  'Puede crear rols?';
	$lang['strrolecreated']  =  'Rol creado.';
	$lang['strrolecreatedbad']  =  'Fall� al crear rol.';
	$lang['stralterrole']  =  'Alterar role';
$lang['strroleupdated']  =  'Role updated.';
$lang['strroleupdatedbad']  =  'Role update failed.';
$lang['strcatupdate']  =  'Modify Catalogs?';
    $lang['strcanlogin']  =  'Puede loggearse?';
$lang['strconnlimit']  =  'Connection limit';
$lang['strdroprole']  =  'Drop role';
    $lang['strmaxconnections']  =  'M�ximo de conexiones';
	$lang['strconfdroprole']  =  '�Est� seguro de que desea eliminar el rol "%s"?';
    $lang['strroledropped']  =  'Usuario eliminado.';
	$lang['strroledroppedbad']  =  'No puedo eliminar rol.';
	$lang['strnoroles']  =  'No se encontraron los rols.';
	$lang['strnolimit']  =  'Sin l�mite';
	$lang['strnever']  =  'Nunca';
$lang['strroleneedsname']  =  'You must give a name for the role.';
	
	// Privileges
	$lang['strprivilege'] = 'Privilegio';
	$lang['strprivileges'] = 'Privilegios';
	$lang['strnoprivileges'] = 'Este objeto tiene privilegios de usuario por defecto.';
	$lang['strgrant'] = 'Otorgar';
	$lang['strrevoke'] = 'Revocar';
	$lang['strgranted'] = 'Privilegios otorgados/revocados.';
	$lang['strgrantfailed'] = 'Fall� al intentar otorgar privilegios.';
	$lang['strgrantbad'] = 'Debe especificar al menos un usuario o grupo y al menos un privilegio.';
	$lang['strgrantor']  =  'Cedente';
	$lang['strasterisk']  =  '*';

	// Databases
	$lang['strdatabase'] = 'Base de Datos';
	$lang['strdatabases'] = 'Bases de Datos';
	$lang['strshowalldatabases'] = 'Mostrar Todas las Bases de Datos';
	$lang['strnodatabase'] = 'No se encontr� la Base de Datos.';
	$lang['strnodatabases'] = 'No se encontraron Bases de Datos.';
	$lang['strcreatedatabase'] = 'Crear base de datos';
	$lang['strdatabasename'] = 'Nombre de la base de datos';
	$lang['strdatabaseneedsname'] = 'Debe darle un nombre a la base de datos.';
	$lang['strdatabasecreated'] = 'Base de Datos creada.';
	$lang['strdatabasecreatedbad'] = 'Fall� la creaci�n de la base de datos.';	
	$lang['strconfdropdatabase'] = '�Est� seguro que quiere eliminar la base de datos "%s"?';
	$lang['strdatabasedropped'] = 'Base de datos eliminada.';
	$lang['strdatabasedroppedbad'] = 'Fall� al eliminar la base de datos.';
	$lang['strentersql'] = 'Ingrese la sentencia de SQL para ejecutar:';
	$lang['strsqlexecuted'] = 'SQL ejecutada.';
	$lang['strvacuumgood'] = 'Limpieza completada.';
	$lang['strvacuumbad'] = 'Fall� al intentar limpiar.';
	$lang['stranalyzegood'] = 'An�lisis completado.';
	$lang['stranalyzebad'] = 'Fall� al intentar analizar.';
	$lang['strreindexgood'] = 'Reindexado completo.';
	$lang['strreindexbad'] = 'Fall� el reindexado.';
	$lang['strfull'] = 'Full';
	$lang['strfreeze'] = 'Freeze';
	$lang['strforce'] = 'Force';
    $lang['strsignalsent']  =  'Se�al enviada.';
    $lang['strsignalsentbad']  =  'Fall� el env�o de la se�al.';
    $lang['strallobjects']  =  'Todos los objetos';
    $lang['strdatabasealtered']  =  'Base de Datos alterada.';
    $lang['strdatabasealteredbad']  =  'Fall� al intentar alterar la Base de Datos.';

	// Views
	$lang['strview'] = 'Vista';
	$lang['strviews'] = 'Vistas';
	$lang['strshowallviews'] = 'Mostrar todas las vistas';
	$lang['strnoview'] = 'No se encontr� la vista.';
	$lang['strnoviews'] = 'No se encontraron vistas.';
	$lang['strcreateview'] = 'Crear Vista';
	$lang['strviewname'] = 'Nombre de Vista';
	$lang['strviewneedsname'] = 'Debe darle un nombre a la vista.';
	$lang['strviewneedsdef'] = 'Debe darle una definici�n a su vista.';
    $lang['strviewneedsfields'] = 'Seleccione por favor los campos que desea en su vista.';
	$lang['strviewcreated'] = 'Vista creada.';
	$lang['strviewcreatedbad'] = 'Fall� al crear la vista.';
	$lang['strconfdropview'] = '�Est� seguro que quiere eliminar la vista "%s"?';
	$lang['strviewdropped'] = 'Vista eliminada.';
	$lang['strviewdroppedbad'] = 'Fall� al intentar eliminar la vista.';
	$lang['strviewupdated'] = 'Vista actualizada.';
	$lang['strviewupdatedbad'] = 'Fall� al actualizar la vista.';
	$lang['strviewlink'] = 'Linking Keys';
	$lang['strviewconditions'] = 'Additional Conditions';
	$lang['strcreateviewwiz'] = 'Crear vista con Asistente';

	// Sequences
	$lang['strsequence'] = 'Secuencia';
	$lang['strsequences'] = 'Secuencias';
	$lang['strshowallsequences'] = 'Mostrar todas las secuencias';
	$lang['strnosequence'] = 'No se encontr� la secuencia.';
	$lang['strnosequences'] = 'No se encontraron secuencias.';
	$lang['strcreatesequence'] = 'Crear secuencia';
	$lang['strlastvalue'] = '�ltimo Valor';
	$lang['strincrementby'] = 'Incremento';	
	$lang['strstartvalue'] = 'Valor Inicial';
	$lang['strmaxvalue'] = 'Valor M�ximo';
	$lang['strminvalue'] = 'Valor M�nimo';
	$lang['strcachevalue'] = 'Valor de Cache';
$lang['strlogcount'] = 'Log Count';
	$lang['striscycled'] = '�Rotar?';
	$lang['striscalled'] = '�Nombre?';
	$lang['strsequenceneedsname'] = 'Debe darle un nombre a la secuencia.';
	$lang['strsequencecreated'] = 'Secuencia creada.';
	$lang['strsequencecreatedbad'] = 'Fall� la creaci�n de la secuencia.'; 
	$lang['strconfdropsequence'] = '�Est� seguro que quiere eliminar la secuencia "%s"?';
	$lang['strsequencedropped'] = 'Secuencia eliminada.';
	$lang['strsequencedroppedbad'] = 'Fall� la eliminaci�n de la secuencia.';
	$lang['strsequencereset'] = 'Secuencia reiniciada.';
	$lang['strsequenceresetbad'] = 'Fall� al intentar reiniciar la secuencia.'; 
$lang['straltersequence']  =  'Alter sequence';
$lang['strsequencealtered']  =  'Sequence altered.';
$lang['strsequencealteredbad']  =  'Sequence alteration failed.';
	$lang['strsetval']  =  'Fijar el valor';
$lang['strsequencesetval']  =  'Sequence value set.';
$lang['strsequencesetvalbad']  =  'Sequence value set failed.';
$lang['strnextval']  =  'Increment Value';
$lang['strsequencenextval']  =  'Sequence incremented.';
$lang['strsequencenextvalbad']  =  'Sequence increment failed.';

	// Indexes
	$lang['strindex'] = '�ndice';
	$lang['strindexes'] = '�ndices';
	$lang['strindexname'] = 'Nombre del �ndice';
	$lang['strshowallindexes'] = 'Mostrar Todos los �ndices';
	$lang['strnoindex'] = 'No se encontr� el �ndice.';
	$lang['strnoindexes'] = 'No se encontraron �ndices.';
	$lang['strcreateindex'] = 'Crear �ndice';
	$lang['strtabname'] = 'Tab Name';
	$lang['strcolumnname'] = 'Nombre de Columna';
	$lang['strindexneedsname'] = 'Debe darle un nombre al �ndice';
	$lang['strindexneedscols'] = 'Los �ndices requieren un n�mero v�lido de columnas.';
	$lang['strindexcreated'] = '�ndice creado';
	$lang['strindexcreatedbad'] = 'Fall� al crear el �ndice.';
	$lang['strconfdropindex'] = '�Est� seguro que quiere eliminar el �ndice "%s"?';
	$lang['strindexdropped'] = '�ndice eliminado.';
	$lang['strindexdroppedbad'] = 'Fall� al eliminar el �ndice.';
	$lang['strkeyname'] = 'Nombre de la llave';
	$lang['struniquekey'] = 'Llave �nica';
	$lang['strprimarykey'] = 'Llave primaria';
 	$lang['strindextype'] = 'Tipo de �ndice';
	$lang['strtablecolumnlist'] = 'Columnas en Tabla';
	$lang['strindexcolumnlist'] = 'Columnas en el �ndice';
	$lang['strconfcluster'] = 'Est� seguro que quiere ordenar la tabla "%s"?';
	$lang['strclusteredgood'] = 'Ordenado completo.';
	$lang['strclusteredbad'] = 'Fall� al ordenar tabla.';

	// Rules
	$lang['strrules'] = 'Reglas';
	$lang['strrule'] = 'Regla';
	$lang['strshowallrules'] = 'Mostrar todas las reglas';
	$lang['strnorule'] = 'No se encontr� la regla.';
	$lang['strnorules'] = 'No se encontraron reglas.';
	$lang['strcreaterule'] = 'Crear regla';
	$lang['strrulename'] = 'Nombre de regla';
	$lang['strruleneedsname'] = 'Debe darle un nombre a la regla.';
	$lang['strrulecreated'] = 'Regla creada.';
	$lang['strrulecreatedbad'] = 'Fall� al crear la regla.';
	$lang['strconfdroprule'] = '�Est� seguro que quiere eliminar la regla "%s" en "%s"?';
	$lang['strruledropped'] = 'Regla eliminada.';
	$lang['strruledroppedbad'] = 'Fall� al eliminar la regla.';

	// Constraints
    $lang['strconstraint']  =  'Restricci�n';
	$lang['strconstraints'] = 'Restricciones';
	$lang['strshowallconstraints'] = 'Mostrar todas las restricciones';
	$lang['strnoconstraints'] = 'No se encontraron restricciones.';
	$lang['strcreateconstraint'] = 'Crear Restricci�n';
	$lang['strconstraintcreated'] = 'Restricci�n creada.';
	$lang['strconstraintcreatedbad'] = 'Fall� al crear la Restricci�n.';
	$lang['strconfdropconstraint'] = '�Est� seguro que quiere eliminar la restricci�n "%s" de "%s"?';
	$lang['strconstraintdropped'] = 'Restricci�n eliminada.';
	$lang['strconstraintdroppedbad'] = 'Fall� al eliminar la restricci�n.';
	$lang['straddcheck'] = 'Agregar chequeo';
	$lang['strcheckneedsdefinition'] = 'Restricci�n de chequeo necesita una definici�n.';
	$lang['strcheckadded'] = 'Restricci�n de chequeo agregada.';
	$lang['strcheckaddedbad'] = 'Fall� al intentar agregar restricci�n de chequeo.';
	$lang['straddpk'] = 'Agregar llave primaria';
	$lang['strpkneedscols'] = 'Llave primaria necesita al menos un campo.';
	$lang['strpkadded'] = 'Llave primaria agregada.';
	$lang['strpkaddedbad'] = 'Fall� al intentar crear la llave primaria.';
	$lang['stradduniq'] = 'Agregar llave �nica';
	$lang['struniqneedscols'] = 'Llave �nica necesita al menos un campo.';
	$lang['struniqadded'] = 'Agregar llave �nica.';
	$lang['struniqaddedbad'] = 'Fall� al intentar agregar la llave �nica.';
	$lang['straddfk'] = 'Agregar referencia';
	$lang['strfkneedscols'] = 'Referencia necesita al menos un campo.';
	$lang['strfkneedstarget'] = 'Referencia necesita una tabla para referenciar.';
	$lang['strfkadded'] = 'Referencia agregada.';
	$lang['strfkaddedbad'] = 'Fall� al agregar la referencia.';
	$lang['strfktarget'] = 'Tabla de destino';
	$lang['strfkcolumnlist'] = 'Campos en la llave';
	$lang['strondelete'] = 'AL ELIMINAR';
	$lang['stronupdate'] = 'AL ACTUALIZAR';

	// Functions
	$lang['strfunction'] = 'Funci�n';
	$lang['strfunctions'] = 'Funciones';
	$lang['strshowallfunctions'] = 'Mostrar todas las funciones';
	$lang['strnofunction'] = 'No se encontr� la funci�n.';
	$lang['strnofunctions'] = 'No se encontraron funciones.';
    $lang['strcreateplfunction']  =  'Crear funci�n SQL/PL';
    $lang['strcreateinternalfunction']  =  'Crear funci�n interna';
    $lang['strcreatecfunction']  =  'Crear funci�n en C';
	$lang['strfunctionname'] = 'Nombre de la funci�n';
	$lang['strreturns'] = 'Devuelve';
    $lang['strproglanguage'] = 'Lenguaje de programaci�n';
	$lang['strfunctionneedsname'] = 'Debe darle un nombre a la funci�n.';
	$lang['strfunctionneedsdef'] = 'Debe darle una definici�n a la funci�n.';
	$lang['strfunctioncreated'] = 'Funci�n creada.';
	$lang['strfunctioncreatedbad'] = 'Fall� la creaci�n de la funci�n.';
	$lang['strconfdropfunction'] = '�Est� seguro que quiere eliminar la funci�n "%s"?';
	$lang['strfunctiondropped'] = 'Funci�n eliminada.';
	$lang['strfunctiondroppedbad'] = 'Fall� al eliminar la funci�n.';
	$lang['strfunctionupdated'] = 'Funci�n actualizada.';
	$lang['strfunctionupdatedbad'] = 'Fall� al actualizar la funci�n.';
    $lang['strobjectfile']  =  'Archivo de objeto';
    $lang['strlinksymbol']  =  'Vinculo simb�lico';
    $lang['strarguments']  =  'Argumentos';
    $lang['strargname']  =  'Nombre';
    $lang['strargmode']  =  'Modo';
    $lang['strargtype']  =  'Tipo';
    $lang['strargadd']  =  'Agregar otro argumento';
    $lang['strargremove']  =  'Eliminar este argumento';
    $lang['strargnoargs']  =  'Esta funci�n no tendr� argumentos.';
    $lang['strargenableargs']  =  'Habilitar argumentos pasados a esta funci�n.';
$lang['strargnorowabove']  =  'There needs to be a row above this row.';
$lang['strargnorowbelow']  =  'There needs to be a row below this row.';
    $lang['strargraise']  =  'Mover arriba.';
    $lang['strarglower']  =  'Mover abajo.';
    $lang['strargremoveconfirm']  =  'Esta seguro que quiere eliminar este argumento? Esto NO se puede deshacer.';


	// Triggers
	$lang['strtrigger'] = 'Disparador';
	$lang['strtriggers'] = 'Disparadores';
	$lang['strshowalltriggers'] = 'Mostrar todos los disparadores';
	$lang['strnotrigger'] = 'No se encontr� el disparador.';
	$lang['strnotriggers'] = 'No se encontraron disparadores.';
	$lang['strcreatetrigger'] = 'Crear Disparador';
	$lang['strtriggerneedsname'] = 'Debe darle un nombre al disparador.';
	$lang['strtriggerneedsfunc'] = 'Debe especificar una funci�n para el disparador.';
	$lang['strtriggercreated'] = 'Disparador creado.';
	$lang['strtriggercreatedbad'] = 'Fall� la creaci�n del disparador.';
	$lang['strconfdroptrigger'] = '�Est� seguro que quiere eliminar el disparador "%s" en "%s"?';
$lang['strconfenabletrigger']  =  'Are you sure you want to enable the trigger "%s" on "%s"?';
$lang['strconfdisabletrigger']  =  'Are you sure you want to disable the trigger "%s" on "%s"?';
	$lang['strtriggerdropped'] = 'Disparador eliminado.';
	$lang['strtriggerdroppedbad'] = 'Fall� al eliminar el disparador.';
$lang['strtriggerenabled']  =  'Trigger enabled.';
$lang['strtriggerenabledbad']  =  'Trigger enable failed.';
$lang['strtriggerdisabled']  =  'Trigger disabled.';
$lang['strtriggerdisabledbad']  =  'Trigger disable failed.';
    $lang['strtriggeraltered'] = 'Disparador modificado.';
    $lang['strtriggeralteredbad'] = 'Fall� la modificaci�n del disparador.';
    $lang['strforeach']  =  'Para cada uno';

	// Types
	$lang['strtype'] = 'Tipo de dato';
	$lang['strtypes'] = 'Tipos de datos';
	$lang['strshowalltypes'] = 'Mostrar todos los tipos';
	$lang['strnotype'] = 'No se encontr� el tipo.';
	$lang['strnotypes'] = 'No se encontraron tipos.';
	$lang['strcreatetype'] = 'Crear Tipo';
    $lang['strcreatecomptype']  =  'Crear tipo compuesto';
    $lang['strtypeneedsfield']  =  'Debe especificar al menos un campo.';
    $lang['strtypeneedscols']  =  'Tipos compuestos requieren de un n�mero valido de columnas.';	
	$lang['strtypename'] = 'Nombre del tipo';
	$lang['strinputfn'] = 'Funci�n de entrada';
	$lang['stroutputfn'] = 'Funci�n de salida';
	$lang['strpassbyval'] = '�Pasar valor?';
	$lang['stralignment'] = 'Alineamiento';
	$lang['strelement'] = 'Elemento';
	$lang['strdelimiter'] = 'Delimitador';
	$lang['strstorage'] = 'Almacenamiento';
    $lang['strfield']  =  'Campo';
    $lang['strnumfields']  =  'Cantidad de campos';
	$lang['strtypeneedsname'] = 'Debe especificar un nombre para el tipo.';
	$lang['strtypeneedslen'] = 'Debe especificar una longitud para el tipo.';
	$lang['strtypecreated'] = 'Tipo creado';
	$lang['strtypecreatedbad'] = 'Fall� al crear el tipo.';
	$lang['strconfdroptype'] = '�Est� seguro que quiere eliminar el tipo "%s"?';
	$lang['strtypedropped'] = 'Tipo eliminado.';
	$lang['strtypedroppedbad'] = 'Fall� al eliminar el tipo.';
    $lang['strflavor']  =  'Tipo';
    $lang['strbasetype']  =  'Base';
    $lang['strcompositetype']  =  'Compuesto';
    $lang['strpseudotype']  =  'Pseudo';

	// Schemas
	$lang['strschema'] = 'Esquema';
	$lang['strschemas'] = 'Esquemas';
	$lang['strshowallschemas'] = 'Mostrar Todos los Esquemas';
	$lang['strnoschema'] = 'No se encontr� el esquema.';
	$lang['strnoschemas'] = 'No se encontraron esquemas.';
	$lang['strcreateschema'] = 'Crear Esquema';
	$lang['strschemaname'] = 'Nombre del esquema';
	$lang['strschemaneedsname'] = 'Debe especificar un nombre para el esquema.';
	$lang['strschemacreated'] = 'Esquema creado';
	$lang['strschemacreatedbad'] = 'Fall� al crear el esquema.';
	$lang['strconfdropschema'] = '�Est� seguro que quiere eliminar el esquema "%s"?';
	$lang['strschemadropped'] = 'Esquema eliminado.';
	$lang['strschemadroppedbad'] = 'Fall� al eliminar el esquema.';
	$lang['strschemaaltered'] = 'Esquema modificado.';
	$lang['strschemaalteredbad'] = 'Modificaci�n del esquema fall�.';
    $lang['strsearchpath']  =  'Orden de busqueda en esquemas';

	// Reports
	$lang['strreport'] = 'Reporte';
	$lang['strreports'] = 'Reportes';
	$lang['strshowallreports'] = 'Mostrar todos los reportes';
	$lang['strnoreports'] = 'No se encontr� el reporte.';
	$lang['strcreatereport'] = 'Crear Reporte';
	$lang['strreportdropped'] = 'Reporte eliminado.';
	$lang['strreportdroppedbad'] = 'Fall� al eliminar el Reporte.';
	$lang['strconfdropreport'] = '�Est� seguro que quiere eliminar el reporte "%s"?';
	$lang['strreportneedsname'] = 'Debe especificar un nombre para el reporte.';
	$lang['strreportneedsdef'] = 'Debe especificar un SQL para el reporte.';
	$lang['strreportcreated'] = 'Reporte guardado.';
	$lang['strreportcreatedbad'] = 'Fall� al guardar el reporte.';
	$lang['strdomain'] = 'Dominio';
	$lang['strdomains'] = 'Dominios';
	$lang['strshowalldomains'] = 'Mostrar todos los dominios';
	$lang['strnodomains'] = 'No se encontraron dominios.';
	$lang['strcreatedomain'] = 'Crear dominio';
	$lang['strdomaindropped'] = 'Dominio eliminado.';
	$lang['strdomaindroppedbad'] = 'Fall� al intentar eliminar el dominio.';
	$lang['strconfdropdomain'] = 'Esta seguro que quiere eliminar el dominio "%s"?';
	$lang['strdomainneedsname'] = 'Debe dar un nombre para el dominio.';
	$lang['strdomaincreated'] = 'Dominio creado.';
	$lang['strdomaincreatedbad'] = 'Fall� al intentar crear el dominio.';
	$lang['strdomainaltered'] = 'Dominio modificado.';
	$lang['strdomainalteredbad'] = 'Fall� al intentar modificar el dominio.';

	// Operators
    $lang['stroperator'] = 'Operador';
	$lang['stroperators'] = 'Operadores';
	$lang['strshowalloperators'] = 'Mostrar todos los operadores';
	$lang['strnooperator'] = 'No se encontr� el operador.';
	$lang['strnooperators'] = 'No se encontraron operadores.';
	$lang['strcreateoperator'] = 'Crear Operador';
	$lang['strleftarg'] = 'Tipo de datos del arg. izquierdo';
	$lang['strrightarg'] = 'Tipo de datos del arg. derecho';
	$lang['strcommutator'] = 'Conmutador';
	$lang['strnegator'] = 'Negaci�n';
	$lang['strrestrict'] = 'Restringir';
	$lang['strjoin'] = 'Uni�n';
	$lang['strhashes'] = 'Hashes';
	$lang['strmerges'] = 'Fusiones';
	$lang['strleftsort'] = 'Ordenado izquierdo';
	$lang['strrightsort'] = 'Ordenado derecho';
	$lang['strlessthan'] = 'Menor que';
	$lang['strgreaterthan'] = 'Mayor que';
	$lang['stroperatorneedsname'] = 'Debe darle un nombre al operador.';
	$lang['stroperatorcreated'] = 'Operador creado';
	$lang['stroperatorcreatedbad'] = 'Fall� al intentar crear el operador.';
	$lang['strconfdropoperator'] = '�Est� seguro que quiere eliminar el operador "%s"?';
	$lang['stroperatordropped'] = 'Operador eliminado.';
	$lang['stroperatordroppedbad'] = 'Fall� al intentar eliminar el operador.';

	// Casts
	$lang['strcasts'] = 'Conversi�n de tipos';
	$lang['strnocasts'] = 'No se encontraron conversiones.';
	$lang['strsourcetype'] = 'Tipo inicial';
	$lang['strtargettype'] = 'Tipo final';
	$lang['strimplicit'] = 'Impl�cito';
	$lang['strinassignment'] = 'En asignaci�n';
	$lang['strbinarycompat'] = '(Compatible con binario)';

	// Conversions
	$lang['strconversions'] = 'Conversiones';
	$lang['strnoconversions'] = 'No se encontraron conversiones.';
	$lang['strsourceencoding'] = 'Source encoding';
	$lang['strtargetencoding'] = 'Target encoding';

	// Languages
	$lang['strlanguages'] = 'Lenguajes';
	$lang['strnolanguages'] = 'No se encontraron lenguajes.';
	$lang['strtrusted'] = 'Trusted';

	// Info
	$lang['strnoinfo'] = 'No hay informaci�n disponible.';
	$lang['strreferringtables'] = 'Referring tables';
	$lang['strparenttables'] = 'Parent tables';
	$lang['strchildtables'] = 'Child tables';

	// Aggregates
$lang['straggregate']  =  'Aggregate';
	$lang['straggregates'] = 'Agregadas';
	$lang['strnoaggregates'] = 'No se encontraron agregadas.';
	$lang['stralltypes'] = '(Todos los tipos)';
$lang['straggrtransfn']  =  'Transition function';
	$lang['strcreateaggregate']  =  'Crear aggregada';
$lang['straggrbasetype']  =  'Input data type';
$lang['straggrsfunc']  =  'State transition function';
$lang['straggrstype']  =  'State data type';
$lang['straggrffunc']  =  'Final function';
$lang['straggrinitcond']  =  'Initial condition';
$lang['straggrsortop']  =  'Sort operator';
	$lang['strdropaggregate']  =  'Eliminar aggregada';
$lang['strconfdropaggregate']  =  'Are you sure you want to drop the aggregate &quot;%s&quot;?';
$lang['straggregatedropped']  =  'Aggregate dropped.';
$lang['straggregatedroppedbad']  =  'Aggregate drop failed.';
$lang['stralteraggregate']  =  'Alter aggregate';
$lang['straggraltered']  =  'Aggregate altered.';
$lang['straggralteredbad']  =  'Aggregate alteration failed.';
$lang['straggrneedsname']  =  'You must specify a name for the aggregate';
$lang['straggrneedsbasetype']  =  'You must specify the input data type for the aggregate';
$lang['straggrneedssfunc']  =  'You must specify the name of the state transition function for the aggregate';
$lang['straggrneedsstype']  =  'You must specify the data type for the aggregate\'s state value';
$lang['straggrcreated']  =  'Aggregate created.';
$lang['straggrcreatedbad']  =  'Aggregate creation failed.';
	$lang['straggrshowall']  =  'Mostrar todas las aggregadas';

	// Operator Classes
	$lang['stropclasses'] = 'Clases de operadores';
	$lang['strnoopclasses'] = 'No se encontraron clases de operadores.';
	$lang['straccessmethod'] = 'M�todo de acceso';

	// Stats and performance
	$lang['strrowperf'] = 'Row Performance';
	$lang['strioperf'] = 'I/O Performance';
	$lang['stridxrowperf'] = 'Index Row Performance';
	$lang['stridxioperf'] = 'Index I/O Performance';
	$lang['strpercent'] = '%';
	$lang['strsequential'] = 'Sequential';
	$lang['strscan'] = 'Scan';
	$lang['strread'] = 'Read';
	$lang['strfetch'] = 'Fetch';
	$lang['strheap'] = 'Heap';
	$lang['strtoast'] = 'TOAST';
	$lang['strtoastindex'] = 'TOAST Index';
	$lang['strcache'] = 'Cache';
	$lang['strdisk'] = 'Disk';
	$lang['strrows2'] = 'Rows';

	// Tablespaces
    $lang['strtablespace']  =  'Tablespace';
    $lang['strtablespaces']  =  'Tablespaces';
    $lang['strshowalltablespaces']  =  'Mostrar todos los tablespaces';
    $lang['strnotablespaces']  =  'No se encontraron tablespaces.';
    $lang['strcreatetablespace']  =  'Crear tablespace';
    $lang['strlocation']  =  'Ubicaci�n';
    $lang['strtablespaceneedsname']  =  'Debe darle un nombre al tablespace.';
    $lang['strtablespaceneedsloc']  =  'Debe dar un directorio en donde crear el tablespace.';
    $lang['strtablespacecreated']  =  'Tablespace creado.';
    $lang['strtablespacecreatedbad']  =  'Fall� la creaci�n del tablespace.';
    $lang['strconfdroptablespace']  =  'Esta seguro que quiere eliminar el tablespace "%s"?';
    $lang['strtablespacedropped']  =  'Tablespace eliminado.';
    $lang['strtablespacedroppedbad']  =  'Fall� al intenta eliminar el tablespace.';
    $lang['strtablespacealtered']  =  'Tablespace modificado.';
    $lang['strtablespacealteredbad']  =  'Fall� la modificaci�n del Tablespace.';

	// Slony clusters
$lang['strcluster']  =  'Cluster';
$lang['strnoclusters']  =  'No clusters found.';
$lang['strconfdropcluster']  =  'Are you sure you want to drop cluster "%s"?';
$lang['strclusterdropped']  =  'Cluster dropped.';
$lang['strclusterdroppedbad']  =  'Cluster drop failed.';
$lang['strinitcluster']  =  'Initialize Cluster';
$lang['strclustercreated']  =  'Cluster initialized.';
$lang['strclustercreatedbad']  =  'Cluster initialization failed.';
$lang['strclusterneedsname']  =  'You must give a name for the cluster.';
$lang['strclusterneedsnodeid']  =  'You must give an ID for the local node.';
	
	// Slony nodes
	$lang['strnodes']  =  'Nodos';
	$lang['strnonodes'] = 'No se encontraron los nodos.';
    $lang['strcreatenode']  =  'Crear nodo';
$lang['strid']  =  'ID';
$lang['stractive']  =  'Active';
$lang['strnodecreated']  =  'Node created.';
$lang['strnodecreatedbad']  =  'Node creation failed.';
$lang['strconfdropnode']  =  'Are you sure you want to drop node "%s"?';
$lang['strnodedropped']  =  'Node dropped.';
$lang['strnodedroppedbad']  =  'Node drop failed';
$lang['strfailover']  =  'Filtro';
$lang['strnodefailedover']  =  'Node failed over.';
$lang['strnodefailedoverbad']  =  'Node fail over fail.';
$lang['strstatus']  =  'Status';	
$lang['strhealthy']  =  'Healthy';
$lang['stroutofsync']  =  'Out of Sync';
$lang['strunknown']  =  'Unknown';	

	
	// Slony paths	
    $lang['strpaths']  =  'Rutas';
	$lang['strnopaths'] = 'No se encontraron rutas.';
    $lang['strcreatepath']  =  'Crear ruta';
$lang['strnodename']  =  'Node name';
$lang['strnodeid']  =  'Node ID';
$lang['strconninfo']  =  'Connection string';
$lang['strconnretry']  =  'Seconds before retry to connect';
$lang['strpathneedsconninfo']  =  'You must give a connection string for the path.';
$lang['strpathneedsconnretry']  =  'You must give the number of seconds to wait before retry to connect.';
$lang['strpathcreated']  =  'Path created.';
$lang['strpathcreatedbad']  =  'Path creation failed.';
$lang['strconfdroppath']  =  'Are you sure you want to drop path "%s"?';
$lang['strpathdropped']  =  'Path dropped.';
$lang['strpathdroppedbad']  =  'Path drop failed.';

	// Slony listens
$lang['strlistens']  =  'Listens';
$lang['strnolistens']  =  'No listens found.';
$lang['strcreatelisten']  =  'Create listen';
$lang['strlistencreated']  =  'Listen created.';
$lang['strlistencreatedbad']  =  'Listen creation failed.';
$lang['strconfdroplisten']  =  'Are you sure you want to drop listen "%s"?';
$lang['strlistendropped']  =  'Listen dropped.';
$lang['strlistendroppedbad']  =  'Listen drop failed.';

	// Slony replication sets
	$lang['strrepsets']  =  'Conjuntos de Replicaci�n';
	$lang['strnorepsets'] = 'No se encontraron conjuntos de Replicaci�n.';
	$lang['strcreaterepset']  =  'Crear un Conjunto de Replicaci�n';
$lang['strrepsetcreated']  =  'Replication set created.';
$lang['strrepsetcreatedbad']  =  'Replication set creation failed.';
$lang['strconfdroprepset']  =  'Are you sure you want to drop replication set "%s"?';
$lang['strrepsetdropped']  =  'Replication set dropped.';
$lang['strrepsetdroppedbad']  =  'Replication set drop failed.';
	$lang['strmerge']  =  'Unir';
$lang['strmergeinto']  =  'Merge Into';
$lang['strrepsetmerged']  =  'Replication sets merged.';
$lang['strrepsetmergedbad']  =  'Replication sets merge failed.';
	$lang['strmove']  =  'Mover';
	$lang['strneworigin']  =  'Origen Nuevo';
$lang['strrepsetmoved']  =  'Replication set moved.';
$lang['strrepsetmovedbad']  =  'Replication set move failed.';
	$lang['strnewrepset']  =  'Nuevo Conjunto de Replicaci�n';
$lang['strlock']  =  'Lock';
$lang['strlocked']  =  'Locked';
$lang['strunlock']  =  'Unlock';
$lang['strconflockrepset']  =  'Are you sure you want to lock replication set "%s"?';
$lang['strrepsetlocked']  =  'Replication set locked.';
$lang['strrepsetlockedbad']  =  'Replication set lock failed.';
$lang['strconfunlockrepset']  =  'Are you sure you want to unlock replication set "%s"?';
$lang['strrepsetunlocked']  =  'Replication set unlocked.';
$lang['strrepsetunlockedbad']  =  'Replication set unlock failed.';
$lang['strexecute']  =  'Execute';
$lang['stronlyonnode']  =  'Only on node';
$lang['strddlscript']  =  'DDL Script';
$lang['strscriptneedsbody']  =  'You must supply a script to be executed on all nodes.';
$lang['strscriptexecuted']  =  'Replication set DDL script executed.';
$lang['strscriptexecutedbad']  =  'Failed executing replication set DDL script.';
$lang['strtabletriggerstoretain']  =  'The following triggers will NOT be disabled by Slony:';

	// Slony tables in replication sets
$lang['straddtable']  =  'Add table';
$lang['strtableneedsuniquekey']  =  'Table to be added requires a primary or unique key.';
$lang['strtableaddedtorepset']  =  'Table added to replication set.';
$lang['strtableaddedtorepsetbad']  =  'Failed adding table to replication set.';
$lang['strconfremovetablefromrepset']  =  'Are you sure you want to remove the table "%s" from replication set "%s"?';
$lang['strtableremovedfromrepset']  =  'Table removed from replication set.';
$lang['strtableremovedfromrepsetbad']  =  'Failed to remove table from replication set.';

	// Slony sequences in replication sets
$lang['straddsequence']  =  'Add sequence';
$lang['strsequenceaddedtorepset']  =  'Sequence added to replication set.';
$lang['strsequenceaddedtorepsetbad']  =  'Failed adding sequence to replication set.';
$lang['strconfremovesequencefromrepset']  =  'Are you sure you want to remove the sequence "%s" from replication set "%s"?';
$lang['strsequenceremovedfromrepset']  =  'Sequence removed from replication set.';
$lang['strsequenceremovedfromrepsetbad']  =  'Failed to remove sequence from replication set.';

	// Slony subscriptions
    $lang['strsubscriptions']  =  'Subscripciones';
    $lang['strnosubscriptions']  =  'No se encontraron subscripciones.';

	// Miscellaneous
	$lang['strtopbar'] = '%s corriendo en %s:%s -- Usted est� logueado con usuario "%s", %s';
	$lang['strtimefmt'] = 'd/m/Y, G:i:s';
	$lang['strhelp'] = 'Ayuda';
    $lang['strhelpicon']  =  '?';
    $lang['strlogintitle']  =  'Loguearse a %s';
    $lang['strlogoutmsg']  =  'Saliendo de %s';
    $lang['strloading']  =  'Cargando...';
    $lang['strerrorloading']  =  'Error Cargando';
    $lang['strclicktoreload']  =  'Click para recargar';

	// Autovacuum
	$lang['strautovacuum']  =  'Autovacuum'; 
$lang['strturnedon']  =  'Turned On'; 
$lang['strturnedoff']  =  'Turned Off'; 
    $lang['strenabled']  =  'Habilitado'; 
    $lang['strvacuumbasethreshold']  =  'Umbral de Vacuum'; 
$lang['strvacuumscalefactor']  =  'Vacuum Scale Factor';  
$lang['stranalybasethreshold']  =  'Analyze Base Threshold';  
$lang['stranalyzescalefactor']  =  'Analyze Scale Factor'; 
	$lang['strvacuumcostdelay']  =  'Tiempo de descanso de vacuum'; 
$lang['strvacuumcostlimit']  =  'Vacuum Cost Limit';  

    // Table-level Locks
    $lang['strlocks']  =  'Bloqueos';
    $lang['strtransaction']  =  'ID de transacci�n';
    $lang['strprocessid']  =  'ID de proceso';
    $lang['strmode']  =  'Modo de bloqueo';
    $lang['strislockheld'] = 'Se mantiene el bloqueo?';

	// Prepared transactions
    $lang['strpreparedxacts']  =  'Transacciones preparadas';
    $lang['strxactid']  =  'ID de Transacci�n';
    $lang['strgid']  =  'ID Global';
?>
