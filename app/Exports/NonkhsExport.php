<?php

namespace App\Exports;

use App\Models\Nonkhs;
use Maatwebsite\Excel\Concerns\FromCollection;

class NonkhsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Nonkhs::all();
    }
}
