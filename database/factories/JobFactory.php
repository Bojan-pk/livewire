<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    // Dodaj statički brojač za praćenje trenutnog indeksa
    protected static $descriptionIndex = 0;
    protected static $codeIndex = 1000; // Početna vrednost za 'code'

    public function definition(): array
    {

        $jobDescriptions = [
            'Razvijajte i održavajte web aplikacije koristeći moderne tehnologije.',
            'Upravljajte projektima, osiguravajući da budu završeni na vreme i u okviru budžeta.',
            'Analizirajte kompleksne skupove podataka i pružite uvide i preporuke.',
            'Razvijajte marketinške strategije za promociju proizvoda i usluga.',
            'Identifikujte potencijalne klijente i prodajte proizvode i usluge.',
            'Nadzirite regrutaciju i integraciju novih zaposlenih.',
            'Sprovodite finansijsku analizu i pripremite izveštaje.',
            'Pružajte podršku i asistenciju korisnicima.',
            'Kreirajte vizuelni sadržaj za marketinške materijale.',
            'Pružajte tehničku podršku i rešavajte probleme IT sistema.',
            'Kreirajte i uređujte sadržaj za veb sajtove i marketinške materijale.',
            'Razvijajte i upravljajte strategijama i planovima proizvoda.',
            'Analizirajte poslovne procese i pružite preporuke.',
            'Nadzirite dnevne operacije kako bi osigurali efikasnost.',
            'Dizajnirajte korisničke interfejse i poboljšavajte korisničko iskustvo.',
            'Pripremajte finansijske izveštaje i upravljajte računovodstvenim evidencijama.',
            'Održavajte i konfigurišite mrežnu infrastrukturu.',
            'Upravljajte nalozima na društvenim mrežama i kreirajte sadržaj.',
            'Testirajte softverske aplikacije kako biste otkrili greške i probleme.',
            'Razvijajte algoritme i modele za analizu podataka.',
            'Sprovodite intervju i pronalazite potencijalne kandidate za otvorene pozicije.',
            'Osigurajte usklađenost sa zakonodavnim i regulatornim zahtevima.',
            'Planirajte i sprovodite marketinške kampanje.',
            'Razvijajte softverska rešenja za različite poslovne potrebe.',
            'Koordinirajte i nadzirite građevinske projekte.',
            'Pružajte konsultantske usluge klijentima u vezi sa poslovnim strategijama.',
            'Sprovodite istraživanje tržišta i analize.',
            'Upravljajte finansijskim planiranjem i budžetiranjem kompanije.',
            'Nadzirite razvoj i implementaciju IT projekata.',
            'Upravljajte odnosima sa ključnim klijentima i zainteresovanim stranama.',
            'Sprovodite obuke za zaposlene.',
            'Dizajnirajte i implementirajte mere sajber bezbednosti.',
            'Koordinirajte logistiku i operacije u lancu snabdevanja.',
            'Razvijajte i implementirajte HR politike i procedure.',
            'Kreirajte i upravljajte marketinškim kampanjama.',
            'Pružajte pravne savete i podršku kompaniji.',
            'Nadzirajte razvoj novih proizvoda i usluga.',
            'Upravljajte i optimizujte online prisustvo kompanije.',
            'Razvijajte i održavajte mobilne aplikacije.',
            'Planirajte i organizujte korporativne događaje.',
            'Sprovodite interne revizije i preglede.',
            'Pružajte korisničku podršku putem telefona i e-maila.',
            'Razvijajte programe obuke za zaposlene.',
            'Nadzirajte upravljanje objektima kompanije.',
            'Kreirajte i upravljajte digitalnim marketinškim strategijama.',
            'Sprovodite procene rizika i upravljajte smanjenjem rizika.',
            'Razvijajte i održavajte e-commerce platforme.',
            'Pružajte podršku za hardverske i softverske probleme.',
            'Upravljajte internom i eksternom komunikacijom kompanije.',
            'Razvijajte i implementirajte procedure za kontrolu kvaliteta.',
            'Analizirajte i izveštavajte o performansama prodaje.',
            'Koordinirajte i upravljajte lansiranjem proizvoda.',
            'Razvijajte finansijske modele i prognoze.',
            'Pružajte podršku krajnjim korisnicima softverskih aplikacija.',
            'Upravljajte brendiranjem i identitetom kompanije.',
            'Sprovodite analize konkurencije i istraživanje tržišta.',
            'Razvijajte strategije za rast i proširenje poslovanja.',
            'Pružajte administrativnu podršku izvršnim direktorima.',
            'Nadzirajte upravljanje inventarom kompanije.',
            'Razvijajte i implementirajte materijale za obuku.',
            'Upravljajte odnosima sa dobavljačima i partnerima.',
            'Kreirajte i održavajte dokumentaciju za poslovne procese.',
            'Sprovodite procene uticaja na životnu sredinu.',
            'Upravljajte programima lojalnosti kupaca.',
            'Razvijajte i implementirajte CRM strategije.',
            'Pružajte podršku za probleme vezane za sigurnost mreže.',
            'Nadzirajte upravljanje nekretninama kompanije.',
            'Razvijajte i održavajte odnose sa medijskim kućama.',
            'Sprovodite evaluacije performansi i ocene.',
            'Upravljajte programima beneficija za zaposlene.',
            'Razvijajte strategije za poboljšanje zadovoljstva korisnika.',
            'Pružajte podršku za usluge cloud computinga.',
            'Upravljajte marketinškim kampanjama putem e-maila.',
            'Nadzirajte razvoj veb sajta kompanije.',
            'Sprovodite finansijske revizije i provere usklađenosti.',
            'Pružajte podršku za sisteme video konferencija.',
            'Razvijajte i implementirajte metodologije upravljanja projektima.',
            'Upravljajte naporima u oblasti odnosa sa javnošću.',
            'Kreirajte i upravljajte sadržajem za biltene.',
            'Pružajte podršku za sisteme za upravljanje preduzećem.',
            'Razvijajte i implementirajte strategije za upravljanje promenama.',
            'Upravljajte IT infrastrukturom i uslugama kompanije.',
            'Kreirajte i upravljajte sadržajem za korporativne blogove.',
            'Pružajte podršku za tehnologije virtualizacije.',
            'Razvijajte i implementirajte programe društvene odgovornosti.',
            'Upravljajte strategijama za akviziciju talenata.',
            'Kreirajte i upravljajte sadržajem za obuke.',
            'Pružajte podršku za rezervnu kopiju i oporavak podataka.',
            'Razvijajte i implementirajte strategije lanca snabdevanja.',
            'Upravljajte procesima nabavke kompanije.',
            'Nadzirajte upravljanje flotom vozila kompanije.',
            'Razvijajte i implementirajte programe zdravlja i sigurnosti.',
            'Pružajte podršku za životni ciklus razvoja softvera.',
            'Upravljajte procesima finansijskog izveštavanja kompanije.',
            'Kreirajte i upravljajte sadržajem za internu komunikaciju.',
            'Pružajte podršku za upravljanje mobilnim uređajima.',
            'Razvijajte i implementirajte planove kontinuiteta poslovanja.',
            'Upravljajte procesima pregovaranja ugovora.',
            'Nadzirajte upravljanje IT sredstvima kompanije.',
            'Razvijajte i implementirajte programe angažovanja zaposlenih.',
            'Pružajte podršku za usluge hostovanja veba.',
            'Upravljajte procesima obračuna plata.',
            'Kreirajte i upravljajte sadržajem za oglašavanje na društvenim mrežama.',
            'Pružajte podršku za sisteme za upravljanje bazama podataka.',
        ];
        

        // Dobij trenutni opis i uvećaj brojač
        $description = $jobDescriptions[self::$descriptionIndex];
        self::$descriptionIndex = (self::$descriptionIndex + 1) % count($jobDescriptions);

        // Dobij trenutni kod i uvećaj brojač
        $code = 'P' . self::$codeIndex;
        self::$codeIndex++;


        return [
            'name' => $description,
            'code' => $code,
        ];
    }
}
