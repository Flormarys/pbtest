<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$jsonData = file_get_contents("books.json");
    	$arrayBooks = json_decode($jsonData, true);     

    	foreach ($arrayBooks as $book) {
            $subjectObject = $book['subject'][0];
            DB::table('books')->insert([
                ['title' => isset($book['title']) ? $book['title'] : NULL,
                'url' => isset($book['url']) ? $book['url'] : NULL,
                'subject_id' => intval($subjectObject['Identifier']),
                'language' => isset($book['Language']) ? $book['Language'] : NULL,
                'word_count' => isset($book['word_count']) ? $book['word_count'] : NULL,
                'is_original' => isset($book['is_original']) ? $book['is_original'] : NULL,
                'based_on' => isset($book['based_on'])? $book['based_on'] : NULL,]
            ]);

        }
    }
}
