<?php

$css = file_get_contents('input/fonts.css');

$fonts_text = explode('/*', $css);

$output_sass = fopen("output/_fonts.scss", "w") or die("Unable to open file!");
$output_css = fopen("output/fonts.css", "w") or die("Unable to open file!");

$font_dir = '../fonts';

fwrite($output_sass, '$font-dir: \''.$font_dir.'\';'."\n");

foreach ($fonts_text as $font_text){
    $lines = preg_split ('/$\R?^/m', $font_text);

    if(!isset($lines[2])){
        continue;
    }

    $font_type = trim(str_replace('*/', '', $lines[0]));
    $font_family = trim(str_replace('font-family: ', '', $lines[2]));
    $font_weight = trim(str_replace('font-weight: ', '', $lines[4]));
    preg_match_all('/(?<=\()(.*?)(?=\))/', $lines[5], $font_info);
    $font_name = $font_info[0][1];
    $font_url = $font_info[0][2];
    $font_format = $font_info[0][3];


    removeUnwantedChars($font_type);
    removeUnwantedChars($font_family);
    removeUnwantedChars($font_weight);
    removeUnwantedChars($font_format);
    removeUnwantedChars($font_name);

    $file_name = implode('-', [$font_name, $font_type, $font_weight]).'.'.$font_format;
    file_put_contents('output/fonts/'.$file_name, fopen($font_url, 'r'));


    $lines[0] = '/* '.$lines[0];
    $lines_sass = $lines;
    $lines_sass[5] = '  src: url(\'#{$font-dir}/'.$file_name.'\') format(\''.$font_format.'\');';

    fwrite($output_sass, implode("\n", $lines_sass));

    $lines_css = $lines;
    $lines_css[5] = '  src: url(\''.$font_dir.'/'.$file_name.'\') format(\''.$font_format.'\');';

    fwrite($output_css, implode("\n", $lines_css));

}

function removeUnwantedChars(&$str){
    $str = str_replace(';', '', $str);
    $str = str_replace('\'', '', $str);
    $str = trim($str);
}