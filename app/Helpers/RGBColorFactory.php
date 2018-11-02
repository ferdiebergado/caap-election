<?php

namespace App\Helpers;

class RGBColorFactory
{
    const colors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];

    const bcolors = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    public function generate($bg = false)
    {
        $colors = $this::colors;
        if ($bg) {
            $colors = $this::bcolors;
        }
        $key = array_rand($colors);
        return $colors[$key];
    }

    // public function generate($bg = false)
    // {
    //     $alpha = 1;
    //     if ($bg) {
    //         $alpha = 0.2;
    //     }
    //     $colors = [];
    //     for ($i = 1; $i <= 3; $i++) {
    //         array_push($colors, rand(1, 255));
    //     }
    //     shuffle($colors);
    //     array_push($colors, $alpha);
    //     return 'rgb(' . implode(',', $colors) . ')';
    // }
}
