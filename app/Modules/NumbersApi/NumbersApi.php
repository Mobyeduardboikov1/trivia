<?php

namespace App\Modules\NumbersApi;

use App\Modules\Interfaces\QuestionApi;


class NumbersApi implements QuestionApi {
    
    protected $numbersApiUrl = 'http://numbersapi.com/|range|/trivia?fragment';
    protected const FROM_NUMBER = 1;
    protected const TO_NUMBER = 3;

    /**
     * Gets the a list of questions from Numbers API
     * @param string $questionCount
     */
    public function getQuestionList(int $questionCount = 20) : array {
        $questionCount = $questionCount;
        $range = "1..$questionCount";
        
        // Get questions from Numbers Api and return the list in a standardized format
        try {
            $data = json_decode(file_get_contents(str_replace('|range|', $range, $this->numbersApiUrl)), true);
            $questions = [];
            foreach ($data as $number => $question) {
                $questions[] = [
                    'question' => ucfirst($question),
                    'answers'   => array_merge([$number], range($number + self::FROM_NUMBER, $number + self::TO_NUMBER)),
                ];
            }
            return $questions;
        } catch (Exception $e) {
            return [];
        }
    }
}
