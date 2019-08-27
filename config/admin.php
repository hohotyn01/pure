<?php
    /**
     * Created by PhpStorm.
     * User: Anton
     * Date: 27.08.2019
     * Time: 10:31
     */

    $bedroom = range('1', '10', '1');
    $bathroom = range('1', '5', '0.5');
    $rate = range('1', '10', '1');

    return [
        'range' => [
            'bedroom' => $bedroom,
            'bathroom' => $bathroom,

            'rate' => $rate
        ]
    ];