<?php

namespace App\Imports;

use App\Models\Zipcode;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class ZipcodeImport implements WithProgressBar, SkipsOnFailure, SkipsOnError, WithMultipleSheets
{
    use Importable, SkipsFailures, SkipsErrors;

    public function sheets(): array
    {
        return [
            0 => (new BucharestImport())->withOutput($this->output),
            1 => (new BigCitiesImport())->withOutput($this->output),
            2 => (new SmallCitiesImport())->withOutput($this->output),
        ];
    }

}
