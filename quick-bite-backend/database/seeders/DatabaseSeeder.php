<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Employee;
use App\Models\Faq;
use App\Models\Image;
use App\Models\Item;
use App\Models\ItemFeedback;
use App\Models\Limit;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use App\Models\VisitFeedback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        Employee::factory(5)->create();
        User::factory(5)->create();
        Menu::factory(2)->create();
        Item::factory(10)->create();
        Image::factory(10)->create();
        ItemFeedback::factory(2)->create();
        Order::factory(5)->create();
        VisitFeedback::factory(5)->create();
        Faq::factory(5)->create();

        $superAdmin = new User();
        $superAdmin->first_name = 'super';
        $superAdmin->last_name = 'admin';
        $superAdmin->email = 'quickbite@keybase.com';
        $superAdmin->password = Hash::make('password');
        $superAdmin->role = 'super admin';
        $superAdmin->save();

        $limit = new Limit();
        $limit->limit = 20;
        $limit->save();
    }
}
