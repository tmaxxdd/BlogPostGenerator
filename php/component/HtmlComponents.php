<?php

class HtmlComponents
{

    function __construct()
    {

    }

    public function getMathjax()
    {
        return
            "<!-- Mathjax -->\n"
            . "<script type='text/javascript' async
            src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML'>\n</script>\n";
    }

    public function getShareThis()
    {
        return
            "<!-- ShareThis -->\n"
            . "<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c3519fdad0b1400119dbb33&product=inline-share-buttons' async='async'>\n"
            . "</script>\n";
    }

    public function getMetadata($title, $description, $section)
    {
        return
            "<!-- Title -->\n"
            . "<title>$title</title>\n"
            . "<!-- Charset -->\n"
            . "<meta charset='utf-8'>\n"
            . "<!-- Author -->\n"
            . "<meta name='author' content='Tomasz Kądziołka'>\n"
            . "<!-- Keywords -->\n"
            . "<meta name='Keywords' content='blog, tomasz, kadziolka, $section'>\n"
            . "<!-- Description -->\n"
            . "<meta name='Description' content='$description'>\n";
    }

    function getGoogleFonts()
    {
        return
            "<!-- Google fonts -->\n"
            . "<link href='https://fonts.googleapis.com/css?family=Anonymous+Pro:700|Dosis:700|Montserrat:400|Fira+Sans' rel='stylesheet'>\n"
            . "<!--Import Google Icon Font-->\n"
            . "<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>\n";
    }

    public function getCSS()
    {
        return
            "<!--Import materialize.css-->\n"
            . "<link type='text/css' rel='stylesheet' href='../css/materialize.min.css' media='screen,projection'/>\n"
            . "<!-- MY CSS -->"
            . "<link href='../css/style.css' rel='stylesheet' type='text/css'>"
            . "<!--Let browser know website is optimized for mobile-->\n"
            . "<meta name='viewport' content='width=device-width, initial-scale=1.0'/> <meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
    }

    public function getSEO($canonical, $title, $description, $fullTime, $canonicalImage)
    {
        return
            "<!-- SEO -->\n"
            . "<link rel='canonical' href='$canonical'>\n"
            . "<link rel='publisher' href=''>\n"
            . "<meta property='og:locale' content='pl_PL'>\n"
            . "<meta property='og:type' content='article'>\n"
            . "<meta property='og:title' content='$title'>\n"
            . "<meta property='og:description' content='$description'>\n"
            . "<meta property='og:url' content='$canonical'>\n"
            . "<meta property='og:site_name' content='Tomasz Kądziołka'>\n"
            . "<meta property='article:section' content='Blog'>\n"
            . "<meta property='article:published_time' content='$fullTime'>\n"
            . "<meta property='article:modified_time' content='$fullTime'>\n"
            . "<meta property='og:updated_time' content='$fullTime'>\n"
            . "<meta property='og:image' content='$canonicalImage'>\n"
            . "<meta property='og:image:width' content='640'>\n"
            . "<meta property='og:image:height' content='426'>\n"
            . "<meta name='twitter:card' content='summary_large_image'>\n"
            . "<meta name='twitter:description' content='$description'>\n"
            . "<meta name='twitter:site' content=''>\n"
            . "<meta name='twitter:image' content='$canonicalImage'>\n"
            . "<meta name='twitter:creator' content=''>\n"
            . "<!-- End of SEO -->\n";
    }

    public function getContentStart()
    {
        return
            "<!-- Content -->\n"
            . "<div class='row'>\n"
            . "<!-- Left ads column -->\n"
            . "<div class='col s12 m12 l2'></div>\n"
            . "<!-- Center -->\n"
            . "<div class='col s12 m12 l8'>\n"
            . "<!-- Content -->\n"
            . "<div class='col s12 m8 l9' style='padding: 0;'>\n";
    }

    public function getArticleHeader($imagePath, $title)
    {
        return
            "<!-- Header -->\n"
            . "<div class='blog-header' style='background: url($imagePath); background-repeat: no-repeat; background-size: cover;'>\n"
            . "<hr>\n"
            . "<h1 class='dosis big-text'>$title</h1>"
            . "<div class='color-overlay'>\n"
            . "</div>\n</div>\n";
    }

    public function getArticleData($section, $date)
    {
        return
            "<!-- Article data -->\n"
            . "<div class='blog-data'>\n"
            . "<p class='section-title montserrat'>" . $section . "</p>\n"
            . "<p class='article-date montserrat'>" . $date . "</p>"
            . "</div>\n";
    }

    public function getContent($content)
    {
        $generatedContent = "<!-- Article -->\n";

        foreach ($content as $key => $item) {
            //Iterate over component. Single component is an array
            // i.e. [array(), array()]

            $currentPosition = $key;
            $currentData = "";

            foreach ($item as $key => $value) {
                //At position 0 is component-id like component-0 and it handles data
                //At position 1 is type. It defines pattern like header or text
                if ($key != 'type') {
                    $currentData = $value;
                } else {
                    if ($currentData != "") {

                        $generatedContent =
                            $generatedContent
                            . $this->getPatternForContent($value, $currentData);

                    } else {
                        $generatedContent =
                            $generatedContent
                            . "<p>No data for " . $currentPosition . "<p>\n";
                    }
                }
            }

        }

        return $generatedContent;
    }

    public function getSocialMedia()
    {
        return
            "<!-- Social media -->\n"
            . "<blockquote>\n"
            . "<p class='montserrat small-text black-text'>Thank you very much for reading this post 😀 If you like my job, you can check more posts or share this article. I will be very pleased 😊</p>\n"
            . "</blockquote>\n"
            . "<div class='sharethis-inline-share-buttons'></div>\n"
            . "</div>\n";
    }

    public function getAboutMe()
    {
        return
            "<img src='https://gravatar.com/avatar/0c904d87b2bab475cb80546166c4ea36?s=400&d=robohash&r=x' class='full-width-image' style='padding: 3em;'>\n"
            . "<h3 class='dosis black-text medium-text center' style='margin-top: 0px;'>About</h3>\n"
            . "<p class='montserrat small-text grey-text'>This is your bio. Some simple sentences about you and your activities.</p>\n"
            . "<div style='text-align: center; margin-bottom: 16px;'>\n"
            . "</div>\n";
    }

    public function getContentEnd()
    {
        return
            "</div>\n"
            . "</div>\n"
            . "<!-- Right ads column -->\n"
            . "<div class='col s12 m12 l2'>\n"
            . "</div>\n"
            . "</div>\n"
            . "</div>\n";
    }

    public function getImportJS()
    {
        return
            "<!--Import jQuery before materialize.js-->\n"
            . "<script type='text/javascript' src='https://code.jquery.com/jquery-3.2.1.min.js'></script>\n"
            . "<script type='text/javascript' src='../js/materialize.min.js'></script>\n"
            . "<script type='text/javascript' src='../js/js.js'></script>\n";
    }

    public function getImportLibraries()
    {
        return
            "<!-- atom-one-light.min -->\n"
            . "<link href='../css/style.css' rel='stylesheet' type='text/css'>\n"
            . "<link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-light.min.css'>\n"
            . "<script src='//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js'></script> <script>hljs.initHighlightingOnLoad();</script>\n";
    }

    public function getFooter()
    {
        return
            "<!-- Footer -->\n"
            . "<footer class='page-footer'>\n"
            . "<div class='footer-copyright'>\n"
            . "<div class='container grey-text'>&copy; <span id='year'>2018</span> Tomasz Kądziołka \n"
            . "</div>\n"
            . "</div>\n"
            . "</footer>\n";
    }

    private function getPatternForContent($type, $value)
    {
        switch ($type) {
            case 'header':
                return
                    "<div class='divider blog'></div>\n"
                    . "<h2 class='fira black-text medium-text center'>" . $value . "</h2>\n";
            case 'text':
                return "<p class='montserrat small-text grey-text center'>" . $value . "</p>\n";
            case 'image':
                return "<img src='" . $value . "' class='full-width-image'>\n";
            case 'code':
                return "<script src='https://gist.github.com/tmaxxdd/" . $value . ".js'></script>\n";
            case 'link':
                $output = "<blockquote style='border-width: 2px;'>\n<a class='green-text' href='" . $value['href'] . "' target='_blank'>" . $value['name'] . "</a>\n</blockquote>\n";
                return $output;
            case 'table':
                $tableView = "<ul class='collection'>\n";
                foreach ($value as $key => $item) {
                    $tableView = $tableView . "<li class='collection-item'>" . $item . "</li>\n";
                }
                $tableView = $tableView . "</ul>\n";
                return $tableView;
            default:
                return "ERROR: Cannot find a pattern to generate!";
        }
    }

}