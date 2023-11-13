<?php

namespace Database\Seeders;

use App\Models\Calculator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalculatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Calculator::create([
            'size' => 'XXS',
            'minHeight' => '140',
            'maxHeight' => '150',
            'minKg' => '50',
            'maxKg' => '55',
        ]);

        Calculator::create([
            'size' => 'XS',
            'minHeight' => '150',
            'maxHeight' => '160',
            'minKg' => '56',
            'maxKg' => '60',
        ]);

        Calculator::create([
            'size' => 'S',
            'minHeight' => '160',
            'maxHeight' => '170',
            'minKg' => '60',
            'maxKg' => '65',
        ]);

        Calculator::create([
            'size' => 'M',
            'minHeight' => '170',
            'maxHeight' => '180',
            'minKg' => '65',
            'maxKg' => '70',
        ]);

        Calculator::create([
            'size' => 'L',
            'minHeight' => '180',
            'maxHeight' => '185',
            'minKg' => '70',
            'maxKg' => '80',
        ]);

        Calculator::create([
            'size' => 'XL',
            'minHeight' => '185',
            'maxHeight' => '190',
            'minKg' => '80',
            'maxKg' => '100',
        ]);

        Calculator::create([
            'size' => 'XXL',
            'minHeight' => '190',
            'maxHeight' => '195',
            'minKg' => '100',
            'maxKg' => '120',
        ]);

        Calculator::create([
            'size' => 'XXXL',
            'minHeight' => '195',
            'maxHeight' => '200',
            'minKg' => '120',
            'maxKg' => '200',
        ]);
    }
}
