<?php

require __DIR__.'/vendor/autoload.php';

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\ExpressionLanguage\DoctrineParserCache;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

$fileCache = new FilesystemCache(__DIR__.'/cache');
$cache = new DoctrineParserCache($fileCache);

$language = new ExpressionLanguage($cache);

$filename = '/sf/data.yml';

require __DIR__.'/../_evaluate.php';
