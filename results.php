<?php

// معالجة المدخلات
$name = $_POST['name'];
$phone = $_POST['phone'];
$list = $_POST['list'];

// إنشاء جدول
$table = "<table border='1'>";
$table .= "<tr><th>الاسم</th><th>رقم الجوال</th><th>القائمة المنسدلة</th></tr>";
$table .= "<tr><td>$name</td><td>$phone</td><td>$list</td></tr>";
$table .= "</table>";

// عرض الجدول
echo $table;

// تصدير الجدول إلى ملف Excel
if (isset($_POST['export_excel'])) {
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=results.xls");
  echo $table;
  exit();
}

// طباعة الجدول على PDF
if (isset($_POST['print_pdf'])) {
  require_once("vendor/autoload.php");
  use Dompdf\Dompdf;

  $dompdf = new Dompdf();
  $dompdf->loadHtml($table);
  $dompdf->setPaper('A4', 'portrait');
  $dompdf->render();
  $dompdf->stream("results.pdf");
  exit();
}

?>
