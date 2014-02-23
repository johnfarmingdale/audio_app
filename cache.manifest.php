<?php header('Content-Type: text/cache-manifest');
  echo "CACHE MANIFEST \n";
  $hashes = "";
  $dir = new RecursiveDirectoryIterator(".");
  //echo "CACHE: \n";
  foreach(new RecursiveIteratorIterator($dir) as $file) {
    if ($file->IsFile() && $file != ".\cache.manifest.php" && $file != ".\index.php" && $file != ".\files\rename_files.php"  && $file != ".\css\images\Thumbs.db" && substr($file->getFilename(), 0, 1) != ".")
    { echo $file . "\n"; $hashes .= md5_file($file); }
  }
  echo "NETWORK: .\\files\\rename_files.php";
  echo "# Hash: " . md5($hashes) . "\n";
  echo "# i8676672342234242959iiooo6";
?>