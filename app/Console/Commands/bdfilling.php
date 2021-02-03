<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Models\Subject;



class bdfilling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:db'; 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this comman will read the book.json file and fill the database with data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->signature = "fill:db";

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Remove all subjects and books
        Book::where('id', '>', 0)->delete();
        Subject::where('id', '>', 0)->delete();
        // Get the contents
        $strJsonBooks = file_get_contents("books.json");

        $arrayBooks = json_decode($strJsonBooks, true);

     
        foreach($arrayBooks as $book){
            $subjectObject = $book['subject'][0];
            $subjectModel = new Subject;
            $subjectModel->identifier = intval($subjectObject['Identifier']);
            $subjectModel->name = $subjectObject['Name'];
            $subjectModel->save();
                        

            
            // check if is not mandatory what to do
            foreach ($book as $column => $data) {
                if (!empty($data['title']) & 
                    !empty($data['url']) & 
                    !empty($data['Language']) & 
                    !empty($data['word_count']) & 
                    !empty($data['is_original'])) {
                
                $saveBook = new Book;
                $saveBook->title = $book['title'];
                $saveBook->url = $book['url'];
                $saveBook->subject_id = $subjectModel['id'];
                $saveBook->language = $book['Language'];
                $saveBook->word_count = $book['word_count'];
                $saveBook->is_original = $book['is_original'];
            //$saveBook->based_on = $book['based_on'];
                            $saveBook->save(); 
            }
            }

            
        }


    }
}
