<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Faq;
use App\Models\Image;
use App\Models\Item;
use App\Models\ItemFeedback;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use App\Models\VisitFeedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Currency::factory(2)->create();
        User::factory(0)->create();
        Menu::factory(2)->create();
        Item::factory(10)->create();
        Image::factory(10)->create();
        ItemFeedback::factory(0)->create();
        Order::factory(0)->create();
        VisitFeedback::factory(0)->create();
        Faq::factory(5)->create();
    }
}
