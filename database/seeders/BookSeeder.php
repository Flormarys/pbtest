<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('books')->delete();        
    	$jsonData = file_get_contents("books.json");
    	$arrayBooks = json_decode($jsonData, true); 
        $requiredAttributes = ['title', 'url', 'subject', 'Language', 'word_count', 'is_original', 'based_on'];    
    	foreach ($arrayBooks as $book) {
            $subjectObject = $book['subject'][0];
             if(count(array_diff_assoc(array_keys($book), $requiredAttributes)) === 0){
                DB::table('books')->insert([
                [
                    'title' => $book['title'],
                    'url' => $book['url'],
                    'subject_id' => intval($subjectObject['Identifier']),
                    'language' => $book['Language'],
                    'word_count' => $book['word_count'],
                    'is_original' => $book['is_original'],
                    'based_on' => isset($book['based_on'])? $book['based_on'] : NULL,
                ]
                ]);
            }
        }*/
        $book = Book::factory()
                ->count(50)
                ->create();
    }
}
