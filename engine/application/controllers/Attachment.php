<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Attachment
 *
 * @author marwansaleh 1:47:44 PM
 */
class Attachment extends Admin_Controller {
    function open($filename){
        if (!$filename){
            exit('No file has defined');
        }else{
            $filename = base64_decode(urldecode($filename));
        }
        if (!file_exists($filename)){
            exit('File '.$filename.' is not found in server');
        }
        $mimetype = mime_content_type($filename);
        $basename = basename($filename);
        header('Content-Description: File Open');
        header("Content-Type: $mimetype");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: inline; filename=\"$basename\""); 
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    }
    
    function download($filename){
        if (!$filename){
            exit('No file has defined');
        }else{
            $filename = base64_decode(urldecode($filename));
        }
        if (!file_exists($filename)){
            exit('File '.$filename.' is not found in server');
        }
        $mimetype = mime_content_type($filename);
        $basename = basename($filename);
        header('Content-Description: File Transfer');
        header("Content-Type: $mimetype");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: attachment; filename=\"$basename\""); 
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    }
}

/**
 * Filename : Attachment.php
 * Location: application/controllers/Attachment.php
 */
