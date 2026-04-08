<?php

namespace App\Exports;
use App\Models\Pet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PetsExport implements FromView, WithColumnWidths, WithStyles
{
    
public function view(): View
{
    return view('pets.excel', [
        'pets' => Pet::all()
    ]);
}

public function columnWidths(): array
{
    return [
        'A' => 5,
        'B' => 10,  
        'C' => 20,            
        'D' => 20,            
        'E' => 15,            
        'F' => 10,            
        'G' => 10,            
        'H' => 20,            
        'I' => 20,            
        'J' => 30,            
        'K' => 10,            
        'L' => 10,            
    ];
}

public function styles(Worksheet $sheet)
{
    return [
        1 => ['font' => ['bold' => true, 'size' => 16]],
    ];
}

}
