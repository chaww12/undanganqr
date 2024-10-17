<?php

namespace App\Exports;

use App\Models\Tamu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TamuExport implements FromCollection, WithHeadings
{
    protected $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * Return the collection of tamu
     */
    public function collection()
    {
        return Tamu::where('registrasi', 1)
            ->where('idevent', $this->eventId)
            ->select('nama', 'jenistamu', 'instansi', 'alamat')
            ->get();
    }

    /**
     * Headings for the Excel file
     */
    public function headings(): array
    {
        return ['Nama', 'Jenis Tamu', 'Instansi', 'Alamat'];
    }
}

