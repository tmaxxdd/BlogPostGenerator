<?php //Generate text file on the fly

   $date = date('Y_m_d_H_i_s');
   $filename = 'blog_data_' . $date . '.txt';
   $filepath = realpath(dirname(__FILE__)) . '/blog_data/' . $filename;
   $zipfile = realpath(dirname(__FILE__)) . '/blog_data/blog_data_' . $date . '.zip';
   
   $f = fopen($filepath, 'w');
   $content = $_POST['blog_data'];
   fwrite($f, $content);
   fclose($f);
   
   $z = fopen($zipfile, 'w');
   fwrite($z, "");
   fclose($z);
   
   $zip = new ZipArchive;
   if ($zip->open($zipfile) === TRUE) {
       $zip->addFile($filepath, $filename);
       $zip->close();
   } else {
       echo 'failed \n';
   }
   
   echo '/blog_data/blog_data_' . $date . '.zip';