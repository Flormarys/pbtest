<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        foreach ($this->collection as $book) {
            $data[] = [
                'title' => $book->title,
                'subject' => $book->fresh('subject'),
            ];
        }
        return [
            'data' => $data
        ];
    }
}
