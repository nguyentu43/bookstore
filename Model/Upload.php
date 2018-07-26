<?php
	class Upload{
		public static function UploadFile($file, $old_img)
		{
			if($file["error"] === 0)
			{
				$f = false;
				$ext = strstr($file['type'], "/");
				$ext_image = ['/jpg', '/gif', '/png', '/jpeg'];
				foreach ($ext_image as $value) {
					if($ext == $value)
						$f = true;
				}

				if($f == true)
				{
					move_uploaded_file($file['tmp_name'], 'hinh/'.$file['name']);
					if(!empty($old_img) && $old_img!='book-icon.png')
					{
						unlink("hinh/".$old_img);
					}
					return $file['name'];
				}
			}
			else
				return $old_img;
		}
	}
?>