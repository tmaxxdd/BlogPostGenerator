<?php

    class HtmlUtil {
        
        public function __construct() {
            
        }
        
        public function getCanonicalUrl($title) {
            $url = "/blog/";
            $formated = $this->formatString($title);
            return $url . $formated . ".html";
        }
        
        public function getFullTime($date, $time) {
            return $date . "T" . $time . ":00+00:00";
        }
        
        public function getCanonicalImage($imagePath) {
            return str_replace('..', '/', $imagePath);
        }
        
        public function formatString($title) {
            $title = str_replace(array('ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż'), array('a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'), $title);
            return strtolower(trim(preg_replace('#\W+#', '_', $title), '_'));
        }
        
    }