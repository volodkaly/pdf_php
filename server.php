<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $courseID = htmlspecialchars($_POST['courseID']) ?? '';
    $courseName = htmlspecialchars($_POST['courseName']) ?? '';
    $studentName = htmlspecialchars($_POST['studentName']) ?? '';
    $graduationDate = htmlspecialchars($_POST['graduationDate']) ?? '';

    function mb_ucwords($str)
    {
        $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
        return $str;
    }

    $courseID = preg_replace('/\s+/', ' ', $courseID);
    $studentName = preg_replace('/\s+/', ' ', $studentName);
    $studentName = mb_ucwords($studentName);

    if (empty($courseID) || empty($courseName) || empty($studentName) || empty($graduationDate)) {
        $error = urlencode("All_fields_are_required.");
        $queryString = http_build_query([
            'error' => $error,
            'courseID' => $courseID,
            'courseName' => $courseName,
            'studentName' => $studentName,
            'graduationDate' => $graduationDate,
        ]);
        header("Location: index.php?$queryString");
        exit;
    }

    $url = "https://example.com/certificates/$courseID";
    $qrCode = new QrCode($url);
    $writer = new PngWriter();
    $qrCodeData = $writer->write($qrCode)->getString();
    $qrCodeBase64 = base64_encode($qrCodeData);

    $dompdf = new Dompdf();

    $html = "
        <html>
        <head>
            <style>
                body { font-family: 'DejaVu Sans', sans-serif; }
                .certificate { text-align: center; border: 10px solid #787878; padding: 50px; }
                .certificate h1 { font-size: 50px; }
                .certificate p { font-size: 30px; }
                .qr{
                    position: absolute;
                    bottom: 20px;
                    right: 20px;
                    width: 150px;
                    height: 150px;
                }
            </style>
        </head>
        <body>
            <div class='certificate'>
                <h1>Certificate of Completion</h1>
                <p>This is to certify that</p>
                <h2>$studentName</h2>
                <p>has successfully completed the course</p>
                <h2>$courseName</h2>
                <p>Course ID: $courseID</p>
                <p>Date of Completion: $graduationDate</p>
            </div>
            <div class='qr-code'>
            <img src='data:image/png;base64,$qrCodeBase64' alt='QR Code' class='qr'/>
        </div>
        </body>
        </html>
    ";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("certificate.pdf", array("Attachment" => 0));
    exit;
}
