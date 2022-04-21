<?php

use App\HealthPackage;
use Illuminate\Database\Seeder;

class HealtPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(HealthPackage::class, 3)->create();
    }
}
