<?php
// namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('currencies')->count() > 0) {
            return;
        }

        \DB::table('currencies')->insert([
            ['short_code' =>'AFN' , 'currency_name' => 'Afghani', 'currency_html_symbol' => '؋' ],
            ['short_code' =>'ALL' , 'currency_name' => 'Lek', 'currency_html_symbol' => 'Lek' ],
            ['short_code' =>'ANG' , 'currency_name' => 'Netherlands Antillian Guilder', 'currency_html_symbol' => 'ƒ' ],
            ['short_code' =>'ARS' , 'currency_name' => 'Argentine Peso', 'currency_html_symbol' => '$' ],
            ['short_code' =>'AUD' , 'currency_name' => 'Australian Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'AWG' , 'currency_name' => 'Aruban Guilder', 'currency_html_symbol' => 'ƒ' ],
            ['short_code' =>'AZN' , 'currency_name' => 'Azerbaijanian Manat', 'currency_html_symbol' => 'ман' ],
            ['short_code' =>'BAM' , 'currency_name' => 'Convertible Marks', 'currency_html_symbol' => 'KM' ],
            ['short_code' => 'BDT', 'currency_name' => 'Bangladeshi Taka', 'currency_html_symbol' => '৳'],
            ['short_code' =>'BBD' , 'currency_name' => 'Barbados Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'BGN' , 'currency_name' => 'Bulgarian Lev', 'currency_html_symbol' => 'лв' ],
            ['short_code' =>'BMD' , 'currency_name' => 'Bermudian Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'BND' , 'currency_name' => 'Brunei Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'BOB' , 'currency_name' => 'BOV Boliviano Mvdol', 'currency_html_symbol' => '$b' ],
            ['short_code' =>'BRL' , 'currency_name' => 'Brazilian Real', 'currency_html_symbol' => 'R$' ],
            ['short_code' =>'BSD' , 'currency_name' => 'Bahamian Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'BWP' , 'currency_name' => 'Pula', 'currency_html_symbol' => 'P' ],
            ['short_code' =>'BYR' , 'currency_name' => 'Belarussian Ruble', 'currency_html_symbol' => '₽' ],
            ['short_code' =>'BZD' , 'currency_name' => 'Belize Dollar', 'currency_html_symbol' => 'BZ$' ],
            ['short_code' =>'CAD' , 'currency_name' => 'Canadian Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'CHF' , 'currency_name' => 'Swiss Franc', 'currency_html_symbol' => 'CHF' ],
            ['short_code' =>'CLP' , 'currency_name' => 'CLF Chilean Peso Unidades de fomento', 'currency_html_symbol' => '$' ],
            ['short_code' =>'CNY' , 'currency_name' => 'Yuan Renminbi', 'currency_html_symbol' => '¥' ],
            ['short_code' =>'COP' , 'currency_name' => 'COU Colombian Peso Unidad de Valor Real', 'currency_html_symbol' => '$' ],
            ['short_code' =>'CRC' , 'currency_name' => 'Costa Rican Colon', 'currency_html_symbol' => '₡' ],
            ['short_code' =>'CUP' , 'currency_name' => 'CUC Cuban Peso Peso Convertible', 'currency_html_symbol' => '₱' ],
            ['short_code' =>'CZK' , 'currency_name' => 'Czech Koruna', 'currency_html_symbol' => 'Kč' ],
            ['short_code' =>'DKK' , 'currency_name' => 'Danish Krone', 'currency_html_symbol' => 'kr' ],
            ['short_code' =>'DOP' , 'currency_name' => 'Dominican Peso', 'currency_html_symbol' => 'RD$' ],
            ['short_code' =>'EGP' , 'currency_name' => 'Egyptian Pound', 'currency_html_symbol' => '£' ],
            ['short_code' =>'EUR' , 'currency_name' => 'Euro', 'currency_html_symbol' => '€' ],
            ['short_code' =>'FJD' , 'currency_name' => 'Fiji Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'FKP' , 'currency_name' => 'Falkland Islands Pound', 'currency_html_symbol' => '£' ],
            ['short_code' =>'GBP' , 'currency_name' => 'Pound Sterling', 'currency_html_symbol' => '£' ],
            ['short_code' =>'GIP' , 'currency_name' => 'Gibraltar Pound', 'currency_html_symbol' => '£' ],
            ['short_code' =>'GTQ' , 'currency_name' => 'Quetzal', 'currency_html_symbol' => 'Q' ],
            ['short_code' =>'GYD' , 'currency_name' => 'Guyana Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'HKD' , 'currency_name' => 'Hong Kong Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'HNL' , 'currency_name' => 'Lempira', 'currency_html_symbol' => 'L' ],
            ['short_code' =>'HRK' , 'currency_name' => 'Croatian Kuna', 'currency_html_symbol' => 'kn' ],
            ['short_code' =>'HUF' , 'currency_name' => 'Forint', 'currency_html_symbol' => 'Ft' ],
            ['short_code' =>'IDR' , 'currency_name' => 'Rupiah', 'currency_html_symbol' => 'Rp' ],
            ['short_code' =>'ILS' , 'currency_name' => 'New Israeli Sheqel', 'currency_html_symbol' => '₪' ],
            ['short_code' =>'IRR' , 'currency_name' => 'Iranian Rial', 'currency_html_symbol' => '﷼' ],
            ['short_code' =>'ISK' , 'currency_name' => 'Iceland Krona', 'currency_html_symbol' => 'kr' ],
            ['short_code' =>'JMD' , 'currency_name' => 'Jamaican Dollar', 'currency_html_symbol' => 'J$' ],
            ['short_code' =>'JPY' , 'currency_name' => 'Yen', 'currency_html_symbol' => '¥' ],
            ['short_code' =>'KGS' , 'currency_name' => 'Som', 'currency_html_symbol' => 'лв' ],
            ['short_code' =>'KHR' , 'currency_name' => 'Riel', 'currency_html_symbol' => '៛' ],
            ['short_code' =>'KPW' , 'currency_name' => 'North Korean Won', 'currency_html_symbol' => '₩' ],
            ['short_code' =>'KRW' , 'currency_name' => 'Won', 'currency_html_symbol' => '₩' ],
            ['short_code' =>'KYD' , 'currency_name' => 'Cayman Islands Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'KZT' , 'currency_name' => 'Tenge', 'currency_html_symbol' => 'лв' ],
            ['short_code' =>'LAK' , 'currency_name' => 'Kip', 'currency_html_symbol' => '₭' ],
            ['short_code' =>'LBP' , 'currency_name' => 'Lebanese Pound', 'currency_html_symbol' => '£' ],
            ['short_code' =>'LKR' , 'currency_name' => 'Sri Lanka Rupee', 'currency_html_symbol' => '₨' ],
            ['short_code' =>'LRD' , 'currency_name' => 'Liberian Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'LTL' , 'currency_name' => 'Lithuanian Litas', 'currency_html_symbol' => 'Lt' ],
            ['short_code' =>'LVL' , 'currency_name' => 'Latvian Lats', 'currency_html_symbol' => 'Ls' ],
            ['short_code' =>'MKD' , 'currency_name' => 'Denar', 'currency_html_symbol' => 'ден' ],
            ['short_code' =>'MNT' , 'currency_name' => 'Tugrik', 'currency_html_symbol' => '₮' ],
            ['short_code' =>'MUR' , 'currency_name' => 'Mauritius Rupee', 'currency_html_symbol' => '₨' ],
            ['short_code' =>'MXN' , 'currency_name' => 'MXV Mexican Peso Mexican Unidad de Inversion (UDI]', 'currency_html_symbol' => '$' ],
            ['short_code' =>'MYR' , 'currency_name' => 'Malaysian Ringgit', 'currency_html_symbol' => 'RM' ],
            ['short_code' =>'MZN' , 'currency_name' => 'Metical', 'currency_html_symbol' => 'MT' ],
            ['short_code' =>'NGN' , 'currency_name' => 'Naira', 'currency_html_symbol' => '₦' ],
            ['short_code' =>'NIO' , 'currency_name' => 'Cordoba Oro', 'currency_html_symbol' => 'C$' ],
            ['short_code' =>'NOK' , 'currency_name' => 'Norwegian Krone', 'currency_html_symbol' => 'kr' ],
            ['short_code' =>'NPR' , 'currency_name' => 'Nepalese Rupee', 'currency_html_symbol' => '₨' ],
            ['short_code' =>'NZD' , 'currency_name' => 'New Zealand Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'OMR' , 'currency_name' => 'Rial Omani', 'currency_html_symbol' => '﷼' ],
            ['short_code' =>'PAB' , 'currency_name' => 'USD Balboa US Dollar', 'currency_html_symbol' => 'B/.' ],
            ['short_code' =>'PEN' , 'currency_name' => 'Nuevo Sol', 'currency_html_symbol' => 'S/.' ],
            ['short_code' =>'PHP' , 'currency_name' => 'Philippine Peso', 'currency_html_symbol' => 'Php' ],
            ['short_code' =>'PKR' , 'currency_name' => 'Pakistan Rupee', 'currency_html_symbol' => '₨' ],
            ['short_code' =>'PLN' , 'currency_name' => 'Zloty', 'currency_html_symbol' => 'zł' ],
            ['short_code' =>'PYG' , 'currency_name' => 'Guarani', 'currency_html_symbol' => 'Gs' ],
            ['short_code' =>'QAR' , 'currency_name' => 'Qatari Rial', 'currency_html_symbol' => '﷼' ],
            ['short_code' =>'RON' , 'currency_name' => 'New Leu', 'currency_html_symbol' => 'lei' ],
            ['short_code' =>'RSD' , 'currency_name' => 'Serbian Dinar', 'currency_html_symbol' => 'Дин.' ],
            ['short_code' =>'RUB' , 'currency_name' => 'Russian Ruble', 'currency_html_symbol' => 'руб' ],
            ['short_code' =>'SAR' , 'currency_name' => 'Saudi Riyal', 'currency_html_symbol' => '﷼' ],
            ['short_code' =>'SBD' , 'currency_name' => 'Solomon Islands Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'SCR' , 'currency_name' => 'Seychelles Rupee', 'currency_html_symbol' => '₨' ],
            ['short_code' =>'SEK' , 'currency_name' => 'Swedish Krona', 'currency_html_symbol' => 'kr' ],
            ['short_code' =>'SGD' , 'currency_name' => 'Singapore Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'SHP' , 'currency_name' => 'Saint Helena Pound', 'currency_html_symbol' => '£' ],
            ['short_code' =>'SOS' , 'currency_name' => 'Somali Shilling', 'currency_html_symbol' => 'S' ],
            ['short_code' =>'SRD' , 'currency_name' => 'Surinam Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'SVC' , 'currency_name' => 'USD El Salvador Colon US Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'SYP' , 'currency_name' => 'Syrian Pound', 'currency_html_symbol' => '£' ],
            ['short_code' =>'THB' , 'currency_name' => 'Baht', 'currency_html_symbol' => '฿' ],
            ['short_code' =>'TRY' , 'currency_name' => 'Turkish Lira', 'currency_html_symbol' => 'TL' ],
            ['short_code' =>'TTD' , 'currency_name' => 'Trinidad and Tobago Dollar', 'currency_html_symbol' => 'TT$' ],
            ['short_code' =>'TWD' , 'currency_name' => 'New Taiwan Dollar', 'currency_html_symbol' => 'NT$' ],
            ['short_code' =>'UAH' , 'currency_name' => 'Hryvnia', 'currency_html_symbol' => '₴' ],
            ['short_code' =>'USD' , 'currency_name' => 'US Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'UYU' , 'currency_name' => 'UYI Uruguay Peso en Unidades Indexadas', 'currency_html_symbol' => '$U' ],
            ['short_code' =>'UZS' , 'currency_name' => 'Uzbekistan Sum', 'currency_html_symbol' => 'лв' ],
            ['short_code' =>'VEF' , 'currency_name' => 'Bolivar Fuerte', 'currency_html_symbol' => 'Bs' ],
            ['short_code' =>'VND' , 'currency_name' => 'Dong', 'currency_html_symbol' => '₫' ],
            ['short_code' =>'XCD' , 'currency_name' => 'East Caribbean Dollar', 'currency_html_symbol' => '$' ],
            ['short_code' =>'YER' , 'currency_name' => 'Yemeni Rial', 'currency_html_symbol' => '﷼' ],
            ['short_code' =>'ZAR' , 'currency_name' => 'Rand', 'currency_html_symbol' => 'R' ],
        ]);
    }
}
