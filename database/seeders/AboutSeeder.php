<?php

namespace Database\Seeders;

use App\Models\Admin\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'title_about_en' => 'title_about_en',
            'title_about_tr' => 'title_about_tr',
            'title_about_ru' => 'title_about_ru',
            'description_about_en' => 'description_about_en',
            'description_about_tr' => 'description_about_tr',
            'description_about_ru' => 'description_about_ru',
            'about_img' => '1_fon.webp',
            'about_img_medium' => '1_fon_medium.webp',
            'about_img_alt' => 'about_img_alt',
            'about_gable_id' => '1',
            'about_gable_type' => 'App\Models\Admin\Page',

        ]);
    }
}
