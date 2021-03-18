<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IndicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
                
                ["symbol" => "AEX VOLATILITY INDEX"], 
                ["symbol" => "AEX25 INDEX"], 
                ["symbol" => "ALL ORDINARIES INDEX"], 
                ["symbol" => "AMX-INDEX"], 
                ["symbol" => "ASCX-INDEX"], 
                ["symbol" => "BCN TOP-5"], 
                ["symbol" => "BEL MID INDEX"], 
                ["symbol" => "BEL SMALL INDEX"], 
                ["symbol" => "BEL20 INDEX"], 
                ["symbol" => "CAC 40 EQUAL WEIGH"], 
                ["symbol" => "CAC ALL SHARES"], 
                ["symbol" => "CAC ALL-TRADABLE"], 
                ["symbol" => "CAC LARGE 60"], 
                ["symbol" => "CAC MID & SMALL"], 
                ["symbol" => "CAC MID 60"], 
                ["symbol" => "CAC NEXT 20"], 
                ["symbol" => "CAC SMALL"], 
                ["symbol" => "CAC40 INDEX"], 
                ["symbol" => "CAC40 LEVERAGE"], 
                ["symbol" => "CAC40 VOLATILITY INDEX"], 
                ["symbol" => "CDAX PERF INDEX"], 
                ["symbol" => "CLASSIC ALL SH. TR"], 
                ["symbol" => "DAX30 PERF INDEX"], 
                ["symbol" => "DIVDAX PR"], 
                ["symbol" => "ESTOXX PRICE EUR INDEX"], 
                ["symbol" => "ESTOXX50 PRICE EUR INDEX"], 
                ["symbol" => "ESTX AUT&PRT EUR (PRICE)"], 
                ["symbol" => "ESTX BANKS EUR (PRICE)"], 
                ["symbol" => "ESTX BAS RES EUR (PRICE)"], 
                ["symbol" => "ESTX CHEM EUR (PRICE)"], 
                ["symbol" => "ESTX CNS&MAT EUR (PRICE)"], 
                ["symbol" => "ESTX FD&BVR EUR (PRICE)"], 
                ["symbol" => "ESTX FIN SVCS EUR (PRICE)"], 
                ["symbol" => "ESTX HEA CARE EUR (PRICE)"], 
                ["symbol" => "ESTX INDUS GD EUR (PRICE)"], 
                ["symbol" => "ESTX INSUR EUR (PRICE)"], 
                ["symbol" => "ESTX MEDIA EUR (PRICE)"], 
                ["symbol" => "ESTX OIL&GAS EUR (PRICE)"], 
                ["symbol" => "ESTX SELECT DIV 30 EUR (PRICE)"], 
                ["symbol" => "ESTX TECH EUR (PRICE)"], 
                ["symbol" => "ESTX TELECOM EUR (PRICE)"], 
                ["symbol" => "ESTX UTIL EUR (PRICE)"], 
                ["symbol" => "EURONEXT 100"], 
                ["symbol" => "FIDELITY NASDAQ COMPOSITE TRACKING STOC"], 
                ["symbol" => "FTSE EURO TOP 100"], 
                ["symbol" => "FTSE4GOODIBX"], 
                ["symbol" => "FTSEUROFIRST 100"], 
                ["symbol" => "FTSEUROFIRST 80"], 
                ["symbol" => "GENERAL STD.TR"], 
                ["symbol" => "GER.ENTREPRE.GEX.TR."], 
                ["symbol" => "HDAX110 PERF INDEX"], 
                ["symbol" => "IBEX CAP NET"], 
                ["symbol" => "IBEX DIVIDEN"], 
                ["symbol" => "IBEX DIVNETO"], 
                ["symbol" => "IBEX IMPACTO"], 
                ["symbol" => "IBEX INVX2"], 
                ["symbol" => "IBEX INVX3"], 
                ["symbol" => "IBEX INVX5"], 
                ["symbol" => "IBEX MAB ALL SHARE"], 
                ["symbol" => "IBEX MEDIUM"], 
                ["symbol" => "IBEX SMALL C"], 
                ["symbol" => "IBEX TOP DIV"], 
                ["symbol" => "IBEX X2"], 
                ["symbol" => "IBEX X3"], 
                ["symbol" => "IBEX35 CAP INDEX"], 
                ["symbol" => "IBEX35 INDEX"], 
                ["symbol" => "IBEXX2 BRUTO"], 
                ["symbol" => "IBEXX2 NET"], 
                ["symbol" => "IBEXX3 NET"], 
                ["symbol" => "IBEXX5 NET"], 
                ["symbol" => "ICELAND ALL-SHARE PI"], 
                ["symbol" => "IGBM"], 
                ["symbol" => "IVO 10 F"], 
                ["symbol" => "IVO 10 ST"], 
                ["symbol" => "IVO 12 F"], 
                ["symbol" => "IVO 12 ST"], 
                ["symbol" => "IVO 15 F"], 
                ["symbol" => "IVO 15 ST"], 
                ["symbol" => "IVO 18 F"], 
                ["symbol" => "IVO 18 ST"], 
                ["symbol" => "LATIBEX AS"], 
                ["symbol" => "LATIBEX BRAS"], 
                ["symbol" => "LATIBEX TOP"], 
                ["symbol" => "LC 100 EUROPE"], 
                ["symbol" => "MDAX50 PERF INDEX"], 
                ["symbol" => "NASDAQ BANK INDEX"], 
                ["symbol" => "NASDAQ BIOTECHNOLOGY INDEX"], 
                ["symbol" => "NASDAQ COMPOSITE INDEX"], 
                ["symbol" => "NASDAQ COMPUTER INDEX"], 
                ["symbol" => "NASDAQ CTA INTERNET INDEX"], 
                ["symbol" => "NASDAQ FINANCIAL 100 INDEX"], 
                ["symbol" => "NASDAQ INDUSTRIAL INDEX"], 
                ["symbol" => "NASDAQ INSURANCE INDEX"], 
                ["symbol" => "NASDAQ OMX RUSSIA 15"], 
                ["symbol" => "NASDAQ REAL ESTATE AND OTHER FINANCIAL"], 
                ["symbol" => "NASDAQ TELECOM INDEX"], 
                ["symbol" => "NASDAQ TRANSPORTATION INDEX"], 
                ["symbol" => "NASDAQ-100 VOLATILITY INDEX"], 
                ["symbol" => "NASDAQ100 INDEX"], 
                ["symbol" => "NEXT 150"], 
                ["symbol" => "NIKKEI 225"], 
                ["symbol" => "OMX COPENHAGEN 20"], 
                ["symbol" => "OMX COPENHAGEN_PI"], 
                ["symbol" => "OMX HELSINKI 25"], 
                ["symbol" => "OMX HELSINKI CAP_PI"], 
                ["symbol" => "OMX HELSINKI_PI"], 
                ["symbol" => "OMX NORDIC 40"], 
                ["symbol" => "OMX OSLO 20 GI"], 
                ["symbol" => "OMX OSLO 20 PI"], 
                ["symbol" => "OMX RIGA_GI"], 
                ["symbol" => "OMX STOCKHOLM 30"], 
                ["symbol" => "OMX STOCKHOLM_PI"], 
                ["symbol" => "OMX TALLINN_GI"], 
                ["symbol" => "OMX VILNIUS_GI"], 
                ["symbol" => "PRIME ALL SH. TR"], 
                ["symbol" => "PRT BE INDEX"], 
                ["symbol" => "PRT FR INDEX"], 
                ["symbol" => "PRT NL INDEX"], 
                ["symbol" => "PRT PT INDEX"], 
                ["symbol" => "PSI20 INDEX"], 
                ["symbol" => "S&P 1000"], 
                ["symbol" => "S&P 400"], 
                ["symbol" => "S&P 500 COMMUNICATION SERVICES"], 
                ["symbol" => "S&P 500 ENERGY"], 
                ["symbol" => "S&P 500 EQUAL WEIGHTED"], 
                ["symbol" => "S&P 500 FINANCIALS"], 
                ["symbol" => "S&P 500 GROWTH"], 
                ["symbol" => "S&P 500 NONUS DOLLAR ER"], 
                ["symbol" => "S&P 500 VALUE"], 
                ["symbol" => "S&P 600"], 
                ["symbol" => "S&P ADR"], 
                ["symbol" => "S&P COMPOSITE 1500"], 
                ["symbol" => "S&P EURO"], 
                ["symbol" => "S&P EUROPE 350"], 
                ["symbol" => "S&P EUROPE 350 COMMUNICATION SERV. SEC"], 
                ["symbol" => "S&P EUROPE 350 FINANCIALS SECTOR"], 
                ["symbol" => "S&P EUROPE 350 INFO TECH SECTOR"], 
                ["symbol" => "S&P GLOB 1200 COMMUNICATION SERV. SECT"], 
                ["symbol" => "S&P GLOB 1200 CONS. DISCRETIONARY SECT"], 
                ["symbol" => "S&P GLOB 1200 CONS. STAPLES SECTOR"], 
                ["symbol" => "S&P GLOB 1200 INFO TECH SECTOR"], 
                ["symbol" => "S&P GLOBAL 1200"], 
                ["symbol" => "S&P GLOBAL 1200 ENERGY SECTOR"], 
                ["symbol" => "S&P GLOBAL 1200 FINANCIALS SECTOR"], 
                ["symbol" => "S&P GLOBAL 1200 HEALTH CARE SECTOR"], 
                ["symbol" => "S&P GLOBAL 1200 INDUSTRIALS SECTOR"], 
                ["symbol" => "S&P GLOBAL 1200 MATERIALS SECTOR"], 
                ["symbol" => "S&P GLOBAL 1200 UTILITIES SECTOR"], 
                ["symbol" => "S&P100 INDEX"], 
                ["symbol" => "S&P500 INDEX"], 
                ["symbol" => "S&P900 INDEX"], 
                ["symbol" => "SBF 120"], 
                ["symbol" => "SCHWAB 1000"], 
                ["symbol" => "SDAX50 PERF INDEX"], 
                ["symbol" => "SHORTDAX TR"], 
                ["symbol" => "SHORTDAX X2 TR"], 
                ["symbol" => "SMI20 INDEX"], 
                ["symbol" => "STOCKHOLM BENCHMARK_GI"], 
                ["symbol" => "STOXX50 PRICE EUR INDEX"], 
                ["symbol" => "STOXX600 PRICE EUR INDEX"], 
                ["symbol" => "STX EU ENLARG 15 EUR (PRICE)"], 
                ["symbol" => "STX EU ENLARG TM EUR (PRICE)"], 
                ["symbol" => "STX ND 30 EUR (PRICE)"], 
                ["symbol" => "STXE 600 AUT&PRT EUR (PRICE)"], 
                ["symbol" => "STXE 600 BANKS EUR (PRICE)"], 
                ["symbol" => "STXE 600 BAS RES EUR (PRICE)"], 
                ["symbol" => "STXE 600 CHEM EUR (PRICE)"], 
                ["symbol" => "STXE 600 CNS&MAT EUR (PRICE)"], 
                ["symbol" => "STXE 600 FD&BVR EUR (PRICE)"], 
                ["symbol" => "STXE 600 FIN SVCS EUR (PRICE)"], 
                ["symbol" => "STXE 600 HEA CARE EUR (PRICE)"], 
                ["symbol" => "STXE 600 INDUS GD EUR (PRICE)"], 
                ["symbol" => "STXE 600 INSUR EUR (PRICE)"], 
                ["symbol" => "STXE 600 MEDIA EUR (PRICE)"], 
                ["symbol" => "STXE 600 OIL&GAS EUR (PRICE)"], 
                ["symbol" => "STXE 600 TECH EUR (PRICE)"], 
                ["symbol" => "STXE 600 TELECOM EUR (PRICE)"], 
                ["symbol" => "STXE 600 UTIL EUR (PRICE)"], 
                ["symbol" => "TECDAX30 INDEX"], 
                ["symbol" => "TECH ALL SHARE PERF INDEX"], 
                ["symbol" => "VOLATILITY NASDAQ 100"],
        ];
        \App\Models\Symbol::insert($arr);
        
    }
}
