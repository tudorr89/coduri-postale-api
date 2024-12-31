<?php

namespace App\Services;

class AddressNumberParser
{
    /**
     * Parse a number string into an array of individual numbers and ranges
     *
     * @param string $numberString
     * @return array
     */
    public static function parseNumberString(string $numberString): array
    {
        $parts = array_map('trim', explode(';', $numberString));
        $numbers = [];

        foreach ($parts as $part) {
            // Remove "nr." prefix if exists
            $part = preg_replace('/^nr\.\s*/', '', $part);

            // Handle ranges (e.g., "254-296")
            if (strpos($part, '-') !== false) {
                list($start, $end) = array_map(function($num) {
                    // Remove any non-numeric suffix (e.g., "255-T" becomes "255")
                    return (int) preg_replace('/[^0-9].*$/', '', $num);
                }, explode('-', $part));

                if($end == 0) {
                    $numbers[] = $start;
                } else {
                    // Add all numbers in the range
                    for ($i = $start; $i <= $end; $i++) {
                        $numbers[] = $i;
                    }
                }
            } else {
                // Handle single numbers
                $numbers[] = (int) preg_replace('/[^0-9].*$/', '', $part);
            }
        }

        return array_unique($numbers);
    }
}
