<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()
        ->create([
            'name' => 'Rainoil Nigerian Limited',
            'email' => 'info@rainoil.com',
            'website' => 'https://www.rainoil.com.ng/',
            'phone' => '0700RAINOIL',
            'address' => 'Plot 8, Block 116, Akiogun Street By Bosun Adekoya Road Lekki , Lagos Nigeria.',
            'bio' => 'Rainoil Limited is an integrated downstream company and a prominent player in the Nigerian oil and gas industry. The Rainoil Group comprises business operations that span across the downstream value chain: Retail Sales, Bulk Storage, Logistics and Shipping Petroleum Product Storage, Haulage/Distribution, and Retail Sales',
            'logo' => 'https://www.rainoil.com.ng/wp-content/uploads/2021/05/Rainoil-transparent-logo.png',
            'hiring_thumbnail' => 'https://www.rainoil.com.ng/wp-content/uploads/2021/05/Rainoil-transparent-logo.png'
        ]);
    }
}
