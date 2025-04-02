<?#���������� ��� Android?>
Android (�� ������� ���� � ������� 2 � 3) �� ����� ����������� ������� ��� ��������� �������� ������������.
������� ��������� ��������� ������, ����� ��� ���� ���������:
<OL>
<LI>������� ������ ���� root-����. ����� ��������� ��������.
<LI>������ ���������� ������������ ����� � <code>/system/etc/security/cacerts.bks</code>
<LI>��� ��������� ����� ������� �������� �� ��������, �������� ����� SD-�����:
<OL>
<LI>cp /system/etc/security/cacerts.bks /mnt/sdcard
<LI>������� <code>cacerts.bks</code> � SD-����� ����� ��������� ��������
</OL>
<LI>���������� ��� ��������� ����� � <A hRef='http://portecle.sourceforge.net/'>�����</A> Portecle
<LI>File/Open Keystore File, ������� ��������� <code>cacerts.bks</code> � ������� ������ ������
<LI>Tools/Import Trusted Certificate, ������� ���� ����������� (�������� <A hRef='/ssl/ca.crt'>����</A>)
<LI>����������� �� ����
<LI>������ ����������� ��� ��� �����������, �������� <code>uxm</code>, ��� ������ ��������� �����
<LI>��������� 3 ���������� ������ ��� ���� ������������, ������� �� ������ ����������
(�������� ��� <A hRef='/ssl/uxm.crt'>�����</A> � <A hRef='/ssl/omz.crt'>�����</A>)
<LI>��������� ���������� - File/Save Keystore
<LI>������� <code>cacerts.bks</code> ������� �� SD-�����
<LI>��������� ���������� �������:
<OL>
<LI>su
<LI>mount -o rw,remount /system
<LI>cp /mnt/sdcard/cacerts.bks /system/etc/security
<LI>mount -o ro,remount /system
</OL>
<LI>������������� Android
<LI>...
<LI>PROFIT!!!
</OL>

<H2>Android 4</H2>
� � Android 4 �� ����� ��� �����! :-)
<P />
<LI>Root-������ �� ����� ���������
<LI>����� ����� ������� ����������� <A hRef='uxm4ics.zip'>���� ����</A> � <code>/system/etc/security/cacerts</code>
(��� ��� ����� ����� ������� �� �����).
<LI>� ���� ������������ �� �����!
