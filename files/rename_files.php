<?php  
 $dir = new RecursiveDirectoryIterator(".");
  foreach(new RecursiveIteratorIterator($dir) as $file) {
    if ($file->IsFile() && $file != "./cache.manifest.php" && substr($file->getFilename(), 0, 1) != ".")
    {
	 $replaced_name = str_replace(' ', '_', $file);
	 $uploaddir='.';
	 rename($uploaddir . '/' . $file, $uploaddir . '/' . $replaced_name);
    }
  }
?>