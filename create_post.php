<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/model/Article.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/generator/HtmlGenerator.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/utils/HtmlUtil.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/generator/HtmlFileGenerator.php');

if ($_POST['ajax']) {
    if (isset($_POST['post_data'])) {

        $data = json_decode($_POST['post_data'], true);

        $article = new Article(
            $data['post_image'],
            $data['post_date'],
            $data['post_time'],
            $data['post_section'],
            $data['post_title'],
            $data['post_description'],
            $data['post_content']
        );

        $htmlGenerator = new HtmlGenerator();
        $html = $htmlGenerator->generateFromObject($article);

        $fileGenerator = new HtmlFileGenerator();
        $util = new HtmlUtil();

        $parsedName = $util->formatString($article->getTitle());

        $generatedFile = $fileGenerator->generate($parsedName, $html);

        if (file_exists($generatedFile)) {
            echo $generatedFile;
        } else {
            echo "Blog file isn't generated!";
        }

    } else {
        http_response_code(500);
        echo "You haven't passed the data.";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}