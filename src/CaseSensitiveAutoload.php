<?php
	
	/**
	 * An autoload method that is case sensitive unlike the build in autoload method in PHP 5.3.
	 * Performance can properly be improved.
	 * @param string $className
	 * @param string $extensions
	 * @return bool
	 */
	function CaseSensitiveAutoload($className, $extensions = null)
	{
		$extensions = explode(",", is_null($extensions) ? spl_autoload_extensions() : $extensions);
		$paths = explode(PATH_SEPARATOR, get_include_path());
		$classPath = str_replace("\\", DIRECTORY_SEPARATOR, $className); 	
		$filePath = null;
		
		foreach($paths as $path)
		{
			foreach($extensions as $extension)
			{
				$filePath = $path . DIRECTORY_SEPARATOR . $classPath .$extension;
				
				if(file_exists($filePath))
				{
					include($filePath);
					return true;
				}
			}
		}
		
		return false;
	}
?>