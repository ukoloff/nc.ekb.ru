<script>
!function(){
setTimeout(init)

function getJ() {
  return document.querySelector('textarea').value
}

function doCopy() {
  navigator.clipboard.writeText(getJ())
  return false
}

function doXLS() {
  var j = JSON.parse(getJ())
  var s = `<html xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns="http://www.w3.org/TR/REC-html40">
<head>
<!--[if gte mso 9]><xml>
<x:ExcelWorkbook>
<x:ExcelWorksheets>
<x:ExcelWorksheet>
<x:Name>Подзразделения</x:Name>
<x:WorksheetOptions>
<x:NoSummaryRowsBelowDetail/>
<x:NoSummaryColumnsRightDetail/>
</x:WorksheetOptions>
</x:ExcelWorksheet>
</x:ExcelWorksheets>
</x:ExcelWorkbook>
</xml><![endif]-->
<meta http-equiv="Content-Type" content='text/html; charset=utf-8' />
<style>
td {
  white-space: nowrap;
}
</style>
</head><body>
<table>
<tr><th>#</th><th>Имя</th><TH>Код</TH><TH>Кол-во</TH><TH>Всего</th></tr>
` + xls(j) + `</table></body></html>`
//  console.log(s)
  // https://stackoverflow.com/a/58356250/6127481  
  var blob = new Blob([s], {type: 'application/vnd.ms-excel'})
  var url = URL.createObjectURL(blob)
  var saver = document.createElementNS("http://www.w3.org/1999/xhtml", "a")
  saver.href = url
  saver.download = 'depts-' + new Date().toISOString().replace(/T.*/, '') + '.xls'
  body = document.body
  body.appendChild(saver)
  saver.dispatchEvent(new MouseEvent("click"))
  body.removeChild(saver)
  URL.revokeObjectURL(url)

  return false
}

function xls(lst, level=0) {
  if (!lst) return ''
  var s = ''
  for (let row of lst) {
    var style = 'mso-outline-parent:collapsed;'
    if (level) style += 'display:none;mso-outline-level:' + level
    s += `<tr style="${style}"<td>${
      level}</td><td>${
      h(row.name)}</td><td>${
      h(row.kod)}</td><td>${
      h(row.n)}</td><td>${
      h(row.total)}</td></tr>
`
    if (row.ch) {
        s += xls(row.ch, level + 1)
    }
  }
  return s
}

function init() {
  document.querySelector('i.fa-li.fa-copy').parentNode.onclick = doCopy
  document.querySelector('i.fa-li.fa-file-excel-o').parentNode.onclick = doXLS
}

var htmlEntities = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }

function h(s) {
  return s == null ? '' : String(s).replace(/[&<>"]/g, e => htmlEntities[e])
}}()
</script>
