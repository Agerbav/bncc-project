<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;
use Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $data = [
            ['name' => 'Electronics'],
            ['name' => 'Food'],
            ['name' => 'Household Essentials'],
            ['name' => 'Fashion'],
            ['name' => 'Beverages'],
            ['name' => 'Furniture'],
            ['name' => 'Beauty and Peronsal Care'],
            ['name' => 'Toys and Hobbies'],
        ];

        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();
        
        foreach ($data as $value){
            Category::insert([
                'name' => $value['name'],       
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
