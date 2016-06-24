<?php

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Stopwatch\Stopwatch;

$context = [
    'object'                      => new Object('object_title'),
    'collection'                  => new ArrayCollection(
        [
            new Object('object_title1'),
            new Object('object_title2'),
            new Object('object_title3')
        ]
    ),
    'multidimensional_array_test' => [
        'test' => [
            '1' => ['2' => ['3' => ['4' => ['5' => ['6' => ['7' => ['8' => ['9' => [0 => '0 value']]]]]]]]]
        ]
    ],
    'data'                        => [
        'nested_object' => new Object(
            'first_level',
            new Object(
                'second_level',
                new Object(
                    'third_level',
                    new Object(
                        'forth_level',
                        new Object(
                            'fifth_level',
                            new Object(
                                'sixth_level',
                                new Object(
                                    'seventh_level'
                                )
                            )
                        )
                    )
                )
            )
        )
    ],
    'string'                      => 'Hello World!',
    'bool'                        => true
];

$yaml = new \Symfony\Component\Yaml\Yaml();
$exprs = $yaml->parse(file_get_contents(__DIR__.$filename));

$stopwatch = new Stopwatch();
$stopwatch->start('execute.expressions');

foreach ($exprs as $expr) {
    $language->evaluate($expr, ['context' => $context]);
}

$stopwatch->stop('execute.expressions');
$event = $stopwatch->getEvent('execute.expressions');

echo '<h3>Oro Expressions</h3>';
echo 'Expressions: '.count($exprs).'<br>';
echo 'Duration: '.$event->getDuration().'ms <br>';
echo 'Memory: '.formatBytes($event->getMemory());
echo '<hr>';


// Helpers

function formatBytes($bytes, $precision = 2)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision).' '.$units[$pow];
}

class Object
{
    protected $title;
    protected $child;

    public function __construct($title, Object $child = null)
    {
        $this->title = $title;
        $this->child = $child;
    }

    public function getChild()
    {
        return $this->child;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
