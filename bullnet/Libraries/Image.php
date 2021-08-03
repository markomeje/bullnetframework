<?php


namespace Bullnet\Libraries;
use Bullnet\Library\Generate;
use Bullnet\Core\Logger;
use Psr\Http\Message\UploadedFileInterface;
use \Exception;

/**
* Uploader Class
* Main class for uploading images
*
*/
class Image 
{

    /**
     * The mime types allowed for upload
     *
     * @var array
     */
    private static $mimes = ['image/jpeg', 'image/png', 'image/gif'];
    
    /**
     * Image extentions allowed for upload
     * @var array
     */
    private static $extensions = ['jpeg', 'png', 'gif', 'jpg'];

    /**
     * 4MB in Bytes(binary) maximum upload size
     * @var array
     */
    public static $filesize = 4194304;
    
    /**
     * @var string
     */
    private static $path;

    /**
     * @var string
     */
    private static $file;

    /**
     * @return void
     */
    public function __construct(UploadedFileInterface $file, $path = '') {
        self::$file = $file;
        self::$path = $path;
    }

    public function upload()
    {
        try {
            if(self::$file->getError() !== UPLOAD_ERR_OK) {
                return false;
            }

            $extension = pathinfo(self::$file->getClientFilename(), PATHINFO_EXTENSION);
            if(!in_array($extension, self::$extensions) || (self::$file->getSize() > self::$filesize) || !in_array(self::$file->getClientMediaType(), self::$mimes)) {
                return false;
            }
            
            $filename = Generate::string(7).'.'.$extension;
            $file = self::$path . DS . $filename;
            self::$file->moveTo($file);
            /*Set 644 permission to avoid any executable files*/
            if(!chmod($file, 0644)) {
                throw new Exception("File permissions couldn't be changed on the server.");
            }
            return (object)['filename' => $filename, 'file' => $file];
        } catch (Exception $error) {
            Logger::log('UPLOADING IMAGE ERROR', $error->getMessage(), __FILE__, $error->getLine());
            return false;
        }   
    }

}
