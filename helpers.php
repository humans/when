<?php

if (! function_exists('when')) {
    function when($conditional)
    {
        return new Humans\When\When($conditional);
    }
}

if (! function_exists('unless')) {
    function unless($conditional)
    {
        return new Humans\When\When(! $conditional);
    }
}