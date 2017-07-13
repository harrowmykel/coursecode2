<?php include 'beginn.php';?>
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
        <div class='col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main'>
        	<?php 
        		$link=isset($_GET['link']) ? urldecode($_GET['link']) : "";
        		$new=isset($_GET['new']) ? urldecode($_GET['new']) : "";?>
          <h1 class="page-header"><?php echo $link ?></h1>
            <div class="row">
                <div class="col-md-8 col-sm-7">
	    	<?php 

	    		$ert=new apiQuery();

	    		if (isset($_POST['acction'])){
	    			$act=$_POST['acction'];
	    			if(isset($_POST['link']) && $_POST['link']!=$link){	    				
	    				$new=$_POST['link'];
	    				$act="editcode";
	    			}
	    			if ($act=="save"){
	    				//deactivate
	    				$day=$_POST['day'];
	    				$time=$_POST['time'];
	    				$method=$_POST['method'];
	    				$new=$day."-".$time;
	    				$resp=$ert->changeDdTime(getUser(), getPass(), $link, $new);
	    				$resp=$ert->changeMethod(getUser(), getPass(), $link, $method);
	    				if(isset($resp->body[0]->username)){
	    					$rtto=ucfirst($resp->body[0]->deactivation_time);
	    					echo "<div class='alert fade-in m-success'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>".translate_var("date_res", array(formatThisForHr($rtto)))."</strong>
						          </div>";
	    				}else{
	    					echo "<div class='alert fade-in m-warning'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>".translate('sorry error')."</strong>
						          </div>";
	    				}
	    			} else if ($act=="confirm"){
	    				$resp=$ert->changelock(getUser(), getPass(), $link, $new);
	    				if(isset($resp->body[0]->username)){
                			$new=$resp->body[0]->ass_code;
	    					echo "<div class='alert fade-in m-success'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>".translate_var("ass_rename", array($link, $new))."<a href='crtview.php?link=$new'>".translate('reload')."</a></strong>
						          </div>";
	    				}else{
	    					echo "<div class='alert fade-in m-warning'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>".translate('sorry error')."</strong>
						          </div>";
	    				}
	    			}else if ($act=="editcode") {
	    				//delete
	    				$serv=$_SERVER['PHP_SELF'];
	    				echo "<div class='alert fade-in m-warning'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>".translate('rename_con')."</strong> ".translate_var('rename_con2', array($link, $new))."  
						            <p> 
					        		<form method='POST' action=' $serv"."?link=$link&new=$new'; ?>
					        			<input type= 'hidden' name='acction' value='confirm'/>
							        	<input type='submit' class='btn btn-sm btn-danger' value='".translate('rename')."'/>
							    	</form></p>
						          </div>";
	    				
	    			} 
	    		}

	    		$erto=new apiQuery();
	    		$Response=$erto->getfile(getUser(), getPass(), $link);
	    		$body=$Response->body;
	    		if (isset($body[0]->error)){
	          		$erot=false;
                  	$error=$body[0]->error_more;
	    		}else{
	    			$words=$body[0];
	    			$numm=count($words);
	          		$erot=true;
	    		}
	    	?>
          <table class="table table-condensed table-striped table-hover table-bordered">
	          <thead>
	            <tr>
	              <th><?php echo translate('name'); ?></th>
	              <th><?php echo translate('value'); ?></th>
	            </tr>
	          </thead>
	          <tbody>
	        		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']."?link=$link"; ?>">
	          	<?php
	              	if($erot){
	              		$gen_url=$words->ass_code;
	              		$deactivated=$words->deactivated_;
	              		$method=$words->method_;
	              		$time=formatThisForHr($words->time);
	              		$deactivatedtime=formatThisForHr($words->deactivated_time);
	              		$day=formatThisForDay($words->deactivation_time);
	              		$timing=formatThisForTme($words->deactivation_time);

	              		if($deactivated!=0){
	              			$deact=translate('react');
	              		}else{
	              			$deact=translate('deact');
	              		}
	              	
	              		echo "<tr><td>".translate('ass_code')."</td><td><input type='text' name='link' value='$gen_url' placeholder='Edit Assignment Code'/>
	              		</td></tr>";
	              		echo "<tr><td>".translate('time')."</td><td>$time
	              		</td></tr>";
	              		echo "<tr><td>".translate('sub date')."</td><td><input type='text' name='day' value='$day' placeholder='Submission Date'/>
	              		</td></tr>";
	              		echo "<tr><td>".translate('sub time')."</td><td><input type='text' name='time' value='$timing' placeholder='Submission Time'/>
	              		</td></tr>";
	              		echo "<tr><td>".translate('deact')."</td><td>$deactivated
	              		</td></tr>";
	              		echo "<tr><td>".translate('deact_time')."</td><td>$deactivatedtime
	              		</td></tr>";
	              		echo "<tr><td colspan=2>".translate('meth')."</td></tr>";
	              		echo "<tr><td colspan=2><textarea type='text' name='method' placeholder='".translate('sub meth')."' style='width:100%;' rows='3'>$method</textarea></td></tr>";
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
      		?>
	        <table><tr>
	        	<td>
	        			<input type= "hidden" name="acction" value="save"/>
			        	<input type="submit" class="btn btn-sm btn-primary" value="<?php echo translate('save');?>"/>
			    	</form>
	        			<a href="crtview.php?link=<?php echo $link;?>"><button class="btn btn-sm btn-success"><?php echo translate('done');?></button></a>
	        	</td>
	        </tr></table>
	        <?php }?>
        </div> <!-- coll-8 -->
        <div class='col-md-4 col-sm-5'>
          <?php include 'single_quotes.php';?>
        </div>
	        
        </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/docs.min.js"></script>
    <script src="../assets/js/k.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
		</div>
  </div>
	</div>
  </body>
</html>
