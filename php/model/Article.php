<?php 

    class Article {
        private $image_path;
        private $date;
        private $time;
        private $section;
        private $title;
        private $description;
        private $content;
        
        function __construct($image_path, $date, $time, $section, $title, $description, $content) {
            $this->image_path = $image_path;
            $this->date = $date;
            $this->time = $time;
            $this->section = $section;
            $this->title = $title;
            $this->description = $description;
            $this->content = $content;
        }
        
        public function getImagePath() {
            return $this->image_path;
        }
        
        public function getDate() {
            return $this->date;
        }
        
        public function getTime() {
            return $this->time;
        }
        
        public function getSection() {
            return $this->section;
        }
        
        public function getTitle() {
            return $this->title;
        }
        
        public function getDescription() {
            return $this->description;
        }
        
        public function getContent() {
            return $this->content;
        }
        
    }