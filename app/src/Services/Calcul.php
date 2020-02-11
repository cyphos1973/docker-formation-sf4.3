<?php

namespace App\Services;

/**
 * @author Gaëtan Rolé-Dubruille <gaetan.role-dubruille@sensiolabs.com>
 */
final class Calcul
{
    /**
     * A simple method returning the average according to given parameters
     */
    public function average(int $firstMark, int $secondMark): float
    {
        return ($firstMark + $secondMark) / 2;
    }
}
