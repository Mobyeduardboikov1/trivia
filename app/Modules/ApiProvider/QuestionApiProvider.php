<?php

namespace App\Modules\ApiProvider;

// APIs declared below
use App\Modules\NumbersApi\NumbersApi;

class QuestionApiProvider {
    protected $apiList = [];
    
    public function __construct() {
        $this->apiList = [
            new NumbersApi() // All alone here at the moment
        ];
    }

    public function getApiList(): array {
        return $this->apiList;
    }
}
