<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Proveedores',
            'Clientes',
            'Inventario',
            'Informes',
            'Facturación',
            'Administrativo',
            'Contable',
            'Parametros',
            'RFID',
            'Generales',
            'Stock_interna',
            'POS (sistema venta)',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}
