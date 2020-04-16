<?php

use App\State;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state_list = $this->getStateList();
        foreach ($state_list as $key => $list) {
            State::updateOrCreate(['code' => $list['code']], [
                'code' => $list['code'],
                'name' => $list['name'],
            ]);
        }
    }

    public function getStateList()
    {
        return $list = array(
            0 => array(
                'code' => 'AN',
                'name' => 'Andaman and Nicobar Islands',
            ),
            1 => array(
                'code' => 'AP',
                'name' => 'Andhra Pradesh',
            ),
            2 => array(
                'code' => 'AR',
                'name' => 'Arunachal Pradesh',
            ),
            3 => array(
                'code' => 'AS',
                'name' => 'Assam',
            ),
            4 => array(
                'code' => 'BR',
                'name' => 'Bihar',
            ),
            5 => array(
                'code' => 'CG',
                'name' => 'Chandigarh',
            ),
            6 => array(
                'code' => 'CH',
                'name' => 'Chhattisgarh',
            ),
            7 => array(
                'code' => 'DH',
                'name' => 'Dadra and Nagar Haveli',
            ),
            8 => array(
                'code' => 'DD',
                'name' => 'Daman and Diu',
            ),
            9 => array(
                'code' => 'DL',
                'name' => 'Delhi',
            ),
            10 => array(
                'code' => 'GA',
                'name' => 'Goa',
            ),
            11 => array(
                'code' => 'GJ',
                'name' => 'Gujarat',
            ),
            12 => array(
                'code' => 'HR',
                'name' => 'Haryana',
            ),
            13 => array(
                'code' => 'HP',
                'name' => 'Himachal Pradesh',
            ),
            14 => array(
                'code' => 'JK',
                'name' => 'Jammu and Kashmir',
            ),
            15 => array(
                'code' => 'JH',
                'name' => 'Jharkhand',
            ),
            16 => array(
                'code' => 'KA',
                'name' => 'Karnataka',
            ),
            17 => array(
                'code' => 'KL',
                'name' => 'Kerala',
            ),
            18 => array(
                'code' => 'LD',
                'name' => 'Lakshadweep',
            ),
            19 => array(
                'code' => 'MP',
                'name' => 'Madhya Pradesh',
            ),
            20 => array(
                'code' => 'MH',
                'name' => 'Maharashtra',
            ),
            21 => array(
                'code' => 'MN',
                'name' => 'Manipur',
            ),
            22 => array(
                'code' => 'ML',
                'name' => 'Meghalaya',
            ),
            23 => array(
                'code' => 'MZ',
                'name' => 'Mizoram',
            ),
            24 => array(
                'code' => 'NL',
                'name' => 'Nagaland',
            ),
            25 => array(
                'code' => 'OR',
                'name' => 'Odisha',
            ),
            26 => array(
                'code' => 'PY',
                'name' => 'Puducherry',
            ),
            27 => array(
                'code' => 'PB',
                'name' => 'Punjab',
            ),
            28 => array(
                'code' => 'RJ',
                'name' => 'Rajasthan',
            ),
            29 => array(
                'code' => 'SK',
                'name' => 'Sikkim',
            ),
            30 => array(
                'code' => 'TN',
                'name' => 'Tamil Nadu',
            ),
            31 => array(
                'code' => 'TS',
                'name' => 'Telangana',
            ),
            32 => array(
                'code' => 'TR',
                'name' => 'Tripura',
            ),
            33 => array(
                'code' => 'UK',
                'name' => 'Uttarakhand',
            ),
            34 => array(
                'code' => 'UP',
                'name' => 'Uttar Pradesh',
            ),
            35 => array(
                'code' => 'WB',
                'name' => 'West Bengal',
            ),
        );
    }
}
