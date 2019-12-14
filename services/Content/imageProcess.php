<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/12/18
 * Time: 4:32 PM
 */

namespace App\Content;

use Egulias\EmailValidator\Warning\IPV6MaxGroups;
use \Gumlet\ImageResize;


/**
 * Class imageProcess
 * @package app\Content
 */
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

    /** @var int  */
    private $maxWidth = 1200;

    /** @var bool  */
    private $resize = true;

    /**
     * imageProcess constructor.
     * @param $siteRoot
     * @param $imageRoot
     * @param bool $recursive
     */
    public function __construct($siteRoot, $imageRoot, $recursive = false, $resize = false)
    {
        $this->siteRoot = $siteRoot;
        $this->imageRoot = $imageRoot;
        $this->recursive = $recursive;
        $this->resize = $resize;
        $this->createImgList();
    }

    /**
     * @param bool $thumbnails
     * @return bool
     */
    public function createImgList($thumbnails = false)
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

    public function createResize ()
    {
        foreach ($this->images as $value) {
            array_walk($value['images'], function ($img) {
                $this->makeThumb($img['fullpath'], $this->siteRoot . $this->imageRoot . 'thumb/', 600);
            });

        }
    }

    /**
     * @param string $dir
     * @return array
     */
    public function scandirs($dir)
    {
        $name = str_ireplace($this->siteRoot, '', $dir);
        $this->images[] = ['dir' => $name,  'images' => $this->scanImgdir($dir)];
        if ($this->recursive === true) {
            $subDirectory = $this->recursiveDir($this->currentDir);
            if (is_array($subDirectory) && is_array($this->images)) {
                $this->images = array_merge($this->images, $subDirectory);
            }
        }

        return $this->images;
    }

    /**
     * scan dir for images and filter results
     * @param array $dir
     * @return array
     */
    public function scanImgdir( $dir)
    {
        $iterator = new \FilesystemIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
        $filter = new \RegexIterator($iterator, '/.(jpg|jpeg|png)$/');
        $fileList = [];
        $thumbnail = substr($this->currentDir,-1,1) === '/' ? 'thumbnail/' : '/thumbnail/';
        foreach($filter as $entry) {
            $meta = exif_read_data($entry->getPathname());
            $altText = $this->nameAltText($entry->getFilename());
            if ($meta["COMPUTED"]["Width"] > 1200) {
                $rightSize = __DIR__ . '/../../public_html/images/s3/' . $entry->getFilename();
                if (!file_exists($rightSize)) {
                    $new = $this->webMaxImg($entry->getPathname(), $rightSize);
                    if ($new === true) {
                        $webpath = str_replace($this->siteRoot, '',  $entry->getPathname());
                    }
                } else { $webpath = '/images/s3/' . $entry->getFilename(); }
                $newImgMeta = exif_read_data($rightSize);
                $meta['COMPUTED']['html'] = $newImgMeta['COMPUTED']['html'];
            }
            $fileList[] = [
                'fullpath' => $entry->getPathname(),
                'filename' => $entry->getFilename(),
                'altText'  => $altText,
                'thumbnail' => $this->currentDir . $thumbnail . $entry->getFilename(),
                'thumbLink' => $this->imageRoot . $thumbnail . $entry->getFilename(),
                'imgUrl' => $this->imageRoot . $entry->getFilename(),
                'html' => $meta['COMPUTED']['html'],
                'webpath' => !is_null($webpath) ? $webpath : '',
            ];
        }

        return $fileList;
    }

    public function maxWebImg (array $images)
    {//todo: this does not work
        foreach ($images as $key => $image) {
            $img = new ImageResize($image['fullpath']);
            $img->resizeToWidth(1200);
            $return = $img->save($image['fullpath']);
        }

        return $return;
    }

    public function webMaxImg (string $path, string $rightSize)
    {
        $img = new ImageResize($path);
        $img->resizeToWidth(1200);
        $img->save($rightSize);

        return file_exists($rightSize);
    }

    /**
     * @param $filename
     * @return null|string|string[]
     */
    private function nameAltText ($filename)
    {
        $altText = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $altText = preg_replace('/[-|_|\.]/i', ' ', $altText);
        $altText =trim($altText);

        return $altText;
    }

    /**
     * RecursiveDir is the
     * @param $dir
     * @return array
     */
    private function recursiveDir ($dir)
    {
        $fileSystemIterator = new \FilesystemIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
        foreach ($fileSystemIterator as $fileInfo){
            if ($fileInfo->isDir() && $fileInfo->getFilename() !== 'thumbnails') { //Thumbnails we generated
                $subDirectory[] = ['dir' => $fileInfo->getFilename(), 'images' => $this->scanImgdir($fileInfo->getPathname())];
            }
        }
        $subDirectory = !isset($subDirectory) ? [] : $subDirectory;

        return $subDirectory;

    }


    /**
     * @param array $images
     * @return string
     */
    private function createThumbnails(array $images)
    {
        echo '<pre>';
        foreach($images as $img) {
            print_r($img);
        }

        return 'nothing';
    }

    /**
     * @param array $images
     */
    private function createHTML(array $images)
    {

    }

    /**
     * @param $imagePath string
     * @param $dest string
     * @param $thumbWidth int
     * @param $rewrite bool
     * @return bool
     */
    private function makeThumb($imagePath, $dest, $thumbWidth, $rewrite = false) {
        if (is_file($dest) && $rewrite === false) { //don't rewrite unless need be
            $this->thumbnails[] = $dest;
            return true;
        }

        if (is_file($imagePath)) {
            $info = pathinfo($imagePath);

            $extension = strtolower($info['extension']);
            if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {

                switch ($extension) {
                    case 'jpg':
                        $img = imagecreatefromjpeg("{$imagePath}");
                        break;
                    case 'jpeg':
                        $img = imagecreatefromjpeg("{$imagePath}");
                        break;
                    case 'png':
                        $img = imagecreatefrompng("{$imagePath}");
                        break;
                    case 'gif':
                        $img = imagecreatefromgif("{$imagePath}");
                        break;
                    default:
                        $img = imagecreatefromjpeg("{$imagePath}");
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

        $result = !isset($result) ? false : $result;

        return $result;
    }

    /**
     * @param $image
     * @param $copyto
     * @param int $width
     * @param bool $rewrite
     * @return bool
     */
    private function resizeImg($image, $copyto, $width = 500, $rewrite = false)
    {
        if (is_file($image)) {
            $info = pathinfo($image);

            $extension = strtolower($info['extension']);
            if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {

                switch ($extension) {
                    case 'jpg':
                        $img = imagecreatefromjpeg("{$image}");
                        break;
                    case 'jpeg':
                        $img = imagecreatefromjpeg("{$image}");
                        break;
                    case 'png':
                        $img = imagecreatefrompng("{$image}");
                        break;
                    case 'gif':
                        $img = imagecreatefromgif("{$image}");
                        break;
                    default:
                        $img = imagecreatefromjpeg("{$image}");
                }
                // load image and get image size

                $currentWidth = imagesx($img);
                $currentHeight = imagesy($img);

                // calculate thumbnail size
                $height = floor($currentHeight * ( $width / $currentWidth ));

                // create a new temporary image
                $tmpImage = imagecreatetruecolor($width, $height);

                // copy and resize old image into new image
                imagecopyresized($tmpImage, $img, 0, 0, 0, 0, $width, $height, $currentWidth, $currentHeight);
                // save thumbnail into a file
                imagejpeg($tmpImage, $copyto);
                $result = $copyto;
            } else {
                $result = false; //'Failed|Not an accepted image type (JPG, PNG, GIF).';
            }
        } else {
            $result = false; //'Failed|Image file does not exist.';
        }

        return $result;

    }

}