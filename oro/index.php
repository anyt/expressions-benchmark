<?php

require __DIR__.'/vendor/autoload.php';

use Oro\Component\ConfigExpression\ConfigExpressions;

$language = new ConfigExpressions();

$filename = '/oro/data.yml';

require __DIR__.'/../_evaluate.php';
