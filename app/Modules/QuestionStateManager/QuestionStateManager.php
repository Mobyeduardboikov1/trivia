<?php

namespace App\Modules\QuestionStateManager;

/**
 * State manager will keep question list in the session [WIP] 
 */
class QuestionStateManager {
    protected $questions = [];
    public function __construct(Request $request) {
        $this->questions = $request->session()->get('questions');
    }

    public function getUnansweredQuestions() {
        return array_filter($this->questions, function($question) {
            return !empty($question['isAnswered']);
        });
    }
}
