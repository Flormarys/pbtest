<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Subject;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $book = [
            'title' => $this->faker->sentence(),
            'url' => $this->faker->url(),
            'subject_id' => Subject::factory(),
            'language' => $this->faker->randomElement(['AR', 'EN', 'ES', 'FR', 'ZH']),
            'word_count' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'is_original' => $this->faker->boolean(),
        ];
        if($book['is_original'] == 0){
            $book['based_on'] = $this->faker->url;
        }
        return $book;
    }
}
