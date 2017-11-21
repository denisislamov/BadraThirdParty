<?php
	$dirs = array_filter(glob('*'), 'is_dir');

	foreach ($dirs as $dir) {
		if ($dir) {
			$pieces = explode("_", $dir);
			$size = count($pieces);
			if ($size == 3)
			{
				echo $dir.";";
			}
		}
	}
?>