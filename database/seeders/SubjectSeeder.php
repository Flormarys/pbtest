<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('subjects')->delete();
    	$jsonData = file_get_contents("books.json");
    	$arrayBooks = json_decode($jsonData, true);
    	foreach($arrayBooks as $book){  
            $subjectObject = $book['subject'][0];
            DB::table('subjects')->insertOrIgnore([
                ['id' => intval($subjectObject['Identifier']), 'name' => $subjectObject['Name']]
            ]);
		}
	
    }
}

