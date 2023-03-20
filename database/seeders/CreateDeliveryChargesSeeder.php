<?php

namespace Database\Seeders;

use App\DeliveryCharge;
use App\Model\Logistic;
use Illuminate\Database\Seeder;

class CreateDeliveryChargesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logistics = Logistic::all();

        foreach ($logistics as $logistic) {
            DeliveryCharge::insert([
                [
                    'logistic_id' => $logistic->id,
                    'amount' => 0,
                    'type' => 'Normal',
                ],
                [
                    'logistic_id' => $logistic->id,
                    'amount' => 0,
                    'type' => 'Premium',
                ]
            ]);
        }
    }
}
