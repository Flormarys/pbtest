<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class SubjectSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$jsonData = file_get_contents($this->bookJsonFile);
    	$arrayJsonBooks = json_decode($jsonData, true);
        $subjectsToInsert = [];
    	foreach($arrayJsonBooks as $book){  
            $subjectObject = $book['subject'][0];
            $subjectsToInsert[] = [
                'id' => intval($subjectObject['Identifier']), 
                'name' => $subjectObject['Name']
            ];
		}
        if (count($subjectsToInsert) > 0) {
            DB::table('subjects')->insertOrIgnore($subjectsToInsert);
        }
    }
}

