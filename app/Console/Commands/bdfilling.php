<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        // Get the contents
        $strJsonBooks = file_get_contents("books.json");
        $arrayBooks = json_decode($strJsonBooks, true);
        var_dump($arrayBooks); // print array


        //$flight = new Flight;
        //$flight->name = $request->name;
        //$flight->save();

    }
}
