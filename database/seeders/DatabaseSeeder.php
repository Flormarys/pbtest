<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;


class DatabaseSeeder extends Seeder
{
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
