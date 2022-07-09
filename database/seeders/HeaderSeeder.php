<?php

namespace Database\Seeders;

use App\Models\Admin\Header;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Header::create([
            'title_header_en' => 'title_header_en',
            'title_header_tr' => 'title_header_tr',
            'title_header_ru' => 'title_header_ru',
            'description_header_en' => 'description_header_en',
            'description_header_tr' => 'description_header_tr',
            'description_header_ru' => 'description_header_ru',
            'header_img' => '1_fon.png',
            'header_img_medium' => '1_fon_medium.png',
            'header_img_alt' => 'header_img_alt',
            'header_gable_id' => '1',
            'header_gable_type' => 'App\Models\Admin\Page',

        ]);
    }
}
