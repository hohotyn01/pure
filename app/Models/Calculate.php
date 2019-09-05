<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Calculate extends Model
    {
        private $dataExtras;

        public function __construct($dataExtras)
        {
            $this->$dataExtras = $dataExtras;
        }

        public function getSum()
        {

        }
    }
