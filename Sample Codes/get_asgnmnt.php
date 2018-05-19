<div class='subsfontcolor'>The Subjects You Teach</div>

		<!-- the jScrollPane script -->
		
<?php

//Loading Comments link with load_updates.php 
//echo "The Subjects You Teach";
 //echo "SUBJECTS YOU TEACH";
foreach($getsub as $subdata)
 {
 $sid=$subdata['sem_id'];// sid- semester id

   $sub_name=$subdata['sub_name'];//cname- class name
  $uid=$subdata['tch_id'];//tid- teacher id, current session id
  $bid=$subdata['b_id'];//bid- branch id
  $cid=$subdata['c_id'];//class id
  $sub_id=$subdata['sub_id'];//class id

     $getasg=$Wall->show($uid,$bid,$sid,$cid,$sub_id);
//$tata=$Wall->show_asgnmnt($uid,$sid,$bid,$cid);
 ?>
<!--?php

//Loading Comments link with load_updates.php 
foreach($commentsarray as $cdata)
 {
 $com_id=$cdata['com_id'];
 $comment=tolink(htmlentities($cdata['comment'] ));
  $time=$cdata['created'];
   $username=$cdata['username'];
  $uid=$cdata['uid_fk'];
   $cface=$Wall->Gravatar($uid);
 ?>-->
 
<div class="stclassbody" id="stclassbody<?php echo $sub_id;?>">

<!--<div class="stimg">
       
</div> <!-- end od stimg-->
<div class="stclasstext">

           <!-- <a class="stcommentdelete" href="#" id="<php echo $sid;?>" title="Delete update">X</a>-->
            <b></b>
 
<div class="sttime">

<!--<form  action=""  id="myform" method="post"> 
<input type="hidden" name="sid" id="sid" value="<php echo $sid;?>">
<input type="hidden" name="classname" id="cname" value="<php echo $cname;?>">
<input type="hidden" name="teacherid"  id="uid" value="<php echo $uid;?>">
<input type="hidden" name="branchid" id="bid" value="<php echo $bid;?>">
<input type="hidden" name="classid"   id="cid" value="<php echo $cid;?>">


</form>-->

<!--?php time_stamp($time);?> --> 


<a href='#' class='commentopen4' id='<?php echo $sub_id;?>' title='subjects'><?php echo $sub_name;?></a>

<div id="hideas<?php echo $sub_id;?>" style="display:none"><a class="hidea" href="#" id="<?php echo $sub_id;?>" title="HIDE IT">HIDE</a></div>
            
               <div id="showas<?php echo $sub_id;?>" style="display:none"><a class="showa" href="#" id="<?php echo $sub_id;?>" title="SHOW">SHOW</a></div>
               <a class="create" href="#" id="<?php echo $sub_id;?>" title="SHOW">CREATE</a>
               
</div> <!-- end of st time-->

<!-- end of stexpand-->

<!--<div class="commentcontainer" id="commentload<php echo $b_id;?>">-->


<div id="theForm<?php echo $sub_id?>" class="Form"  style="display:none">
<div id="output<?php echo $sub_id?>" class="out"></div>
<form action="uploader.php" id="<?php echo $sub_id?>"  class="Fileit" enctype="multipart/form-data" method="post" >
    <label>Title
    <span class="small">Title of the File</span>
    </label>
    <input type="text" name="mName" id="mName" />
<textarea cols="30" rows="4" name="desc" id="desc" maxlength="200" ></textarea>
    <label>Question File
    <span class="small">Choose a File</span>
    </label>
    <input type="file" name="mFile" id="mFile" />
     <label>Answer File
    <span class="small">Choose a File</span>
    </label>
    <input type="file" name="anFile" id="anFile" />
     
    <input type="hidden" value="<?php echo $sid ?>" id="<?php echo $sid ?>" name="sid"/>
        <input type="hidden" value="<?php echo $uid ?>" id="<?php echo $uid ?>" name="uid"/>
            <input type="hidden" value="<?php echo $bid ?>"  id="<?php echo $bid ?>" name="bid"/>
                <input type="hidden" value="<?php echo $cid ?>"  id="<?php echo $cid ?>" name="cid"/>
                    <input type="hidden" value="<?php echo $sub_id ?>"  id="<?php echo $sub_id ?>" name="sub_id"/>
                    <div  class="clearit" id="<?php echo $sub_id?>" style="display:none"></div>
    <button type="submit" class="red-button" id="uploadButton<?php echo $sub_id?>">Upload</button>
    <div class="spacer<?php echo $sub_id;?>"></div>
</form>
</div> 



							
  <div class="commentupdate" style='display:none' id='my<?php echo $sub_id;?>'>
    
     <?php include('load_subs.php') ?>
     

      </div> <!-- end of comment update-->
	
  



    
<!--</div><!-- end of commentcontainer-->

</div>
</div>

  
   





<?php 
}
?>