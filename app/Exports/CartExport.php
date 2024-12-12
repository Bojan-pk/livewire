<?php

namespace App\Exports;

use App\Models\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CartExport implements FromView, WithStyles, WithProperties
{
    protected $cart;

    public function __construct(array $cart)
    {
        $this->cart = $cart;
    }

    public function view(): View
    {
        return view('exports.cart', [
            'cart' => $this->cart
        ]);
    }

    public function properties(): array
    {
        return [
            'creator' => 'Your Name',
            'title' => 'Cart Export',
            'description' => 'Exported cart details in landscape A4 format',
        ];
    }

    // Postavke za stilove u Excel-u
    public function styles(Worksheet $sheet)
{
    // Podesite orijentaciju stranice na A4 Landscape
    $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
    $sheet->getPageMargins()->setTop(0.5);
    $sheet->getPageMargins()->setRight(0.5);
    $sheet->getPageMargins()->setLeft(0.5);
    $sheet->getPageMargins()->setBottom(0.5);

    // Dodavanje naslova tabele u A1
    $sheet->mergeCells('A1:J1'); // Merge cells from A1 to J1
    $sheet->getStyle('A1')->getFont()->setBold(true); // Podebljani tekst
    $sheet->getStyle('A1')->getAlignment()->setHorizontal('center'); // Centriranje naslova
    $sheet->getStyle('A1')->getAlignment()->setVertical('center'); // Vertikalno centriranje
    $sheet->getStyle('A1')->getFont()->setSize(16); // Veličina fonta naslova

    // Postavljanje razmaka između naslova i tabele
    $sheet->getRowDimension(1)->setRowHeight(30); // Povećajte visinu prvog reda (naslov)
    $sheet->getStyle('A1')->getFont()->setName('Times New Roman'); // Postavite font na Times New Roman

    // Postavite font na Times New Roman za sve ostale ćelije
    $sheet->getStyle('A2:J' . (count($this->cart) + 2))
          ->getFont()
          ->setName('Times New Roman');

    // Stilovi za zaglavlje tabele
    $sheet->getStyle('A2:J2')->getFont()->setBold(true); // Zaglavlje tabele
    $sheet->getStyle('A2:J2')->getAlignment()->setHorizontal('center'); // Centriranje zaglavlja
    $sheet->getStyle('A2:J2')->getAlignment()->setVertical('center');
    $sheet->getStyle('A2:J2')->getAlignment()->setWrapText(true); // Automatski prelazak u novi red

    // Dodavanje poprečnih linija za svaki red
    $rowCount = count($this->cart) + 2; // Ukupan broj redova sa zaglavljem
    for ($i = 2; $i <= $rowCount; $i++) {
        $sheet->getStyle('A' . $i . ':J' . $i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    // Dodavanje uzdužnih linija (ivica između kolona)
    $columnCount = 10; // Broj kolona (A-J)
    for ($i = 1; $i <= $columnCount; $i++) {
        $sheet->getStyle(chr(64 + $i) . '2:' . chr(64 + $i) . $rowCount)
              ->getBorders()
              ->getRight()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    // Dodavanje boldovanog okvira oko cele tabele
    $sheet->getStyle('A2:J' . $rowCount)->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK); // Boldovan okvir oko cele tabele

    // Postavljanje širine kolona
    $sheet->getColumnDimension('A')->setWidth(8);
    $sheet->getColumnDimension('B')->setWidth(40);
    $sheet->getColumnDimension('C')->setWidth(8);
    $sheet->getColumnDimension('D')->setWidth(8);
    $sheet->getColumnDimension('E')->setWidth(8);
    $sheet->getColumnDimension('F')->setWidth(8);
    $sheet->getColumnDimension('G')->setWidth(8);
    $sheet->getColumnDimension('H')->setWidth(8);
    $sheet->getColumnDimension('I')->setWidth(15);
    $sheet->getColumnDimension('J')->setWidth(20);

    return [];
}

    
    
    
}
