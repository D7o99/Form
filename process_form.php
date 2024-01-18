<?php
require 'vendor/autoload.php'; // تأكد من وجود ملف autoload.php لتحميل المكتبات

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

// استقبال البيانات من النموذج
$name = $_POST['name'];
$phone = $_POST['phone'];
$dropdown = $_POST['dropdown'];

// معالجة ملفات الرفع (يمكنك توسيعها حسب الحاجة)

// عرض البيانات في جدول
echo "<table border='1'>
        <tr>
            <th>الاسم</th>
            <th>رقم الجوال</th>
            <th>قائمة منسدلة</th>
        </tr>
        <tr>
            <td>$name</td>
            <td>$phone</td>
            <td>$dropdown</td>
        </tr>
      </table>";

// تصدير الجدول إلى Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'الاسم')->setCellValue('B1', 'رقم الجوال')->setCellValue('C1', 'قائمة منسدلة');
$sheet->setCellValue('A2', $name)->setCellValue('B2', $phone)->setCellValue('C2', $dropdown);
$excelWriter = new Xlsx($spreadsheet);
$excelWriter->save('exported_data.xlsx');

// طباعة الجدول إلى PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('arial', 'B', 12);
$pdf->writeHTML("<h2>الاسم: $name</h2><h2>رقم الجوال: $phone</h2><h2>قائمة منسدلة: $dropdown</h2>");
$pdf->Output('exported_data.pdf', 'D');
?>