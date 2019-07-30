<?php

use App\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentMethod::create([
            'name' => 'Crédito'
        ]);

        App\PaymentMethod::create([
            'name' => 'Efectivo'
        ]);

        App\PaymentMethod::create([
            'name' => 'Cheque a fecha'
        ]);
    }
}
