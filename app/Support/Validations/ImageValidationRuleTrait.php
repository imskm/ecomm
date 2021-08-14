<?php

namespace App\Support\Validations;

trait ImageValidationRuleTrait
{
	protected function xrequired_file_rule($field, $data)
	{
		// Check if $_FILE array is empty
		if (count($_FILES) === 0) {
			$this->setError($field, __FUNCTION__, "$field can not be empty");
			return false;
		}

		foreach ($_FILES[$field] as $file) {
			if (count($file) == 0) {
				$this->setError($field, __FUNCTION__, "All field of $field are required");
				return false;
			}
		}

		return true;
	}

	protected function xfile_rule($field, $data, $args)
	{
		$args = explode(",", $args); // $args[0] -> type, $args[1] -> size
		$ret = true;

		$files = $this->diverseFilesArray($_FILES[$field]);
		foreach ($files as $file) {
			// 1. Check the file is submitted
			//    or Check for $_FILES Corruption Attack | Multiple Files
			if ($ret) {
				$ret = $this->fileCheckUndefined($file);
			}

			// 2. Check file has submitted properly
			if ($ret) {
				$ret = $this->fileCheckError($file);
			}

			// 3. Check the file size
			if ($ret) {
				$ret = $this->fileCheckSize($file, (int) $args[1]);
			}

			// 4. Check the type of file
			if ($ret) {
				$ret = $this->fileCheckType($file, $args[0]);
			}

			// 5. If validation failes set the error and return false
			if (!$ret) {
				$this->setError($field, __FUNCTION__, $this->file_upload_error_msg);
				return false;
			}
		}

		// 5. Every check passed so return true
		return true;
	}

	private function fileCheckUndefined($file)
	{
		// Check Undefined | $_FILES Corruption Attack | Multiple Files
		if (!isset($file['error']) || is_array($file['error'])) {
			$this->file_upload_error_msg = "Product image is required";
			return false;
		}

		return true;
	}

	private function fileCheckError($file)
	{
		$ret = true;

		// Check Error code
		switch ($file['error']) {
			case UPLOAD_ERR_OK:
				break;
	        
	        case UPLOAD_ERR_NO_FILE:
	            $this->file_upload_error_msg = 'No file sent';
	            $ret = false;
	            break;

	        case UPLOAD_ERR_INI_SIZE:
	        case UPLOAD_ERR_FORM_SIZE:
		        $this->file_upload_error_msg = 'Exceeded filesize limit';
	            $ret = false;
	            break;

	        default:
		        $this->file_upload_error_msg = 'Unknown errors';
	            $ret = false;
	            break;
		}

		return $ret;
	}

	private function fileCheckSize($file, $size)
	{
		if ($file['size'] > $size) {
			$this->file_upload_error_msg = "Exceeded max filesize limit";
			return false;
		}

		return true;
	}

	/**
	 * Check file type
	 * @Incomplete ONLY checks for image file type
	 */
	private function fileCheckType($file, $type)
	{
		$allowed_mimes = [
			'jpg' => 'image/jpeg',
            // 'png' => 'image/png',
            // 'gif' => 'image/gif',
		];

		$finfo = new \finfo(FILEINFO_MIME_TYPE);

		$mime = $finfo->file($file['tmp_name']);
		if (($ext = array_search($mime, $allowed_mimes, true)) === false) {
			$this->file_upload_error_msg = 'Invalid image type uploaded, allowed jpg';
			return false;
		}

		return true;
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
}