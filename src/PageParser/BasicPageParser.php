<?php
namespace PageParser;

class BasicPageParser implements IPageParser
{
    private $content;

    public function __construct($url)
    {
        $this->url = $url;
        if(!is_readable($this->url))
            $this->content = "";
    }

    public function GetPageTitle()
    {
        $content = $this->GetPageContent();
        preg_match("#<title>(.+)</title>#iuUs", $content, $m);

        if(isset($m[1]))
            return $m[1];
        else
            return "";
    }

    private function GetPageContent()
    {
        if(null === $this->content)
            $this->content = file_get_contents($this->url);

        return $this->content;
    }

    public function GetPageSize()
    {
        return mb_strlen($this->GetPageContent());
    }
}