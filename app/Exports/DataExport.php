<?php

namespace App\Exports;

use App\Models\Combindata;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Combindata::select("a", "b", "res","x","fres")->get();
    }

    public function headings(): array
    {
        return ["A", "B", "resultat","x","final resultat"];
    }
}
