<?php
spl_autoload_register('autoloader');
/**
 * autoload
 *
 */
function autoloader ($className) {
    $config = Config::getInstance();
    $dir = $config->getConfig('app_dir');
    $directory = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
    $filename = $className . '.php';
    foreach ($fileIterator as $file) {
        if (strtolower($file->getFilename()) === strtolower($filename)
                && $file->isReadable()) {
            include_once $file->getPathname();
            return;
        }
    }
    throw new AutoloaderClassNotFound("Unable to load $className.");
}
