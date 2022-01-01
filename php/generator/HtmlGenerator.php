<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/component/HtmlComponents.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/utils/HtmlUtil.php');

class HtmlGenerator
{
    private $htmlComponents;
    private $htmlUtil;

    public function __construct()
    {
        $this->htmlComponents = new HtmlComponents();
        $this->htmlUtil = new HtmlUtil();
    }

    public function generateFromObject($article)
    {
        $html = "";

        return $html . $this->generateHeader(
                $article->getTitle(),
                $article->getDescription(),
                $article->getSection(),
                $this->htmlUtil->getCanonicalUrl($article->getTitle()),
                $this->htmlUtil->getFullTime($article->getDate(), $article->getTime()),
                $this->htmlUtil->getCanonicalImage($article->getImagePath())
            )
            . $this->generateBody(
                $article->getTitle(),
                $article->getImagePath(),
                $article->getContent(),
                $article->getSection(),
                $article->getDate()
            )
            . $this->generateRightPanel()
            . $this->generateFooter();
    }

    private function generateHeader($title, $description, $section, $canonical, $fullTime, $canonicalImage)
    {
        $header = "<!Doctype html>\n<html>\n<head>\n";

        $header = $header
            . $this->htmlComponents->getMathjax()
            . $this->htmlComponents->getShareThis()
            . $this->htmlComponents->getMetadata($title, $description, $section)
            . $this->htmlComponents->getGoogleFonts()
            . $this->htmlComponents->getCSS()
            . $this->htmlComponents->getSEO($canonical, $title, $description, $fullTime, $canonicalImage);

        return $header . "</head>\n";
    }

    private function generateBody($title, $imagePath, $content, $section, $date)
    {
        $body = "<body>\n";

        return $body
            . $this->htmlComponents->getContentStart()
            . $this->htmlComponents->getArticleHeader($imagePath, $title)
            . $this->htmlComponents->getArticleData($section, $date)
            . $this->htmlComponents->getContent($content)
            . $this->htmlComponents->getSocialMedia();
    }

    private function generateRightPanel()
    {

        $rightPanel = "<div class='col s12 m4 l3'>\n<div class='blog-right-panel'>\n";

        return $rightPanel
            . $this->htmlComponents->getAboutMe()
            . $this->htmlComponents->getContentEnd();
    }

    private function generateFooter()
    {
        $footer = "";

        return $footer
            . $this->htmlComponents->getImportJS()
            . $this->htmlComponents->getImportLibraries()
            . "</body>\n"
            . $this->htmlComponents->getFooter();
    }


}