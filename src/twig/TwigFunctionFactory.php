<?php

namespace Blog\twig;

use Twig\TwigFunction;

class TwigFunctionFactory
{
    public function create( ...$arguments ) : TwigFunction
    {
        return new TwigFunction( ...$arguments );
    }
}