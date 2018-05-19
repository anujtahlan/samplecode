<?php


// replace with your mysql database details

$MySql_username 	= "root"; //mysql username
$MySql_password 	= "connectpeople"; //mysql password
$MySql_hostname 	= "localhost"; //hostname
$MySql_databasename = 'assignmnt'; //databasename




if($_POST)
{	
	if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
	{
		
		//required variables are empty
		die("Title is empty!");
		
	}
//-------------------------------------FOR ANSWER FILE-------------------------------------------------------//	
     $anFileName			= strtolower($_FILES['anFile']['name']); //uploaded file name
	//$FileTitle			= mysql_real_escape_string($_POST['anName']); // file title
	$anImageExt			= substr($anFileName, strrpos($anFileName, '.')); //file extension
	$FileType			= $_FILES['anFile']['type']; //file type
	$anFileSize			= $_FILES['anFile']["size"]; //file size
//-------------------------------------FOR QUESTION FILE---------------------------------------------------//
	$FileName			= strtolower($_FILES['mFile']['name']); //uploaded file name
	
	$FileTitle			= mysql_real_escape_string($_POST['mName']); // file title
	$ImageExt			= substr($FileName, strrpos($FileName, '.')); //file extension
	$FileType			= $_FILES['mFile']['type']; //file type
	$FileSize			= $_FILES['mFile']["size"]; //file size
	//-------------------------------------GENERAL FUNCTIONS FOR BOTH---------------------------------------------------//
	
	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
	$uploaded_date		= date("Y-m-d H:i:s");
	$uid=$_POST['uid'];
		$subid=$_POST['sub_id'];
			$semid=$_POST['sid'];
				$cid=$_POST['cid'];
				$bid=$_POST['bid'];
						$desc=$_POST['desc'];
							//$uid=1;//$_POST['uid'];								
	
	$ded=2013-11-25;
	//---------- CREATING UPLOAD DIRECTORY----//
	$UploadDirect='uploads/'.$uid;

	if(!is_dir($UploadDirect))
	{mkdir($UploadDirect);
	}
	
	
		$UploadDirector=	$UploadDirect.'/'.$bid;
		
		if(!is_dir($UploadDirector))
	{mkdir($UploadDirector);
	}
		$UploadDirectr=	$UploadDirector.'/'.$semid;
	
	if(!is_dir($UploadDirectr))
	{mkdir($UploadDirectr);
	}
	
	
	$quesUploadDirectory=	$UploadDirectr.'/'.$cid.'_'.$subid;
	
	
		if(!is_dir($quesUploadDirectory))
	{mkdir($quesUploadDirectory);
	}
	$UploadDirectory=	$quesUploadDirectory.'/questions';
	$ansUploadDirectory=	$quesUploadDirectory.'/answers';
	
	if (!is_dir($UploadDirectory)) {
	//destination folder does not exist

		
	
//------- CREATING DIRECTORY FOR QUESTIONS UPLOAD-----//	
	
mkdir($UploadDirectory);   

		}
		
			if (!is_dir($ansUploadDirectory)) {
	//destination folder does not exist

		//------- CREATING DIRECTORY FOR ANSWERS UPLOAD-----//
	
	
	
mkdir($ansUploadDirectory);   

		}


		
	switch(strtolower($FileType))
	{
		//allowed file types
		case 'image/png': //png file
		case 'image/gif': //gif file 
		case 'image/jpeg': //jpeg file
		case 'application/pdf': //PDF file
		case 'application/msword': //ms word file
		case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document': //ms word file
		
		case 'application/vnd.ms-excel': //ms excel file
		case 'application/x-zip-compressed': //zip file
		case 'text/plain': //text file
		case 'text/html': //html file
			break;
		default:
			die('Unsupported File!'); //output error
	}

  //--------- DETAILS ABOUT THE question FILE UPLOADED BY TEACHER, CREATING NEW NAME FOR THE FILE AND SETTING PATH-------//
	
	//File Title will be used as new File name
	         $NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
	          $NewFileName = $NewFileName.'_'.$RandNumber.$ImageExt;
              //Rename and save uploded file to destination folder.
            $path=$UploadDirectory.'/'.$NewFileName;
	
//--------- DETAILS ABOUT THE ANSWER FILE UPLOADED BY TEACHER, CREATING NEW NAME FOR THE FILE AND SETTING PATH-------//
         
		 //File Title will be used as new File name
	$anNewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($anFileName));
	$anNewFileName = $anNewFileName.'_'.$RandNumber.$anImageExt;
         //Rename and save uploded file to destination folder.
         $anpath=$ansUploadDirectory.'/'.$anNewFileName;

//---------- NOW UPLOADING THE FILES AND UPDATING THE DATABASE-------//
   if(move_uploaded_file($_FILES['mFile']["tmp_name"], $path ))
   {
	   // UPLOADING AMSWER FILE, IF THE FILE WAS SUBMITTED BY THE TEACHER// OTHER WISE LEAVE IT 
	     if(move_uploaded_file($_FILES['anFile']["tmp_name"], $anpath ))
			{//connect & insert file record in database
		$dbconn = mysql_connect($MySql_hostname, $MySql_username, $MySql_password)or die("Unable to connect to MySQL");
		mysql_select_db($MySql_databasename,$dbconn);

		
		@mysql_query("INSERT INTO assignment_details (name, description,created, deadline,filefolder,fileloc,rpfilefolder,rpfileloc,tch_id,b_id ,sem_id,c_id,sub_id) VALUES ('$FileTitle','$desc','$uploaded_date','$ded','$UploadDirectory', '$NewFileName','$ansUploadDirectory','$anNewFileName','$uid','$bid','$semid','$cid','$subid')");
		mysql_close($dbconn);
			}
		die('Success! File Uploaded.');
		
   }else{
   		die('error uploading File!');
   }
}

//function outputs upload error messages, http://www.php.net/manual/en/features.file-upload.errors.php#90522
function upload_errors($err_code) {
	switch ($err_code) { 
        case UPLOAD_ERR_INI_SIZE: 
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
        case UPLOAD_ERR_FORM_SIZE: 
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 
        case UPLOAD_ERR_PARTIAL: 
            return 'The uploaded file was only partially uploaded'; 
        case UPLOAD_ERR_NO_FILE: 
            return 'No file was uploaded'; 
        case UPLOAD_ERR_NO_TMP_DIR: 
            return 'Missing a temporary folder'; 
        case UPLOAD_ERR_CANT_WRITE: 
            return 'Failed to write file to disk'; 
        case UPLOAD_ERR_EXTENSION: 
            return 'File upload stopped by extension'; 
        default: 
            return 'Unknown upload error'; 
    } 
} 
?>