<?php

namespace App\Modules\QuestionManager;

use App\Modules\DataTransfer\DataTransfer;
use App\Modules\Interfaces\QuestionApi;
use App\Modules\ApiProvider\QuestionApiProvider;

/**
 * A wrapper for question services. 
 */
class QuestionManager {

    /**
     * Returns and array of existing APIs
     */
    public function getQuestionProviders(): array {
        return (new QuestionApiProvider())->getApiList();
    }

    /**
     * Loads questions from all available APIs
     */
    public function getQuestionList(): DataTransfer {
        $questionProviders = $this->getQuestionProviders();
        $questionList = [];
        foreach ($questionProviders as $questionProvider) {
            $questions = $this->loadQuestions($questionProvider);
            if ($questions->hasError()) {
                return new DataTransfer([], $questions->error());
            }
            $questionList = array_merge($questionList, $questions->data());
        }
        return new DataTransfer($questionList);
    }

    /**
     * A method returns a list of questions from a concrete question API
     */
    public function loadQuestions(QuestionApi $service): DataTransfer {
        $questions = $service->getQuestionList();
        if (empty($questions)) {
            return new DataTransfer(null, "Empty data set returned");
        }
        return new DataTransfer($questions);        
    }
}
