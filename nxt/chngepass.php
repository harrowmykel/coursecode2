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
        
        <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 main">
          <h1 class="page-header"><i class="icon icon-edit"></i> <?php echo translate('edit_prof');?></h1>
            <div class="row">
                <div class="col-md-8 col-sm-7">
	    	<?php 
	    		$erto=new apiQuery();

	    		$pass="";

	    		if (isset($_POST['acction'])){
	    			$act=$_POST['acction'];
	    			if ($act=="editprof"){
	    				$pass=$_POST['pass'];
	    				$new_pass=isset($_POST['newpass'])?$_POST['newpass']:"";
	                    
	    				$resp=$erto->editpass(getUser(), $pass,  $new_pass);
	    				
	    				if(isset($resp->body[0]->username)){
	    					$rtto=ucfirst($resp->body[0]->username);
	    					echo "<div class='alert fade-in m-success'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>".translate('prof_saved')."</strong>
						          </div>";                
                save_to_db($rtto, $new_pass);
	    				}else{
	    					$errp=$resp->body[0]->error_more;
	    					echo "<div class='alert fade-in m-warning'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>".translate('sorry error')."</strong> $errp
						          </div>";
	    				}
	    			}
	    		}


	    		$Response=$erto->fetchprof(getUser(), getPass());
	    		$body=$Response->body;
	    		if (isset($body[0]->error)){
	          		$erot=false;
                  	$error=$body[0]->error_more;
	          		//error
	    		}else{
	    			$words=$body[0];
	    			$numm=count($words);
	          		$erot=true;
	    		}
	    	?>
          <table class="table table-condensed table-striped table-hover table-bordered">
	          <thead>
	            <tr>
	              <th><?php echo translate('name');?></th>
	              <th><?php echo translate('value');?></th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php
	              	if($erot){
	              		$self=$_SERVER['PHP_SELF'];
	              		echo "<form method='POST' action='$self'>";
	              		echo "<tr><td><i class='fa fa-lock'></i> ".translate('old_pass')."</td><td><input type='password' name='pass' value=''/>
	              		</td></tr>";
	              		echo "<tr><td><i class='fa fa-lock'></i> ".translate('new_pass')."</td><td><input type='password' name='newpass' value=''/>
	        			<input type= 'hidden' name='acction' value='editprof'/>
	              		</td></tr>";
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
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> <?php echo translate('save_prof');?></button>
			    	</form>
	        	</td>
	        	<td>
	        		<a href="profile.php"/><button class="btn btn-sm btn-warning"/><i class="fa fa-times-circle-o"><?php echo translate('cancel');?></i></button></a>
	        	</td>
	        </tr></table>
	        <?php }?>
        </div> <!-- coll-8 -->
        <div class='col-md-4 col-sm-5'>
    
          <?php include 'single_quotes.php';?>
          </div>
	        
        </div>     <!-- Bootstrap core JavaScript
================================================== -->     <!-- Placed at the
end of the document so the pages load faster -->    
 <script src="../assets/js/jquery.js"></script>    
 <script src="../assets/js/bootstrap.min.js"></script>    
 <script src="../assets/js/docs.min.js"></script>    
 <script src="../assets/js/k.js"></script>     <!-- IE10 viewport hack for
Surface/desktop Windows 8 bug -->     <script src="../../assets/js/ie10
-viewport-bug-workaround.js"></script>         </div>   </div>     </div>
</body> </html>
