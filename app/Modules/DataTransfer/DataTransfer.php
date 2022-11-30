<?php

namespace App\Modules\DataTransfer;

class DataTransfer {
    protected string $error = '';
    protected array $data = [];

    public function __construct(array $data, string $error = '') {
        $this->data = $data;
        $this->error = $error;
    }

    public function hasError() {
        return !empty($this->error);
    }

    public function data() {
        return $this->data;
    }

    public function error() {
        return $this->error;
    }
}
