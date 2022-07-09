<?php

namespace Database\Seeders;

use App\Models\Admin\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'name_page'       => 'Главная',

        ]);
        Page::create([
            'name_page'       => 'Каталог готовых проектов',
        ]);

        Page::create([
            'name_page'       => 'Каталог новых проектов',
        ]);

        Page::create([
            'name_page'       => 'Прочая недвижимость',
        ]);

        Page::create([
            'name_page'       => 'Вопросы',
        ]);

        Page::create([
            'name_page'       => 'Рассрочка',
        ]);
        Page::create([
            'name_page'       => 'Новости',
        ]);
        Page::create([
            'name_page'       => 'Соглашение',
        ]);
        Page::create([
            'name_page'       => 'Дизайн интерьера',
        ]);

    }
}
