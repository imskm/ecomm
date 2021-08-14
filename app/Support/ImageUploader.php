<?php

namespace App\Support;

/**
 * ImageUploader
 * A basic image uploader class for uploading images
 * This class only designed for one of my client's project
 * (Aaivan). I have to write this class because the previous
 * File upload class was not good and is buggy and can not handle
 * file naming when multiple files are uploaded.
 */
class ImageUploader
{
	private $filenames = [];
	private $failed_saves = [];
	private $destination;
	private $files = [];

	public function __construct($destination)
	{
		if (!is_dir($destination)) {
			throw new \Exception("'$destination' is not a directory");
		}
		if (!is_writable($destination)) {
			throw new \Exception("'$destination' is not a writable directory");
		}

		$this->destination = rtrim($destination, "/");
	}

	public function save($field)
	{
		$ret = true;

		if (count($_FILES) == 0) {
			throw new \Exception("No file uploaded.");
		}

		$this->files = $this->diverseFilesArray($_FILES[$field]);
		foreach ($this->files as $file) {
			$filename = gen_file_name();
			if (!($ext = $this->getExtension($file))) {
				throw new \Exception("Unknown image file extension.");
			}
			$filename .= ".$ext";
			if (!$this->moveFile($file, $this->destination . "/$filename")) {
				$this->failed_saves[] = $file;
				$ret = false;
				continue;
			}

			$this->filenames[] = $filename;
		}

		return $ret;
	}

	private function moveFile($file, $destination)
	{
		return move_uploaded_file($file['tmp_name'], $destination);
	}

	private function diverseFilesArray(array $files)
	{
		$result = array();

	    foreach($files as $key1 => $value1) {
	        foreach($value1 as $key2 => $value2) {
	            $result[$key2][$key1] = $value2;
	        }
	    }

	    return $result; 
	}

	private function getExtension($file)
	{
		$allowed_mimes = [
			'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
		];

		$finfo = new \finfo(FILEINFO_MIME_TYPE);

		$mime = $finfo->file($file['tmp_name']);
		$ext = array_search($mime, $allowed_mimes, true);
		if ($ext === false) {
			return "";
		}

		return $ext;
	}

	public function getSavedFileNames()
	{
		return $this->filenames;
	}

	public function getFailedFileNames()
	{
		$result = [];
		foreach ($this->failed_saves as $f) {
			$result[] = $f['name'];
		}

		return $result;
	}

	public function getFailedSaves()
	{
		return $this->failed_saves;
	}

}