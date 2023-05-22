<?php

namespace Database\Seeders;

use anlutro\LaravelSettings\Facades\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::set('logoWhite', 'assets/default/settings/logoWhite.png');
        Setting::set('logoBlack', 'assets/default/settings/logoBlack.png');
        Setting::set('icon', 'assets/default/settings/icon.png');

        Setting::save();
    }
}
