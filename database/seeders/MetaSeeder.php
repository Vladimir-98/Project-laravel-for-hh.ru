<?php

namespace Database\Seeders;

use App\Models\Admin\meta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meta::create([
            'title_meta_en' => 'title_meta_en',
            'title_meta_tr' => 'title_meta_tr',
            'title_meta_ru' => 'title_meta_ru',
            'description_meta_en' => 'description_meta_en',
            'description_meta_tr' => 'description_meta_tr',
            'description_meta_ru' => 'description_meta_ru',
            'canonical' => 'canonical',
            'meta_gable_id' => '1',
            'meta_gable_type' => 'App\Models\Admin\Page',

        ]);

        Meta::create([
            'title_meta_en' => 'Apartments for sale in Turkey from the construction company .',
            'title_meta_tr' => 'İnşaat şirketi \'dan Türkiye\'de daire satışı.',
            'title_meta_ru' => 'Продажа квартир в Турции от строительной компании .',
            'description_meta_en' => 'Find, buy in installments an apartment in the city of Mersin. Ads for the sale of real estate on the Mediterranean coast from a developer in Turkey.  Construction Company',
            'description_meta_tr' => 'Mersin\'de taksitle bir daire bulun, satın alın. Türkiye\'de Akdeniz kıyısında satılık emlak ilanları.  İnşaat Şirketi',
            'description_meta_ru' => 'Найти, купить в рассрочку квартиру в городе Мерсин. Объявления о продаже недвижимости на берегу средиземного моря от застройщика в Турции. Строительная компания ',
            'canonical' => '',
            'meta_gable_id' => '4',
            'meta_gable_type' => 'App\Models\Admin\Page',

        ]);
    }
}
