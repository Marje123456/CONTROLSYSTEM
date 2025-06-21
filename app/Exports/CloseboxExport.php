<?php

namespace App\Exports;

use App\Models\Closebox;
use Maatwebsite\Excel\Concerns\FromCollection;

class CloseboxExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Closebox::all();
    }
}