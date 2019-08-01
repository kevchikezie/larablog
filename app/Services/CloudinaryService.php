<?php

namespace App\Services;

use JD\Cloudder\Facades\Cloudder;
use App\Contracts\FileUploadContract;

class CloudinaryService implements FileUploadContract
{
    /** 
     * Upload file to Cloudinary
     *
     * @param  Illuminate\Http\Request  $file
     * @return array
     */
	public function upload($file)
    {
        // Get file extension
        $fileExtension = $file->getClientOriginalExtension();

        // Form new file name
        $fileName = uniqid(true) . '_' . time() . '.' . $fileExtension;
        
        // Get temp path
        $photo = $file->getRealPath();

        // Upload image to Cloudinary
       	Cloudder::upload($photo, $fileName);

        return Cloudder::getResult();
    }

    /**
     * Update file on cloud Cloudinary
     *
     * @param  string  $fileName
     * @param  string  $fileName
     * @return boolean
     */
    public function update($file, $fileName = '')
    {
        if(!is_null($fileName) || $fileName != '') {
            $this->delete($fileName);
        }

        return $this->upload($file);
    }

    /**
     * Delete file from Cloudinary
     *
     * @param string  $fileName
     * @return boolean
     */
    public function delete($fileName)
    {
        Cloudder::destroyImage($fileName);
        return Cloudder::delete($fileName);
    }

}