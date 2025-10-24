<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Mpdf\Mpdf;

class Reports extends Controller
{
    public function testPdf()
    {
        // Instantiate mPDF
        $mpdf = new Mpdf();

        // Write simple HTML content
        $mpdf->WriteHTML('<h1>Hello, world!</h1>');

        // Send PDF output inline to browser
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="test.pdf"')
            ->setBody($mpdf->Output('', 'S'));
    }
}
