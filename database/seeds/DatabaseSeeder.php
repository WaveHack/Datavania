<?php

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
        $this->call(AchievementSeeder::class);
        $this->call(DlcSeeder::class);
        $this->call(CharacterSeeder::class);
        $this->call(MusicSeeder::class);
        $this->call(ItemTypeSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ChapterSeeder::class);
    }
}
