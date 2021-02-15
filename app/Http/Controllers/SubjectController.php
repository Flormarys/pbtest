<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SubjectResource as SubjectResource;
use App\Models\Subject;
use App\Http\Resources\SubjectCollection;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;

class SubjectController extends Controller
{

	public function subjectList()
	{
		return SubjectResource::collection(Subject::all());
	}

	public function subject($id)
	{
		return Subject::find($id);
	}   

}
