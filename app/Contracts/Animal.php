<?php

namespace App\Contracts;

interface Animal
{   
    const ABC = 22;
    public function bark(): string;
    public function sing(): string;
    public function dance(): string;
}
