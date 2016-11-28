<?php
namespace App\Helpers;

class CommonFunction
{


    /**
     * @param $data
     * @param $filter
     * @return array
     */
    public static function filterDataFromRequest($data, $filter)
    {
        $response = [];
        foreach ($data as $key => $object) {
            if (in_array($key, $filter)) {
                $response[$key] = $object;
            }
        }
        return $response;
    }

    /**
     * @param $request
     * @return array
     */
    public static function getDataFromRequest($request)
    {
        $managerData = [ ];
        foreach ($request->all() as $key => $object) {
            if (isset( $object ) && ! empty( $object ) && $object != "" && $object != null) {
                $managerData[ $key ] = $object;
            }
        }
        return $managerData;
    }

    public static function uploadFile( $file, $user, $width = 400 , $height = 400 )
    {
        $thumbnail_filename = $file->getClientOriginalName();
        $localDestinationPath = "../public/uploads/";
        self::createDirecotry( $localDestinationPath );
        $localDestinationPath = "../public/uploads/" . $user->id;
        self::createDirecotry( $localDestinationPath );
        if(CommonFunction::isImage($thumbnail_filename)) {
         $file = \Image::make($file)->resize($width, $height);  
         $file->save($localDestinationPath.'/'.$thumbnail_filename);
        }
        else{
           $file->move( $localDestinationPath, $thumbnail_filename );
        }
        $url ='/uploads/' . $user->id . '/' . $thumbnail_filename;
        return [ 'path' => $url, 'extension' => \File::extension($url),'filename' => $thumbnail_filename];   
    }

    public static function createDirecotry($directoryName)
    {
        return is_dir( $directoryName ) || mkdir( $directoryName);
    }
    
    public static function isImage( $src_file_name )
    {
        $supported_image = array(
            'gif',
            'jpg',
            'jpeg',
            'png'
        );
        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
        if (in_array($ext, $supported_image)) {
            return true;
        }
        return false;
    }
    public static function isAudtio( $src_file_name )
    {
        $supported_image = array(
            'mp3'
        );
        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
        if (in_array($ext, $supported_image)) {
            return true;
        }
        return false;
    }
    public static function isFile( $src_file_name )
    {
        $supported_image = array(
            'pdf',
            'docx',
            'xlsx'
        );
        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
        if (in_array($ext, $supported_image)) {
            return true;
        }
        return false;
    }
    public static function isSupportedMimesTypeImageOrDoc( $mimeType )
    {
        $supportedTypes = [
            'image/jpeg',
            'image/png',
            'image/jpg',
            'image/gif',
            'image/svg',
            'audio/mpeg',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/pdf'
        ];
        
        return in_array($mimeType, $supportedTypes);
    }
    public static function isSupportedMimesType( $mimeType )
    {
        $supportedTypes = [
            'image/jpeg',
            'image/png',
            'image/jpg',
            'image/gif',
            'image/svg',
            'audio/mpeg', 
            'audio/mpeg3', 
            'audio/mp3',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/pdf'
        ];
        
        return in_array($mimeType, $supportedTypes);
    }
    
    public static function forgotPasswordSendEmail( $email, $password )
    {
        $array = array(
           'password'    =>$password,
           'subject' =>"UneLeap :: Password Reset"
           );
    
        \Mail::to( $email )->send(new \App\Mail\PasswordReset( $array ));
    }
}
