<?php

namespace Application\Library;
use Application\Library\Generate;
use Application\Core\Logger;
use \Exception;

 /**
  * Uploader Class
  *
  */

class Uploader {

    public static $allowedMime = [
        "image" =>  ["jpg", "png", "gif", "jpeg"],
        "csv"   =>  ['text/csv', 'application/vnd.ms-excel', 'text/plain'],
        "file"  =>  ['application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/pdf',
                        'application/zip',
                        'application/vnd.ms-powerpoint'],
        "audio" => ["mp3", "ogg", "mp4", "m4a"]
    ];

    public static $maximumFilesize = 4194304; //4MB in Bytes(binary)


    public function __construct() {}


    public function process($file, $directory, $type = "", $maximumFilesize = 0){
        $maximumFilesize = empty($maximumFilesize) ? self::$maximumFilesize : $maximumFilesize;
        if (!isset($file['error']) || is_array($file['error']) || UPLOAD_ERR_NO_FILE === $file['error'] || UPLOAD_ERR_FORM_SIZE === $file['error'] || UPLOAD_ERR_FORM_SIZE === $file['error']) {
            return false;
        }

        if($type === "csv"){
            $basename = "grades" . "." . "csv";
            $data = ["basename" => $basename, "extension" => "csv"];
        } else {
            $filename = $file["name"];
            $filenameArray = explode(".", $filename);
            $extension = strtolower(end($filenameArray));

            if(empty($extension) || !in_array($extension, self::$allowedMime["image"]) || $file["size"] > $maximumFilesize) return false;
            $hashedFilename = substr(Generate::hash(strtolower($filename.$extension)), 0, 10);
            $basename = $hashedFilename . "." . $extension;
            $path = $directory . DS . $basename;
            $data = ["basename" => $basename, "path" => $path];
        }
        return $data;
    }

    public function fileExists($file){
       return (file_exists($file) && is_file($file)) ? true : false;
    }

    public function deleteFile($file){
        if(self::fileExists($file)) return unlink($file);
    }

    private function mime($file){
        if(!file_exists($file["tmp_name"])){
            return false;
        }elseif(!function_exists('finfo_open')) {
            Logger::log("PHP VERSION FUNCTION ERROR", "finfo_open FUNCTION DOES NOT EXISTS", __FILE__, __LINE__);
            return false;
        }

        $finfo_open = finfo_open(FILEINFO_MIME_TYPE);
        $finfo_file = finfo_file($finfo_open, $file["tmp_name"]);
        finfo_close($finfo_open);
        list($mime) = explode(';', $finfo_file);
        return $mime;
    }

    private static function mimeToExtension($mime){
        $array = [
            'image/jpeg' => 'jpeg', // for both jpeg & jpg.
            'image/png' => 'png',
            'image/gif' => 'gif',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/pdf' => 'pdf',
            'application/zip' => 'zip',
            'application/vnd.ms-powerpoint' => 'ppt',
            "audio/mpeg" => "mp3",
            "audio/x-m4a" => "m4a"
        ];
        return isset($array[$mime]) ? $array[$mime]: false;
    }

    private static function getFileName($file){
        $filename = pathinfo($file['name'], PATHINFO_FILENAME);
        $filename = preg_replace("/([^A-Za-z0-9_\-\.]|[\.]{2})/", "", $filename);
        $filename = basename($filename);
        return $filename;
    }

    public static function upload($file, $path, $width, $height) {
        if(!move_uploaded_file($file["tmp_name"], $path)){
            throw new Exception("Error Uploading file");
        }elseif(!chmod($path, 0644)) {
            throw new Exception("Upload Permission Error");
        }else {
            $gumlet = new \Gumlet\ImageResize($path);
            //$allow_enlarge = false;
            $gumlet->resize($width, $height);
            $gumlet->save($path);
        }
    }


}
