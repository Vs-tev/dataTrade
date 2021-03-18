<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CryptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*  $arr = [
            ["symbol" => "BTCUSD",
            "type" => 'Crypto' 
            ], 
            ["symbol" => "ETHBTC",
            "type" => 'Crypto' 
            ], 
            ["symbol" => "ETHUSD ",
            "type" => 'Crypto' 
            ], 
            ["symbol" => "Crypto10",
            "type" => 'Crypto' 
            ], 
            ["symbol" => "LTCUSD",
            "type" => 'Crypto' 
            ], 
            ["symbol" => "BABUSD",
            "type" => 'Crypto' 
            ], 
            ["symbol" => "XLMUSD",
            "type" => 'Crypto' 
            ], 
            ["symbol" => "ADAUSD",
            "type" => 'Crypto' 
            ],
        ]; */

        $arr = [
        ["symbol" => "Oil",
         "type" => "CFD"
        ], 
		["symbol" => "Heating Oil",
        "type" => "CFD"
        ], 
		["symbol" => "Brent Oil",
        "type" => "CFD"
        ], 
		["symbol" => "Silver",
        "type" => "CFD"
        ], 
		["symbol" => "Gold",
        "type" => "CFD"
        ], 
		["symbol" => "Palladium",
        "type" => "CFD"
        ], 
		["symbol" => "Low Sulphur Gasoil",
        "type" => "CFD"
        ], 
		["symbol" => "Coffee",
        "type" => "CFD"
        ], 
		["symbol" => "Wheat",
        "type" => "CFD"
        ], 
		["symbol" => "Corn",
        "type" => "CFD"
        ], 
		["symbol" => "Natural Gas",
        "type" => "CFD"
        ], 
		["symbol" => "Lean Hogs",
        "type" => "CFD"
        ], 
		["symbol" => "Gasoline",
        "type" => "CFD"
        ], 
		["symbol" => "Copper",
        "type" => "CFD"
        ], 
		["symbol" => "Platinum",
        "type" => "CFD"
        ], 
		["symbol" => "Sugar",
        "type" => "CFD"
        ], 
		["symbol" => "Live Cattle",
        "type" => "CFD"
        ], 
		["symbol" => "Cocoa",
        "type" => "CFD"
        ], 
		["symbol" => "Soybeans",
        "type" => "CFD"
        ], 
		["symbol" => "EUA",
        "type" => "CFD"
        ], 
		["symbol" => "Cotton",
        "type" => "CFD"
        ], 
		["symbol" => "Feeder Cattle",
        "type" => "CFD"
        ],
    ];
        \App\Models\Symbol::insert($arr);
    }
}
