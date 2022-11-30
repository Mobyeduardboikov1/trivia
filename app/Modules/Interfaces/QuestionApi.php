<?php

namespace App\Modules\Interfaces;

/**
 * QuestionApi provides common methods for specific question services (example : NumbersService)
 */
interface QuestionApi {
    public function getQuestionList(int $questionCount) : array;
}
