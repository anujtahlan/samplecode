<?php
//Srinivas Tamada http://9lessons.info
//Wall_Updates

class Wall_Updates {


    
     // Updates   	
	  public function Updates($uid) 
	{
	    $query = mysql_query("SELECT b.b_id,b.bname,t.tch_id from branches b, teacher_branch t where t.tch_id='$uid' and b.b_id=t.b_id  ") or die(mysql_error());
         while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
		
    }
	//Comments retrieving comments
	   public function Comments($msg_id) 
	   // here msg_id is branch id for the respective branch the user click
	{
	    $query = mysql_query("SELECT s.tch_id,s.sem_id,a.name from teacher_sem s, semester a where s.sem_id=a.sem_id and s.tch_id='$uid'") or die(mysql_error());
	   while($row=mysql_fetch_array($query))
	    $data[]=$row;
        if(!empty($data))
		{
       return $data;
         }
	}
	
	//Avatar Image
	/*public function Gravatar($uid) 
	{
	    $query = mysql_query("SELECT email FROM `users` WHERE uid='$uid'") or die(mysql_error());
	   $row=mysql_fetch_array($query);
	   if(!empty($row))
	   {
	    $email=$row['email'];
        $lowercase = strtolower($email);
        $imagecode = md5( $lowercase );
		$data="http://www.gravatar.com/avatar.php?gravatar_id=$imagecode";
		return $data;
         }
		 else
		 {
		 $data="default.jpg";
		return $data;
		 }
	}
	*/
	/*Insert Update
	public function Insert_Update($uid, $update) 
	{
	$update=htmlentities($update);
	   $time=time();
	   $ip=$_SERVER['REMOTE_ADDR'];
        $query = mysql_query("SELECT msg_id,message FROM `messages` WHERE uid_fk='$uid' order by msg_id desc limit 1") or die(mysql_error());
        $result = mysql_fetch_array($query);
		
        if ($update!=$result['message']) {
            $query = mysql_query("INSERT INTO `messages` (message, uid_fk, ip,created) VALUES ('$update', '$uid', '$ip','$time')") or die(mysql_error());
            $newquery = mysql_query("SELECT M.msg_id, M.uid_fk, M.message, M.created, U.username FROM messages M, users U where M.uid_fk=U.uid and M.uid_fk='$uid' order by M.msg_id desc limit 1 ");
            $result = mysql_fetch_array($newquery);
			 return $result;
        } 
		else
		{
				 return false;
		}
		
       
    }
	
	*/
	
	//Insert Comments
	public function Insert_detail($uid,$fname,$lname,$regno) 
	{
	$fname=htmlentities($fname);
		$lname=htmlentities($lname);
			$regno=htmlentities($regno);
				
	   	   $query = mysql_query("SELECT * FROM `teacher_detail` WHERE tch_id='$uid'") or die(mysql_error());
        $result = mysql_fetch_array($query);
		
        if ($regno!=$result['regno']&&$fname!=$result['fname']&&$regno!=$result['regno']) //if 1 open
		{
               $query = mysql_query("UPDATE teacher_detail
SET tch_id='$uid', fname='$fname', lname='$lname', regno='$regno'
WHERE tch_id='$uid';") or die(mysql_error(
"error"

));
		
		
			//my chng counting cmnts//
            $newquery = mysql_query("SELECT t.tch_id, t.fname, t.lname, t.regno, b.b_id, c.bname
FROM teacher_detail t, teacher_branch b, branches c
WHERE t.tch_id = b.tch_id
AND c.b_id = b.b_id
ORDER BY t.tch_id DESC ");
            $result = mysql_fetch_array($newquery);

         
		   return $result;
		}//if 1 close

	    else 
	 {
		 return false;  
    
	 }
		 	
	}// function close
	
	
 public function Updates($uid) 
	{
	    $query = mysql_query("SELECT b.b_id,b.bname,t.tch_id from branches b, teacher_branch t where t.tch_id='$uid' and b.b_id=t.b_id  ") or die(mysql_error());
         while($row=mysql_fetch_array($query))
		$data[]=$row;
	    return $data;
		
    }
	//Comments retrieving comments
	   public function show_asgm($uid,$sem_id) 
	   // here msg_id is branch id for the respective branch the user click
	{
	    $query = mysql_query("SELECT s.tch_id,s.sem_id,a.name from teacher_sem s, semester a where s.sem_id=a.sem_id and s.tch_id='$uid'") or die(mysql_error());
	   while($row=mysql_fetch_array($query))
	    $data[]=$row;
        if(!empty($data))
		{
       return $data;
         }
	}
	

    

}

?>
