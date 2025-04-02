<?#Сертификат для Android?>
Android (по крайней мере в версиях 2 и 3) не имеет стандартных средств для установки корневых сертификатов.
Поэтому требуется несколько бубнов, чтобы его таки уговорить:
<OL>
<LI>Телефон должен быть root-ован. Любым доступным способом.
<LI>Список доверенных сертификатов лежит в <code>/system/etc/security/cacerts.bks</code>
<LI>Его требуется любым образом перелить на компютер, например через SD-карту:
<OL>
<LI>cp /system/etc/security/cacerts.bks /mnt/sdcard
<LI>Забрать <code>cacerts.bks</code> с SD-карты любым доступным способом
</OL>
<LI>Установить или запустить прямо с <A hRef='http://portecle.sourceforge.net/'>сайта</A> Portecle
<LI>File/Open Keystore File, выбрать скачанный <code>cacerts.bks</code> и указать пустой пароль
<LI>Tools/Import Trusted Certificate, указать файл сертификата (например <A hRef='/ssl/ca.crt'>этот</A>)
<LI>Согласиться со всем
<LI>Ввести осмысленное имя для сертификата, например <code>uxm</code>, или просто незанятый номер
<LI>Повторить 3 предыдущих пункта для всех сертификатов, которые Вы хотите установить
(например для <A hRef='/ssl/uxm.crt'>этого</A> и <A hRef='/ssl/omz.crt'>этого</A>)
<LI>Сохранить полученное - File/Save Keystore
<LI>Вернуть <code>cacerts.bks</code> обратно на SD-карту
<LI>Выполнить магические команды:
<OL>
<LI>su
<LI>mount -o rw,remount /system
<LI>cp /mnt/sdcard/cacerts.bks /system/etc/security
<LI>mount -o ro,remount /system
</OL>
<LI>Перезагрузить Android
<LI>...
<LI>PROFIT!!!
</OL>

<H2>Android 4</H2>
А в Android 4 всё стало ещё проще! :-)
<P />
<LI>Root-доступ всё равно необходим
<LI>Нужно любым образом распаковать <A hRef='uxm4ics.zip'>этот файл</A> в <code>/system/etc/security/cacerts</code>
(там уже лежит много похожих по имени).
<LI>И даже перезагрузка не нужна!
