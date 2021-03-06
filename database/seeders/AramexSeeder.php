<?php

namespace Database\Seeders;

use App\Models\DeliveryCompaniesCity;
use App\Models\DeliveryCompaniesCountry;
use App\Models\DeliveryCompanyArea;
use Carbon\Carbon;
use ExtremeSa\Aramex\Aramex;
use Illuminate\Database\Seeder;

class AramexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = Aramex::fetchCountries()->run();
        $cities = Aramex::fetchStates()->setCountryCode('AE')->run();

        if ($cities->isSuccessful()) {
            foreach ($cities->getStates() as $city) {
                $deliveryCity = DeliveryCompaniesCity::whereCityName($city->getName())->first();
                if (!$deliveryCity) {
                    $deliveryCity = new DeliveryCompaniesCity();

                    $deliveryCity->delivery_company_id = 1;
                    $deliveryCity->city_name = $city->getName();
                    $deliveryCity->country_code = 'AE';
                }
                $deliveryCity->last_fetched_at = Carbon::now();
                $deliveryCity->save();
            }
        }

        if ($countries->isSuccessful()) {
            foreach ($countries->getCountries() as $country) {
                $deliveryCountry = DeliveryCompaniesCountry::whereName($country->getName())->first();
                if (!$deliveryCountry) {
                    $deliveryCountry = new DeliveryCompaniesCountry();
                    $deliveryCountry->delivery_company_id = 1;
                    $deliveryCountry->code = $country->getCode();
                    $deliveryCountry->name = $country->getName();
                    $deliveryCountry->iso_code = $country->getIsoCode();
                    $deliveryCountry->state_required = $country->getStateRequired();
                    $deliveryCountry->post_code_required = $country->getPostCodeRequired();
                    $deliveryCountry->internation_calling_number = $country->getInternationalCallingNumber();
                }
                $deliveryCountry->last_fetched_at = Carbon::now();
                $deliveryCountry->save();
            }
        }

        $this->aramexAreas();
    }


    private function aramexAreas() {
        $arr = [
            [
                'name' => 'Abu Dhabi',
                'location_code' => 'AUH',
                'entity' => 'AUH',
                'areas' => [
                        "Abu Al Abyad Island",
                        "Abu Dhabi International Airport",
                        "Airport Road",
                        "Ajban Farms",
                        "Al Adla",
                        "Al Aman",
                        "Al Bahia",
                        "Al Bandar",
                        "Al Bateen",
                        "Al Dabiya",
                        "Al Dana",
                        "Al Danah",
                        "Al Dhafra",
                        "Al Dharfrah",
                        "Al Faya",
                        "Al Forsan Village",
                        "Al Ghadeer",
                        "Al Gharbia",
                        "Al Ghazal Golf Club",
                        "Al Haffar",
                        "Al Hamra",
                        "Al Jubail Island",
                        "Al Khateem",
                        "Al Khubeirah",
                        "Al Kifefah",
                        "Al Lissaily",
                        "Al Madina Al Riyadiya",
                        "Al Mafraq Industrial Area",
                        "Al Maiarid",
                        "Al Manhal",
                        "Al Mania",
                        "Al Maqta",
                        "Al Marfa",
                        "Al Markaziyah",
                        "Al Maryah Island",
                        "Al Me'rad",
                        "Al Mina",
                        "Al Mirfa",
                        "Al Muntazah",
                        "Al Mushrif",
                        "Al Muzoon",
                        "Al Nahda East",
                        "Al Nahda West",
                        "Al Nahyan",
                        "Al Naser Street",
                        "Al Qurm",
                        "Al Raha",
                        "Al Rahba",
                        "Al Ras Al Akhdar",
                        "Al Rayyana",
                        "Al Razeen",
                        "Al Reef",
                        "Al Reem Island",
                        "Al Rowdah Al Zaab",
                        "Al Rumaila",
                        "Al Safarat",
                        "Al Samha",
                        "Al Seef",
                        "Al Shahama",
                        "Al Shahama Old",
                        "Al Shaleela",
                        "Al Shamkha East",
                        "Al Shamkha South",
                        "Al Shawamekh",
                        "Al Shuwaib",
                        "Al Taweelah",
                        "Al Thurayya",
                        "Al Wahdah",
                        "Al Wathba North",
                        "Al Wathba South",
                        "Al Zaab",
                        "Al Zahiyah",
                        "Al Zeina",
                        "Baniyas East",
                        "Baniyas West",
                        "Bawabat Al Sharq",
                        "Bida Zayed",
                        "Bu Ghar",
                        "Bu Hasa",
                        "Dalma Island",
                        "Delma Street",
                        "Electra Street",
                        "Ghantoot",
                        "Ghayati",
                        "Gheweifat",
                        "Grand Mosque District",
                        "Habshan",
                        "Hadabat Al Zaafaran",
                        "Hamdan Street",
                        "Hamim",
                        "ICAD 1",
                        "ICAD 2",
                        "ICAD 3",
                        "Jananah Island",
                        "Jebel Dhanna",
                        "Karamah (Abu Dhabi)",
                        "Khaleej Ul Arab Street",
                        "Khalidiyah",
                        "Khalifa City A",
                        "Khalifa City B",
                        "Khor Al-Raha",
                        "Liwa Street",
                        "Liwa Western Region",
                        "Lulu Island",
                        "Madinat Zayed (City Area)",
                        "Madinat Zayed (Western Region)",
                        "Mafraq Workers City",
                        "Mahawi",
                        "Manasir",
                        "Mangrove Village",
                        "Masdar City",
                        "Mazayed Village",
                        "Mohammed Bin Zayed City",
                        "Motor World",
                        "Muroor Street",
                        "Musaffah Shabia 10",
                        "Musaffah Shabia 11",
                        "Musaffah Shabia 12",
                        "Musaffah Shabia 9",
                        "Mussafah Industrial Area M1",
                        "Mussafah Industrial Area M10",
                        "Mussafah Industrial Area M11",
                        "Mussafah Industrial Area M12",
                        "Mussafah Industrial Area M13",
                        "Mussafah Industrial Area M14",
                        "Mussafah Industrial Area M15",
                        "Mussafah Industrial Area M16",
                        "Mussafah Industrial Area M17",
                        "Mussafah Industrial Area M18",
                        "Mussafah Industrial Area M19",
                        "Mussafah Industrial Area M2",
                        "Mussafah Industrial Area M20",
                        "Mussafah Industrial Area M21",
                        "Mussafah Industrial Area M22",
                        "Mussafah Industrial Area M23",
                        "Mussafah Industrial Area M24",
                        "Mussafah Industrial Area M25",
                        "Mussafah Industrial Area M26",
                        "Mussafah Industrial Area M27",
                        "Mussafah Industrial Area M28",
                        "Mussafah Industrial Area M29",
                        "Mussafah Industrial Area M3",
                        "Mussafah Industrial Area M30",
                        "Mussafah Industrial Area M31",
                        "Mussafah Industrial Area M32",
                        "Mussafah Industrial Area M33",
                        "Mussafah Industrial Area M34",
                        "Mussafah Industrial Area M35",
                        "Mussafah Industrial Area M36",
                        "Mussafah Industrial Area M37",
                        "Mussafah Industrial Area M38",
                        "Mussafah Industrial Area M39",
                        "Mussafah Industrial Area M4",
                        "Mussafah Industrial Area M40",
                        "Mussafah Industrial Area M41",
                        "Mussafah Industrial Area M42",
                        "Mussafah Industrial Area M43",
                        "Mussafah Industrial Area M44",
                        "Mussafah Industrial Area M45",
                        "Mussafah Industrial Area M46",
                        "Mussafah Industrial Area M5",
                        "Mussafah Industrial Area M6",
                        "Mussafah Industrial Area M7",
                        "Mussafah Industrial Area M8",
                        "Mussafah Industrial Area M9",
                        "Mussafah Shabiya",
                        "Najda street",
                        "New Al Falah",
                        "New Al Nahda",
                        "Old Al Falah",
                        "Other",
                        "Port Zayed",
                        "Qareen Al Aish",
                        "Qasr Al Bahr",
                        "Qutuf",
                        "Ras Ghurb Island",
                        "Rawadat Al Reef",
                        "Ruwais",
                        "Saadiyat Island",
                        "Salam City",
                        "Salam street",
                        "Sas Al Nakhl",
                        "Shakhbout City",
                        "Sila",
                        "Southern Marina Village",
                        "Tarif",
                        "Tourist Club Area (TCA)",
                        "Umm Al Ashtan",
                        "Yas Island East",
                        "Yas Island West",
                        "Yas Marina",
                        "Zayed City",
                        "Zayed Military City",
                        "Zayed Sports City",
                    ],
            ],
            [
                'name' => 'Ajman',
                'location_code' => 'AJM',
                'entity' => 'DXB',
                'areas' => [
                    "Ajman Free Zone",
                    "Ajman Marina",
                    "Ajman Meadows",
                    "Ajman Villas",
                    "Al Alya",
                    "Al Bahya",
                    "Al bustan",
                    "Al Butain",
                    "Al Hamidiya",
                    "Al Helio 1",
                    "Al Helio 2",
                    "Al Helio City",
                    "Al Humaideya 1",
                    "Al Humaideya 2",
                    "Al Jurf",
                    "Al Jurf 1",
                    "Al Jurf 2",
                    "Al Jurf Industrial Area 1",
                    "Al Jurf Industrial Area 2",
                    "Al Jurf Industrial Area 3",
                    "Al Karama (Ajman)",
                    "Al Manama",
                    "Al Muntazi 1",
                    "Al Muntazi 2",
                    "Al Muwaihat 1",
                    "Al Muwaihat 2",
                    "Al Muwaihat 3",
                    "Al Nakheel",
                    "Al Nuamiya",
                    "Al Owan",
                    "Al Raqaib 1",
                    "Al Raqaib 2",
                    "Al Rashidiya",
                    "Al rawdha 1",
                    "Al Rawdha 2",
                    "Al Rawdha 3",
                    "Al Rumailah",
                    "Al Safia",
                    "Al Sawan",
                    "Al Tallah 1",
                    "Al Tallah 2",
                    "Al Zahra",
                    "Al Zahya",
                    "Al Zawrah",
                    "Al Zorah",
                    "Al-Zarah",
                    "Emirates City",
                    "Fewa Ajman",
                    "Green City",
                    "Hamdiya - Jarf",
                    "Hamriya Free Zone",
                    "Hamriya Town",
                    "Industrial Area 1",
                    "Industrial Area 2",
                    "Liwara",
                    "Masfout",
                    "Mishrif City",
                    "Mishrif Villas",
                    "Musheirif",
                    "Muwaihath",
                    "Naemiyah",
                    "New Industrial Area",
                    "New Industrial City",
                    "Other"
                ],
            ],
            [
                'name' => 'Al Ain',
                'location_code' => 'AAN',
                'entity' => 'DXB',
                'areas' => [
                    "Abu Samra",
                    "Al Ain Hospital",
                    "Al Ain Industrial Area",
                    "Al Ain International Airport",
                    "Al Aqabiya",
                    "Al Badiya Park",
                    "Al Bateen",
                    "Al Dhahir",
                    "Al Dharmaa",
                    "Al Faqa",
                    "Al Foaa",
                    "Al Grayye",
                    "Al hayer",
                    "Al Hili",
                    "Al Jahili",
                    "Al Jimi",
                    "Al Khabisi",
                    "Al Khazna",
                    "Al Khrair",
                    "Al Maqam",
                    "Al Markhaniya",
                    "Al Masoudi",
                    "Al Mnaizfah",
                    "Al Murabaa",
                    "Al Murabba",
                    "Al Mutaredh",
                    "Al Mutaredh Oasis",
                    "Al Mutawa'a",
                    "Al Muwaiji",
                    "Al Nabghah",
                    "Al Neyadat",
                    "Al Qattara",
                    "Al Qisais",
                    "Al Quaa Area",
                    "Al Ruwaikah",
                    "Al Saad",
                    "Al Salamat",
                    "Al Sarooj",
                    "Al Shaaibah",
                    "Al Shwaib",
                    "Al touba",
                    "Al Towayya",
                    "Al Wagan",
                    "Al Yahar",
                    "Al Yahar North",
                    "Al Yahar South",
                    "Asherj",
                    "Ayn al Faidah",
                    "Bida Bin Ammar",
                    "Central District",
                    "Defence",
                    "Falaj Hazzaa",
                    "Fun City",
                    "Gafat Al- Nayyar",
                    "Gharebah",
                    "Green Mubazzarah",
                    "Hai Khalid",
                    "Hilli Archaeological Park",
                    "Industrial Area",
                    "Jabel Hafeet",
                    "Jiza't Wraigah",
                    "Khatm Al Shikla",
                    "Kuwaitat",
                    "Majlood",
                    "Masaken",
                    "Mazyad",
                    "Nahil",
                    "Neima",
                    "New Manasir",
                    "Other",
                    "Oud Al Toba",
                    "Oud Bin Sag-Han",
                    "Remah",
                    "Sanaya",
                    "Sha'ab Al Ashkher",
                    "Shareat Al Muwaiji",
                    "Sheikh Tahnoon Stadium Sport Club",
                    "Sweihan",
                    "Tawam",
                    "Ummghafa",
                    "Zakher",
                    "Zoo"
                ],
            ],
            [
                'name' => 'Dubai',
                'location_code' => 'DXB',
                'entity' => 'DXB',
                'areas' => [
                    "Abu Hail ( Deira )",
                    "Al Awir 1",
                    "Al Awir 2",
                    "Al Bada",
                    "Al Baraha ( Deira )",
                    "Al Bararri",
                    "Al Barsha 1",
                    "Al Barsha 2",
                    "Al Barsha 3",
                    "Al Barsha South 1",
                    "Al Barsha South 2",
                    "Al Barsha South 3",
                    "Al Buteen",
                    "Al Dhagaya",
                    "Al Furjan",
                    "Al Garhoud",
                    "Al Ghubaiba",
                    "Al Habtoor City",
                    "Al Hamriya ( Deira )",
                    "Al Hamriya Port ( Deira )",
                    "Al Hudaiba",
                    "Al Jaddaf",
                    "Al Jaffiliya",
                    "Al Jafiliya",
                    "Al Karama (Dubai)",
                    "Al Khabaisi ( Deira )",
                    "Al Khwaneej 1",
                    "Al Khwaneej 2",
                    "Al Kifaf",
                    "Al Lisali",
                    "Al Mamzar ( Deira )",
                    "Al Manara",
                    "Al Mankhool",
                    "Al Merkad",
                    "Al Mina",
                    "Al Mizhar 1",
                    "Al Mizhar 2",
                    "Al Muraqqabat ( Deira )",
                    "Al Murar ( Deira )",
                    "Al Muteena ( Deira )",
                    "Al Nahda 1",
                    "Al Nahda 2",
                    "Al Nasr",
                    "Al Qudra",
                    "Al Quoz 1",
                    "Al Quoz 2",
                    "Al Quoz 3",
                    "Al Quoz 4",
                    "Al Quoz Industrial 1",
                    "Al Quoz Industrial 2",
                    "Al Quoz Industrial 3",
                    "Al Quoz Industrial 4",
                    "Al Qusais 1",
                    "Al Qusais 2",
                    "Al Qusais 3",
                    "Al Qusais Industrial 1",
                    "Al Qusais Industrial 2",
                    "Al Qusais Industrial 3",
                    "Al Qusais Industrial 4",
                    "Al Qusais Industrial 5",
                    "Al Raffa",
                    "Al Ras ( Deira )",
                    "Al Rashidiya",
                    "Al Reem 1",
                    "Al Reem 2",
                    "Al Reem 3",
                    "Al Rigga ( Deira )",
                    "Al Ruwayya",
                    "Al Sabkha ( Deira )",
                    "Al Safa 1",
                    "Al Safa 2",
                    "Al Safouh 1",
                    "Al Safouh 2",
                    "Al Satwa",
                    "Al Shindagha",
                    "Al Souq Al Kabeer",
                    "Al Tammam",
                    "Al Twar 1",
                    "Al Twar 2",
                    "Al Twar 3",
                    "Al Waha",
                    "Al Waheda ( Deira )",
                    "Al Warqaa 1",
                    "Al Warqaa 2",
                    "Al Warqaa 3",
                    "Al Warqaa 4",
                    "Al Warqaa 5",
                    "Al Wasl",
                    "Arabian Ranches 1",
                    "Arabian Ranches 2",
                    "Arjan",
                    "Ayal Nasir",
                    "Baniyas ( Deira )",
                    "Barsha Heights (TECOM)",
                    "Bu Kadra",
                    "Bur Dubai",
                    "Burjuman",
                    "Business Bay",
                    "City of Arabia",
                    "City of Arabia",
                    "Damac Hills",
                    "Deira Corniche",
                    "DIFC - Dubai International Financial Center",
                    "DIP - Dubai Investment Park 1",
                    "DIP - Dubai Investment Park 2",
                    "Discovery Gardens",
                    "Downtown Burj Dubai",
                    "Downtown Jebel Ali",
                    "Dubai Academic City",
                    "Dubai Design District (D3)",
                    "Dubai Festival City",
                    "Dubai Healthcare City",
                    "Dubai Heritage Vision",
                    "Dubai Industrial City",
                    "Dubai International Airport",
                    "Dubai international Endurance City",
                    "Dubai Internet City",
                    "Dubai Knowledge Village",
                    "Dubai Land",
                    "Dubai Lifestyle City",
                    "Dubai Logistic City (DLC)",
                    "Dubai Mall",
                    "Dubai Marina (Marsa Dubai)",
                    "Dubai Maritime City",
                    "Dubai Media City",
                    "Dubai Motor City",
                    "Dubai Outlet Mall",
                    "Dubai Outsource Zone",
                    "Dubai Park",
                    "Dubai Production City",
                    "Dubai Silicon Oasis",
                    "Dubai South",
                    "Dubai Sports City (DSC)",
                    "Dubai Studio City",
                    "Dubai Waterfront",
                    "Dubai World Central (DWC)",
                    "DWC - International Airport",
                    "Emirates Hill 1",
                    "Emirates Hill 2",
                    "Emirates Hill 3",
                    "Emirates Hill 4",
                    "Falcon City of Wonders",
                    "Gold Souk ( Deira )",
                    "Golf City",
                    "Green Community East",
                    "Green Community Village",
                    "Hatta",
                    "Hor Al Anz ( Deira )",
                    "Hor Al Anz East ( Deira )",
                    "IMPZ - International Media Production Zone",
                    "International City",
                    "JAFZA - Jebel Ali Free Zone North",
                    "JAFZA - Jebel Ali Free Zone South",
                    "Jebel Ali Conservation Area",
                    "Jebel Ali Gardens",
                    "Jebel Ali Industrial",
                    "Jebel Ali Race Course",
                    "Jebel Ali Village",
                    "Jumeirah 1",
                    "Jumeirah 2",
                    "Jumeirah 3",
                    "Jumeirah Beach Residency (JBR)",
                    "Jumeirah Heights",
                    "Jumeirah Islands",
                    "Jumeirah Lakes Towers (JLT)",
                    "Jumeirah Park",
                    "Jumeirah Village Circle (JVC)",
                    "Jumeirah Village Triangle (JVT)",
                    "Lahbab",
                    "Layan",
                    "Liwan",
                    "Majan",
                    "Mena Jebel Ali",
                    "Meydan",
                    "Mira Oasis",
                    "Mirdif",
                    "Mohammed Bin Rashid Gardens",
                    "Mudon",
                    "Muhaisanah 1",
                    "Muhaisanah 2",
                    "Muhaisanah 3",
                    "Muhaisanah 4",
                    "Mushrif",
                    "Nad Al Hammar",
                    "Nad Al Sheba 1",
                    "Nad Al Sheba 2",
                    "Nad Al Sheba 3",
                    "Nad Al Sheba 4",
                    "Nad Shamma",
                    "Naif ( Deira )",
                    "National Industries Park (NIP)",
                    "Other",
                    "Oud Al Muteena",
                    " Oud Al Muteena 1",
                    "Oud Al Muteena 2",
                    "Oud Metha",
                    "Palm Deira",
                    "Palm Jebel Ali",
                    "Palm Jumeira",
                    "Port Rashid",
                    "Port Saeed ( Deira )",
                    "Ras Al Khor",
                    "Ras Al Khor Industrial 1",
                    "Ras Al Khor Industrial 2",
                    "Ras Al Khor Industrial 3",
                    "Remraam",
                    "Rigga Al Buteen",
                    "Sonapur",
                    "Technology Park",
                    "The Centro",
                    "The Galleries",
                    "The Gardens",
                    "The Greens",
                    "The Lagoons",
                    "The Sunstainable City",
                    "Tiger Woods Dubai",
                    "Trade Centre 1",
                    "Trade Centre 2",
                    "Umm Al Sheif",
                    "Umm Hurair 1",
                    "Umm Hurair 2",
                    "Umm Ramool",
                    "Umm Suqeim 1",
                    "Umm Suqeim 2",
                    "Umm Suqeim 3",
                    "University Village (Al Ruwaiya)",
                    "Uptown Mirdif",
                    "Wadi Alamardi",
                    "Warsan 1",
                    "Warsan 2",
                    "Zaabeel 1",
                    "Zaabeel 2"
                ],
            ],
            [
                'name' => 'Fujairah',
                'location_code' => 'FUJ',
                'entity' => 'DXB',
                'areas' => [
                    "Al Aqah",
                    "Al badiya",
                    "Al Baladiya",
                    "Al bithna",
                    "Al Faseel",
                    "Al Gurfa",
                    "Al Halah",
                    "Al Hayl",
                    "Al Ittihad",
                    "Al Jaber Tower",
                    "Al Mahatta",
                    "Al Owaid",
                    "Al Qurayyah",
                    "Al Taween",
                    "Al Wurayah Valley",
                    "Al-Ghail",
                    "Anajaimat",
                    "Bidiyah",
                    "Corniche Street",
                    "Dadna",
                    "Dahir",
                    "Dibba",
                    "Dibba Al-Hisn",
                    "EId Mussalla Rd",
                    "Friday Market",
                    "Fujairah Etisalat",
                    "Fujairah Football Club",
                    "Fujairah Free Zone 1",
                    "Fujairah Free Zone 2",
                    "Fujairah Free Zone 3(Al hail)",
                    "Fujairah Heritage",
                    "Fujairah Hospital",
                    "Fujairah Muncipality",
                    "Fujairah Port",
                    "Fujairah Tower",
                    "Fujairah Trade Center",
                    "Ghub",
                    "Industrial Area",
                    "Kalba",
                    "Khor Fakkan",
                    "Luluyah Beach",
                    "Madhab",
                    "Manama",
                    "Masafi",
                    "Merashid",
                    "Mina Al Fajer",
                    "Murbah beach",
                    "Other",
                    "Qidfa",
                    "Rughaylat",
                    "Sakamkam New",
                    "Sakamkam Old",
                    "Sharm",
                    "Skamkam",
                    "Tawban",
                    "Taweelah",
                    "Town Centre",
                    "Zubara Beach"
                ],
            ],
            [
                'name' => 'Ras Al Khaimah',
                'location_code' => 'RKT',
                'entity' => 'DXB',
                'areas' => [
                    "Adhan",
                    "Adhen Village",
                    "Airport Road",
                    "Al Dhait",
                    "Al Fahlain",
                    "Al Fulayyah",
                    "Al Ghabah",
                    "Al Ghail",
                    "Al Ghashban",
                    "Al Hamra",
                    "Al Hulaylah",
                    "Al Jazeera",
                    "Al Juwais",
                    "Al Kharran",
                    "Al Mahamm",
                    "Al Masafirah",
                    "Al Mataf",
                    "Al Naslah",
                    "Al Nudood",
                    "Al Qurum",
                    "Al Qusaidat",
                    "Al Quwayz",
                    "Al Rams",
                    "Al Sall",
                    "Al Soor",
                    "Al Turfa",
                    "Al Uraibi",
                    "Al Usayli",
                    "Ar Rafa'ah",
                    "As Sur",
                    "Ash Sha-aam",
                    "Athabat",
                    "Awanat",
                    "Baqal",
                    "Corniche",
                    "Dafan Al Khor",
                    "Daftah",
                    "Dahan",
                    "Digdaga",
                    "Habsab",
                    "Khatt",
                    "Khor Khwair",
                    "Khuzam",
                    "Liwa Badr",
                    "Maghribiyah",
                    "Mamourah",
                    "Mina' Saqr",
                    "Mudfak",
                    "Munay",
                    "Nakheel",
                    "Other",
                    "RAK Maritime City",
                    "Ras al selaab",
                    "Seih Al Burairat",
                    "Seih Al Ghubb",
                    "Seih Al Qusaidat",
                    "Seih Al Uraibi",
                    "Sidroh",
                    "Suhaim",
                    "Al Hayr"
                ],
            ],
            [
                'name' => 'Sharjah',
                'location_code' => 'SHJ',
                'entity' => 'DXB',
                'areas' => [
                    "Abu Shagara",
                    "Al Abar",
                    "Al Azra",
                    "Al Badieya",
                    "Al Bu Daniq",
                    "Al Buteena",
                    "Al Darari",
                    "Al Dhaid",
                    "Al Falah Suburb",
                    "Al Falaj",
                    "Al Faya",
                    "Al Ghafia",
                    "Al Ghubaiba",
                    "Al Ghuwair",
                    "Al Goaz",
                    "Al Hamriya",
                    "Al Hamriya Freezone",
                    "Al Hayrah",
                    "Al Hazana",
                    "Al Jazzat",
                    "Al Jubail",
                    "Al Jurainah 1",
                    "Al Jurainah 2",
                    "Al Jurainah 3",
                    "Al Jurainah 4",
                    "Al Khan",
                    "Al Khashfah",
                    "Al Khezamia",
                    "Al Layyeh Suburb",
                    "Al Madam",
                    "Al Mahatah",
                    "Al Majaz",
                    "Al Manakh",
                    "Al Manazel",
                    "Al Mareija",
                    "Al Mirgab",
                    "Al Mujarrah",
                    "Al Muntazah",
                    "Al Musalla",
                    "Al Muwafjah",
                    "Al Nahda",
                    "Al Nasseriya",
                    "Al Nekhailat",
                    "Al Noof 1",
                    "Al Noof 2",
                    "Al Noof 3",
                    "Al Noof 4",
                    "Al Nud",
                    "Al Qadisiya",
                    "Al Qasimia",
                    "Al Qulaayah",
                    "Al Rafa'ah",
                    "Al rahmaniya",
                    "Al Ramaqiya",
                    "Al Ramla",
                    "Al Ramtha",
                    "Al Rifa'a",
                    "Al Riqa Suburb",
                    "Al Sabkha",
                    "Al Shahba",
                    "Al Sharq",
                    "Al Shuwaihean",
                    "Al Soor",
                    "Al Suyoh Suburb",
                    "Al Sweihat",
                    "Al Taawun",
                    "Al Tala'a",
                    "Al Yarmook",
                    "Al Yash",
                    "Al Zubair",
                    "Barashi",
                    "Buhaira Corniche",
                    "Dasman",
                    "Dhaid",
                    "Halwan Suburb",
                    "Industrial Area 1",
                    "Industrial Area 10",
                    "Industrial Area 11",
                    "Industrial Area 12",
                    "Industrial Area 13",
                    "Industrial Area 14",
                    "Industrial Area 15",
                    "Industrial Area 16",
                    "Industrial Area 17",
                    "Industrial Area 2",
                    "Industrial Area 3",
                    "Industrial Area 4",
                    "Industrial Area 5",
                    "Industrial Area 6",
                    "Industrial Area 7",
                    "Industrial Area 8",
                    "Industrial Area 9",
                    "Jamal Abdul Nasser Street",
                    "Juwaiza'A Suburb",
                    "Maleha",
                    "Maysaloon",
                    "Musallah",
                    "Muwailah",
                    "Muzairah",
                    "Nabba",
                    "Other",
                    "Qarayen 1",
                    "Qarayen 2",
                    "Qarayen 3",
                    "Qarayen 4",
                    "Qarayen 5",
                    "Rolla",
                    "Saif Zone",
                    "Sajja",
                    "Samnam",
                    "Sharjah International Airport",
                    "Sharqan",
                    "Um Al Taraffa",
                    "University City"
                ],
            ],
            [
                'name' => 'Um Al Quiwan',
                'location_code' => 'UMQ',
                'entity' => 'DXB',
                'areas' => [
                    "Al Aahad",
                    "Al Abrab",
                    "Al Dar Al Baida - A",
                    "Al Dar Al Baida - B",
                    "Al Haditha",
                    "Al Hawiyah",
                    "Al Humrah - A",
                    "Al Humrah - B",
                    "Al Humrah - C",
                    "Al Humrah - D",
                    "Al Khor",
                    "Al Limghadar",
                    "Al Maidan",
                    "Al Raas - A",
                    "Al Raas - B",
                    "Al Raas - C",
                    "Al Raas - D",
                    "Al Rafaah",
                    "Al Ramlah",
                    "Al Ramlah - B",
                    "Al Ramlah - C",
                    "Al Rashidiya",
                    "Al Raudah",
                    "Al Riqqah",
                    "Al Salamah - A",
                    "Al Salamah - B",
                    "Al Salamah - C",
                    "Al Surrah",
                    "Falaj Al Mulla",
                    "Fallaj Al Muwallah",
                    "Green Belt",
                    "Hamra",
                    "Industrial Area",
                    "Jamiya",
                    "Kaber",
                    "Lubsah",
                    "Masjid Al Mazroui",
                    "Old Town Area",
                    "Other",
                    "Umm Al Quwain Marina"
                ],
            ]
        ];


        foreach ($arr as $state) {
            $deliveryCity = DeliveryCompaniesCity::whereCityName($state['name'])->first();
            foreach ($state['areas'] as $area){
                $deliveryArea = DeliveryCompanyArea::whereArea($area)->whereStateId($deliveryCity->id)->first();
                if(!$deliveryArea) {
                    $deliveryArea = new DeliveryCompanyArea();
                    $deliveryArea->delivery_company_id = 1;
                    $deliveryArea->state_id = $deliveryCity->id;
                    $deliveryArea->area = $area;
                    $deliveryArea->entity = $state['entity'];
                    $deliveryArea->location_code = $state['location_code'];
                    $deliveryArea->country_code = "AE";
                    $deliveryArea->save();
                }
            }
        }
    }
}
