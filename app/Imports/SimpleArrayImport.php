<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SimpleArrayImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // This import class doesn't process data, just returns it
        return $rows;
    }
}
