<?php

class BasicPageParserTest extends PHPUnit_Framework_TestCase
{
    public function testPageTitleValid()
    {
        $parser = new \PageParser\BasicPageParser(__DIR__.'/test.html');
        $title = $parser->GetPageTitle();

        $this->assertEquals("hello", $title);
    }

    public function testPageTitle_InvalidUrl_EmptyTitle()
    {
        $parser = new \PageParser\BasicPageParser(__DIR__.'/t.html');
        $title = $parser->GetPageTitle();

        $this->assertEquals("", $title);
    }


    public function testPageSizeIsCorrect()
    {
        $parser = new \PageParser\BasicPageParser(__DIR__.'/test.html');
        $size = $parser->GetPageSize();

        $this->assertEquals(33, $size);
    }

    public function testPageSize_InvalidUrl_SizeZero()
    {
        $parser = new \PageParser\BasicPageParser(__DIR__.'/t.html');
        $size = $parser->GetPageSize();
        $this->assertEquals(0, $size);
    }
}