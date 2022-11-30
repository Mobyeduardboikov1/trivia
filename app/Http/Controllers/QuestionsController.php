<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\QuestionManager\QuestionManager;

class QuestionsController extends Controller
{
    public function index() {
        $questionManager = new QuestionManager();
        $questions = $questionManager->getQuestionList();
        if ($questions->hasError()) {
            return response()->json(array('error' => $questions->error()));
        }
        return response()->json($questions->data());
    }
}
