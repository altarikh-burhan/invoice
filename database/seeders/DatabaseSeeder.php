<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'Macbook Pro Series 13 2020',
            'description' => 'Seri komputer jinjing Macintosh yang diproduksi oleh Apple',
            'price' => 18500000,
            'stock' => 5
        ]);

        Product::create([
            'title' => 'Asus Rog Slim 1 A2',
            'description' => 'Sebuah brand perangkat keras notebook khusus gaming dari ASUS',
            'price' => 10500000,
            'stock' => 15
        ]);

        Product::create([
            'title' => 'Macbook Pro 13 2020',
            'description' => 'Seri komputer jinjing Macintosh yang diproduksi oleh Apple',
            'price' => 18500000,
            'stock' => 5
        ]);

        Product::create([
            'title' => 'Asus Rog Slim 1 A3',
            'description' => 'Sebuah brand perangkat keras notebook khusus gaming dari ASUS',
            'price' => 10500000,
            'stock' => 15
        ]);

        Product::create([
            'title' => 'Macbook Slim 13 2020',
            'description' => 'Seri komputer jinjing Macintosh yang diproduksi oleh Apple',
            'price' => 18500000,
            'stock' => 5
        ]);

        Product::create([
            'title' => 'Asus Rog Slim 1 A4',
            'description' => 'Sebuah brand perangkat keras notebook khusus gaming dari ASUS',
            'price' => 10500000,
            'stock' => 15
        ]);
     // Customer::factory(20)->create();   
        $this->call(ProvinceTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
    }
}
