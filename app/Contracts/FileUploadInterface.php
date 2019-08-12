<?php

namespace App\Contracts;

interface FileUploadInterface 
{
    /** 
     * Upload file to cloud storage
     *
     * @param  Illuminate\Http\Request  $file
     * @return array
     */
	public function upload($file);

    /**
     * Update file on cloud storage
     *
     * @param  string  $fileName
     * @param  string  $fileName
     * @return boolean
     */
    public function update($file, $fileName = '');

    /**
     * Delete file from cloud storage
     *
     * @param  string  $fileName
     * @return boolean
     */
    public function delete($fileName);

}