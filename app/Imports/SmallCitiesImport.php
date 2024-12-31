<?php

namespace App\Imports;

use App\Models\Zipcode;
use App\Traits\Diacritics;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class SmallCitiesImport implements ToModel, SkipsOnFailure, SkipsOnError, WithValidation, WithHeadingRow, WithProgressBar
{
    use Importable, SkipsErrors, SkipsFailures, Diacritics;
    public function model(array $row)
    {
        return new Zipcode([
            'county' => $this->diacritics($row['judet']),
            'city' => $this->diacritics($row['localitate']),
            'street' => '',
            'street_type' => '',
            'number' => '',
            'zipcode' => $row['codpostal'],
        ]);
    }

    public function rules(): array
    {
        return [
            'zipcode' => 'unique:zipcodes,zipcode',
        ];
    }

    public function onError(\Throwable $e)
    {
        Log::info('Cant insert into DB: '.$e->getMessage());
    }
}
