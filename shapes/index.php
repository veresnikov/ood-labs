<?php
declare(strict_types=1);
header("Content-Type: text/plain");
require_once "vendor/autoload.php";

use App\Example\Example;

echo Example::HelloWorld() . PHP_EOL;

const INPUT_FILE_QUERY_PARAM = "input";
const OUTPUT_FILE_QUERY_PARAM = "output";

function getQueryParameter(string $key): ?string
{
    if (!array_key_exists($key, $_GET)) {
        return null;
    }
    return $_GET[$key];
}

$inputFilePath = getQueryParameter(INPUT_FILE_QUERY_PARAM);
$outputFilePath = getQueryParameter(OUTPUT_FILE_QUERY_PARAM);

if ($inputFilePath === null || !$outputFilePath === null) {
    echo "Using {$_SERVER["HTTP_HOST"]}?input='<'path to input file'>'&output='<'path to output file'>'" . PHP_EOL;
}