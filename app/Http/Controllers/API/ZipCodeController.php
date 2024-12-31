<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZipCodeRequest;
use App\Models\Zipcode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class ZipCodeController extends Controller
{
    private const CACHE_TTL_HOURS = 24;
    private const CACHE_PREFIX = 'zipcode_search_';

    public function __invoke(ZipCodeRequest $request): string
    {
        return Cache::remember(
            $this->generateCacheKey($request),
            now()->addHours(self::CACHE_TTL_HOURS),
            fn () => $this->performSearch($request)
        );
    }

    private function generateCacheKey(ZipCodeRequest $request): string
    {
        $searchParams = [
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'county' => $request->county,
            'street' => $request->street,
            'number' => $request->number,
        ];

        return self::CACHE_PREFIX . md5(json_encode($searchParams));
    }

    private function performSearch(ZipCodeRequest $request): string
    {
        return Zipcode::query()
            ->when(
                $request->zipcode,
                fn (Builder $query) => $query->where('zipcode', $request->zipcode)
            )
            ->when(
                $request->city,
                function (Builder $query) use ($request) {
                    return $query->where('city', $request->city)
                        ->where('county', $request->county)
                        ->where('street', 'LIKE', "%{$request->street}%")
                        ->orWhere(function($q) use ($request) {
                            $parts = explode(' ', $request->street);
                            $reversed = implode(' ', array_reverse($parts));
                            $q->where('street', 'LIKE', '%' . $reversed . '%');
                        })
                        ->when(
                            $request->number,
                            function (Builder $query) use ($request) {
                                $query->WhereHas('numbers', function ($subQuery) use ($request) {
                                    $subQuery->where('number', $request->number);
                                });
                        });
                }
            )
            ->firstOrFail()
            ->toJson(JSON_PRETTY_PRINT);
    }
}
