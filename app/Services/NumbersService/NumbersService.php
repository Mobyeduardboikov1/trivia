<?php

namespace App\Services\NumbersService;

use App\Services\QuestionService\Interfaces\QuestionServiceInterface;


class NumbersService implements QuestionServiceInterface {
    
    protected $numbersApiUrl = 'http://numbersapi.com/|range|/trivia?fragment';

    /**
     * Gets the a list of questions from Numbers API
     * @param string $questionCount
     */
    public function getQuestionList(int $questionCount = 20) : array {
        try {
            $questionCount = (int)$questionCount;
            $range = "1..$questionCount";
            $questions = json_decode(file_get_contents(str_replace('|range|', $range, $this->numbersApiUrl)), true);
            return $questions;
        }
        catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }

    /**
     * Formats the list of questions to be ['question', 'answers'], where the correct answer is the first in a row
     * @param array $questions
     */
    public function formatQuestionList(array $questions) : array {
        $formattedQuestions = [];
        
        foreach ($questions as $number => $question) {
            $formattedQuestion = [
                'question' => ucfirst($question),
                'answers'   => array_merge([$number], range($number + 1, $number + 3)),
            ];

            $formattedQuestions[] = $formattedQuestion;
        }

        return $formattedQuestions;
    }
}