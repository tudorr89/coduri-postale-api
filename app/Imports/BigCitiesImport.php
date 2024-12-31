<?php

namespace App\Imports;

use App\Models\Number;
use App\Models\Zipcode;
use App\Services\AddressNumberParser;
use App\Traits\Diacritics;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class BigCitiesImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError, WithProgressBar
{
    use Importable, SkipsErrors, SkipsFailures, Diacritics;
    public function model(array $row)
    {
        $numbers = AddressNumberParser::parseNumberString($row['numarbloc']);

        $zipcode = Zipcode::firstOrCreate(['zipcode' => $row['codpostal']],[
            'county' => $this->diacritics($row['judet']),
            'city' => $this->diacritics($row['localitate']),
            'street' => $this->addStreetType($row['tip_artera'], $this->diacritics($row['denumire_artera'])),
            'number' => $row['numarbloc'],
            'zipcode' => $row['codpostal'],
        ]);

        if(count($numbers) > 0) {
            foreach ($numbers as $number) {
                $zipcode->numbers()->create(['number' => $number]);
            }
        }

        return $zipcode;
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
