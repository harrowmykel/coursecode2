<?php include 'beginn.php';
	    		
  	$rtyt=isset($_GET['page'])?$_GET['page']:1;
  	$errdhjvh=$_SERVER['PHP_SELF'];
  	$erot=true;
  	$prv=$rtyt;
    $nxxt=$rtyt+1;

	$words=array();
	$erto=new apiQuery();
	$Response=$erto->getMessagesLists(getUser(), getPass(), $rtyt);
	$body=$Response->body;
	if (isset($body[0]->error)){
  		$erot=false;
      	$error=$body[0]->error_more;
  		//error
	}else{
		$words=$body[0];
  		$no_pages=$body[1]->pages;
		$numm=count($words);
  		$erot=true;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.php';?>
  </head>

  <body>
    <?php include 'header.php';?>
  
    <div class='container-fluid'>
      <div class='row'>
        <?php include 'sidebar.php';?>
        
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
          <h1 class="page-header"><?php echo translate('messages');?></h1>
          <div class="row">
            <div class='col-md-8 col-sm-7'>
          <table class="table table-condensed table-striped table-hover table-bordered">
	          <tbody>
                <tr>
                    <td>
                      <?php echo translate('start_a_convo');?>
                      <form method="get" action="messages_read.php">
                        <input type="text" name="user" placeholder="username" style="width:60%"><br>
                        <input type="submit" name="send_r" value="<?php echo translate('start');?>" class=" btn pull-left btn-sm btn-primary bfjfg btn btn-sm btn-primary"/>
                      </form>
                    </td>
                </tr>
	          	<?php
	              	if($erot){
                    $num=count($words);
                    for($i=$num; $i>0; $i--){
                      $key=$i-1;
                      $value=$words[$key];
	              			$ouser=$value->username;
	              			$msg_=$value->subtitle;
                      $fullname=$value->fullname;
                      $ed_time=getDWM($value->timestamp);
                      $read=$value->read;
                      if($read=="w"){
                        echo "<tr><td class='warning'><a href='messages_read.php?user=$ouser'><h5><b>$fullname</b></h5></a>
                        <p style='margin-left:20px;'>$msg_"."... <span class='small'> $ed_time</span></p></td></tr>";
                      }else{
                        echo "<tr><td><a href='messages_read.php?user=$ouser'><h5><b>$fullname</b></h5></a>
                        <p style='margin-left:20px;'>$msg_"."... <span class='small'> $ed_time</span></p></td></tr>";
                      }
	              		}
	              	}else{
                      echo "<tr>
                              <td>1</td>
                              <td>$error</td>
                            </tr>";
                    }
	             ?>
	          </tbody>
	        </table>
  	<?php
    if($erot){
        echo "<ul class='pagination pagination-centered'>";
        if ($rtyt==1){
          echo "<li class='disabled'><a href='".$errdhjvh."?page=1'>".translate('prev')."</a></li>";
        }else{
          echo "<li><a href='".$errdhjvh."?page=$prv'>".translate('prev')."</a></li>"; 
        }

        if($no_pages>1){
            for($ie=1; $ie!=$no_pages; $ie++){
              if ($ie==$rtyt){
                echo "<li class='active'><a href='".$errdhjvh."?page=$ie'>$ie</a></li>";
              } else {
                echo "<li><a href='".$errdhjvh."?page=$ie'>$ie</a></li>";  
              }                   
            }
            if ($rtyt==$no_pages){
              echo "<li class='disabled'><a href='".$errdhjvh."?page=5'>".translate('next')."</a></li>";
            }else{
              echo "<li><a href='".$errdhjvh."?page=$nxxt'>".translate('next')."</a></li>";                      
            }
        }        
        echo "</ul>";
    }
        ?>
        </div> <!-- coll-8 -->
        <div class='col-md-4 col-sm-5'>          
          <?php include 'single_quotes.php';?>
          <!-- /.panel -->
        </div> <!-- coll-8 -->
        </div> <!-- row -->
	        
        </div>     <!-- Bootstrap core JavaScript
================================================== -->     <!-- Placed at the
end of the document so the pages load faster -->     <script
src="../assets/js/jquery.js"></script>     <script
src="../assets/js/bootstrap.min.js"></script> <script
src="../assets/js/k.js"></script>       <script
src="../assets/js/docs.min.js"></script>     <!-- IE10 viewport hack for
Surface/desktop Windows 8 bug -->     <script src="../../assets/js/ie10
-viewport-bug-workaround.js"></script>         </div>   </div>     </div>
</body> </html>
