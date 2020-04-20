<?php

use App\City;
use App\State;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $City_list = $this->getCityList();
        foreach ($City_list as $key => $list) {
            $state = State::where('name', $list['state'])->first();
            if (!$state) {
                dd($key, $list);
            }
            City::updateOrCreate(['name' => $list['name']], [
                'name' => $list['name'],
                'state_id' => $state->id,
                'active' => true,
            ]);
        }
    }

    public function getCityList()
    {
        return array(
            0 => array(
                'id' => '1',
                'name' => 'Mumbai',
                'state' => 'Maharashtra',
            ),
            1 => array(
                'id' => '2',
                'name' => 'Delhi',
                'state' => 'Delhi',
            ),
            2 => array(
                'id' => '3',
                'name' => 'Bengaluru',
                'state' => 'Karnataka',
            ),
            3 => array(
                'id' => '4',
                'name' => 'Ahmedabad',
                'state' => 'Gujarat',
            ),
            4 => array(
                'id' => '5',
                'name' => 'Hyderabad',
                'state' => 'Telangana',
            ),
            5 => array(
                'id' => '6',
                'name' => 'Chennai',
                'state' => 'Tamil Nadu',
            ),
            6 => array(
                'id' => '7',
                'name' => 'Kolkata',
                'state' => 'West Bengal',
            ),
            7 => array(
                'id' => '8',
                'name' => 'Pune',
                'state' => 'Maharashtra',
            ),
            8 => array(
                'id' => '9',
                'name' => 'Jaipur',
                'state' => 'Rajasthan',
            ),
            9 => array(
                'id' => '10',
                'name' => 'Surat',
                'state' => 'Gujarat',
            ),
            10 => array(
                'id' => '11',
                'name' => 'Lucknow',
                'state' => 'Uttar Pradesh',
            ),
            11 => array(
                'id' => '12',
                'name' => 'Kanpur',
                'state' => 'Uttar Pradesh',
            ),
            12 => array(
                'id' => '13',
                'name' => 'Nagpur',
                'state' => 'Maharashtra',
            ),
            13 => array(
                'id' => '14',
                'name' => 'Patna',
                'state' => 'Bihar',
            ),
            14 => array(
                'id' => '15',
                'name' => 'Indore',
                'state' => 'Madhya Pradesh',
            ),
            15 => array(
                'id' => '16',
                'name' => 'Thane',
                'state' => 'Maharashtra',
            ),
            16 => array(
                'id' => '17',
                'name' => 'Bhopal',
                'state' => 'Madhya Pradesh',
            ),
            17 => array(
                'id' => '18',
                'name' => 'Visakhapatnam',
                'state' => 'Andhra Pradesh',
            ),
            18 => array(
                'id' => '19',
                'name' => 'Vadodara',
                'state' => 'Gujarat',
            ),
            19 => array(
                'id' => '20',
                'name' => 'Firozabad',
                'state' => 'Uttar Pradesh',
            ),
            20 => array(
                'id' => '21',
                'name' => 'Ludhiana',
                'state' => 'Punjab',
            ),
            21 => array(
                'id' => '22',
                'name' => 'Rajkot',
                'state' => 'Gujarat',
            ),
            22 => array(
                'id' => '23',
                'name' => 'Agra',
                'state' => 'Uttar Pradesh',
            ),
            23 => array(
                'id' => '24',
                'name' => 'Siliguri',
                'state' => 'West Bengal',
            ),
            24 => array(
                'id' => '25',
                'name' => 'Nashik',
                'state' => 'Maharashtra',
            ),
            25 => array(
                'id' => '26',
                'name' => 'Faridabad',
                'state' => 'Haryana',
            ),
            26 => array(
                'id' => '27',
                'name' => 'Patiala',
                'state' => 'Punjab',
            ),
            27 => array(
                'id' => '28',
                'name' => 'Meerut',
                'state' => 'Uttar Pradesh',
            ),
            28 => array(
                'id' => '29',
                'name' => 'Kalyan-Dombivali',
                'state' => 'Maharashtra',
            ),
            29 => array(
                'id' => '30',
                'name' => 'Vasai-Virar',
                'state' => 'Maharashtra',
            ),
            30 => array(
                'id' => '31',
                'name' => 'Varanasi',
                'state' => 'Uttar Pradesh',
            ),
            31 => array(
                'id' => '32',
                'name' => 'Srinagar',
                'state' => 'Jammu and Kashmir',
            ),
            32 => array(
                'id' => '33',
                'name' => 'Dhanbad',
                'state' => 'Jharkhand',
            ),
            33 => array(
                'id' => '34',
                'name' => 'Jodhpur',
                'state' => 'Rajasthan',
            ),
            34 => array(
                'id' => '35',
                'name' => 'Amritsar',
                'state' => 'Punjab',
            ),
            35 => array(
                'id' => '36',
                'name' => 'Raipur',
                'state' => 'Chhattisgarh',
            ),
            36 => array(
                'id' => '37',
                'name' => 'Allahabad',
                'state' => 'Uttar Pradesh',
            ),
            37 => array(
                'id' => '38',
                'name' => 'Coimbatore',
                'state' => 'Tamil Nadu',
            ),
            38 => array(
                'id' => '39',
                'name' => 'Jabalpur',
                'state' => 'Madhya Pradesh',
            ),
            39 => array(
                'id' => '40',
                'name' => 'Gwalior',
                'state' => 'Madhya Pradesh',
            ),
            40 => array(
                'id' => '41',
                'name' => 'Vijayawada',
                'state' => 'Andhra Pradesh',
            ),
            41 => array(
                'id' => '42',
                'name' => 'Madurai',
                'state' => 'Tamil Nadu',
            ),
            42 => array(
                'id' => '43',
                'name' => 'Guwahati',
                'state' => 'Assam',
            ),
            43 => array(
                'id' => '44',
                'name' => 'Chandigarh',
                'state' => 'Chandigarh',
            ),
            44 => array(
                'id' => '45',
                'name' => 'Hubli-Dharwad',
                'state' => 'Karnataka',
            ),
            45 => array(
                'id' => '46',
                'name' => 'Amroha',
                'state' => 'Uttar Pradesh',
            ),
            46 => array(
                'id' => '47',
                'name' => 'Moradabad',
                'state' => 'Uttar Pradesh',
            ),
            47 => array(
                'id' => '48',
                'name' => 'Gurgaon',
                'state' => 'Haryana',
            ),
            48 => array(
                'id' => '49',
                'name' => 'Aligarh',
                'state' => 'Uttar Pradesh',
            ),
            49 => array(
                'id' => '50',
                'name' => 'Solapur',
                'state' => 'Maharashtra',
            ),
            50 => array(
                'id' => '51',
                'name' => 'Ranchi',
                'state' => 'Jharkhand',
            ),
            51 => array(
                'id' => '52',
                'name' => 'Jalandhar',
                'state' => 'Punjab',
            ),
            52 => array(
                'id' => '53',
                'name' => 'Tiruchirappalli',
                'state' => 'Tamil Nadu',
            ),
            53 => array(
                'id' => '54',
                'name' => 'Bhubaneswar',
                'state' => 'Odisha',
            ),
            54 => array(
                'id' => '55',
                'name' => 'Salem',
                'state' => 'Tamil Nadu',
            ),
            55 => array(
                'id' => '56',
                'name' => 'Warangal',
                'state' => 'Telangana',
            ),
            56 => array(
                'id' => '57',
                'name' => 'Mira-Bhayandar',
                'state' => 'Maharashtra',
            ),
            57 => array(
                'id' => '58',
                'name' => 'Thiruvananthapuram',
                'state' => 'Kerala',
            ),
            58 => array(
                'id' => '59',
                'name' => 'Bhiwandi',
                'state' => 'Maharashtra',
            ),
            59 => array(
                'id' => '60',
                'name' => 'Saharanpur',
                'state' => 'Uttar Pradesh',
            ),
            60 => array(
                'id' => '61',
                'name' => 'Guntur',
                'state' => 'Andhra Pradesh',
            ),
            61 => array(
                'id' => '62',
                'name' => 'Amravati',
                'state' => 'Maharashtra',
            ),
            62 => array(
                'id' => '63',
                'name' => 'Bikaner',
                'state' => 'Rajasthan',
            ),
            63 => array(
                'id' => '64',
                'name' => 'Noida',
                'state' => 'Uttar Pradesh',
            ),
            64 => array(
                'id' => '65',
                'name' => 'Jamshedpur',
                'state' => 'Jharkhand',
            ),
            65 => array(
                'id' => '66',
                'name' => 'Bhilai Nagar',
                'state' => 'Chhattisgarh',
            ),
            66 => array(
                'id' => '67',
                'name' => 'Cuttack',
                'state' => 'Odisha',
            ),
            67 => array(
                'id' => '68',
                'name' => 'Kochi',
                'state' => 'Kerala',
            ),
            68 => array(
                'id' => '69',
                'name' => 'Udaipur',
                'state' => 'Rajasthan',
            ),
            69 => array(
                'id' => '70',
                'name' => 'Bhavnagar',
                'state' => 'Gujarat',
            ),
            70 => array(
                'id' => '71',
                'name' => 'Dehradun',
                'state' => 'Uttarakhand',
            ),
            71 => array(
                'id' => '72',
                'name' => 'Asansol',
                'state' => 'West Bengal',
            ),
            72 => array(
                'id' => '73',
                'name' => 'Nanded-Waghala',
                'state' => 'Maharashtra',
            ),
            73 => array(
                'id' => '74',
                'name' => 'Ajmer',
                'state' => 'Rajasthan',
            ),
            74 => array(
                'id' => '75',
                'name' => 'Jamnagar',
                'state' => 'Gujarat',
            ),
            75 => array(
                'id' => '76',
                'name' => 'Ujjain',
                'state' => 'Madhya Pradesh',
            ),
            76 => array(
                'id' => '77',
                'name' => 'Sangli',
                'state' => 'Maharashtra',
            ),
            77 => array(
                'id' => '78',
                'name' => 'Loni',
                'state' => 'Uttar Pradesh',
            ),
            78 => array(
                'id' => '79',
                'name' => 'Jhansi',
                'state' => 'Uttar Pradesh',
            ),
            79 => array(
                'id' => '80',
                'name' => 'Pondicherry',
                'state' => 'Puducherry',
            ),
            80 => array(
                'id' => '81',
                'name' => 'Nellore',
                'state' => 'Andhra Pradesh',
            ),
            81 => array(
                'id' => '82',
                'name' => 'Jammu',
                'state' => 'Jammu and Kashmir',
            ),
            82 => array(
                'id' => '83',
                'name' => 'Belagavi',
                'state' => 'Karnataka',
            ),
            83 => array(
                'id' => '84',
                'name' => 'Raurkela',
                'state' => 'Odisha',
            ),
            84 => array(
                'id' => '85',
                'name' => 'Mangaluru',
                'state' => 'Karnataka',
            ),
            85 => array(
                'id' => '86',
                'name' => 'Tirunelveli',
                'state' => 'Tamil Nadu',
            ),
            86 => array(
                'id' => '87',
                'name' => 'Malegaon',
                'state' => 'Maharashtra',
            ),
            87 => array(
                'id' => '88',
                'name' => 'Gaya',
                'state' => 'Bihar',
            ),
            88 => array(
                'id' => '89',
                'name' => 'Tiruppur',
                'state' => 'Tamil Nadu',
            ),
            89 => array(
                'id' => '90',
                'name' => 'Davanagere',
                'state' => 'Karnataka',
            ),
            90 => array(
                'id' => '91',
                'name' => 'Kozhikode',
                'state' => 'Kerala',
            ),
            91 => array(
                'id' => '92',
                'name' => 'Akola',
                'state' => 'Maharashtra',
            ),
            92 => array(
                'id' => '93',
                'name' => 'Kurnool',
                'state' => 'Andhra Pradesh',
            ),
            93 => array(
                'id' => '94',
                'name' => 'Bokaro Steel City',
                'state' => 'Jharkhand',
            ),
            94 => array(
                'id' => '95',
                'name' => 'Rajahmundry',
                'state' => 'Andhra Pradesh',
            ),
            95 => array(
                'id' => '96',
                'name' => 'Ballari',
                'state' => 'Karnataka',
            ),
            96 => array(
                'id' => '97',
                'name' => 'Agartala',
                'state' => 'Tripura',
            ),
            97 => array(
                'id' => '98',
                'name' => 'Bhagalpur',
                'state' => 'Bihar',
            ),
            98 => array(
                'id' => '99',
                'name' => 'Latur',
                'state' => 'Maharashtra',
            ),
            99 => array(
                'id' => '100',
                'name' => 'Dhule',
                'state' => 'Maharashtra',
            ),
            100 => array(
                'id' => '101',
                'name' => 'Korba',
                'state' => 'Chhattisgarh',
            ),
            101 => array(
                'id' => '102',
                'name' => 'Bhilwara',
                'state' => 'Rajasthan',
            ),
            102 => array(
                'id' => '103',
                'name' => 'Brahmapur',
                'state' => 'Odisha',
            ),
            103 => array(
                'id' => '104',
                'name' => 'Mysore',
                'state' => 'Karnataka',
            ),
            104 => array(
                'id' => '105',
                'name' => 'Muzaffarpur',
                'state' => 'Bihar',
            ),
            105 => array(
                'id' => '106',
                'name' => 'Ahmednagar',
                'state' => 'Maharashtra',
            ),
            106 => array(
                'id' => '107',
                'name' => 'Kollam',
                'state' => 'Kerala',
            ),
            107 => array(
                'id' => '108',
                'name' => 'Raghunathganj',
                'state' => 'West Bengal',
            ),
            108 => array(
                'id' => '109',
                'name' => 'Bilaspur',
                'state' => 'Chhattisgarh',
            ),
            109 => array(
                'id' => '110',
                'name' => 'Shahjahanpur',
                'state' => 'Uttar Pradesh',
            ),
            110 => array(
                'id' => '111',
                'name' => 'Thrissur',
                'state' => 'Kerala',
            ),
            111 => array(
                'id' => '112',
                'name' => 'Alwar',
                'state' => 'Rajasthan',
            ),
            112 => array(
                'id' => '113',
                'name' => 'Kakinada',
                'state' => 'Andhra Pradesh',
            ),
            113 => array(
                'id' => '114',
                'name' => 'Nizamabad',
                'state' => 'Telangana',
            ),
            114 => array(
                'id' => '115',
                'name' => 'Sagar',
                'state' => 'Madhya Pradesh',
            ),
            115 => array(
                'id' => '116',
                'name' => 'Tumkur',
                'state' => 'Karnataka',
            ),
            116 => array(
                'id' => '117',
                'name' => 'Hisar',
                'state' => 'Haryana',
            ),
            117 => array(
                'id' => '118',
                'name' => 'Rohtak',
                'state' => 'Haryana',
            ),
            118 => array(
                'id' => '119',
                'name' => 'Panipat',
                'state' => 'Haryana',
            ),
            119 => array(
                'id' => '120',
                'name' => 'Darbhanga',
                'state' => 'Bihar',
            ),
            120 => array(
                'id' => '121',
                'name' => 'Kharagpur',
                'state' => 'West Bengal',
            ),
            121 => array(
                'id' => '122',
                'name' => 'Aizawl',
                'state' => 'Mizoram',
            ),
            122 => array(
                'id' => '123',
                'name' => 'Ichalkaranji',
                'state' => 'Maharashtra',
            ),
            123 => array(
                'id' => '124',
                'name' => 'Tirupati',
                'state' => 'Andhra Pradesh',
            ),
            124 => array(
                'id' => '125',
                'name' => 'Karnal',
                'state' => 'Haryana',
            ),
            125 => array(
                'id' => '126',
                'name' => 'Bathinda',
                'state' => 'Punjab',
            ),
            126 => array(
                'id' => '127',
                'name' => 'Rampur',
                'state' => 'Uttar Pradesh',
            ),
            127 => array(
                'id' => '128',
                'name' => 'Shivamogga',
                'state' => 'Karnataka',
            ),
            128 => array(
                'id' => '129',
                'name' => 'Ratlam',
                'state' => 'Madhya Pradesh',
            ),
            129 => array(
                'id' => '130',
                'name' => 'Modinagar',
                'state' => 'Uttar Pradesh',
            ),
            130 => array(
                'id' => '131',
                'name' => 'Durg',
                'state' => 'Chhattisgarh',
            ),
            131 => array(
                'id' => '132',
                'name' => 'Shillong',
                'state' => 'Meghalaya',
            ),
            132 => array(
                'id' => '133',
                'name' => 'Imphal',
                'state' => 'Manipur',
            ),
            133 => array(
                'id' => '134',
                'name' => 'Hapur',
                'state' => 'Uttar Pradesh',
            ),
            134 => array(
                'id' => '135',
                'name' => 'Ranipet',
                'state' => 'Tamil Nadu',
            ),
            135 => array(
                'id' => '136',
                'name' => 'Anantapur',
                'state' => 'Andhra Pradesh',
            ),
            136 => array(
                'id' => '137',
                'name' => 'Arrah',
                'state' => 'Bihar',
            ),
            137 => array(
                'id' => '138',
                'name' => 'Karimnagar',
                'state' => 'Telangana',
            ),
            138 => array(
                'id' => '139',
                'name' => 'Parbhani',
                'state' => 'Maharashtra',
            ),
            139 => array(
                'id' => '140',
                'name' => 'Etawah',
                'state' => 'Uttar Pradesh',
            ),
            140 => array(
                'id' => '141',
                'name' => 'Bharatpur',
                'state' => 'Rajasthan',
            ),
            141 => array(
                'id' => '142',
                'name' => 'Begusarai',
                'state' => 'Bihar',
            ),
            142 => array(
                'id' => '143',
                'name' => 'New Delhi',
                'state' => 'Delhi',
            ),
            143 => array(
                'id' => '144',
                'name' => 'Chhapra',
                'state' => 'Bihar',
            ),
            144 => array(
                'id' => '145',
                'name' => 'Kadapa',
                'state' => 'Andhra Pradesh',
            ),
            145 => array(
                'id' => '146',
                'name' => 'Ramagundam',
                'state' => 'Telangana',
            ),
            146 => array(
                'id' => '147',
                'name' => 'Pali',
                'state' => 'Rajasthan',
            ),
            147 => array(
                'id' => '148',
                'name' => 'Satna',
                'state' => 'Madhya Pradesh',
            ),
            148 => array(
                'id' => '149',
                'name' => 'Vizianagaram',
                'state' => 'Andhra Pradesh',
            ),
            149 => array(
                'id' => '150',
                'name' => 'Katihar',
                'state' => 'Bihar',
            ),
            150 => array(
                'id' => '151',
                'name' => 'Hardwar',
                'state' => 'Uttarakhand',
            ),
            151 => array(
                'id' => '152',
                'name' => 'Sonipat',
                'state' => 'Haryana',
            ),
            152 => array(
                'id' => '153',
                'name' => 'Nagercoil',
                'state' => 'Tamil Nadu',
            ),
            153 => array(
                'id' => '154',
                'name' => 'Thanjavur',
                'state' => 'Tamil Nadu',
            ),
            154 => array(
                'id' => '155',
                'name' => 'Murwara (Katni)',
                'state' => 'Madhya Pradesh',
            ),
            155 => array(
                'id' => '156',
                'name' => 'Naihati',
                'state' => 'West Bengal',
            ),
            156 => array(
                'id' => '157',
                'name' => 'Sambhal',
                'state' => 'Uttar Pradesh',
            ),
            157 => array(
                'id' => '158',
                'name' => 'Nadiad',
                'state' => 'Gujarat',
            ),
            158 => array(
                'id' => '159',
                'name' => 'Yamunanagar',
                'state' => 'Haryana',
            ),
            159 => array(
                'id' => '160',
                'name' => 'English Bazar',
                'state' => 'West Bengal',
            ),
            160 => array(
                'id' => '161',
                'name' => 'Eluru',
                'state' => 'Andhra Pradesh',
            ),
            161 => array(
                'id' => '162',
                'name' => 'Munger',
                'state' => 'Bihar',
            ),
            162 => array(
                'id' => '163',
                'name' => 'Panchkula',
                'state' => 'Haryana',
            ),
            163 => array(
                'id' => '164',
                'name' => 'Raayachuru',
                'state' => 'Karnataka',
            ),
            164 => array(
                'id' => '165',
                'name' => 'Panvel',
                'state' => 'Maharashtra',
            ),
            165 => array(
                'id' => '166',
                'name' => 'Deoghar',
                'state' => 'Jharkhand',
            ),
            166 => array(
                'id' => '167',
                'name' => 'Ongole',
                'state' => 'Andhra Pradesh',
            ),
            167 => array(
                'id' => '168',
                'name' => 'Nandyal',
                'state' => 'Andhra Pradesh',
            ),
            168 => array(
                'id' => '169',
                'name' => 'Morena',
                'state' => 'Madhya Pradesh',
            ),
            169 => array(
                'id' => '170',
                'name' => 'Bhiwani',
                'state' => 'Haryana',
            ),
            170 => array(
                'id' => '171',
                'name' => 'Porbandar',
                'state' => 'Gujarat',
            ),
            171 => array(
                'id' => '172',
                'name' => 'Palakkad',
                'state' => 'Kerala',
            ),
            172 => array(
                'id' => '173',
                'name' => 'Anand',
                'state' => 'Gujarat',
            ),
            173 => array(
                'id' => '174',
                'name' => 'Purnia',
                'state' => 'Bihar',
            ),
            174 => array(
                'id' => '175',
                'name' => 'Baharampur',
                'state' => 'West Bengal',
            ),
            175 => array(
                'id' => '176',
                'name' => 'Barmer',
                'state' => 'Rajasthan',
            ),
            176 => array(
                'id' => '177',
                'name' => 'Morvi',
                'state' => 'Gujarat',
            ),
            177 => array(
                'id' => '178',
                'name' => 'Orai',
                'state' => 'Uttar Pradesh',
            ),
            178 => array(
                'id' => '179',
                'name' => 'Bahraich',
                'state' => 'Uttar Pradesh',
            ),
            179 => array(
                'id' => '180',
                'name' => 'Sikar',
                'state' => 'Rajasthan',
            ),
            180 => array(
                'id' => '181',
                'name' => 'Vellore',
                'state' => 'Tamil Nadu',
            ),
            181 => array(
                'id' => '182',
                'name' => 'Singrauli',
                'state' => 'Madhya Pradesh',
            ),
            182 => array(
                'id' => '183',
                'name' => 'Khammam',
                'state' => 'Telangana',
            ),
            183 => array(
                'id' => '184',
                'name' => 'Mahesana',
                'state' => 'Gujarat',
            ),
            184 => array(
                'id' => '185',
                'name' => 'Silchar',
                'state' => 'Assam',
            ),
            185 => array(
                'id' => '186',
                'name' => 'Sambalpur',
                'state' => 'Odisha',
            ),
            186 => array(
                'id' => '187',
                'name' => 'Rewa',
                'state' => 'Madhya Pradesh',
            ),
            187 => array(
                'id' => '188',
                'name' => 'Unnao',
                'state' => 'Uttar Pradesh',
            ),
            188 => array(
                'id' => '189',
                'name' => 'Hugli-Chinsurah',
                'state' => 'West Bengal',
            ),
            189 => array(
                'id' => '190',
                'name' => 'Raiganj',
                'state' => 'West Bengal',
            ),
            190 => array(
                'id' => '191',
                'name' => 'Phusro',
                'state' => 'Jharkhand',
            ),
            191 => array(
                'id' => '192',
                'name' => 'Adityapur',
                'state' => 'Jharkhand',
            ),
            192 => array(
                'id' => '193',
                'name' => 'Alappuzha',
                'state' => 'Kerala',
            ),
            193 => array(
                'id' => '194',
                'name' => 'Bahadurgarh',
                'state' => 'Haryana',
            ),
            194 => array(
                'id' => '195',
                'name' => 'Machilipatnam',
                'state' => 'Andhra Pradesh',
            ),
            195 => array(
                'id' => '196',
                'name' => 'Rae Bareli',
                'state' => 'Uttar Pradesh',
            ),
            196 => array(
                'id' => '197',
                'name' => 'Jalpaiguri',
                'state' => 'West Bengal',
            ),
            197 => array(
                'id' => '198',
                'name' => 'Bharuch',
                'state' => 'Gujarat',
            ),
            198 => array(
                'id' => '199',
                'name' => 'Pathankot',
                'state' => 'Punjab',
            ),
            199 => array(
                'id' => '200',
                'name' => 'Hoshiarpur',
                'state' => 'Punjab',
            ),
            200 => array(
                'id' => '201',
                'name' => 'Baramula',
                'state' => 'Jammu and Kashmir',
            ),
            201 => array(
                'id' => '202',
                'name' => 'Adoni',
                'state' => 'Andhra Pradesh',
            ),
            202 => array(
                'id' => '203',
                'name' => 'Jind',
                'state' => 'Haryana',
            ),
            203 => array(
                'id' => '204',
                'name' => 'Tonk',
                'state' => 'Rajasthan',
            ),
            204 => array(
                'id' => '205',
                'name' => 'Tenali',
                'state' => 'Andhra Pradesh',
            ),
            205 => array(
                'id' => '206',
                'name' => 'Kancheepuram',
                'state' => 'Tamil Nadu',
            ),
            206 => array(
                'id' => '207',
                'name' => 'Vapi',
                'state' => 'Gujarat',
            ),
            207 => array(
                'id' => '208',
                'name' => 'Sirsa',
                'state' => 'Haryana',
            ),
            208 => array(
                'id' => '209',
                'name' => 'Navsari',
                'state' => 'Gujarat',
            ),
            209 => array(
                'id' => '210',
                'name' => 'Mahbubnagar',
                'state' => 'Telangana',
            ),
            210 => array(
                'id' => '211',
                'name' => 'Puri',
                'state' => 'Odisha',
            ),
            211 => array(
                'id' => '212',
                'name' => 'Robertson Pet',
                'state' => 'Karnataka',
            ),
            212 => array(
                'id' => '213',
                'name' => 'Erode',
                'state' => 'Tamil Nadu',
            ),
            213 => array(
                'id' => '214',
                'name' => 'Batala',
                'state' => 'Punjab',
            ),
            214 => array(
                'id' => '215',
                'name' => 'Haldwani-cum-Kathgodam',
                'state' => 'Uttarakhand',
            ),
            215 => array(
                'id' => '216',
                'name' => 'Vidisha',
                'state' => 'Madhya Pradesh',
            ),
            216 => array(
                'id' => '217',
                'name' => 'Saharsa',
                'state' => 'Bihar',
            ),
            217 => array(
                'id' => '218',
                'name' => 'Thanesar',
                'state' => 'Haryana',
            ),
            218 => array(
                'id' => '219',
                'name' => 'Chittoor',
                'state' => 'Andhra Pradesh',
            ),
            219 => array(
                'id' => '220',
                'name' => 'Veraval',
                'state' => 'Gujarat',
            ),
            220 => array(
                'id' => '221',
                'name' => 'Lakhimpur',
                'state' => 'Uttar Pradesh',
            ),
            221 => array(
                'id' => '222',
                'name' => 'Sitapur',
                'state' => 'Uttar Pradesh',
            ),
            222 => array(
                'id' => '223',
                'name' => 'Hindupur',
                'state' => 'Andhra Pradesh',
            ),
            223 => array(
                'id' => '224',
                'name' => 'Santipur',
                'state' => 'West Bengal',
            ),
            224 => array(
                'id' => '225',
                'name' => 'Balurghat',
                'state' => 'West Bengal',
            ),
            225 => array(
                'id' => '226',
                'name' => 'Ganjbasoda',
                'state' => 'Madhya Pradesh',
            ),
            226 => array(
                'id' => '227',
                'name' => 'Moga',
                'state' => 'Punjab',
            ),
            227 => array(
                'id' => '228',
                'name' => 'Proddatur',
                'state' => 'Andhra Pradesh',
            ),
            228 => array(
                'id' => '229',
                'name' => 'Srinagar',
                'state' => 'Uttarakhand',
            ),
            229 => array(
                'id' => '230',
                'name' => 'Medinipur',
                'state' => 'West Bengal',
            ),
            230 => array(
                'id' => '231',
                'name' => 'Habra',
                'state' => 'West Bengal',
            ),
            231 => array(
                'id' => '232',
                'name' => 'Sasaram',
                'state' => 'Bihar',
            ),
            232 => array(
                'id' => '233',
                'name' => 'Hajipur',
                'state' => 'Bihar',
            ),
            233 => array(
                'id' => '234',
                'name' => 'Bhuj',
                'state' => 'Gujarat',
            ),
            234 => array(
                'id' => '235',
                'name' => 'Shivpuri',
                'state' => 'Madhya Pradesh',
            ),
            235 => array(
                'id' => '236',
                'name' => 'Ranaghat',
                'state' => 'West Bengal',
            ),
            236 => array(
                'id' => '237',
                'name' => 'Shimla',
                'state' => 'Himachal Pradesh',
            ),
            237 => array(
                'id' => '238',
                'name' => 'Tiruvannamalai',
                'state' => 'Tamil Nadu',
            ),
            238 => array(
                'id' => '239',
                'name' => 'Kaithal',
                'state' => 'Haryana',
            ),
            239 => array(
                'id' => '240',
                'name' => 'Rajnandgaon',
                'state' => 'Chhattisgarh',
            ),
            240 => array(
                'id' => '241',
                'name' => 'Godhra',
                'state' => 'Gujarat',
            ),
            241 => array(
                'id' => '242',
                'name' => 'Hazaribag',
                'state' => 'Jharkhand',
            ),
            242 => array(
                'id' => '243',
                'name' => 'Bhimavaram',
                'state' => 'Andhra Pradesh',
            ),
            243 => array(
                'id' => '244',
                'name' => 'Mandsaur',
                'state' => 'Madhya Pradesh',
            ),
            244 => array(
                'id' => '245',
                'name' => 'Dibrugarh',
                'state' => 'Assam',
            ),
            245 => array(
                'id' => '246',
                'name' => 'Kolar',
                'state' => 'Karnataka',
            ),
            246 => array(
                'id' => '247',
                'name' => 'Bankura',
                'state' => 'West Bengal',
            ),
            247 => array(
                'id' => '248',
                'name' => 'Mandya',
                'state' => 'Karnataka',
            ),
            248 => array(
                'id' => '249',
                'name' => 'Dehri-on-Sone',
                'state' => 'Bihar',
            ),
            249 => array(
                'id' => '250',
                'name' => 'Madanapalle',
                'state' => 'Andhra Pradesh',
            ),
            250 => array(
                'id' => '251',
                'name' => 'Malerkotla',
                'state' => 'Punjab',
            ),
            251 => array(
                'id' => '252',
                'name' => 'Lalitpur',
                'state' => 'Uttar Pradesh',
            ),
            252 => array(
                'id' => '253',
                'name' => 'Bettiah',
                'state' => 'Bihar',
            ),
            253 => array(
                'id' => '254',
                'name' => 'Pollachi',
                'state' => 'Tamil Nadu',
            ),
            254 => array(
                'id' => '255',
                'name' => 'Khanna',
                'state' => 'Punjab',
            ),
            255 => array(
                'id' => '256',
                'name' => 'Neemuch',
                'state' => 'Madhya Pradesh',
            ),
            256 => array(
                'id' => '257',
                'name' => 'Palwal',
                'state' => 'Haryana',
            ),
            257 => array(
                'id' => '258',
                'name' => 'Palanpur',
                'state' => 'Gujarat',
            ),
            258 => array(
                'id' => '259',
                'name' => 'Guntakal',
                'state' => 'Andhra Pradesh',
            ),
            259 => array(
                'id' => '260',
                'name' => 'Nabadwip',
                'state' => 'West Bengal',
            ),
            260 => array(
                'id' => '261',
                'name' => 'Udupi',
                'state' => 'Karnataka',
            ),
            261 => array(
                'id' => '262',
                'name' => 'Jagdalpur',
                'state' => 'Chhattisgarh',
            ),
            262 => array(
                'id' => '263',
                'name' => 'Motihari',
                'state' => 'Bihar',
            ),
            263 => array(
                'id' => '264',
                'name' => 'Pilibhit',
                'state' => 'Uttar Pradesh',
            ),
            264 => array(
                'id' => '265',
                'name' => 'Dimapur',
                'state' => 'Nagaland',
            ),
            265 => array(
                'id' => '266',
                'name' => 'Mohali',
                'state' => 'Punjab',
            ),
            266 => array(
                'id' => '267',
                'name' => 'Sadulpur',
                'state' => 'Rajasthan',
            ),
            267 => array(
                'id' => '268',
                'name' => 'Rajapalayam',
                'state' => 'Tamil Nadu',
            ),
            268 => array(
                'id' => '269',
                'name' => 'Dharmavaram',
                'state' => 'Andhra Pradesh',
            ),
            269 => array(
                'id' => '270',
                'name' => 'Kashipur',
                'state' => 'Uttarakhand',
            ),
            270 => array(
                'id' => '271',
                'name' => 'Sivakasi',
                'state' => 'Tamil Nadu',
            ),
            271 => array(
                'id' => '272',
                'name' => 'Darjiling',
                'state' => 'West Bengal',
            ),
            272 => array(
                'id' => '273',
                'name' => 'Chikkamagaluru',
                'state' => 'Karnataka',
            ),
            273 => array(
                'id' => '274',
                'name' => 'Gudivada',
                'state' => 'Andhra Pradesh',
            ),
            274 => array(
                'id' => '275',
                'name' => 'Baleshwar Town',
                'state' => 'Odisha',
            ),
            275 => array(
                'id' => '276',
                'name' => 'Mancherial',
                'state' => 'Telangana',
            ),
            276 => array(
                'id' => '277',
                'name' => 'Srikakulam',
                'state' => 'Andhra Pradesh',
            ),
            277 => array(
                'id' => '278',
                'name' => 'Adilabad',
                'state' => 'Telangana',
            ),
            278 => array(
                'id' => '279',
                'name' => 'Yavatmal',
                'state' => 'Maharashtra',
            ),
            279 => array(
                'id' => '280',
                'name' => 'Barnala',
                'state' => 'Punjab',
            ),
            280 => array(
                'id' => '281',
                'name' => 'Nagaon',
                'state' => 'Assam',
            ),
            281 => array(
                'id' => '282',
                'name' => 'Narasaraopet',
                'state' => 'Andhra Pradesh',
            ),
            282 => array(
                'id' => '283',
                'name' => 'Raigarh',
                'state' => 'Chhattisgarh',
            ),
            283 => array(
                'id' => '284',
                'name' => 'Roorkee',
                'state' => 'Uttarakhand',
            ),
            284 => array(
                'id' => '285',
                'name' => 'Valsad',
                'state' => 'Gujarat',
            ),
            285 => array(
                'id' => '286',
                'name' => 'Ambikapur',
                'state' => 'Chhattisgarh',
            ),
            286 => array(
                'id' => '287',
                'name' => 'Giridih',
                'state' => 'Jharkhand',
            ),
            287 => array(
                'id' => '288',
                'name' => 'Chandausi',
                'state' => 'Uttar Pradesh',
            ),
            288 => array(
                'id' => '289',
                'name' => 'Purulia',
                'state' => 'West Bengal',
            ),
            289 => array(
                'id' => '290',
                'name' => 'Patan',
                'state' => 'Gujarat',
            ),
            290 => array(
                'id' => '291',
                'name' => 'Bagaha',
                'state' => 'Bihar',
            ),
            291 => array(
                'id' => '292',
                'name' => 'Hardoi ',
                'state' => 'Uttar Pradesh',
            ),
            292 => array(
                'id' => '293',
                'name' => 'Achalpur',
                'state' => 'Maharashtra',
            ),
            293 => array(
                'id' => '294',
                'name' => 'Osmanabad',
                'state' => 'Maharashtra',
            ),
            294 => array(
                'id' => '295',
                'name' => 'Deesa',
                'state' => 'Gujarat',
            ),
            295 => array(
                'id' => '296',
                'name' => 'Nandurbar',
                'state' => 'Maharashtra',
            ),
            296 => array(
                'id' => '297',
                'name' => 'Azamgarh',
                'state' => 'Uttar Pradesh',
            ),
            297 => array(
                'id' => '298',
                'name' => 'Ramgarh',
                'state' => 'Jharkhand',
            ),
            298 => array(
                'id' => '299',
                'name' => 'Firozpur',
                'state' => 'Punjab',
            ),
            299 => array(
                'id' => '300',
                'name' => 'Baripada Town',
                'state' => 'Odisha',
            ),
            300 => array(
                'id' => '301',
                'name' => 'Karwar',
                'state' => 'Karnataka',
            ),
            301 => array(
                'id' => '302',
                'name' => 'Siwan',
                'state' => 'Bihar',
            ),
            302 => array(
                'id' => '303',
                'name' => 'Rajampet',
                'state' => 'Andhra Pradesh',
            ),
            303 => array(
                'id' => '304',
                'name' => 'Pudukkottai',
                'state' => 'Tamil Nadu',
            ),
            304 => array(
                'id' => '305',
                'name' => 'Anantnag',
                'state' => 'Jammu and Kashmir',
            ),
            305 => array(
                'id' => '306',
                'name' => 'Tadpatri',
                'state' => 'Andhra Pradesh',
            ),
            306 => array(
                'id' => '307',
                'name' => 'Satara',
                'state' => 'Maharashtra',
            ),
            307 => array(
                'id' => '308',
                'name' => 'Bhadrak',
                'state' => 'Odisha',
            ),
            308 => array(
                'id' => '309',
                'name' => 'Kishanganj',
                'state' => 'Bihar',
            ),
            309 => array(
                'id' => '310',
                'name' => 'Suryapet',
                'state' => 'Telangana',
            ),
            310 => array(
                'id' => '311',
                'name' => 'Wardha',
                'state' => 'Maharashtra',
            ),
            311 => array(
                'id' => '312',
                'name' => 'Ranebennuru',
                'state' => 'Karnataka',
            ),
            312 => array(
                'id' => '313',
                'name' => 'Amreli',
                'state' => 'Gujarat',
            ),
            313 => array(
                'id' => '314',
                'name' => 'Neyveli (TS)',
                'state' => 'Tamil Nadu',
            ),
            314 => array(
                'id' => '315',
                'name' => 'Jamalpur',
                'state' => 'Bihar',
            ),
            315 => array(
                'id' => '316',
                'name' => 'Marmagao',
                'state' => 'Goa',
            ),
            316 => array(
                'id' => '317',
                'name' => 'Udgir',
                'state' => 'Maharashtra',
            ),
            317 => array(
                'id' => '318',
                'name' => 'Tadepalligudem',
                'state' => 'Andhra Pradesh',
            ),
            318 => array(
                'id' => '319',
                'name' => 'Nagapattinam',
                'state' => 'Tamil Nadu',
            ),
            319 => array(
                'id' => '320',
                'name' => 'Buxar',
                'state' => 'Bihar',
            ),
            320 => array(
                'id' => '321',
                'name' => 'Aurangabad',
                'state' => 'Maharashtra',
            ),
            321 => array(
                'id' => '322',
                'name' => 'Jehanabad',
                'state' => 'Bihar',
            ),
            322 => array(
                'id' => '323',
                'name' => 'Phagwara',
                'state' => 'Punjab',
            ),
            323 => array(
                'id' => '324',
                'name' => 'Khair',
                'state' => 'Uttar Pradesh',
            ),
            324 => array(
                'id' => '325',
                'name' => 'Sawai Madhopur',
                'state' => 'Rajasthan',
            ),
            325 => array(
                'id' => '326',
                'name' => 'Kapurthala',
                'state' => 'Punjab',
            ),
            326 => array(
                'id' => '327',
                'name' => 'Chilakaluripet',
                'state' => 'Andhra Pradesh',
            ),
            327 => array(
                'id' => '328',
                'name' => 'Aurangabad',
                'state' => 'Bihar',
            ),
            328 => array(
                'id' => '329',
                'name' => 'Malappuram',
                'state' => 'Kerala',
            ),
            329 => array(
                'id' => '330',
                'name' => 'Rewari',
                'state' => 'Haryana',
            ),
            330 => array(
                'id' => '331',
                'name' => 'Nagaur',
                'state' => 'Rajasthan',
            ),
            331 => array(
                'id' => '332',
                'name' => 'Sultanpur',
                'state' => 'Uttar Pradesh',
            ),
            332 => array(
                'id' => '333',
                'name' => 'Nagda',
                'state' => 'Madhya Pradesh',
            ),
            333 => array(
                'id' => '334',
                'name' => 'Port Blair',
                'state' => 'Andaman and Nicobar Islands',
            ),
            334 => array(
                'id' => '335',
                'name' => 'Lakhisarai',
                'state' => 'Bihar',
            ),
            335 => array(
                'id' => '336',
                'name' => 'Panaji',
                'state' => 'Goa',
            ),
            336 => array(
                'id' => '337',
                'name' => 'Tinsukia',
                'state' => 'Assam',
            ),
            337 => array(
                'id' => '338',
                'name' => 'Itarsi',
                'state' => 'Madhya Pradesh',
            ),
            338 => array(
                'id' => '339',
                'name' => 'Kohima',
                'state' => 'Nagaland',
            ),
            339 => array(
                'id' => '340',
                'name' => 'Balangir',
                'state' => 'Odisha',
            ),
            340 => array(
                'id' => '341',
                'name' => 'Nawada',
                'state' => 'Bihar',
            ),
            341 => array(
                'id' => '342',
                'name' => 'Jharsuguda',
                'state' => 'Odisha',
            ),
            342 => array(
                'id' => '343',
                'name' => 'Jagtial',
                'state' => 'Telangana',
            ),
            343 => array(
                'id' => '344',
                'name' => 'Viluppuram',
                'state' => 'Tamil Nadu',
            ),
            344 => array(
                'id' => '345',
                'name' => 'Amalner',
                'state' => 'Maharashtra',
            ),
            345 => array(
                'id' => '346',
                'name' => 'Zirakpur',
                'state' => 'Punjab',
            ),
            346 => array(
                'id' => '347',
                'name' => 'Tanda',
                'state' => 'Uttar Pradesh',
            ),
            347 => array(
                'id' => '348',
                'name' => 'Tiruchengode',
                'state' => 'Tamil Nadu',
            ),
            348 => array(
                'id' => '349',
                'name' => 'Nagina',
                'state' => 'Uttar Pradesh',
            ),
            349 => array(
                'id' => '350',
                'name' => 'Yemmiganur',
                'state' => 'Andhra Pradesh',
            ),
            350 => array(
                'id' => '351',
                'name' => 'Vaniyambadi',
                'state' => 'Tamil Nadu',
            ),
            351 => array(
                'id' => '352',
                'name' => 'Sarni',
                'state' => 'Madhya Pradesh',
            ),
            352 => array(
                'id' => '353',
                'name' => 'Theni Allinagaram',
                'state' => 'Tamil Nadu',
            ),
            353 => array(
                'id' => '354',
                'name' => 'Margao',
                'state' => 'Goa',
            ),
            354 => array(
                'id' => '355',
                'name' => 'Akot',
                'state' => 'Maharashtra',
            ),
            355 => array(
                'id' => '356',
                'name' => 'Sehore',
                'state' => 'Madhya Pradesh',
            ),
            356 => array(
                'id' => '357',
                'name' => 'Mhow Cantonment',
                'state' => 'Madhya Pradesh',
            ),
            357 => array(
                'id' => '358',
                'name' => 'Kot Kapura',
                'state' => 'Punjab',
            ),
            358 => array(
                'id' => '359',
                'name' => 'Makrana',
                'state' => 'Rajasthan',
            ),
            359 => array(
                'id' => '360',
                'name' => 'Pandharpur',
                'state' => 'Maharashtra',
            ),
            360 => array(
                'id' => '361',
                'name' => 'Miryalaguda',
                'state' => 'Telangana',
            ),
            361 => array(
                'id' => '362',
                'name' => 'Shamli',
                'state' => 'Uttar Pradesh',
            ),
            362 => array(
                'id' => '363',
                'name' => 'Seoni',
                'state' => 'Madhya Pradesh',
            ),
            363 => array(
                'id' => '364',
                'name' => 'Ranibennur',
                'state' => 'Karnataka',
            ),
            364 => array(
                'id' => '365',
                'name' => 'Kadiri',
                'state' => 'Andhra Pradesh',
            ),
            365 => array(
                'id' => '366',
                'name' => 'Shrirampur',
                'state' => 'Maharashtra',
            ),
            366 => array(
                'id' => '367',
                'name' => 'Rudrapur',
                'state' => 'Uttarakhand',
            ),
            367 => array(
                'id' => '368',
                'name' => 'Parli',
                'state' => 'Maharashtra',
            ),
            368 => array(
                'id' => '369',
                'name' => 'Najibabad',
                'state' => 'Uttar Pradesh',
            ),
            369 => array(
                'id' => '370',
                'name' => 'Nirmal',
                'state' => 'Telangana',
            ),
            370 => array(
                'id' => '371',
                'name' => 'Udhagamandalam',
                'state' => 'Tamil Nadu',
            ),
            371 => array(
                'id' => '372',
                'name' => 'Shikohabad',
                'state' => 'Uttar Pradesh',
            ),
            372 => array(
                'id' => '373',
                'name' => 'Jhumri Tilaiya',
                'state' => 'Jharkhand',
            ),
            373 => array(
                'id' => '374',
                'name' => 'Aruppukkottai',
                'state' => 'Tamil Nadu',
            ),
            374 => array(
                'id' => '375',
                'name' => 'Ponnani',
                'state' => 'Kerala',
            ),
            375 => array(
                'id' => '376',
                'name' => 'Jamui',
                'state' => 'Bihar',
            ),
            376 => array(
                'id' => '377',
                'name' => 'Sitamarhi',
                'state' => 'Bihar',
            ),
            377 => array(
                'id' => '378',
                'name' => 'Chirala',
                'state' => 'Andhra Pradesh',
            ),
            378 => array(
                'id' => '379',
                'name' => 'Anjar',
                'state' => 'Gujarat',
            ),
            379 => array(
                'id' => '380',
                'name' => 'Karaikal',
                'state' => 'Puducherry',
            ),
            380 => array(
                'id' => '381',
                'name' => 'Hansi',
                'state' => 'Haryana',
            ),
            381 => array(
                'id' => '382',
                'name' => 'Anakapalle',
                'state' => 'Andhra Pradesh',
            ),
            382 => array(
                'id' => '383',
                'name' => 'Mahasamund',
                'state' => 'Chhattisgarh',
            ),
            383 => array(
                'id' => '384',
                'name' => 'Faridkot',
                'state' => 'Punjab',
            ),
            384 => array(
                'id' => '385',
                'name' => 'Saunda',
                'state' => 'Jharkhand',
            ),
            385 => array(
                'id' => '386',
                'name' => 'Dhoraji',
                'state' => 'Gujarat',
            ),
            386 => array(
                'id' => '387',
                'name' => 'Paramakudi',
                'state' => 'Tamil Nadu',
            ),
            387 => array(
                'id' => '388',
                'name' => 'Balaghat',
                'state' => 'Madhya Pradesh',
            ),
            388 => array(
                'id' => '389',
                'name' => 'Sujangarh',
                'state' => 'Rajasthan',
            ),
            389 => array(
                'id' => '390',
                'name' => 'Khambhat',
                'state' => 'Gujarat',
            ),
            390 => array(
                'id' => '391',
                'name' => 'Muktsar',
                'state' => 'Punjab',
            ),
            391 => array(
                'id' => '392',
                'name' => 'Rajpura',
                'state' => 'Punjab',
            ),
            392 => array(
                'id' => '393',
                'name' => 'Kavali',
                'state' => 'Andhra Pradesh',
            ),
            393 => array(
                'id' => '394',
                'name' => 'Dhamtari',
                'state' => 'Chhattisgarh',
            ),
            394 => array(
                'id' => '395',
                'name' => 'Ashok Nagar',
                'state' => 'Madhya Pradesh',
            ),
            395 => array(
                'id' => '396',
                'name' => 'Sardarshahar',
                'state' => 'Rajasthan',
            ),
            396 => array(
                'id' => '397',
                'name' => 'Mahuva',
                'state' => 'Gujarat',
            ),
            397 => array(
                'id' => '398',
                'name' => 'Bargarh',
                'state' => 'Odisha',
            ),
            398 => array(
                'id' => '399',
                'name' => 'Kamareddy',
                'state' => 'Telangana',
            ),
            399 => array(
                'id' => '400',
                'name' => 'Sahibganj',
                'state' => 'Jharkhand',
            ),
            400 => array(
                'id' => '401',
                'name' => 'Kothagudem',
                'state' => 'Telangana',
            ),
            401 => array(
                'id' => '402',
                'name' => 'Ramanagaram',
                'state' => 'Karnataka',
            ),
            402 => array(
                'id' => '403',
                'name' => 'Gokak',
                'state' => 'Karnataka',
            ),
            403 => array(
                'id' => '404',
                'name' => 'Tikamgarh',
                'state' => 'Madhya Pradesh',
            ),
            404 => array(
                'id' => '405',
                'name' => 'Araria',
                'state' => 'Bihar',
            ),
            405 => array(
                'id' => '406',
                'name' => 'Rishikesh',
                'state' => 'Uttarakhand',
            ),
            406 => array(
                'id' => '407',
                'name' => 'Shahdol',
                'state' => 'Madhya Pradesh',
            ),
            407 => array(
                'id' => '408',
                'name' => 'Medininagar (Daltonganj)',
                'state' => 'Jharkhand',
            ),
            408 => array(
                'id' => '409',
                'name' => 'Arakkonam',
                'state' => 'Tamil Nadu',
            ),
            409 => array(
                'id' => '410',
                'name' => 'Washim',
                'state' => 'Maharashtra',
            ),
            410 => array(
                'id' => '411',
                'name' => 'Sangrur',
                'state' => 'Punjab',
            ),
            411 => array(
                'id' => '412',
                'name' => 'Bodhan',
                'state' => 'Telangana',
            ),
            412 => array(
                'id' => '413',
                'name' => 'Fazilka',
                'state' => 'Punjab',
            ),
            413 => array(
                'id' => '414',
                'name' => 'Palacole',
                'state' => 'Andhra Pradesh',
            ),
            414 => array(
                'id' => '415',
                'name' => 'Keshod',
                'state' => 'Gujarat',
            ),
            415 => array(
                'id' => '416',
                'name' => 'Sullurpeta',
                'state' => 'Andhra Pradesh',
            ),
            416 => array(
                'id' => '417',
                'name' => 'Wadhwan',
                'state' => 'Gujarat',
            ),
            417 => array(
                'id' => '418',
                'name' => 'Gurdaspur',
                'state' => 'Punjab',
            ),
            418 => array(
                'id' => '419',
                'name' => 'Vatakara',
                'state' => 'Kerala',
            ),
            419 => array(
                'id' => '420',
                'name' => 'Tura',
                'state' => 'Meghalaya',
            ),
            420 => array(
                'id' => '421',
                'name' => 'Narnaul',
                'state' => 'Haryana',
            ),
            421 => array(
                'id' => '422',
                'name' => 'Kharar',
                'state' => 'Punjab',
            ),
            422 => array(
                'id' => '423',
                'name' => 'Yadgir',
                'state' => 'Karnataka',
            ),
            423 => array(
                'id' => '424',
                'name' => 'Ambejogai',
                'state' => 'Maharashtra',
            ),
            424 => array(
                'id' => '425',
                'name' => 'Ankleshwar',
                'state' => 'Gujarat',
            ),
            425 => array(
                'id' => '426',
                'name' => 'Savarkundla',
                'state' => 'Gujarat',
            ),
            426 => array(
                'id' => '427',
                'name' => 'Paradip',
                'state' => 'Odisha',
            ),
            427 => array(
                'id' => '428',
                'name' => 'Virudhachalam',
                'state' => 'Tamil Nadu',
            ),
            428 => array(
                'id' => '429',
                'name' => 'Kanhangad',
                'state' => 'Kerala',
            ),
            429 => array(
                'id' => '430',
                'name' => 'Kadi',
                'state' => 'Gujarat',
            ),
            430 => array(
                'id' => '431',
                'name' => 'Srivilliputhur',
                'state' => 'Tamil Nadu',
            ),
            431 => array(
                'id' => '432',
                'name' => 'Gobindgarh',
                'state' => 'Punjab',
            ),
            432 => array(
                'id' => '433',
                'name' => 'Tindivanam',
                'state' => 'Tamil Nadu',
            ),
            433 => array(
                'id' => '434',
                'name' => 'Mansa',
                'state' => 'Punjab',
            ),
            434 => array(
                'id' => '435',
                'name' => 'Taliparamba',
                'state' => 'Kerala',
            ),
            435 => array(
                'id' => '436',
                'name' => 'Manmad',
                'state' => 'Maharashtra',
            ),
            436 => array(
                'id' => '437',
                'name' => 'Tanuku',
                'state' => 'Andhra Pradesh',
            ),
            437 => array(
                'id' => '438',
                'name' => 'Rayachoti',
                'state' => 'Andhra Pradesh',
            ),
            438 => array(
                'id' => '439',
                'name' => 'Virudhunagar',
                'state' => 'Tamil Nadu',
            ),
            439 => array(
                'id' => '440',
                'name' => 'Koyilandy',
                'state' => 'Kerala',
            ),
            440 => array(
                'id' => '441',
                'name' => 'Jorhat',
                'state' => 'Assam',
            ),
            441 => array(
                'id' => '442',
                'name' => 'Karur',
                'state' => 'Tamil Nadu',
            ),
            442 => array(
                'id' => '443',
                'name' => 'Valparai',
                'state' => 'Tamil Nadu',
            ),
            443 => array(
                'id' => '444',
                'name' => 'Srikalahasti',
                'state' => 'Andhra Pradesh',
            ),
            444 => array(
                'id' => '445',
                'name' => 'Neyyattinkara',
                'state' => 'Kerala',
            ),
            445 => array(
                'id' => '446',
                'name' => 'Bapatla',
                'state' => 'Andhra Pradesh',
            ),
            446 => array(
                'id' => '447',
                'name' => 'Fatehabad',
                'state' => 'Haryana',
            ),
            447 => array(
                'id' => '448',
                'name' => 'Malout',
                'state' => 'Punjab',
            ),
            448 => array(
                'id' => '449',
                'name' => 'Sankarankovil',
                'state' => 'Tamil Nadu',
            ),
            449 => array(
                'id' => '450',
                'name' => 'Tenkasi',
                'state' => 'Tamil Nadu',
            ),
            450 => array(
                'id' => '451',
                'name' => 'Ratnagiri',
                'state' => 'Maharashtra',
            ),
            451 => array(
                'id' => '452',
                'name' => 'Rabkavi Banhatti',
                'state' => 'Karnataka',
            ),
            452 => array(
                'id' => '453',
                'name' => 'Sikandrabad',
                'state' => 'Uttar Pradesh',
            ),
            453 => array(
                'id' => '454',
                'name' => 'Chaibasa',
                'state' => 'Jharkhand',
            ),
            454 => array(
                'id' => '455',
                'name' => 'Chirmiri',
                'state' => 'Chhattisgarh',
            ),
            455 => array(
                'id' => '456',
                'name' => 'Palwancha',
                'state' => 'Telangana',
            ),
            456 => array(
                'id' => '457',
                'name' => 'Bhawanipatna',
                'state' => 'Odisha',
            ),
            457 => array(
                'id' => '458',
                'name' => 'Kayamkulam',
                'state' => 'Kerala',
            ),
            458 => array(
                'id' => '459',
                'name' => 'Pithampur',
                'state' => 'Madhya Pradesh',
            ),
            459 => array(
                'id' => '460',
                'name' => 'Nabha',
                'state' => 'Punjab',
            ),
            460 => array(
                'id' => '461',
                'name' => 'Shahabad, Hardoi',
                'state' => 'Uttar Pradesh',
            ),
            461 => array(
                'id' => '462',
                'name' => 'Dhenkanal',
                'state' => 'Odisha',
            ),
            462 => array(
                'id' => '463',
                'name' => 'Uran Islampur',
                'state' => 'Maharashtra',
            ),
            463 => array(
                'id' => '464',
                'name' => 'Gopalganj',
                'state' => 'Bihar',
            ),
            464 => array(
                'id' => '465',
                'name' => 'Bongaigaon City',
                'state' => 'Assam',
            ),
            465 => array(
                'id' => '466',
                'name' => 'Palani',
                'state' => 'Tamil Nadu',
            ),
            466 => array(
                'id' => '467',
                'name' => 'Pusad',
                'state' => 'Maharashtra',
            ),
            467 => array(
                'id' => '468',
                'name' => 'Sopore',
                'state' => 'Jammu and Kashmir',
            ),
            468 => array(
                'id' => '469',
                'name' => 'Pilkhuwa',
                'state' => 'Uttar Pradesh',
            ),
            469 => array(
                'id' => '470',
                'name' => 'Tarn Taran',
                'state' => 'Punjab',
            ),
            470 => array(
                'id' => '471',
                'name' => 'Renukoot',
                'state' => 'Uttar Pradesh',
            ),
            471 => array(
                'id' => '472',
                'name' => 'Mandamarri',
                'state' => 'Telangana',
            ),
            472 => array(
                'id' => '473',
                'name' => 'Shahabad',
                'state' => 'Karnataka',
            ),
            473 => array(
                'id' => '474',
                'name' => 'Barbil',
                'state' => 'Odisha',
            ),
            474 => array(
                'id' => '475',
                'name' => 'Koratla',
                'state' => 'Telangana',
            ),
            475 => array(
                'id' => '476',
                'name' => 'Madhubani',
                'state' => 'Bihar',
            ),
            476 => array(
                'id' => '477',
                'name' => 'Arambagh',
                'state' => 'West Bengal',
            ),
            477 => array(
                'id' => '478',
                'name' => 'Gohana',
                'state' => 'Haryana',
            ),
            478 => array(
                'id' => '479',
                'name' => 'Ladnu',
                'state' => 'Rajasthan',
            ),
            479 => array(
                'id' => '480',
                'name' => 'Pattukkottai',
                'state' => 'Tamil Nadu',
            ),
            480 => array(
                'id' => '481',
                'name' => 'Sirsi',
                'state' => 'Karnataka',
            ),
            481 => array(
                'id' => '482',
                'name' => 'Sircilla',
                'state' => 'Telangana',
            ),
            482 => array(
                'id' => '483',
                'name' => 'Tamluk',
                'state' => 'West Bengal',
            ),
            483 => array(
                'id' => '484',
                'name' => 'Jagraon',
                'state' => 'Punjab',
            ),
            484 => array(
                'id' => '485',
                'name' => 'AlipurdUrban Agglomerationr',
                'state' => 'West Bengal',
            ),
            485 => array(
                'id' => '486',
                'name' => 'Alirajpur',
                'state' => 'Madhya Pradesh',
            ),
            486 => array(
                'id' => '487',
                'name' => 'Tandur',
                'state' => 'Telangana',
            ),
            487 => array(
                'id' => '488',
                'name' => 'Naidupet',
                'state' => 'Andhra Pradesh',
            ),
            488 => array(
                'id' => '489',
                'name' => 'Tirupathur',
                'state' => 'Tamil Nadu',
            ),
            489 => array(
                'id' => '490',
                'name' => 'Tohana',
                'state' => 'Haryana',
            ),
            490 => array(
                'id' => '491',
                'name' => 'Ratangarh',
                'state' => 'Rajasthan',
            ),
            491 => array(
                'id' => '492',
                'name' => 'Dhubri',
                'state' => 'Assam',
            ),
            492 => array(
                'id' => '493',
                'name' => 'Masaurhi',
                'state' => 'Bihar',
            ),
            493 => array(
                'id' => '494',
                'name' => 'Visnagar',
                'state' => 'Gujarat',
            ),
            494 => array(
                'id' => '495',
                'name' => 'Vrindavan',
                'state' => 'Uttar Pradesh',
            ),
            495 => array(
                'id' => '496',
                'name' => 'Nokha',
                'state' => 'Rajasthan',
            ),
            496 => array(
                'id' => '497',
                'name' => 'Nagari',
                'state' => 'Andhra Pradesh',
            ),
            497 => array(
                'id' => '498',
                'name' => 'Narwana',
                'state' => 'Haryana',
            ),
            498 => array(
                'id' => '499',
                'name' => 'Ramanathapuram',
                'state' => 'Tamil Nadu',
            ),
            499 => array(
                'id' => '500',
                'name' => 'Ujhani',
                'state' => 'Uttar Pradesh',
            ),
            500 => array(
                'id' => '501',
                'name' => 'Samastipur',
                'state' => 'Bihar',
            ),
            501 => array(
                'id' => '502',
                'name' => 'Laharpur',
                'state' => 'Uttar Pradesh',
            ),
            502 => array(
                'id' => '503',
                'name' => 'Sangamner',
                'state' => 'Maharashtra',
            ),
            503 => array(
                'id' => '504',
                'name' => 'Nimbahera',
                'state' => 'Rajasthan',
            ),
            504 => array(
                'id' => '505',
                'name' => 'Siddipet',
                'state' => 'Telangana',
            ),
            505 => array(
                'id' => '506',
                'name' => 'Suri',
                'state' => 'West Bengal',
            ),
            506 => array(
                'id' => '507',
                'name' => 'Diphu',
                'state' => 'Assam',
            ),
            507 => array(
                'id' => '508',
                'name' => 'Jhargram',
                'state' => 'West Bengal',
            ),
            508 => array(
                'id' => '509',
                'name' => 'Shirpur-Warwade',
                'state' => 'Maharashtra',
            ),
            509 => array(
                'id' => '510',
                'name' => 'Tilhar',
                'state' => 'Uttar Pradesh',
            ),
            510 => array(
                'id' => '511',
                'name' => 'Sindhnur',
                'state' => 'Karnataka',
            ),
            511 => array(
                'id' => '512',
                'name' => 'Udumalaipettai',
                'state' => 'Tamil Nadu',
            ),
            512 => array(
                'id' => '513',
                'name' => 'Malkapur',
                'state' => 'Maharashtra',
            ),
            513 => array(
                'id' => '514',
                'name' => 'Wanaparthy',
                'state' => 'Telangana',
            ),
            514 => array(
                'id' => '515',
                'name' => 'Gudur',
                'state' => 'Andhra Pradesh',
            ),
            515 => array(
                'id' => '516',
                'name' => 'Kendujhar',
                'state' => 'Odisha',
            ),
            516 => array(
                'id' => '517',
                'name' => 'Mandla',
                'state' => 'Madhya Pradesh',
            ),
            517 => array(
                'id' => '518',
                'name' => 'Mandi',
                'state' => 'Himachal Pradesh',
            ),
            518 => array(
                'id' => '519',
                'name' => 'Nedumangad',
                'state' => 'Kerala',
            ),
            519 => array(
                'id' => '520',
                'name' => 'North Lakhimpur',
                'state' => 'Assam',
            ),
            520 => array(
                'id' => '521',
                'name' => 'Vinukonda',
                'state' => 'Andhra Pradesh',
            ),
            521 => array(
                'id' => '522',
                'name' => 'Tiptur',
                'state' => 'Karnataka',
            ),
            522 => array(
                'id' => '523',
                'name' => 'Gobichettipalayam',
                'state' => 'Tamil Nadu',
            ),
            523 => array(
                'id' => '524',
                'name' => 'Sunabeda',
                'state' => 'Odisha',
            ),
            524 => array(
                'id' => '525',
                'name' => 'Wani',
                'state' => 'Maharashtra',
            ),
            525 => array(
                'id' => '526',
                'name' => 'Upleta',
                'state' => 'Gujarat',
            ),
            526 => array(
                'id' => '527',
                'name' => 'Narasapuram',
                'state' => 'Andhra Pradesh',
            ),
            527 => array(
                'id' => '528',
                'name' => 'Nuzvid',
                'state' => 'Andhra Pradesh',
            ),
            528 => array(
                'id' => '529',
                'name' => 'Tezpur',
                'state' => 'Assam',
            ),
            529 => array(
                'id' => '530',
                'name' => 'Una',
                'state' => 'Gujarat',
            ),
            530 => array(
                'id' => '531',
                'name' => 'Markapur',
                'state' => 'Andhra Pradesh',
            ),
            531 => array(
                'id' => '532',
                'name' => 'Sheopur',
                'state' => 'Madhya Pradesh',
            ),
            532 => array(
                'id' => '533',
                'name' => 'Thiruvarur',
                'state' => 'Tamil Nadu',
            ),
            533 => array(
                'id' => '534',
                'name' => 'Sidhpur',
                'state' => 'Gujarat',
            ),
            534 => array(
                'id' => '535',
                'name' => 'Sahaswan',
                'state' => 'Uttar Pradesh',
            ),
            535 => array(
                'id' => '536',
                'name' => 'Suratgarh',
                'state' => 'Rajasthan',
            ),
            536 => array(
                'id' => '537',
                'name' => 'Shajapur',
                'state' => 'Madhya Pradesh',
            ),
            537 => array(
                'id' => '538',
                'name' => 'Rayagada',
                'state' => 'Odisha',
            ),
            538 => array(
                'id' => '539',
                'name' => 'Lonavla',
                'state' => 'Maharashtra',
            ),
            539 => array(
                'id' => '540',
                'name' => 'Ponnur',
                'state' => 'Andhra Pradesh',
            ),
            540 => array(
                'id' => '541',
                'name' => 'Kagaznagar',
                'state' => 'Telangana',
            ),
            541 => array(
                'id' => '542',
                'name' => 'Gadwal',
                'state' => 'Telangana',
            ),
            542 => array(
                'id' => '543',
                'name' => 'Bhatapara',
                'state' => 'Chhattisgarh',
            ),
            543 => array(
                'id' => '544',
                'name' => 'Kandukur',
                'state' => 'Andhra Pradesh',
            ),
            544 => array(
                'id' => '545',
                'name' => 'Sangareddy',
                'state' => 'Telangana',
            ),
            545 => array(
                'id' => '546',
                'name' => 'Unjha',
                'state' => 'Gujarat',
            ),
            546 => array(
                'id' => '547',
                'name' => 'Lunglei',
                'state' => 'Mizoram',
            ),
            547 => array(
                'id' => '548',
                'name' => 'Karimganj',
                'state' => 'Assam',
            ),
            548 => array(
                'id' => '549',
                'name' => 'Kannur',
                'state' => 'Kerala',
            ),
            549 => array(
                'id' => '550',
                'name' => 'Bobbili',
                'state' => 'Andhra Pradesh',
            ),
            550 => array(
                'id' => '551',
                'name' => 'Mokameh',
                'state' => 'Bihar',
            ),
            551 => array(
                'id' => '552',
                'name' => 'Talegaon Dabhade',
                'state' => 'Maharashtra',
            ),
            552 => array(
                'id' => '553',
                'name' => 'Anjangaon',
                'state' => 'Maharashtra',
            ),
            553 => array(
                'id' => '554',
                'name' => 'Mangrol',
                'state' => 'Gujarat',
            ),
            554 => array(
                'id' => '555',
                'name' => 'Sunam',
                'state' => 'Punjab',
            ),
            555 => array(
                'id' => '556',
                'name' => 'Gangarampur',
                'state' => 'West Bengal',
            ),
            556 => array(
                'id' => '557',
                'name' => 'Thiruvallur',
                'state' => 'Tamil Nadu',
            ),
            557 => array(
                'id' => '558',
                'name' => 'Tirur',
                'state' => 'Kerala',
            ),
            558 => array(
                'id' => '559',
                'name' => 'Rath',
                'state' => 'Uttar Pradesh',
            ),
            559 => array(
                'id' => '560',
                'name' => 'Jatani',
                'state' => 'Odisha',
            ),
            560 => array(
                'id' => '561',
                'name' => 'Viramgam',
                'state' => 'Gujarat',
            ),
            561 => array(
                'id' => '562',
                'name' => 'Rajsamand',
                'state' => 'Rajasthan',
            ),
            562 => array(
                'id' => '563',
                'name' => 'Yanam',
                'state' => 'Puducherry',
            ),
            563 => array(
                'id' => '564',
                'name' => 'Kottayam',
                'state' => 'Kerala',
            ),
            564 => array(
                'id' => '565',
                'name' => 'Panruti',
                'state' => 'Tamil Nadu',
            ),
            565 => array(
                'id' => '566',
                'name' => 'Dhuri',
                'state' => 'Punjab',
            ),
            566 => array(
                'id' => '567',
                'name' => 'Namakkal',
                'state' => 'Tamil Nadu',
            ),
            567 => array(
                'id' => '568',
                'name' => 'Kasaragod',
                'state' => 'Kerala',
            ),
            568 => array(
                'id' => '569',
                'name' => 'Modasa',
                'state' => 'Gujarat',
            ),
            569 => array(
                'id' => '570',
                'name' => 'Rayadurg',
                'state' => 'Andhra Pradesh',
            ),
            570 => array(
                'id' => '571',
                'name' => 'Supaul',
                'state' => 'Bihar',
            ),
            571 => array(
                'id' => '572',
                'name' => 'Kunnamkulam',
                'state' => 'Kerala',
            ),
            572 => array(
                'id' => '573',
                'name' => 'Umred',
                'state' => 'Maharashtra',
            ),
            573 => array(
                'id' => '574',
                'name' => 'Bellampalle',
                'state' => 'Telangana',
            ),
            574 => array(
                'id' => '575',
                'name' => 'Sibsagar',
                'state' => 'Assam',
            ),
            575 => array(
                'id' => '576',
                'name' => 'Mandi Dabwali',
                'state' => 'Haryana',
            ),
            576 => array(
                'id' => '577',
                'name' => 'Ottappalam',
                'state' => 'Kerala',
            ),
            577 => array(
                'id' => '578',
                'name' => 'Dumraon',
                'state' => 'Bihar',
            ),
            578 => array(
                'id' => '579',
                'name' => 'Samalkot',
                'state' => 'Andhra Pradesh',
            ),
            579 => array(
                'id' => '580',
                'name' => 'Jaggaiahpet',
                'state' => 'Andhra Pradesh',
            ),
            580 => array(
                'id' => '581',
                'name' => 'Goalpara',
                'state' => 'Assam',
            ),
            581 => array(
                'id' => '582',
                'name' => 'Tuni',
                'state' => 'Andhra Pradesh',
            ),
            582 => array(
                'id' => '583',
                'name' => 'Lachhmangarh',
                'state' => 'Rajasthan',
            ),
            583 => array(
                'id' => '584',
                'name' => 'Bhongir',
                'state' => 'Telangana',
            ),
            584 => array(
                'id' => '585',
                'name' => 'Amalapuram',
                'state' => 'Andhra Pradesh',
            ),
            585 => array(
                'id' => '586',
                'name' => 'Firozpur Cantt.',
                'state' => 'Punjab',
            ),
            586 => array(
                'id' => '587',
                'name' => 'Vikarabad',
                'state' => 'Telangana',
            ),
            587 => array(
                'id' => '588',
                'name' => 'Thiruvalla',
                'state' => 'Kerala',
            ),
            588 => array(
                'id' => '589',
                'name' => 'Sherkot',
                'state' => 'Uttar Pradesh',
            ),
            589 => array(
                'id' => '590',
                'name' => 'Palghar',
                'state' => 'Maharashtra',
            ),
            590 => array(
                'id' => '591',
                'name' => 'Shegaon',
                'state' => 'Maharashtra',
            ),
            591 => array(
                'id' => '592',
                'name' => 'Jangaon',
                'state' => 'Telangana',
            ),
            592 => array(
                'id' => '593',
                'name' => 'Bheemunipatnam',
                'state' => 'Andhra Pradesh',
            ),
            593 => array(
                'id' => '594',
                'name' => 'Panna',
                'state' => 'Madhya Pradesh',
            ),
            594 => array(
                'id' => '595',
                'name' => 'Thodupuzha',
                'state' => 'Kerala',
            ),
            595 => array(
                'id' => '596',
                'name' => 'KathUrban Agglomeration',
                'state' => 'Jammu and Kashmir',
            ),
            596 => array(
                'id' => '597',
                'name' => 'Palitana',
                'state' => 'Gujarat',
            ),
            597 => array(
                'id' => '598',
                'name' => 'Arwal',
                'state' => 'Bihar',
            ),
            598 => array(
                'id' => '599',
                'name' => 'Venkatagiri',
                'state' => 'Andhra Pradesh',
            ),
            599 => array(
                'id' => '600',
                'name' => 'Kalpi',
                'state' => 'Uttar Pradesh',
            ),
            600 => array(
                'id' => '601',
                'name' => 'Rajgarh (Churu)',
                'state' => 'Rajasthan',
            ),
            601 => array(
                'id' => '602',
                'name' => 'Sattenapalle',
                'state' => 'Andhra Pradesh',
            ),
            602 => array(
                'id' => '603',
                'name' => 'Arsikere',
                'state' => 'Karnataka',
            ),
            603 => array(
                'id' => '604',
                'name' => 'Ozar',
                'state' => 'Maharashtra',
            ),
            604 => array(
                'id' => '605',
                'name' => 'Thirumangalam',
                'state' => 'Tamil Nadu',
            ),
            605 => array(
                'id' => '606',
                'name' => 'Petlad',
                'state' => 'Gujarat',
            ),
            606 => array(
                'id' => '607',
                'name' => 'Nasirabad',
                'state' => 'Rajasthan',
            ),
            607 => array(
                'id' => '608',
                'name' => 'Phaltan',
                'state' => 'Maharashtra',
            ),
            608 => array(
                'id' => '609',
                'name' => 'Rampurhat',
                'state' => 'West Bengal',
            ),
            609 => array(
                'id' => '610',
                'name' => 'Nanjangud',
                'state' => 'Karnataka',
            ),
            610 => array(
                'id' => '611',
                'name' => 'Forbesganj',
                'state' => 'Bihar',
            ),
            611 => array(
                'id' => '612',
                'name' => 'Tundla',
                'state' => 'Uttar Pradesh',
            ),
            612 => array(
                'id' => '613',
                'name' => 'BhabUrban Agglomeration',
                'state' => 'Bihar',
            ),
            613 => array(
                'id' => '614',
                'name' => 'Sagara',
                'state' => 'Karnataka',
            ),
            614 => array(
                'id' => '615',
                'name' => 'Pithapuram',
                'state' => 'Andhra Pradesh',
            ),
            615 => array(
                'id' => '616',
                'name' => 'Sira',
                'state' => 'Karnataka',
            ),
            616 => array(
                'id' => '617',
                'name' => 'Bhadrachalam',
                'state' => 'Telangana',
            ),
            617 => array(
                'id' => '618',
                'name' => 'Charkhi Dadri',
                'state' => 'Haryana',
            ),
            618 => array(
                'id' => '619',
                'name' => 'Chatra',
                'state' => 'Jharkhand',
            ),
            619 => array(
                'id' => '620',
                'name' => 'Palasa Kasibugga',
                'state' => 'Andhra Pradesh',
            ),
            620 => array(
                'id' => '621',
                'name' => 'Nohar',
                'state' => 'Rajasthan',
            ),
            621 => array(
                'id' => '622',
                'name' => 'Yevla',
                'state' => 'Maharashtra',
            ),
            622 => array(
                'id' => '623',
                'name' => 'Sirhind Fatehgarh Sahib',
                'state' => 'Punjab',
            ),
            623 => array(
                'id' => '624',
                'name' => 'Bhainsa',
                'state' => 'Telangana',
            ),
            624 => array(
                'id' => '625',
                'name' => 'Parvathipuram',
                'state' => 'Andhra Pradesh',
            ),
            625 => array(
                'id' => '626',
                'name' => 'Shahade',
                'state' => 'Maharashtra',
            ),
            626 => array(
                'id' => '627',
                'name' => 'Chalakudy',
                'state' => 'Kerala',
            ),
            627 => array(
                'id' => '628',
                'name' => 'Narkatiaganj',
                'state' => 'Bihar',
            ),
            628 => array(
                'id' => '629',
                'name' => 'Kapadvanj',
                'state' => 'Gujarat',
            ),
            629 => array(
                'id' => '630',
                'name' => 'Macherla',
                'state' => 'Andhra Pradesh',
            ),
            630 => array(
                'id' => '631',
                'name' => 'Raghogarh-Vijaypur',
                'state' => 'Madhya Pradesh',
            ),
            631 => array(
                'id' => '632',
                'name' => 'Rupnagar',
                'state' => 'Punjab',
            ),
            632 => array(
                'id' => '633',
                'name' => 'Naugachhia',
                'state' => 'Bihar',
            ),
            633 => array(
                'id' => '634',
                'name' => 'Sendhwa',
                'state' => 'Madhya Pradesh',
            ),
            634 => array(
                'id' => '635',
                'name' => 'Byasanagar',
                'state' => 'Odisha',
            ),
            635 => array(
                'id' => '636',
                'name' => 'Sandila',
                'state' => 'Uttar Pradesh',
            ),
            636 => array(
                'id' => '637',
                'name' => 'Gooty',
                'state' => 'Andhra Pradesh',
            ),
            637 => array(
                'id' => '638',
                'name' => 'Salur',
                'state' => 'Andhra Pradesh',
            ),
            638 => array(
                'id' => '639',
                'name' => 'Nanpara',
                'state' => 'Uttar Pradesh',
            ),
            639 => array(
                'id' => '640',
                'name' => 'Sardhana',
                'state' => 'Uttar Pradesh',
            ),
            640 => array(
                'id' => '641',
                'name' => 'Vita',
                'state' => 'Maharashtra',
            ),
            641 => array(
                'id' => '642',
                'name' => 'Gumia',
                'state' => 'Jharkhand',
            ),
            642 => array(
                'id' => '643',
                'name' => 'Puttur',
                'state' => 'Karnataka',
            ),
            643 => array(
                'id' => '644',
                'name' => 'Jalandhar Cantt.',
                'state' => 'Punjab',
            ),
            644 => array(
                'id' => '645',
                'name' => 'Nehtaur',
                'state' => 'Uttar Pradesh',
            ),
            645 => array(
                'id' => '646',
                'name' => 'Changanassery',
                'state' => 'Kerala',
            ),
            646 => array(
                'id' => '647',
                'name' => 'Mandapeta',
                'state' => 'Andhra Pradesh',
            ),
            647 => array(
                'id' => '648',
                'name' => 'Dumka',
                'state' => 'Jharkhand',
            ),
            648 => array(
                'id' => '649',
                'name' => 'Seohara',
                'state' => 'Uttar Pradesh',
            ),
            649 => array(
                'id' => '650',
                'name' => 'Umarkhed',
                'state' => 'Maharashtra',
            ),
            650 => array(
                'id' => '651',
                'name' => 'Madhupur',
                'state' => 'Jharkhand',
            ),
            651 => array(
                'id' => '652',
                'name' => 'Vikramasingapuram',
                'state' => 'Tamil Nadu',
            ),
            652 => array(
                'id' => '653',
                'name' => 'Punalur',
                'state' => 'Kerala',
            ),
            653 => array(
                'id' => '654',
                'name' => 'Kendrapara',
                'state' => 'Odisha',
            ),
            654 => array(
                'id' => '655',
                'name' => 'Sihor',
                'state' => 'Gujarat',
            ),
            655 => array(
                'id' => '656',
                'name' => 'Nellikuppam',
                'state' => 'Tamil Nadu',
            ),
            656 => array(
                'id' => '657',
                'name' => 'Samana',
                'state' => 'Punjab',
            ),
            657 => array(
                'id' => '658',
                'name' => 'Warora',
                'state' => 'Maharashtra',
            ),
            658 => array(
                'id' => '659',
                'name' => 'Nilambur',
                'state' => 'Kerala',
            ),
            659 => array(
                'id' => '660',
                'name' => 'Rasipuram',
                'state' => 'Tamil Nadu',
            ),
            660 => array(
                'id' => '661',
                'name' => 'Ramnagar',
                'state' => 'Uttarakhand',
            ),
            661 => array(
                'id' => '662',
                'name' => 'Jammalamadugu',
                'state' => 'Andhra Pradesh',
            ),
            662 => array(
                'id' => '663',
                'name' => 'Nawanshahr',
                'state' => 'Punjab',
            ),
            663 => array(
                'id' => '664',
                'name' => 'Thoubal',
                'state' => 'Manipur',
            ),
            664 => array(
                'id' => '665',
                'name' => 'Athni',
                'state' => 'Karnataka',
            ),
            665 => array(
                'id' => '666',
                'name' => 'Cherthala',
                'state' => 'Kerala',
            ),
            666 => array(
                'id' => '667',
                'name' => 'Sidhi',
                'state' => 'Madhya Pradesh',
            ),
            667 => array(
                'id' => '668',
                'name' => 'Farooqnagar',
                'state' => 'Telangana',
            ),
            668 => array(
                'id' => '669',
                'name' => 'Peddapuram',
                'state' => 'Andhra Pradesh',
            ),
            669 => array(
                'id' => '670',
                'name' => 'Chirkunda',
                'state' => 'Jharkhand',
            ),
            670 => array(
                'id' => '671',
                'name' => 'Pachora',
                'state' => 'Maharashtra',
            ),
            671 => array(
                'id' => '672',
                'name' => 'Madhepura',
                'state' => 'Bihar',
            ),
            672 => array(
                'id' => '673',
                'name' => 'Pithoragarh',
                'state' => 'Uttarakhand',
            ),
            673 => array(
                'id' => '674',
                'name' => 'Tumsar',
                'state' => 'Maharashtra',
            ),
            674 => array(
                'id' => '675',
                'name' => 'Phalodi',
                'state' => 'Rajasthan',
            ),
            675 => array(
                'id' => '676',
                'name' => 'Tiruttani',
                'state' => 'Tamil Nadu',
            ),
            676 => array(
                'id' => '677',
                'name' => 'Rampura Phul',
                'state' => 'Punjab',
            ),
            677 => array(
                'id' => '678',
                'name' => 'Perinthalmanna',
                'state' => 'Kerala',
            ),
            678 => array(
                'id' => '679',
                'name' => 'Padrauna',
                'state' => 'Uttar Pradesh',
            ),
            679 => array(
                'id' => '680',
                'name' => 'Pipariya',
                'state' => 'Madhya Pradesh',
            ),
            680 => array(
                'id' => '681',
                'name' => 'Dalli-Rajhara',
                'state' => 'Chhattisgarh',
            ),
            681 => array(
                'id' => '682',
                'name' => 'Punganur',
                'state' => 'Andhra Pradesh',
            ),
            682 => array(
                'id' => '683',
                'name' => 'Mattannur',
                'state' => 'Kerala',
            ),
            683 => array(
                'id' => '684',
                'name' => 'Mathura',
                'state' => 'Uttar Pradesh',
            ),
            684 => array(
                'id' => '685',
                'name' => 'Thakurdwara',
                'state' => 'Uttar Pradesh',
            ),
            685 => array(
                'id' => '686',
                'name' => 'Nandivaram-Guduvancheri',
                'state' => 'Tamil Nadu',
            ),
            686 => array(
                'id' => '687',
                'name' => 'Mulbagal',
                'state' => 'Karnataka',
            ),
            687 => array(
                'id' => '688',
                'name' => 'Manjlegaon',
                'state' => 'Maharashtra',
            ),
            688 => array(
                'id' => '689',
                'name' => 'Wankaner',
                'state' => 'Gujarat',
            ),
            689 => array(
                'id' => '690',
                'name' => 'Sillod',
                'state' => 'Maharashtra',
            ),
            690 => array(
                'id' => '691',
                'name' => 'Nidadavole',
                'state' => 'Andhra Pradesh',
            ),
            691 => array(
                'id' => '692',
                'name' => 'Surapura',
                'state' => 'Karnataka',
            ),
            692 => array(
                'id' => '693',
                'name' => 'Rajagangapur',
                'state' => 'Odisha',
            ),
            693 => array(
                'id' => '694',
                'name' => 'Sheikhpura',
                'state' => 'Bihar',
            ),
            694 => array(
                'id' => '695',
                'name' => 'Parlakhemundi',
                'state' => 'Odisha',
            ),
            695 => array(
                'id' => '696',
                'name' => 'Kalimpong',
                'state' => 'West Bengal',
            ),
            696 => array(
                'id' => '697',
                'name' => 'Siruguppa',
                'state' => 'Karnataka',
            ),
            697 => array(
                'id' => '698',
                'name' => 'Arvi',
                'state' => 'Maharashtra',
            ),
            698 => array(
                'id' => '699',
                'name' => 'Limbdi',
                'state' => 'Gujarat',
            ),
            699 => array(
                'id' => '700',
                'name' => 'Barpeta',
                'state' => 'Assam',
            ),
            700 => array(
                'id' => '701',
                'name' => 'Manglaur',
                'state' => 'Uttarakhand',
            ),
            701 => array(
                'id' => '702',
                'name' => 'Repalle',
                'state' => 'Andhra Pradesh',
            ),
            702 => array(
                'id' => '703',
                'name' => 'Mudhol',
                'state' => 'Karnataka',
            ),
            703 => array(
                'id' => '704',
                'name' => 'Shujalpur',
                'state' => 'Madhya Pradesh',
            ),
            704 => array(
                'id' => '705',
                'name' => 'Mandvi',
                'state' => 'Gujarat',
            ),
            705 => array(
                'id' => '706',
                'name' => 'Thangadh',
                'state' => 'Gujarat',
            ),
            706 => array(
                'id' => '707',
                'name' => 'Sironj',
                'state' => 'Madhya Pradesh',
            ),
            707 => array(
                'id' => '708',
                'name' => 'Nandura',
                'state' => 'Maharashtra',
            ),
            708 => array(
                'id' => '709',
                'name' => 'Shoranur',
                'state' => 'Kerala',
            ),
            709 => array(
                'id' => '710',
                'name' => 'Nathdwara',
                'state' => 'Rajasthan',
            ),
            710 => array(
                'id' => '711',
                'name' => 'Periyakulam',
                'state' => 'Tamil Nadu',
            ),
            711 => array(
                'id' => '712',
                'name' => 'Sultanganj',
                'state' => 'Bihar',
            ),
            712 => array(
                'id' => '713',
                'name' => 'Medak',
                'state' => 'Telangana',
            ),
            713 => array(
                'id' => '714',
                'name' => 'Narayanpet',
                'state' => 'Telangana',
            ),
            714 => array(
                'id' => '715',
                'name' => 'Raxaul Bazar',
                'state' => 'Bihar',
            ),
            715 => array(
                'id' => '716',
                'name' => 'Rajauri',
                'state' => 'Jammu and Kashmir',
            ),
            716 => array(
                'id' => '717',
                'name' => 'Pernampattu',
                'state' => 'Tamil Nadu',
            ),
            717 => array(
                'id' => '718',
                'name' => 'Nainital',
                'state' => 'Uttarakhand',
            ),
            718 => array(
                'id' => '719',
                'name' => 'Ramachandrapuram',
                'state' => 'Andhra Pradesh',
            ),
            719 => array(
                'id' => '720',
                'name' => 'Vaijapur',
                'state' => 'Maharashtra',
            ),
            720 => array(
                'id' => '721',
                'name' => 'Nangal',
                'state' => 'Punjab',
            ),
            721 => array(
                'id' => '722',
                'name' => 'Sidlaghatta',
                'state' => 'Karnataka',
            ),
            722 => array(
                'id' => '723',
                'name' => 'Punch',
                'state' => 'Jammu and Kashmir',
            ),
            723 => array(
                'id' => '724',
                'name' => 'Pandhurna',
                'state' => 'Madhya Pradesh',
            ),
            724 => array(
                'id' => '725',
                'name' => 'Wadgaon Road',
                'state' => 'Maharashtra',
            ),
            725 => array(
                'id' => '726',
                'name' => 'Talcher',
                'state' => 'Odisha',
            ),
            726 => array(
                'id' => '727',
                'name' => 'Varkala',
                'state' => 'Kerala',
            ),
            727 => array(
                'id' => '728',
                'name' => 'Pilani',
                'state' => 'Rajasthan',
            ),
            728 => array(
                'id' => '729',
                'name' => 'Nowgong',
                'state' => 'Madhya Pradesh',
            ),
            729 => array(
                'id' => '730',
                'name' => 'Naila Janjgir',
                'state' => 'Chhattisgarh',
            ),
            730 => array(
                'id' => '731',
                'name' => 'Mapusa',
                'state' => 'Goa',
            ),
            731 => array(
                'id' => '732',
                'name' => 'Vellakoil',
                'state' => 'Tamil Nadu',
            ),
            732 => array(
                'id' => '733',
                'name' => 'Merta City',
                'state' => 'Rajasthan',
            ),
            733 => array(
                'id' => '734',
                'name' => 'Sivaganga',
                'state' => 'Tamil Nadu',
            ),
            734 => array(
                'id' => '735',
                'name' => 'Mandideep',
                'state' => 'Madhya Pradesh',
            ),
            735 => array(
                'id' => '736',
                'name' => 'Sailu',
                'state' => 'Maharashtra',
            ),
            736 => array(
                'id' => '737',
                'name' => 'Vyara',
                'state' => 'Gujarat',
            ),
            737 => array(
                'id' => '738',
                'name' => 'Kovvur',
                'state' => 'Andhra Pradesh',
            ),
            738 => array(
                'id' => '739',
                'name' => 'Vadalur',
                'state' => 'Tamil Nadu',
            ),
            739 => array(
                'id' => '740',
                'name' => 'Nawabganj',
                'state' => 'Uttar Pradesh',
            ),
            740 => array(
                'id' => '741',
                'name' => 'Padra',
                'state' => 'Gujarat',
            ),
            741 => array(
                'id' => '742',
                'name' => 'Sainthia',
                'state' => 'West Bengal',
            ),
            742 => array(
                'id' => '743',
                'name' => 'Siana',
                'state' => 'Uttar Pradesh',
            ),
            743 => array(
                'id' => '744',
                'name' => 'Shahpur',
                'state' => 'Karnataka',
            ),
            744 => array(
                'id' => '745',
                'name' => 'Sojat',
                'state' => 'Rajasthan',
            ),
            745 => array(
                'id' => '746',
                'name' => 'Noorpur',
                'state' => 'Uttar Pradesh',
            ),
            746 => array(
                'id' => '747',
                'name' => 'Paravoor',
                'state' => 'Kerala',
            ),
            747 => array(
                'id' => '748',
                'name' => 'Murtijapur',
                'state' => 'Maharashtra',
            ),
            748 => array(
                'id' => '749',
                'name' => 'Ramnagar',
                'state' => 'Bihar',
            ),
            749 => array(
                'id' => '750',
                'name' => 'Sundargarh',
                'state' => 'Odisha',
            ),
            750 => array(
                'id' => '751',
                'name' => 'Taki',
                'state' => 'West Bengal',
            ),
            751 => array(
                'id' => '752',
                'name' => 'Saundatti-Yellamma',
                'state' => 'Karnataka',
            ),
            752 => array(
                'id' => '753',
                'name' => 'Pathanamthitta',
                'state' => 'Kerala',
            ),
            753 => array(
                'id' => '754',
                'name' => 'Wadi',
                'state' => 'Karnataka',
            ),
            754 => array(
                'id' => '755',
                'name' => 'Rameshwaram',
                'state' => 'Tamil Nadu',
            ),
            755 => array(
                'id' => '756',
                'name' => 'Tasgaon',
                'state' => 'Maharashtra',
            ),
            756 => array(
                'id' => '757',
                'name' => 'Sikandra Rao',
                'state' => 'Uttar Pradesh',
            ),
            757 => array(
                'id' => '758',
                'name' => 'Sihora',
                'state' => 'Madhya Pradesh',
            ),
            758 => array(
                'id' => '759',
                'name' => 'Tiruvethipuram',
                'state' => 'Tamil Nadu',
            ),
            759 => array(
                'id' => '760',
                'name' => 'Tiruvuru',
                'state' => 'Andhra Pradesh',
            ),
            760 => array(
                'id' => '761',
                'name' => 'Mehkar',
                'state' => 'Maharashtra',
            ),
            761 => array(
                'id' => '762',
                'name' => 'Peringathur',
                'state' => 'Kerala',
            ),
            762 => array(
                'id' => '763',
                'name' => 'Perambalur',
                'state' => 'Tamil Nadu',
            ),
            763 => array(
                'id' => '764',
                'name' => 'Manvi',
                'state' => 'Karnataka',
            ),
            764 => array(
                'id' => '765',
                'name' => 'Zunheboto',
                'state' => 'Nagaland',
            ),
            765 => array(
                'id' => '766',
                'name' => 'Mahnar Bazar',
                'state' => 'Bihar',
            ),
            766 => array(
                'id' => '767',
                'name' => 'Attingal',
                'state' => 'Kerala',
            ),
            767 => array(
                'id' => '768',
                'name' => 'Shahbad',
                'state' => 'Haryana',
            ),
            768 => array(
                'id' => '769',
                'name' => 'Puranpur',
                'state' => 'Uttar Pradesh',
            ),
            769 => array(
                'id' => '770',
                'name' => 'Nelamangala',
                'state' => 'Karnataka',
            ),
            770 => array(
                'id' => '771',
                'name' => 'Nakodar',
                'state' => 'Punjab',
            ),
            771 => array(
                'id' => '772',
                'name' => 'Lunawada',
                'state' => 'Gujarat',
            ),
            772 => array(
                'id' => '773',
                'name' => 'Murshidabad',
                'state' => 'West Bengal',
            ),
            773 => array(
                'id' => '774',
                'name' => 'Mahe',
                'state' => 'Puducherry',
            ),
            774 => array(
                'id' => '775',
                'name' => 'Lanka',
                'state' => 'Assam',
            ),
            775 => array(
                'id' => '776',
                'name' => 'Rudauli',
                'state' => 'Uttar Pradesh',
            ),
            776 => array(
                'id' => '777',
                'name' => 'Tuensang',
                'state' => 'Nagaland',
            ),
            777 => array(
                'id' => '778',
                'name' => 'Lakshmeshwar',
                'state' => 'Karnataka',
            ),
            778 => array(
                'id' => '779',
                'name' => 'Zira',
                'state' => 'Punjab',
            ),
            779 => array(
                'id' => '780',
                'name' => 'Yawal',
                'state' => 'Maharashtra',
            ),
            780 => array(
                'id' => '781',
                'name' => 'Thana Bhawan',
                'state' => 'Uttar Pradesh',
            ),
            781 => array(
                'id' => '782',
                'name' => 'Ramdurg',
                'state' => 'Karnataka',
            ),
            782 => array(
                'id' => '783',
                'name' => 'Pulgaon',
                'state' => 'Maharashtra',
            ),
            783 => array(
                'id' => '784',
                'name' => 'Sadasivpet',
                'state' => 'Telangana',
            ),
            784 => array(
                'id' => '785',
                'name' => 'Nargund',
                'state' => 'Karnataka',
            ),
            785 => array(
                'id' => '786',
                'name' => 'Neem-Ka-Thana',
                'state' => 'Rajasthan',
            ),
            786 => array(
                'id' => '787',
                'name' => 'Memari',
                'state' => 'West Bengal',
            ),
            787 => array(
                'id' => '788',
                'name' => 'Nilanga',
                'state' => 'Maharashtra',
            ),
            788 => array(
                'id' => '789',
                'name' => 'Naharlagun',
                'state' => 'Arunachal Pradesh',
            ),
            789 => array(
                'id' => '790',
                'name' => 'Pakaur',
                'state' => 'Jharkhand',
            ),
            790 => array(
                'id' => '791',
                'name' => 'Wai',
                'state' => 'Maharashtra',
            ),
            791 => array(
                'id' => '792',
                'name' => 'Tarikere',
                'state' => 'Karnataka',
            ),
            792 => array(
                'id' => '793',
                'name' => 'Malavalli',
                'state' => 'Karnataka',
            ),
            793 => array(
                'id' => '794',
                'name' => 'Raisen',
                'state' => 'Madhya Pradesh',
            ),
            794 => array(
                'id' => '795',
                'name' => 'Lahar',
                'state' => 'Madhya Pradesh',
            ),
            795 => array(
                'id' => '796',
                'name' => 'Uravakonda',
                'state' => 'Andhra Pradesh',
            ),
            796 => array(
                'id' => '797',
                'name' => 'Savanur',
                'state' => 'Karnataka',
            ),
            797 => array(
                'id' => '798',
                'name' => 'Sirohi',
                'state' => 'Rajasthan',
            ),
            798 => array(
                'id' => '799',
                'name' => 'Udhampur',
                'state' => 'Jammu and Kashmir',
            ),
            799 => array(
                'id' => '800',
                'name' => 'Umarga',
                'state' => 'Maharashtra',
            ),
            800 => array(
                'id' => '801',
                'name' => 'Pratapgarh',
                'state' => 'Rajasthan',
            ),
            801 => array(
                'id' => '802',
                'name' => 'Lingsugur',
                'state' => 'Karnataka',
            ),
            802 => array(
                'id' => '803',
                'name' => 'Usilampatti',
                'state' => 'Tamil Nadu',
            ),
            803 => array(
                'id' => '804',
                'name' => 'Palia Kalan',
                'state' => 'Uttar Pradesh',
            ),
            804 => array(
                'id' => '805',
                'name' => 'Wokha',
                'state' => 'Nagaland',
            ),
            805 => array(
                'id' => '806',
                'name' => 'Rajpipla',
                'state' => 'Gujarat',
            ),
            806 => array(
                'id' => '807',
                'name' => 'Vijayapura',
                'state' => 'Karnataka',
            ),
            807 => array(
                'id' => '808',
                'name' => 'Rawatbhata',
                'state' => 'Rajasthan',
            ),
            808 => array(
                'id' => '809',
                'name' => 'Sangaria',
                'state' => 'Rajasthan',
            ),
            809 => array(
                'id' => '810',
                'name' => 'Paithan',
                'state' => 'Maharashtra',
            ),
            810 => array(
                'id' => '811',
                'name' => 'Rahuri',
                'state' => 'Maharashtra',
            ),
            811 => array(
                'id' => '812',
                'name' => 'Patti',
                'state' => 'Punjab',
            ),
            812 => array(
                'id' => '813',
                'name' => 'Zaidpur',
                'state' => 'Uttar Pradesh',
            ),
            813 => array(
                'id' => '814',
                'name' => 'Lalsot',
                'state' => 'Rajasthan',
            ),
            814 => array(
                'id' => '815',
                'name' => 'Maihar',
                'state' => 'Madhya Pradesh',
            ),
            815 => array(
                'id' => '816',
                'name' => 'Vedaranyam',
                'state' => 'Tamil Nadu',
            ),
            816 => array(
                'id' => '817',
                'name' => 'Nawapur',
                'state' => 'Maharashtra',
            ),
            817 => array(
                'id' => '818',
                'name' => 'Solan',
                'state' => 'Himachal Pradesh',
            ),
            818 => array(
                'id' => '819',
                'name' => 'Vapi',
                'state' => 'Gujarat',
            ),
            819 => array(
                'id' => '820',
                'name' => 'Sanawad',
                'state' => 'Madhya Pradesh',
            ),
            820 => array(
                'id' => '821',
                'name' => 'Warisaliganj',
                'state' => 'Bihar',
            ),
            821 => array(
                'id' => '822',
                'name' => 'Revelganj',
                'state' => 'Bihar',
            ),
            822 => array(
                'id' => '823',
                'name' => 'Sabalgarh',
                'state' => 'Madhya Pradesh',
            ),
            823 => array(
                'id' => '824',
                'name' => 'Tuljapur',
                'state' => 'Maharashtra',
            ),
            824 => array(
                'id' => '825',
                'name' => 'Simdega',
                'state' => 'Jharkhand',
            ),
            825 => array(
                'id' => '826',
                'name' => 'Musabani',
                'state' => 'Jharkhand',
            ),
            826 => array(
                'id' => '827',
                'name' => 'Kodungallur',
                'state' => 'Kerala',
            ),
            827 => array(
                'id' => '828',
                'name' => 'Phulabani',
                'state' => 'Odisha',
            ),
            828 => array(
                'id' => '829',
                'name' => 'Umreth',
                'state' => 'Gujarat',
            ),
            829 => array(
                'id' => '830',
                'name' => 'Narsipatnam',
                'state' => 'Andhra Pradesh',
            ),
            830 => array(
                'id' => '831',
                'name' => 'Nautanwa',
                'state' => 'Uttar Pradesh',
            ),
            831 => array(
                'id' => '832',
                'name' => 'Rajgir',
                'state' => 'Bihar',
            ),
            832 => array(
                'id' => '833',
                'name' => 'Yellandu',
                'state' => 'Telangana',
            ),
            833 => array(
                'id' => '834',
                'name' => 'Sathyamangalam',
                'state' => 'Tamil Nadu',
            ),
            834 => array(
                'id' => '835',
                'name' => 'Pilibanga',
                'state' => 'Rajasthan',
            ),
            835 => array(
                'id' => '836',
                'name' => 'Morshi',
                'state' => 'Maharashtra',
            ),
            836 => array(
                'id' => '837',
                'name' => 'Pehowa',
                'state' => 'Haryana',
            ),
            837 => array(
                'id' => '838',
                'name' => 'Sonepur',
                'state' => 'Bihar',
            ),
            838 => array(
                'id' => '839',
                'name' => 'Pappinisseri',
                'state' => 'Kerala',
            ),
            839 => array(
                'id' => '840',
                'name' => 'Zamania',
                'state' => 'Uttar Pradesh',
            ),
            840 => array(
                'id' => '841',
                'name' => 'Mihijam',
                'state' => 'Jharkhand',
            ),
            841 => array(
                'id' => '842',
                'name' => 'Purna',
                'state' => 'Maharashtra',
            ),
            842 => array(
                'id' => '843',
                'name' => 'Puliyankudi',
                'state' => 'Tamil Nadu',
            ),
            843 => array(
                'id' => '844',
                'name' => 'Shikarpur, Bulandshahr',
                'state' => 'Uttar Pradesh',
            ),
            844 => array(
                'id' => '845',
                'name' => 'Umaria',
                'state' => 'Madhya Pradesh',
            ),
            845 => array(
                'id' => '846',
                'name' => 'Porsa',
                'state' => 'Madhya Pradesh',
            ),
            846 => array(
                'id' => '847',
                'name' => 'Naugawan Sadat',
                'state' => 'Uttar Pradesh',
            ),
            847 => array(
                'id' => '848',
                'name' => 'Fatehpur Sikri',
                'state' => 'Uttar Pradesh',
            ),
            848 => array(
                'id' => '849',
                'name' => 'Manuguru',
                'state' => 'Telangana',
            ),
            849 => array(
                'id' => '850',
                'name' => 'Udaipur',
                'state' => 'Tripura',
            ),
            850 => array(
                'id' => '851',
                'name' => 'Pipar City',
                'state' => 'Rajasthan',
            ),
            851 => array(
                'id' => '852',
                'name' => 'Pattamundai',
                'state' => 'Odisha',
            ),
            852 => array(
                'id' => '853',
                'name' => 'Nanjikottai',
                'state' => 'Tamil Nadu',
            ),
            853 => array(
                'id' => '854',
                'name' => 'Taranagar',
                'state' => 'Rajasthan',
            ),
            854 => array(
                'id' => '855',
                'name' => 'Yerraguntla',
                'state' => 'Andhra Pradesh',
            ),
            855 => array(
                'id' => '856',
                'name' => 'Satana',
                'state' => 'Maharashtra',
            ),
            856 => array(
                'id' => '857',
                'name' => 'Sherghati',
                'state' => 'Bihar',
            ),
            857 => array(
                'id' => '858',
                'name' => 'Sankeshwara',
                'state' => 'Karnataka',
            ),
            858 => array(
                'id' => '859',
                'name' => 'Madikeri',
                'state' => 'Karnataka',
            ),
            859 => array(
                'id' => '860',
                'name' => 'Thuraiyur',
                'state' => 'Tamil Nadu',
            ),
            860 => array(
                'id' => '861',
                'name' => 'Sanand',
                'state' => 'Gujarat',
            ),
            861 => array(
                'id' => '862',
                'name' => 'Rajula',
                'state' => 'Gujarat',
            ),
            862 => array(
                'id' => '863',
                'name' => 'Kyathampalle',
                'state' => 'Telangana',
            ),
            863 => array(
                'id' => '864',
                'name' => 'Shahabad, Rampur',
                'state' => 'Uttar Pradesh',
            ),
            864 => array(
                'id' => '865',
                'name' => 'Tilda Newra',
                'state' => 'Chhattisgarh',
            ),
            865 => array(
                'id' => '866',
                'name' => 'Narsinghgarh',
                'state' => 'Madhya Pradesh',
            ),
            866 => array(
                'id' => '867',
                'name' => 'Chittur-Thathamangalam',
                'state' => 'Kerala',
            ),
            867 => array(
                'id' => '868',
                'name' => 'Malaj Khand',
                'state' => 'Madhya Pradesh',
            ),
            868 => array(
                'id' => '869',
                'name' => 'Sarangpur',
                'state' => 'Madhya Pradesh',
            ),
            869 => array(
                'id' => '870',
                'name' => 'Robertsganj',
                'state' => 'Uttar Pradesh',
            ),
            870 => array(
                'id' => '871',
                'name' => 'Sirkali',
                'state' => 'Tamil Nadu',
            ),
            871 => array(
                'id' => '872',
                'name' => 'Radhanpur',
                'state' => 'Gujarat',
            ),
            872 => array(
                'id' => '873',
                'name' => 'Tiruchendur',
                'state' => 'Tamil Nadu',
            ),
            873 => array(
                'id' => '874',
                'name' => 'Utraula',
                'state' => 'Uttar Pradesh',
            ),
            874 => array(
                'id' => '875',
                'name' => 'Patratu',
                'state' => 'Jharkhand',
            ),
            875 => array(
                'id' => '876',
                'name' => 'Vijainagar, Ajmer',
                'state' => 'Rajasthan',
            ),
            876 => array(
                'id' => '877',
                'name' => 'Periyasemur',
                'state' => 'Tamil Nadu',
            ),
            877 => array(
                'id' => '878',
                'name' => 'Pathri',
                'state' => 'Maharashtra',
            ),
            878 => array(
                'id' => '879',
                'name' => 'Sadabad',
                'state' => 'Uttar Pradesh',
            ),
            879 => array(
                'id' => '880',
                'name' => 'Talikota',
                'state' => 'Karnataka',
            ),
            880 => array(
                'id' => '881',
                'name' => 'Sinnar',
                'state' => 'Maharashtra',
            ),
            881 => array(
                'id' => '882',
                'name' => 'Mungeli',
                'state' => 'Chhattisgarh',
            ),
            882 => array(
                'id' => '883',
                'name' => 'Sedam',
                'state' => 'Karnataka',
            ),
            883 => array(
                'id' => '884',
                'name' => 'Shikaripur',
                'state' => 'Karnataka',
            ),
            884 => array(
                'id' => '885',
                'name' => 'Sumerpur',
                'state' => 'Rajasthan',
            ),
            885 => array(
                'id' => '886',
                'name' => 'Sattur',
                'state' => 'Tamil Nadu',
            ),
            886 => array(
                'id' => '887',
                'name' => 'Sugauli',
                'state' => 'Bihar',
            ),
            887 => array(
                'id' => '888',
                'name' => 'Lumding',
                'state' => 'Assam',
            ),
            888 => array(
                'id' => '889',
                'name' => 'Vandavasi',
                'state' => 'Tamil Nadu',
            ),
            889 => array(
                'id' => '890',
                'name' => 'Titlagarh',
                'state' => 'Odisha',
            ),
            890 => array(
                'id' => '891',
                'name' => 'Uchgaon',
                'state' => 'Maharashtra',
            ),
            891 => array(
                'id' => '892',
                'name' => 'Mokokchung',
                'state' => 'Nagaland',
            ),
            892 => array(
                'id' => '893',
                'name' => 'Paschim Punropara',
                'state' => 'West Bengal',
            ),
            893 => array(
                'id' => '894',
                'name' => 'Sagwara',
                'state' => 'Rajasthan',
            ),
            894 => array(
                'id' => '895',
                'name' => 'Ramganj Mandi',
                'state' => 'Rajasthan',
            ),
            895 => array(
                'id' => '896',
                'name' => 'Tarakeswar',
                'state' => 'West Bengal',
            ),
            896 => array(
                'id' => '897',
                'name' => 'Mahalingapura',
                'state' => 'Karnataka',
            ),
            897 => array(
                'id' => '898',
                'name' => 'Dharmanagar',
                'state' => 'Tripura',
            ),
            898 => array(
                'id' => '899',
                'name' => 'Mahemdabad',
                'state' => 'Gujarat',
            ),
            899 => array(
                'id' => '900',
                'name' => 'Manendragarh',
                'state' => 'Chhattisgarh',
            ),
            900 => array(
                'id' => '901',
                'name' => 'Uran',
                'state' => 'Maharashtra',
            ),
            901 => array(
                'id' => '902',
                'name' => 'Tharamangalam',
                'state' => 'Tamil Nadu',
            ),
            902 => array(
                'id' => '903',
                'name' => 'Tirukkoyilur',
                'state' => 'Tamil Nadu',
            ),
            903 => array(
                'id' => '904',
                'name' => 'Pen',
                'state' => 'Maharashtra',
            ),
            904 => array(
                'id' => '905',
                'name' => 'Makhdumpur',
                'state' => 'Bihar',
            ),
            905 => array(
                'id' => '906',
                'name' => 'Maner',
                'state' => 'Bihar',
            ),
            906 => array(
                'id' => '907',
                'name' => 'Oddanchatram',
                'state' => 'Tamil Nadu',
            ),
            907 => array(
                'id' => '908',
                'name' => 'Palladam',
                'state' => 'Tamil Nadu',
            ),
            908 => array(
                'id' => '909',
                'name' => 'Mundi',
                'state' => 'Madhya Pradesh',
            ),
            909 => array(
                'id' => '910',
                'name' => 'Nabarangapur',
                'state' => 'Odisha',
            ),
            910 => array(
                'id' => '911',
                'name' => 'Mudalagi',
                'state' => 'Karnataka',
            ),
            911 => array(
                'id' => '912',
                'name' => 'Samalkha',
                'state' => 'Haryana',
            ),
            912 => array(
                'id' => '913',
                'name' => 'Nepanagar',
                'state' => 'Madhya Pradesh',
            ),
            913 => array(
                'id' => '914',
                'name' => 'Karjat',
                'state' => 'Maharashtra',
            ),
            914 => array(
                'id' => '915',
                'name' => 'Ranavav',
                'state' => 'Gujarat',
            ),
            915 => array(
                'id' => '916',
                'name' => 'Pedana',
                'state' => 'Andhra Pradesh',
            ),
            916 => array(
                'id' => '917',
                'name' => 'Pinjore',
                'state' => 'Haryana',
            ),
            917 => array(
                'id' => '918',
                'name' => 'Lakheri',
                'state' => 'Rajasthan',
            ),
            918 => array(
                'id' => '919',
                'name' => 'Pasan',
                'state' => 'Madhya Pradesh',
            ),
            919 => array(
                'id' => '920',
                'name' => 'Puttur',
                'state' => 'Andhra Pradesh',
            ),
            920 => array(
                'id' => '921',
                'name' => 'Vadakkuvalliyur',
                'state' => 'Tamil Nadu',
            ),
            921 => array(
                'id' => '922',
                'name' => 'Tirukalukundram',
                'state' => 'Tamil Nadu',
            ),
            922 => array(
                'id' => '923',
                'name' => 'Mahidpur',
                'state' => 'Madhya Pradesh',
            ),
            923 => array(
                'id' => '924',
                'name' => 'Mussoorie',
                'state' => 'Uttarakhand',
            ),
            924 => array(
                'id' => '925',
                'name' => 'Muvattupuzha',
                'state' => 'Kerala',
            ),
            925 => array(
                'id' => '926',
                'name' => 'Rasra',
                'state' => 'Uttar Pradesh',
            ),
            926 => array(
                'id' => '927',
                'name' => 'Udaipurwati',
                'state' => 'Rajasthan',
            ),
            927 => array(
                'id' => '928',
                'name' => 'Manwath',
                'state' => 'Maharashtra',
            ),
            928 => array(
                'id' => '929',
                'name' => 'Adoor',
                'state' => 'Kerala',
            ),
            929 => array(
                'id' => '930',
                'name' => 'Uthamapalayam',
                'state' => 'Tamil Nadu',
            ),
            930 => array(
                'id' => '931',
                'name' => 'Partur',
                'state' => 'Maharashtra',
            ),
            931 => array(
                'id' => '932',
                'name' => 'Nahan',
                'state' => 'Himachal Pradesh',
            ),
            932 => array(
                'id' => '933',
                'name' => 'Ladwa',
                'state' => 'Haryana',
            ),
            933 => array(
                'id' => '934',
                'name' => 'Mankachar',
                'state' => 'Assam',
            ),
            934 => array(
                'id' => '935',
                'name' => 'Nongstoin',
                'state' => 'Meghalaya',
            ),
            935 => array(
                'id' => '936',
                'name' => 'Losal',
                'state' => 'Rajasthan',
            ),
            936 => array(
                'id' => '937',
                'name' => 'Sri Madhopur',
                'state' => 'Rajasthan',
            ),
            937 => array(
                'id' => '938',
                'name' => 'Ramngarh',
                'state' => 'Rajasthan',
            ),
            938 => array(
                'id' => '939',
                'name' => 'Mavelikkara',
                'state' => 'Kerala',
            ),
            939 => array(
                'id' => '940',
                'name' => 'Rawatsar',
                'state' => 'Rajasthan',
            ),
            940 => array(
                'id' => '941',
                'name' => 'Rajakhera',
                'state' => 'Rajasthan',
            ),
            941 => array(
                'id' => '942',
                'name' => 'Lar',
                'state' => 'Uttar Pradesh',
            ),
            942 => array(
                'id' => '943',
                'name' => 'Lal Gopalganj Nindaura',
                'state' => 'Uttar Pradesh',
            ),
            943 => array(
                'id' => '944',
                'name' => 'Muddebihal',
                'state' => 'Karnataka',
            ),
            944 => array(
                'id' => '945',
                'name' => 'Sirsaganj',
                'state' => 'Uttar Pradesh',
            ),
            945 => array(
                'id' => '946',
                'name' => 'Shahpura',
                'state' => 'Rajasthan',
            ),
            946 => array(
                'id' => '947',
                'name' => 'Surandai',
                'state' => 'Tamil Nadu',
            ),
            947 => array(
                'id' => '948',
                'name' => 'Sangole',
                'state' => 'Maharashtra',
            ),
            948 => array(
                'id' => '949',
                'name' => 'Pavagada',
                'state' => 'Karnataka',
            ),
            949 => array(
                'id' => '950',
                'name' => 'Tharad',
                'state' => 'Gujarat',
            ),
            950 => array(
                'id' => '951',
                'name' => 'Mansa',
                'state' => 'Gujarat',
            ),
            951 => array(
                'id' => '952',
                'name' => 'Umbergaon',
                'state' => 'Gujarat',
            ),
            952 => array(
                'id' => '953',
                'name' => 'Mavoor',
                'state' => 'Kerala',
            ),
            953 => array(
                'id' => '954',
                'name' => 'Nalbari',
                'state' => 'Assam',
            ),
            954 => array(
                'id' => '955',
                'name' => 'Talaja',
                'state' => 'Gujarat',
            ),
            955 => array(
                'id' => '956',
                'name' => 'Malur',
                'state' => 'Karnataka',
            ),
            956 => array(
                'id' => '957',
                'name' => 'Mangrulpir',
                'state' => 'Maharashtra',
            ),
            957 => array(
                'id' => '958',
                'name' => 'Soro',
                'state' => 'Odisha',
            ),
            958 => array(
                'id' => '959',
                'name' => 'Shahpura',
                'state' => 'Rajasthan',
            ),
            959 => array(
                'id' => '960',
                'name' => 'Vadnagar',
                'state' => 'Gujarat',
            ),
            960 => array(
                'id' => '961',
                'name' => 'Raisinghnagar',
                'state' => 'Rajasthan',
            ),
            961 => array(
                'id' => '962',
                'name' => 'Sindhagi',
                'state' => 'Karnataka',
            ),
            962 => array(
                'id' => '963',
                'name' => 'Sanduru',
                'state' => 'Karnataka',
            ),
            963 => array(
                'id' => '964',
                'name' => 'Sohna',
                'state' => 'Haryana',
            ),
            964 => array(
                'id' => '965',
                'name' => 'Manavadar',
                'state' => 'Gujarat',
            ),
            965 => array(
                'id' => '966',
                'name' => 'Pihani',
                'state' => 'Uttar Pradesh',
            ),
            966 => array(
                'id' => '967',
                'name' => 'Safidon',
                'state' => 'Haryana',
            ),
            967 => array(
                'id' => '968',
                'name' => 'Risod',
                'state' => 'Maharashtra',
            ),
            968 => array(
                'id' => '969',
                'name' => 'Rosera',
                'state' => 'Bihar',
            ),
            969 => array(
                'id' => '970',
                'name' => 'Sankari',
                'state' => 'Tamil Nadu',
            ),
            970 => array(
                'id' => '971',
                'name' => 'Malpura',
                'state' => 'Rajasthan',
            ),
            971 => array(
                'id' => '972',
                'name' => 'Sonamukhi',
                'state' => 'West Bengal',
            ),
            972 => array(
                'id' => '973',
                'name' => 'Shamsabad, Agra',
                'state' => 'Uttar Pradesh',
            ),
            973 => array(
                'id' => '974',
                'name' => 'Nokha',
                'state' => 'Bihar',
            ),
            974 => array(
                'id' => '975',
                'name' => 'PandUrban Agglomeration',
                'state' => 'West Bengal',
            ),
            975 => array(
                'id' => '976',
                'name' => 'Mainaguri',
                'state' => 'West Bengal',
            ),
            976 => array(
                'id' => '977',
                'name' => 'Afzalpur',
                'state' => 'Karnataka',
            ),
            977 => array(
                'id' => '978',
                'name' => 'Shirur',
                'state' => 'Maharashtra',
            ),
            978 => array(
                'id' => '979',
                'name' => 'Salaya',
                'state' => 'Gujarat',
            ),
            979 => array(
                'id' => '980',
                'name' => 'Shenkottai',
                'state' => 'Tamil Nadu',
            ),
            980 => array(
                'id' => '981',
                'name' => 'Pratapgarh',
                'state' => 'Tripura',
            ),
            981 => array(
                'id' => '982',
                'name' => 'Vadipatti',
                'state' => 'Tamil Nadu',
            ),
            982 => array(
                'id' => '983',
                'name' => 'Nagarkurnool',
                'state' => 'Telangana',
            ),
            983 => array(
                'id' => '984',
                'name' => 'Savner',
                'state' => 'Maharashtra',
            ),
            984 => array(
                'id' => '985',
                'name' => 'Sasvad',
                'state' => 'Maharashtra',
            ),
            985 => array(
                'id' => '986',
                'name' => 'Rudrapur',
                'state' => 'Uttar Pradesh',
            ),
            986 => array(
                'id' => '987',
                'name' => 'Soron',
                'state' => 'Uttar Pradesh',
            ),
            987 => array(
                'id' => '988',
                'name' => 'Sholingur',
                'state' => 'Tamil Nadu',
            ),
            988 => array(
                'id' => '989',
                'name' => 'Pandharkaoda',
                'state' => 'Maharashtra',
            ),
            989 => array(
                'id' => '990',
                'name' => 'Perumbavoor',
                'state' => 'Kerala',
            ),
            990 => array(
                'id' => '991',
                'name' => 'Maddur',
                'state' => 'Karnataka',
            ),
            991 => array(
                'id' => '992',
                'name' => 'Nadbai',
                'state' => 'Rajasthan',
            ),
            992 => array(
                'id' => '993',
                'name' => 'Talode',
                'state' => 'Maharashtra',
            ),
            993 => array(
                'id' => '994',
                'name' => 'Shrigonda',
                'state' => 'Maharashtra',
            ),
            994 => array(
                'id' => '995',
                'name' => 'Madhugiri',
                'state' => 'Karnataka',
            ),
            995 => array(
                'id' => '996',
                'name' => 'Tekkalakote',
                'state' => 'Karnataka',
            ),
            996 => array(
                'id' => '997',
                'name' => 'Seoni-Malwa',
                'state' => 'Madhya Pradesh',
            ),
            997 => array(
                'id' => '998',
                'name' => 'Shirdi',
                'state' => 'Maharashtra',
            ),
            998 => array(
                'id' => '999',
                'name' => 'SUrban Agglomerationr',
                'state' => 'Uttar Pradesh',
            ),
            999 => array(
                'id' => '1000',
                'name' => 'Terdal',
                'state' => 'Karnataka',
            ),
            1000 => array(
                'id' => '1001',
                'name' => 'Raver',
                'state' => 'Maharashtra',
            ),
            1001 => array(
                'id' => '1002',
                'name' => 'Tirupathur',
                'state' => 'Tamil Nadu',
            ),
            1002 => array(
                'id' => '1003',
                'name' => 'Taraori',
                'state' => 'Haryana',
            ),
            1003 => array(
                'id' => '1004',
                'name' => 'Mukhed',
                'state' => 'Maharashtra',
            ),
            1004 => array(
                'id' => '1005',
                'name' => 'Manachanallur',
                'state' => 'Tamil Nadu',
            ),
            1005 => array(
                'id' => '1006',
                'name' => 'Rehli',
                'state' => 'Madhya Pradesh',
            ),
            1006 => array(
                'id' => '1007',
                'name' => 'Sanchore',
                'state' => 'Rajasthan',
            ),
            1007 => array(
                'id' => '1008',
                'name' => 'Rajura',
                'state' => 'Maharashtra',
            ),
            1008 => array(
                'id' => '1009',
                'name' => 'Piro',
                'state' => 'Bihar',
            ),
            1009 => array(
                'id' => '1010',
                'name' => 'Mudabidri',
                'state' => 'Karnataka',
            ),
            1010 => array(
                'id' => '1011',
                'name' => 'Vadgaon Kasba',
                'state' => 'Maharashtra',
            ),
            1011 => array(
                'id' => '1012',
                'name' => 'Nagar',
                'state' => 'Rajasthan',
            ),
            1012 => array(
                'id' => '1013',
                'name' => 'Vijapur',
                'state' => 'Gujarat',
            ),
            1013 => array(
                'id' => '1014',
                'name' => 'Viswanatham',
                'state' => 'Tamil Nadu',
            ),
            1014 => array(
                'id' => '1015',
                'name' => 'Polur',
                'state' => 'Tamil Nadu',
            ),
            1015 => array(
                'id' => '1016',
                'name' => 'Panagudi',
                'state' => 'Tamil Nadu',
            ),
            1016 => array(
                'id' => '1017',
                'name' => 'Manawar',
                'state' => 'Madhya Pradesh',
            ),
            1017 => array(
                'id' => '1018',
                'name' => 'Tehri',
                'state' => 'Uttarakhand',
            ),
            1018 => array(
                'id' => '1019',
                'name' => 'Samdhan',
                'state' => 'Uttar Pradesh',
            ),
            1019 => array(
                'id' => '1020',
                'name' => 'Pardi',
                'state' => 'Gujarat',
            ),
            1020 => array(
                'id' => '1021',
                'name' => 'Rahatgarh',
                'state' => 'Madhya Pradesh',
            ),
            1021 => array(
                'id' => '1022',
                'name' => 'Panagar',
                'state' => 'Madhya Pradesh',
            ),
            1022 => array(
                'id' => '1023',
                'name' => 'Uthiramerur',
                'state' => 'Tamil Nadu',
            ),
            1023 => array(
                'id' => '1024',
                'name' => 'Tirora',
                'state' => 'Maharashtra',
            ),
            1024 => array(
                'id' => '1025',
                'name' => 'Rangia',
                'state' => 'Assam',
            ),
            1025 => array(
                'id' => '1026',
                'name' => 'Sahjanwa',
                'state' => 'Uttar Pradesh',
            ),
            1026 => array(
                'id' => '1027',
                'name' => 'Wara Seoni',
                'state' => 'Madhya Pradesh',
            ),
            1027 => array(
                'id' => '1028',
                'name' => 'Magadi',
                'state' => 'Karnataka',
            ),
            1028 => array(
                'id' => '1029',
                'name' => 'Rajgarh (Alwar)',
                'state' => 'Rajasthan',
            ),
            1029 => array(
                'id' => '1030',
                'name' => 'Rafiganj',
                'state' => 'Bihar',
            ),
            1030 => array(
                'id' => '1031',
                'name' => 'Tarana',
                'state' => 'Madhya Pradesh',
            ),
            1031 => array(
                'id' => '1032',
                'name' => 'Rampur Maniharan',
                'state' => 'Uttar Pradesh',
            ),
            1032 => array(
                'id' => '1033',
                'name' => 'Sheoganj',
                'state' => 'Rajasthan',
            ),
            1033 => array(
                'id' => '1034',
                'name' => 'Raikot',
                'state' => 'Punjab',
            ),
            1034 => array(
                'id' => '1035',
                'name' => 'Pauri',
                'state' => 'Uttarakhand',
            ),
            1035 => array(
                'id' => '1036',
                'name' => 'Sumerpur',
                'state' => 'Uttar Pradesh',
            ),
            1036 => array(
                'id' => '1037',
                'name' => 'Navalgund',
                'state' => 'Karnataka',
            ),
            1037 => array(
                'id' => '1038',
                'name' => 'Shahganj',
                'state' => 'Uttar Pradesh',
            ),
            1038 => array(
                'id' => '1039',
                'name' => 'Marhaura',
                'state' => 'Bihar',
            ),
            1039 => array(
                'id' => '1040',
                'name' => 'Tulsipur',
                'state' => 'Uttar Pradesh',
            ),
            1040 => array(
                'id' => '1041',
                'name' => 'Sadri',
                'state' => 'Rajasthan',
            ),
            1041 => array(
                'id' => '1042',
                'name' => 'Thiruthuraipoondi',
                'state' => 'Tamil Nadu',
            ),
            1042 => array(
                'id' => '1043',
                'name' => 'Shiggaon',
                'state' => 'Karnataka',
            ),
            1043 => array(
                'id' => '1044',
                'name' => 'Pallapatti',
                'state' => 'Tamil Nadu',
            ),
            1044 => array(
                'id' => '1045',
                'name' => 'Mahendragarh',
                'state' => 'Haryana',
            ),
            1045 => array(
                'id' => '1046',
                'name' => 'Sausar',
                'state' => 'Madhya Pradesh',
            ),
            1046 => array(
                'id' => '1047',
                'name' => 'Ponneri',
                'state' => 'Tamil Nadu',
            ),
            1047 => array(
                'id' => '1048',
                'name' => 'Mahad',
                'state' => 'Maharashtra',
            ),
            1048 => array(
                'id' => '1049',
                'name' => 'Lohardaga',
                'state' => 'Jharkhand',
            ),
            1049 => array(
                'id' => '1050',
                'name' => 'Tirwaganj',
                'state' => 'Uttar Pradesh',
            ),
            1050 => array(
                'id' => '1051',
                'name' => 'Margherita',
                'state' => 'Assam',
            ),
            1051 => array(
                'id' => '1052',
                'name' => 'Sundarnagar',
                'state' => 'Himachal Pradesh',
            ),
            1052 => array(
                'id' => '1053',
                'name' => 'Rajgarh',
                'state' => 'Madhya Pradesh',
            ),
            1053 => array(
                'id' => '1054',
                'name' => 'Mangaldoi',
                'state' => 'Assam',
            ),
            1054 => array(
                'id' => '1055',
                'name' => 'Renigunta',
                'state' => 'Andhra Pradesh',
            ),
            1055 => array(
                'id' => '1056',
                'name' => 'Longowal',
                'state' => 'Punjab',
            ),
            1056 => array(
                'id' => '1057',
                'name' => 'Ratia',
                'state' => 'Haryana',
            ),
            1057 => array(
                'id' => '1058',
                'name' => 'Lalgudi',
                'state' => 'Tamil Nadu',
            ),
            1058 => array(
                'id' => '1059',
                'name' => 'Shrirangapattana',
                'state' => 'Karnataka',
            ),
            1059 => array(
                'id' => '1060',
                'name' => 'Niwari',
                'state' => 'Madhya Pradesh',
            ),
            1060 => array(
                'id' => '1061',
                'name' => 'Natham',
                'state' => 'Tamil Nadu',
            ),
            1061 => array(
                'id' => '1062',
                'name' => 'Unnamalaikadai',
                'state' => 'Tamil Nadu',
            ),
            1062 => array(
                'id' => '1063',
                'name' => 'PurqUrban Agglomerationzi',
                'state' => 'Uttar Pradesh',
            ),
            1063 => array(
                'id' => '1064',
                'name' => 'Shamsabad, Farrukhabad',
                'state' => 'Uttar Pradesh',
            ),
            1064 => array(
                'id' => '1065',
                'name' => 'Mirganj',
                'state' => 'Bihar',
            ),
            1065 => array(
                'id' => '1066',
                'name' => 'Todaraisingh',
                'state' => 'Rajasthan',
            ),
            1066 => array(
                'id' => '1067',
                'name' => 'Warhapur',
                'state' => 'Uttar Pradesh',
            ),
            1067 => array(
                'id' => '1068',
                'name' => 'Rajam',
                'state' => 'Andhra Pradesh',
            ),
            1068 => array(
                'id' => '1069',
                'name' => 'Urmar Tanda',
                'state' => 'Punjab',
            ),
            1069 => array(
                'id' => '1070',
                'name' => 'Lonar',
                'state' => 'Maharashtra',
            ),
            1070 => array(
                'id' => '1071',
                'name' => 'Powayan',
                'state' => 'Uttar Pradesh',
            ),
            1071 => array(
                'id' => '1072',
                'name' => 'P.N.Patti',
                'state' => 'Tamil Nadu',
            ),
            1072 => array(
                'id' => '1073',
                'name' => 'Palampur',
                'state' => 'Himachal Pradesh',
            ),
            1073 => array(
                'id' => '1074',
                'name' => 'Srisailam Project (Right Flank Colony) Township',
                'state' => 'Andhra Pradesh',
            ),
            1074 => array(
                'id' => '1075',
                'name' => 'Sindagi',
                'state' => 'Karnataka',
            ),
            1075 => array(
                'id' => '1076',
                'name' => 'Sandi',
                'state' => 'Uttar Pradesh',
            ),
            1076 => array(
                'id' => '1077',
                'name' => 'Vaikom',
                'state' => 'Kerala',
            ),
            1077 => array(
                'id' => '1078',
                'name' => 'Malda',
                'state' => 'West Bengal',
            ),
            1078 => array(
                'id' => '1079',
                'name' => 'Tharangambadi',
                'state' => 'Tamil Nadu',
            ),
            1079 => array(
                'id' => '1080',
                'name' => 'Sakaleshapura',
                'state' => 'Karnataka',
            ),
            1080 => array(
                'id' => '1081',
                'name' => 'Lalganj',
                'state' => 'Bihar',
            ),
            1081 => array(
                'id' => '1082',
                'name' => 'Malkangiri',
                'state' => 'Odisha',
            ),
            1082 => array(
                'id' => '1083',
                'name' => 'Rapar',
                'state' => 'Gujarat',
            ),
            1083 => array(
                'id' => '1084',
                'name' => 'Mauganj',
                'state' => 'Madhya Pradesh',
            ),
            1084 => array(
                'id' => '1085',
                'name' => 'Todabhim',
                'state' => 'Rajasthan',
            ),
            1085 => array(
                'id' => '1086',
                'name' => 'Srinivaspur',
                'state' => 'Karnataka',
            ),
            1086 => array(
                'id' => '1087',
                'name' => 'Murliganj',
                'state' => 'Bihar',
            ),
            1087 => array(
                'id' => '1088',
                'name' => 'Reengus',
                'state' => 'Rajasthan',
            ),
            1088 => array(
                'id' => '1089',
                'name' => 'Sawantwadi',
                'state' => 'Maharashtra',
            ),
            1089 => array(
                'id' => '1090',
                'name' => 'Tittakudi',
                'state' => 'Tamil Nadu',
            ),
            1090 => array(
                'id' => '1091',
                'name' => 'Lilong',
                'state' => 'Manipur',
            ),
            1091 => array(
                'id' => '1092',
                'name' => 'Rajaldesar',
                'state' => 'Rajasthan',
            ),
            1092 => array(
                'id' => '1093',
                'name' => 'Pathardi',
                'state' => 'Maharashtra',
            ),
            1093 => array(
                'id' => '1094',
                'name' => 'Achhnera',
                'state' => 'Uttar Pradesh',
            ),
            1094 => array(
                'id' => '1095',
                'name' => 'Pacode',
                'state' => 'Tamil Nadu',
            ),
            1095 => array(
                'id' => '1096',
                'name' => 'Naraura',
                'state' => 'Uttar Pradesh',
            ),
            1096 => array(
                'id' => '1097',
                'name' => 'Nakur',
                'state' => 'Uttar Pradesh',
            ),
            1097 => array(
                'id' => '1098',
                'name' => 'Palai',
                'state' => 'Kerala',
            ),
            1098 => array(
                'id' => '1099',
                'name' => 'Morinda, India',
                'state' => 'Punjab',
            ),
            1099 => array(
                'id' => '1100',
                'name' => 'Manasa',
                'state' => 'Madhya Pradesh',
            ),
            1100 => array(
                'id' => '1101',
                'name' => 'Nainpur',
                'state' => 'Madhya Pradesh',
            ),
            1101 => array(
                'id' => '1102',
                'name' => 'Sahaspur',
                'state' => 'Uttar Pradesh',
            ),
            1102 => array(
                'id' => '1103',
                'name' => 'Pauni',
                'state' => 'Maharashtra',
            ),
            1103 => array(
                'id' => '1104',
                'name' => 'Prithvipur',
                'state' => 'Madhya Pradesh',
            ),
            1104 => array(
                'id' => '1105',
                'name' => 'Ramtek',
                'state' => 'Maharashtra',
            ),
            1105 => array(
                'id' => '1106',
                'name' => 'Silapathar',
                'state' => 'Assam',
            ),
            1106 => array(
                'id' => '1107',
                'name' => 'Songadh',
                'state' => 'Gujarat',
            ),
            1107 => array(
                'id' => '1108',
                'name' => 'Safipur',
                'state' => 'Uttar Pradesh',
            ),
            1108 => array(
                'id' => '1109',
                'name' => 'Sohagpur',
                'state' => 'Madhya Pradesh',
            ),
            1109 => array(
                'id' => '1110',
                'name' => 'Mul',
                'state' => 'Maharashtra',
            ),
            1110 => array(
                'id' => '1111',
                'name' => 'Sadulshahar',
                'state' => 'Rajasthan',
            ),
            1111 => array(
                'id' => '1112',
                'name' => 'Phillaur',
                'state' => 'Punjab',
            ),
            1112 => array(
                'id' => '1113',
                'name' => 'Sambhar',
                'state' => 'Rajasthan',
            ),
            1113 => array(
                'id' => '1114',
                'name' => 'Prantij',
                'state' => 'Rajasthan',
            ),
            1114 => array(
                'id' => '1115',
                'name' => 'Nagla',
                'state' => 'Uttarakhand',
            ),
            1115 => array(
                'id' => '1116',
                'name' => 'Pattran',
                'state' => 'Punjab',
            ),
            1116 => array(
                'id' => '1117',
                'name' => 'Mount Abu',
                'state' => 'Rajasthan',
            ),
            1117 => array(
                'id' => '1118',
                'name' => 'Reoti',
                'state' => 'Uttar Pradesh',
            ),
            1118 => array(
                'id' => '1119',
                'name' => 'Tenu dam-cum-Kathhara',
                'state' => 'Jharkhand',
            ),
            1119 => array(
                'id' => '1120',
                'name' => 'Panchla',
                'state' => 'West Bengal',
            ),
            1120 => array(
                'id' => '1121',
                'name' => 'Sitarganj',
                'state' => 'Uttarakhand',
            ),
            1121 => array(
                'id' => '1122',
                'name' => 'Pasighat',
                'state' => 'Arunachal Pradesh',
            ),
            1122 => array(
                'id' => '1123',
                'name' => 'Motipur',
                'state' => 'Bihar',
            ),
            1123 => array(
                'id' => '1124',
                'name' => 'O\' Valley',
                'state' => 'Tamil Nadu',
            ),
            1124 => array(
                'id' => '1125',
                'name' => 'Raghunathpur',
                'state' => 'West Bengal',
            ),
            1125 => array(
                'id' => '1126',
                'name' => 'Suriyampalayam',
                'state' => 'Tamil Nadu',
            ),
            1126 => array(
                'id' => '1127',
                'name' => 'Qadian',
                'state' => 'Punjab',
            ),
            1127 => array(
                'id' => '1128',
                'name' => 'Rairangpur',
                'state' => 'Odisha',
            ),
            1128 => array(
                'id' => '1129',
                'name' => 'Silvassa',
                'state' => 'Dadra and Nagar Haveli',
            ),
            1129 => array(
                'id' => '1130',
                'name' => 'Nowrozabad (Khodargama)',
                'state' => 'Madhya Pradesh',
            ),
            1130 => array(
                'id' => '1131',
                'name' => 'Mangrol',
                'state' => 'Rajasthan',
            ),
            1131 => array(
                'id' => '1132',
                'name' => 'Soyagaon',
                'state' => 'Maharashtra',
            ),
            1132 => array(
                'id' => '1133',
                'name' => 'Sujanpur',
                'state' => 'Punjab',
            ),
            1133 => array(
                'id' => '1134',
                'name' => 'Manihari',
                'state' => 'Bihar',
            ),
            1134 => array(
                'id' => '1135',
                'name' => 'Sikanderpur',
                'state' => 'Uttar Pradesh',
            ),
            1135 => array(
                'id' => '1136',
                'name' => 'Mangalvedhe',
                'state' => 'Maharashtra',
            ),
            1136 => array(
                'id' => '1137',
                'name' => 'Phulera',
                'state' => 'Rajasthan',
            ),
            1137 => array(
                'id' => '1138',
                'name' => 'Ron',
                'state' => 'Karnataka',
            ),
            1138 => array(
                'id' => '1139',
                'name' => 'Sholavandan',
                'state' => 'Tamil Nadu',
            ),
            1139 => array(
                'id' => '1140',
                'name' => 'Saidpur',
                'state' => 'Uttar Pradesh',
            ),
            1140 => array(
                'id' => '1141',
                'name' => 'Shamgarh',
                'state' => 'Madhya Pradesh',
            ),
            1141 => array(
                'id' => '1142',
                'name' => 'Thammampatti',
                'state' => 'Tamil Nadu',
            ),
            1142 => array(
                'id' => '1143',
                'name' => 'Maharajpur',
                'state' => 'Madhya Pradesh',
            ),
            1143 => array(
                'id' => '1144',
                'name' => 'Multai',
                'state' => 'Madhya Pradesh',
            ),
            1144 => array(
                'id' => '1145',
                'name' => 'Mukerian',
                'state' => 'Punjab',
            ),
            1145 => array(
                'id' => '1146',
                'name' => 'Sirsi',
                'state' => 'Uttar Pradesh',
            ),
            1146 => array(
                'id' => '1147',
                'name' => 'Purwa',
                'state' => 'Uttar Pradesh',
            ),
            1147 => array(
                'id' => '1148',
                'name' => 'Sheohar',
                'state' => 'Bihar',
            ),
            1148 => array(
                'id' => '1149',
                'name' => 'Namagiripettai',
                'state' => 'Tamil Nadu',
            ),
            1149 => array(
                'id' => '1150',
                'name' => 'Parasi',
                'state' => 'Uttar Pradesh',
            ),
            1150 => array(
                'id' => '1151',
                'name' => 'Lathi',
                'state' => 'Gujarat',
            ),
            1151 => array(
                'id' => '1152',
                'name' => 'Lalganj',
                'state' => 'Uttar Pradesh',
            ),
            1152 => array(
                'id' => '1153',
                'name' => 'Narkhed',
                'state' => 'Maharashtra',
            ),
            1153 => array(
                'id' => '1154',
                'name' => 'Mathabhanga',
                'state' => 'West Bengal',
            ),
            1154 => array(
                'id' => '1155',
                'name' => 'Shendurjana',
                'state' => 'Maharashtra',
            ),
            1155 => array(
                'id' => '1156',
                'name' => 'Peravurani',
                'state' => 'Tamil Nadu',
            ),
            1156 => array(
                'id' => '1157',
                'name' => 'Mariani',
                'state' => 'Assam',
            ),
            1157 => array(
                'id' => '1158',
                'name' => 'Phulpur',
                'state' => 'Uttar Pradesh',
            ),
            1158 => array(
                'id' => '1159',
                'name' => 'Rania',
                'state' => 'Haryana',
            ),
            1159 => array(
                'id' => '1160',
                'name' => 'Pali',
                'state' => 'Madhya Pradesh',
            ),
            1160 => array(
                'id' => '1161',
                'name' => 'Pachore',
                'state' => 'Madhya Pradesh',
            ),
            1161 => array(
                'id' => '1162',
                'name' => 'Parangipettai',
                'state' => 'Tamil Nadu',
            ),
            1162 => array(
                'id' => '1163',
                'name' => 'Pudupattinam',
                'state' => 'Tamil Nadu',
            ),
            1163 => array(
                'id' => '1164',
                'name' => 'Panniyannur',
                'state' => 'Kerala',
            ),
            1164 => array(
                'id' => '1165',
                'name' => 'Maharajganj',
                'state' => 'Bihar',
            ),
            1165 => array(
                'id' => '1166',
                'name' => 'Rau',
                'state' => 'Madhya Pradesh',
            ),
            1166 => array(
                'id' => '1167',
                'name' => 'Monoharpur',
                'state' => 'West Bengal',
            ),
            1167 => array(
                'id' => '1168',
                'name' => 'Mandawa',
                'state' => 'Rajasthan',
            ),
            1168 => array(
                'id' => '1169',
                'name' => 'Marigaon',
                'state' => 'Assam',
            ),
            1169 => array(
                'id' => '1170',
                'name' => 'Pallikonda',
                'state' => 'Tamil Nadu',
            ),
            1170 => array(
                'id' => '1171',
                'name' => 'Pindwara',
                'state' => 'Rajasthan',
            ),
            1171 => array(
                'id' => '1172',
                'name' => 'Shishgarh',
                'state' => 'Uttar Pradesh',
            ),
            1172 => array(
                'id' => '1173',
                'name' => 'Patur',
                'state' => 'Maharashtra',
            ),
            1173 => array(
                'id' => '1174',
                'name' => 'Mayang Imphal',
                'state' => 'Manipur',
            ),
            1174 => array(
                'id' => '1175',
                'name' => 'Mhowgaon',
                'state' => 'Madhya Pradesh',
            ),
            1175 => array(
                'id' => '1176',
                'name' => 'Guruvayoor',
                'state' => 'Kerala',
            ),
            1176 => array(
                'id' => '1177',
                'name' => 'Mhaswad',
                'state' => 'Maharashtra',
            ),
            1177 => array(
                'id' => '1178',
                'name' => 'Sahawar',
                'state' => 'Uttar Pradesh',
            ),
            1178 => array(
                'id' => '1179',
                'name' => 'Sivagiri',
                'state' => 'Tamil Nadu',
            ),
            1179 => array(
                'id' => '1180',
                'name' => 'Mundargi',
                'state' => 'Karnataka',
            ),
            1180 => array(
                'id' => '1181',
                'name' => 'Punjaipugalur',
                'state' => 'Tamil Nadu',
            ),
            1181 => array(
                'id' => '1182',
                'name' => 'Kailasahar',
                'state' => 'Tripura',
            ),
            1182 => array(
                'id' => '1183',
                'name' => 'Samthar',
                'state' => 'Uttar Pradesh',
            ),
            1183 => array(
                'id' => '1184',
                'name' => 'Sakti',
                'state' => 'Chhattisgarh',
            ),
            1184 => array(
                'id' => '1185',
                'name' => 'Sadalagi',
                'state' => 'Karnataka',
            ),
            1185 => array(
                'id' => '1186',
                'name' => 'Silao',
                'state' => 'Bihar',
            ),
            1186 => array(
                'id' => '1187',
                'name' => 'Mandalgarh',
                'state' => 'Rajasthan',
            ),
            1187 => array(
                'id' => '1188',
                'name' => 'Loha',
                'state' => 'Maharashtra',
            ),
            1188 => array(
                'id' => '1189',
                'name' => 'Pukhrayan',
                'state' => 'Uttar Pradesh',
            ),
            1189 => array(
                'id' => '1190',
                'name' => 'Padmanabhapuram',
                'state' => 'Tamil Nadu',
            ),
            1190 => array(
                'id' => '1191',
                'name' => 'Belonia',
                'state' => 'Tripura',
            ),
            1191 => array(
                'id' => '1192',
                'name' => 'Saiha',
                'state' => 'Mizoram',
            ),
            1192 => array(
                'id' => '1193',
                'name' => 'Srirampore',
                'state' => 'West Bengal',
            ),
            1193 => array(
                'id' => '1194',
                'name' => 'Talwara',
                'state' => 'Punjab',
            ),
            1194 => array(
                'id' => '1195',
                'name' => 'Puthuppally',
                'state' => 'Kerala',
            ),
            1195 => array(
                'id' => '1196',
                'name' => 'Khowai',
                'state' => 'Tripura',
            ),
            1196 => array(
                'id' => '1197',
                'name' => 'Vijaypur',
                'state' => 'Madhya Pradesh',
            ),
            1197 => array(
                'id' => '1198',
                'name' => 'Takhatgarh',
                'state' => 'Rajasthan',
            ),
            1198 => array(
                'id' => '1199',
                'name' => 'Thirupuvanam',
                'state' => 'Tamil Nadu',
            ),
            1199 => array(
                'id' => '1200',
                'name' => 'Adra',
                'state' => 'West Bengal',
            ),
            1200 => array(
                'id' => '1201',
                'name' => 'Piriyapatna',
                'state' => 'Karnataka',
            ),
            1201 => array(
                'id' => '1202',
                'name' => 'Obra',
                'state' => 'Uttar Pradesh',
            ),
            1202 => array(
                'id' => '1203',
                'name' => 'Adalaj',
                'state' => 'Gujarat',
            ),
            1203 => array(
                'id' => '1204',
                'name' => 'Nandgaon',
                'state' => 'Maharashtra',
            ),
            1204 => array(
                'id' => '1205',
                'name' => 'Barh',
                'state' => 'Bihar',
            ),
            1205 => array(
                'id' => '1206',
                'name' => 'Chhapra',
                'state' => 'Gujarat',
            ),
            1206 => array(
                'id' => '1207',
                'name' => 'Panamattom',
                'state' => 'Kerala',
            ),
            1207 => array(
                'id' => '1208',
                'name' => 'Niwai',
                'state' => 'Uttar Pradesh',
            ),
            1208 => array(
                'id' => '1209',
                'name' => 'Bageshwar',
                'state' => 'Uttarakhand',
            ),
            1209 => array(
                'id' => '1210',
                'name' => 'Tarbha',
                'state' => 'Odisha',
            ),
            1210 => array(
                'id' => '1211',
                'name' => 'Adyar',
                'state' => 'Karnataka',
            ),
            1211 => array(
                'id' => '1212',
                'name' => 'Narsinghgarh',
                'state' => 'Madhya Pradesh',
            ),
            1212 => array(
                'id' => '1213',
                'name' => 'Warud',
                'state' => 'Maharashtra',
            ),
            1213 => array(
                'id' => '1214',
                'name' => 'Asarganj',
                'state' => 'Bihar',
            ),
            1214 => array(
                'id' => '1215',
                'name' => 'Sarsod',
                'state' => 'Haryana',
            ),
            1215 => array(
                'id' => '1216',
                'name' => 'Gandhinagar',
                'state' => 'Gujarat',
            ),
            1216 => array(
                'id' => '1217',
                'name' => 'Kullu',
                'state' => 'Himachal Pradesh',
            ),
            1217 => array(
                'id' => '1218',
                'name' => 'Manali',
                'state' => 'Himachal Pradesh',
            ),
            1218 => array(
                'id' => '1219',
                'name' => 'Mirzapur',
                'state' => 'Uttar Pradesh',
            ),
            1219 => array(
                'id' => '1220',
                'name' => 'Kota',
                'state' => 'Rajasthan',
            ),
            1220 => array(
                'id' => '1221',
                'name' => 'Dispur',
                'state' => 'Assam',
            ),
        );
    }
}
