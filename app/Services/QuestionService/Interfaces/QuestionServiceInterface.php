<?php

namespace App\Services\QuestionService\Interfaces;

/**
 * QuestionIntefface provides common methods for specific question services (example : NumbersService)
 */
interface QuestionServiceInterface {
    public function getQuestionList(int $questionCount) : array;
    public function formatQuestionList(array $questions) : array;
}
