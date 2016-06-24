<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

$language = new ExpressionLanguage();

$filename = '/sf/data.yml';

require __DIR__.'/../_evaluate.php';
