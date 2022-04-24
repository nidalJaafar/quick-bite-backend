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
        Currency::factory(10)->create();
        User::factory(10)->create();
        Menu::factory(10)->create();
        Item::factory(50)->create();
        Image::factory(50)->create();
        ItemFeedback::factory(100)->create();
        Order::factory(50)->create();
        VisitFeedback::factory(10)->create();
        Faq::factory(10)->create();
    }
}
