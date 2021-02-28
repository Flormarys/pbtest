<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;


class DatabaseSeeder extends Seeder
{

    use RefreshDatabase;

    protected $bookJsonFile = './database/seeders/data/books.json';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SubjectSeeder::class);
        $this->call(BookSeeder::class);
    }
}
