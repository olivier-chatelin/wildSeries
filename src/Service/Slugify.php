<?php


namespace App\Service;


class Slugify
{
    public const TRANSLATION_TABLE = [
        'é' => 'e',
        'à' => 'a',
        'è' => 'è',
        'ç' => 'c',
        'â' => 'a',
        'ê' => 'e',
        '\'' => '-',
        'ù' => 'u',
    ];
    public const PONCTUATION_MARK = [
        ".",",","\"","!","?",":",";"
    ];

    public function generate(string $input): string
    {
        $slug = trim($input);
        $slug = str_replace(" ","-",$slug);
        foreach (self::TRANSLATION_TABLE as $key => $translation) {
            $slug = str_replace($key, $translation, $slug);
        }
        foreach (self::PONCTUATION_MARK as $mark) {
            $slug = str_replace($mark,"",$slug);
        }
        $slug = strtolower($slug);
        $slug = str_replace('--','-',$slug);
        return $slug;





    }
}