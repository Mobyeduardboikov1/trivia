<?php

namespace App\Services\QuestionService;

use App\Services\QuestionService\Interfaces\QuestionServiceInterface;



/**
 * A wrapper for question services. 
 */
class QuestionService {
    

    /**
     * A method returns a list of questions from a question service
     */
    public function loadQuestions(QuestionServiceInterface $service) {
        $questions = $service->getQuestionList();
        
        // Let's show a simple message to the user if something went wrong.
        if (!empty($questions['error'])) {
            return ['error' => $questions['error']];
        }

        return $service->formatQuestionList($questions);
    }


}
