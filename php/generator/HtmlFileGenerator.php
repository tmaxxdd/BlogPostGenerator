<?php
    
    class HtmlFileGenerator {
        
        public function __construct() {
            
        }
        
        public function generate($name, $html) {
            
            $myFile = $_SERVER['DOCUMENT_ROOT'] .  "/blog/" . $name . ".html";
            
            if (!file_exists($myFile)) {
                $handle = fopen($myFile, 'w') or die('Cannot open file:  ' . $myFile); //implicitly creates file
                fclose($handle);
                chmod($myFile,0755); //Change the file permissions if allowed
            }
             
            $fh = fopen($myFile, 'w'); // or die("error");  
            fwrite($fh, $html);
            fclose($fh);
            
            return $myFile;
        }
        
    }
    
?>