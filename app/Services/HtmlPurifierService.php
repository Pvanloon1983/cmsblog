<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

class HtmlPurifierService
{
    protected $purifier;

    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,b,strong,i,em,u,a[href],ul,ol,li,br,img[src|alt|width|height],h1,h2,h3,h4,h5,h6,blockquote');
        $config->set('AutoFormat.AutoParagraph', true);
        $config->set('AutoFormat.RemoveEmpty', true);
        $this->purifier = new HTMLPurifier($config);
    }

    public function purify(string $dirtyHtml): string
    {
        return $this->purifier->purify($dirtyHtml);
    }
}
