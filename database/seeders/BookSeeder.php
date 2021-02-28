<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
    	$jsonData = file_get_contents($this->bookJsonFile);
    	$arrayBooks = json_decode($jsonData, true); 
        $requiredAttributes = [
            'title', 
            'url', 
            'subject', 
            'Language', 
            'word_count', 
            'is_original', 
            'based_on'
        ];    
        $booksToInsert = [];
    	foreach ($arrayBooks as $book) {
            $bookJsonProperties = array_keys($book);
            $bookJsonPropertiesVsRequiredProperties = array_diff_assoc(
                $bookJsonProperties, $requiredAttributes
            );
            if(count($bookJsonPropertiesVsRequiredProperties) === 0){
                $subjectObject = $book['subject'][0];
                $booksToInsert[] = [
                    'title' => $book['title'],
                    'url' => $book['url'],
                    'subject_id' => intval($subjectObject['Identifier']),
                    'language' => $book['Language'],
                    'word_count' => $book['word_count'],
                    'is_original' => $book['is_original'],
                    'based_on' => isset($book['based_on'])? $book['based_on'] : null,
                ];
            }
        }
        if(count($booksToInsert) > 0) {
            DB::table('books')->insert($booksToInsert);
        }
    }
}
