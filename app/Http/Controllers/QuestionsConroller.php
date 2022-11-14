<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NumbersService\NumbersService;
use App\Services\QuestionService\QuestionService;

class QuestionsConroller extends Controller
{
    public function index() {
        $questionService = new QuestionService();
        return response()->json($questionService->loadQuestions(new NumbersService()));
    }
}
