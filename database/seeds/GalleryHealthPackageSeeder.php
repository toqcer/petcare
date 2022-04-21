<?php

use App\Gallery;
use Illuminate\Database\Seeder;

class GalleryHealthPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Gallery::class, 12)->create();
    }
}
