<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Subject;
use App\Http\Resources\SubjectResource as SubjectResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'subject' => new SubjectResource(Subject::find($this->subject_id)),
            'language' => $this->language,
            'word_count' => $this->word_count,
            'is_original' => $this->is_original,
            'based_on' => $this->based_on,
        ];
    }
}
