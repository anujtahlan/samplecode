<?PHP function read_file($filename){
		
		$striped_content = '';
		$content = '';
		
		if(!$filename || !file_exists($filename)) return false;
		
		$zip = zip_open($filename);
		
		if (!$zip || is_numeric($zip)) return false;
	
	
		while ($zip_entry = zip_read($zip)) {
			
			if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
			
			if (zip_entry_name($zip_entry) != "word/document.xml") continue;

			$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
			
			zip_entry_close($zip_entry);
		}// end while
	
		zip_close($zip);
		
		//echo $content;
		//echo "<hr>";
		//file_put_contents('1.xml', $content);		
		
		//$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
		//$content = str_replace('</w:r></w:p>', "\r\n", $content);
		$striped_content = strip_tags($content);

		return $striped_content;
	}
	
	$filename = "upload2/1/assignment_1_464269887.docx";
	$filename2="upload2/1/i_am_new_317789704.docx";
	$content = read_file($filename);
	$content2 = read_file($filename2);
	if($content !== false) {
		
		similar_text(	$content,	$content2, $percent);
	//echo $content;
	echo $percent;	
	
	}
	else {
		echo 'Couldn\'t the file. Please check that file.';
	}
	
	
    ?>