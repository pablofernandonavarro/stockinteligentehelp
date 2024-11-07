<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
           'Yagmour',
            'Wanama',
           ' Burgues',
            'Gusman',
            'Wanama Kids',
            'Natalia Antolin',
           ' Balbi',
        ];

        foreach ($customers as $name) {
            Customer::create([
                'name' => $name

            ]);
        }
    }
}
