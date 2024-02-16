<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        product::create([
            'product_name'=>'Guide',
            'product_price'=>120.00
        ]);
        product::create([
            'product_name'=>'Marker',
            'product_price'=>45.00
        ]);
        product::create([
            'product_name'=>'NoteBook',
            'product_price'=>80.00
        ]);
        product::create([
            'product_name'=>'Geometory Box',
            'product_price'=>110.00
        ]);
        product::create([
            'product_name'=>'Pencil Box',
            'product_price'=>70.00
        ]);
    }
}
