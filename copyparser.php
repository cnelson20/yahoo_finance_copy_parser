<?php

$input_filename = $argv[1];

$file_contents = file_get_contents($input_filename);
$output_csv = "";

$lines = explode((strstr($file_contents, "\r\n") !== false) ? "\r\n" : "\n", $file_contents);
if (strlen($lines[count($lines) - 1]) == 0) { array_pop($lines); }

for ($i = 0; $i < count($lines);) {
    $output_csv .= $lines[$i];
    $i++;

    while ($i < count($lines) && !(ord($lines[$i]) >= ord('A') && ord($lines[$i]) <= ord('Z'))) {
        $output_csv .= "," . str_replace(",", "", $lines[$i]);
        $i++;
    }

    $output_csv .= "\n";
}

file_put_contents($input_filename . ".csv", $output_csv);