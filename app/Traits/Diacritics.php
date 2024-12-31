<?php

namespace App\Traits;

trait Diacritics
{
    public function diacritics($string)
    {
        $diacritics = array(
            // Lowercase letters
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ă' => 'a', 'ā' => 'a',
            'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ċ' => 'c',
            'ď' => 'd', 'đ' => 'd',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ě' => 'e', 'ē' => 'e', 'ę' => 'e', 'ė' => 'e',
            'ƒ' => 'f',
            'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g',
            'ĥ' => 'h', 'ħ' => 'h',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i', 'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i',
            'ĵ' => 'j',
            'ķ' => 'k',
            'ĺ' => 'l', 'ļ' => 'l', 'ľ' => 'l', 'ŀ' => 'l', 'ł' => 'l',
            'ñ' => 'n', 'ń' => 'n', 'ņ' => 'n', 'ň' => 'n',
            'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o',
            'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r',
            'ś' => 's', 'š' => 's', 'ş' => 's', 'ș' => 's',
            'ť' => 't', 'ţ' => 't', 'ț' => 't',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ū' => 'u', 'ů' => 'u', 'ű' => 'u', 'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u',
            'ŵ' => 'w',
            'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y',
            'ż' => 'z', 'ź' => 'z', 'ž' => 'z',
            'æ' => 'ae', 'œ' => 'oe', 'ß' => 'ss',

            // Uppercase letters
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ă' => 'A', 'Ā' => 'A',
            'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ċ' => 'C',
            'Ď' => 'D', 'Đ' => 'D',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ě' => 'E', 'Ē' => 'E', 'Ę' => 'E', 'Ė' => 'E',
            'Ĝ' => 'G', 'Ğ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G',
            'Ĥ' => 'H', 'Ħ' => 'H',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
            'Ĵ' => 'J',
            'Ķ' => 'K',
            'Ĺ' => 'L', 'Ļ' => 'L', 'Ľ' => 'L', 'Ŀ' => 'L', 'Ł' => 'L',
            'Ñ' => 'N', 'Ń' => 'N', 'Ņ' => 'N', 'Ň' => 'N',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O',
            'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R',
            'Ś' => 'S', 'Š' => 'S', 'Ş' => 'S', 'Ș' => 'S',
            'Ť' => 'T', 'Ţ' => 'T', 'Ț' => 'T',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ū' => 'U', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
            'Ŵ' => 'W',
            'Ý' => 'Y', 'Ÿ' => 'Y', 'Ŷ' => 'Y',
            'Ż' => 'Z', 'Ź' => 'Z', 'Ž' => 'Z',
            'Æ' => 'AE', 'Œ' => 'OE'
        );

        // Replace diacritics
        $text = strtr($string, $diacritics);

        return $text;
    }

    public function addStreetType($type, $address)
    {
        $types = [
            'Alee' => 'Aleea',
            'Alee I' => 'Aleea I',
            'Alee II' => 'Aleea II',
            'Alee III' => 'Aleea III',
            'Alee IV' => 'Aleea IV',
            'Alee V' => 'Aleea V',
            'Alee VI' => 'Aleea VI',
            'Alee VII' => 'Aleea VII',
            'Alee VIII' => 'Aleea VIII',
            'Bulevard' => 'Bulevardul',
            'Cale' => 'Calea',
            'Camp' => 'Campul',
            'Canal' => 'Canalul',
            'Canton' => 'Cantonul',
            'Cartier' => 'Cartierul',
            'Colonie' => 'Colonia',
            'Curte' => 'Curtea',
            'Drum' => 'Drumul',
            'Esplanada' => 'Esplanada',
            'Fundac' => 'Fundac',
            'Fundatura' => 'Fundatura',
            'Hotar' => 'Hotarul',
            'Intrare' => 'Intrarea',
            'Parc' => 'Parcul',
            'Pasaj' => 'Pasajul',
            'Piata' => 'Piata',
            'Pietonal' => 'Pietonal',
            'Piateta' => 'Piateta',
            'Platou' => 'Platoul',
            'Pod' => 'Podul',
            'Poligon' => 'Poligonul',
            'Poteca' => 'Poteca',
            'Prelungire' => 'Prelungirea',
            'Rampa' => 'Rampa',
            'Scuar' => 'Scuarul',
            'Sir'   => 'Sirul',
            'Sosea' => 'Soseaua',
            'Splai' => 'Splaiul',
            'Strada' => 'Strada',
            'Strada ' => 'Strada',
            'Statia' => 'Statia',
            'Stradela' => 'Stradela',
            'Suis' => 'Suisul',
            'Trecatoare' => 'Trecatoarea',
            'Ulita' => 'Ulita',
            'Vad' => 'Vadul',
            'Varianta' => 'Varianta',
        ];

        return $types[$this->diacritics($type)] . ' ' .$address;
    }
}
