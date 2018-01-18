<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/12/18
 * Time: 4:32 PM
 */

namespace app\Content;


class imageProcess
{

    /**
     * @var string
     * Current directory working on
     */
    private $currentDir;

    /**
     * @var string
     * Root to create the links
     */
    private $siteRoot;

    /**
     * @var string
     * Image directory
     */
    private $imageRoot;

    /**
     * @var boolean
     * Create thumbnails
     */
    public $flagThumbnails;

    /**
     * @var boolean
     * recursive flag
     */
    private $recursive;

    /**
     * @var array
     * Array of html version
     */
    private $thumbHtml;

    /**
     * @var array
     * Array of Images - linkUrl, textfilename, alttype, thumbnail
     */
    public $images;

    /**
     * @param $siteRoot
     * @param $imageRoot
     * @param bool|false $recursive
     */
    public function __construct($siteRoot, $imageRoot, $recursive = false)
    {
        $this->siteRoot = $siteRoot;
        $this->imageRoot = $imageRoot;
        $this->recursive = $recursive;
    }

    public function createImgList()
    {
        $this->currentDir = $this->siteRoot . $this->imageRoot;
        $images = array_filter($this->scandirs($this->currentDir));
        if (is_dir($this->currentDir) && is_array($images)) {
            if ($this->flagThumbnails === true) {
                echo 'start sub thumb';
                $thumbnail = $this->createThumbnails($images);
            }
        }

        return true;
    }

    public function scandirs($dir)
    {
        $name = str_ireplace($this->siteRoot, '', $dir);
        $this->images[$name] = $this->scanImgdir($dir);
        if ($this->recursive === true) {
            $subdir = $this->recursiveDir($this->currentDir);
            if (is_array($subdir) && is_array($this->images)) {
                $this->images = array_merge($this->images, $subdir);
            }
        }

        return $this->images;
    }

    /**
     * RecursiveDir is the
     * @param $dir
     * @return array
     */
    private function recursiveDir ($dir)
    {
        $fileSystemIterator = new FilesystemIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        foreach ($fileSystemIterator as $fileInfo){
            if ($fileInfo->isDir() && $fileInfo->getFilename() !== 'thumbnails') { //Thumbnails we generated
                $subdir[$fileInfo->getFilename()] = $this->scanImgdir($fileInfo->getPathname());
            }
        }
        if (!isset($subdir)) {
            $subdir = [];
        }

        return $subdir;

    }

    /**
     * scan dir for images and filter results
     * @param $dir
     * @return array
     */
    public function scanImgdir($dir)
    {
        $iterator = new FilesystemIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $filter = new RegexIterator($iterator, '/.(jpg|jpeg|png)$/');
        $filelist = array();
        foreach($filter as $entry) {
            $altText = $this->nameAltText($entry->getFilename());
            $filelist[] = [$entry->getPathname(), $entry->getFilename(), $altText, $this->currentDir . '/thumbnail/' . $entry->getFilename()];
        }

        return $filelist;
    }

    private function nameAltText ($filename)
    {
        $altText = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $altText = preg_replace('/[-|_|\.]/i', ' ', $altText);
        $altText =trim($altText);

        return $altText;
    }

    private function createThumbnails(array $images)
    {
        echo '<pre>';
        foreach($images as $img) {
            print_r($img);
        }
    }

    private function createHTML(array $images)
    {

    }

    /**
     * @param $pathToImage string
     * @param $dest string
     * @param $thumbWidth int
     * @param $rewrite bool
     * @return bool
     */
    private function make_thumb($pathToImage, $dest, $thumbWidth, $rewrite = false) {
        if (is_file($dest) && $rewrite === false) { //don't rewrite unless need be
            $this->thumbnails[] = $dest;
            return true;
        }
        $result = false;
        if (is_file($pathToImage)) {
            $info = pathinfo($pathToImage);

            $extension = strtolower($info['extension']);
            if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {

                switch ($extension) {
                    case 'jpg':
                        $img = imagecreatefromjpeg("{$pathToImage}");
                        break;
                    case 'jpeg':
                        $img = imagecreatefromjpeg("{$pathToImage}");
                        break;
                    case 'png':
                        $img = imagecreatefrompng("{$pathToImage}");
                        break;
                    case 'gif':
                        $img = imagecreatefromgif("{$pathToImage}");
                        break;
                    default:
                        $img = imagecreatefromjpeg("{$pathToImage}");
                }
                // load image and get image size

                $width = imagesx($img);
                $height = imagesy($img);

                // calculate thumbnail size
                $new_width = $thumbWidth;
                $new_height = floor($height * ( $thumbWidth / $width ));

                // create a new temporary image
                $tmp_img = imagecreatetruecolor($new_width, $new_height);

                // copy and resize old image into new image
                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                // save thumbnail into a file
                imagejpeg($tmp_img, $dest);
                $result = true;
                $this->thumbnails[] = $dest;
            } else {
                $result = false; //'Failed|Not an accepted image type (JPG, PNG, GIF).';
            }
        } else {
            $result = false; //'Failed|Image file does not exist.';
        }
        return $result;
    }

}