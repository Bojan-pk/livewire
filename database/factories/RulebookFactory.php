<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RulebookFactory extends Factory
{
   
    protected static $index = 0;

    public function definition(): array
    {
        $fms = [
            'Programer za razvoj web aplikacija',
            'Menadžer projekta',
            'Analitičar podataka',
            'Marketing menadžer',
            'Prodajni predstavnik',
            'Specijalista za ljudske resurse',
            'Finansijski analitičar',
            'Korisnička podrška',
            'Grafički dizajner',
            'IT tehničar',
            'Pisac sadržaja',
            'Menadžer proizvoda',
            'Poslovni analitičar',
            'Operativni menadžer',
            'UI/UX dizajner',
            'Računovođa',
            'Mrežni administrator',
            'Menadžer društvenih mreža',
            'Tester softvera',
            'Inženjer za podatke',
            'Regruter',
            'Pravni savetnik',
            'Menadžer kampanja',
            'Softverski inženjer',
            'Građevinski inženjer',
            'Konsultant',
            'Istraživač tržišta',
            'Finansijski menadžer',
            'IT menadžer projekta',
            'Menadžer klijenata',
            'Trener',
            'Specijalista za sajber bezbednost',
            'Logistički koordinator',
            'HR menadžer',
            'Menadžer za oglašavanje',
            'Pravni savetnik',
            'Menadžer za razvoj proizvoda',
            'SEO specijalista',
            'Razvijač mobilnih aplikacija',
            'Event menadžer',
            'Interni revizor',
            'Korisnička podrška (telefonska i email)',
            'Trener zaposlenih',
            'Menadžer objekata',
            'Digitalni marketing menadžer',
            'Specijalista za upravljanje rizikom',
            'E-commerce menadžer',
            'Specijalista za IT podršku',
            'PR menadžer',
            'Menadžer za upravljanje kvalitetom',
        ];

        $fcs=['pt','mj','pp','pk','stv','zk','kk','zs','kg','bg'];

        $fm = $fms[rand(0,49)];
        $fc=$fcs[rand(0,9)];
        self::$index= (self::$index+ 1) % count($fms);

        return [
           'rb'=> self::$index,
            'fm'=>$fm,
            'fc_sso'=>$fc,
            'pg_bb'=>'aaa',
            'note'=>'napomema',
            //'rulebooks_table_id'=>1,
            'regulation_id'=>1

        ];
    }
}
