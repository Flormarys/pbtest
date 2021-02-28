<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Subject;
use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookTest extends TestCase
{
    /**
     * This will reset database after each test
     */
    use DatabaseMigrations, WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_searchBooksByTitle()
    {
        $books = Book::factory(10)->create();
        $exampleBook =  $books->first();
        $stringToSearch = $exampleBook->title;
        $apiResponse = $this->json('GET', 'api/books', ['search' => $stringToSearch]);
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        foreach ($apiResponseInArrayFormat->data as $bookInArrayFormat) {
            if ( strpos( $bookInArrayFormat->title, $stringToSearch ) !== false ) {
                $this->assertStringContainsString($bookInArrayFormat->title, $stringToSearch);
            } else {
                $this->assertStringContainsString(
                    $bookInArrayFormat->subject->name, 
                    $stringToSearch
                );
            }
        }
    }

    public function test_putSearchParameterEmpty()
    {
        $apiResponse = $this->json('GET', 'api/books', ['search' => '']);
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        $this->assertTrue($apiResponseInArrayFormat->error);
        $this->assertEquals(
            $apiResponseInArrayFormat->messages[0], 
            "The search format is invalid, must be letters or numbers"
        );
    }

    public function test_searchBooksByAbsentString()
    {
        $books = Book::factory(3)->create();
        $i = 0;
        foreach ($books as $book) {
            $book->title = 'I am a title '. $i;
            $i++;
            $book->save();
        }
        $apiResponse = $this->json('GET', 'api/books', ['search' => 'I am a title abc123']);
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        $this->assertEmpty($apiResponseInArrayFormat->data);
        $this->assertEquals($apiResponseInArrayFormat->meta->total, 0);
    }

    public function test_IsOriginalShouldReturnsOriginalBooks()
    {
        $books = Book::factory(10)->create();
        $exampleBook =  $books->first();
        $integerToSearch = $exampleBook->is_original;
        $apiResponse = $this->json('GET', 'api/books', ['is_original' => $integerToSearch]);
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        foreach ($apiResponseInArrayFormat->data as $bookInArrayFormat) {
            $this->assertIsInt($bookInArrayFormat->is_original);
            $this->assertEquals($bookInArrayFormat->is_original, $exampleBook->is_original);
        }
    }

    public function test_errorByEnteringStringForIsOriginalParameter()
    {
        $apiResponse = $this->json('GET', 'api/books', ['is_original' => 'fake']);
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        $this->assertTrue($apiResponseInArrayFormat->error);
        $this->assertEquals(
            $apiResponseInArrayFormat->messages[0], 
            'The is original field must be true or false.'
        );
    }

    public function test_errorInIsOriginalParameter()
    {
        $apiResponse = $this->json('GET', 'api/books', ['is_original' => 6]);
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        $this->assertTrue($apiResponseInArrayFormat->error);
        $this->assertEquals(
            $apiResponseInArrayFormat->messages[0], 
            'The is original field must be true or false.'
        );
    }

    public function test_perPageGetRightNumberOfBooks() {
        $totalBooks = 10;
        $books = Book::factory($totalBooks)->create();
        $perPage = 3;
        $apiResponse = $this->json('GET', 'api/books', ['per_page' => $perPage]);
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        $this->assertCount($perPage, $apiResponseInArrayFormat->data);
        $this->assertEquals($apiResponseInArrayFormat->meta->total, $totalBooks);
    }

    public function test_pageParameterOffset() {
        $totalBooks = 10;
        $books = Book::factory($totalBooks)->create();
        $perPage = 3;
        $page = 100;
        $apiResponse = $this->json(
            'GET', 
            'api/books', 
            [
                'per_page' => $perPage, 
                'page' => $page
            ]
        );
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        $this->assertEmpty($apiResponseInArrayFormat->data);
        $this->assertEquals($apiResponseInArrayFormat->meta->total, $totalBooks);
    }

    public function test_pageToZero() {
        $totalBooks = 10;
        $books = Book::factory($totalBooks)->create();
        $page = 0;
        $apiResponse = $this->json(
            'GET', 
            'api/books', 
            [
                'page' => $page
            ]
        );
        $apiResponseInArrayFormat = json_decode($apiResponse->getContent());
        $this->assertTrue($apiResponseInArrayFormat->error);
        $this->assertEquals(
            $apiResponseInArrayFormat->messages[0], 
            'The page must be at least 1.'
        );
    }
}
