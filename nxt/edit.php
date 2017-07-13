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
          <h1 class="page-header"><?php echo translate('edit_prof');?></h1>
          <div class="row">
            <div class='col-md-8 col-sm-7'>
	    	<?php 
	    		$erto=new apiQuery();

	    		$pass="";

	    		if (isset($_POST['acction'])){
	    			$act=$_POST['acction'];
	    			if ($act=="editprof"){
	    				$user=$_POST['user'];
	    				$pass=$_POST['pass'];
	    				$new_pass=isset($_POST['newpass'])?$_POST['newpass']:"";
	    				$name=$_POST['name'];
	    				$dob=$_POST['dob'];
	    				$email=$_POST['email'];
	    				$country=$_POST['country'];
	    				$country=$_POST['country'];
				        $matric=$_POST['matric'];
				        $school=$_POST['school'];
				        $teacher=1;

				        if (isset($_POST['student'])){
				           $teacher=0;
				        }
	                    
	    				$resp=$erto->editprof($user, $pass, $name, $dob, $email, $country, $teacher, $school, $matric);

	    				if(isset($resp->body[0]->username)){
	    					$rtto=ucfirst($resp->body[0]->username);
	    					echo "<div class='alert fade-in m-success'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>". translate('prof_saved')."</strong>
						          </div>";
	    				}else{
	    					$errp=$resp->body[0]->error_more;
	    					echo "<div class='alert fade-in m-warning'>
						            <button type='button' class='close' data-dismiss='alert'>&times;</button>
						            <strong>". translate('sorry error')."</strong> $errp
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
	              <th>Name</th>
	              <th>Value</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php
	              	if($erot){
	              		$name=$words->name;
	              		$country=$words->country;
	              		$username=$words->username;
	              		$dob=formatThisTime($words->dob);
	              		$email=$words->email;
	              		$time=formatThisForHr($words->time);
	              		$matric=$words->matric_no;
	                    $school=$words->school;
	                    $teacher=$words->teacher;
	                    $trch="false";
	                    if ($teacher==0){
	                      $trch="checked";
	                    }

	              		$self=$_SERVER['PHP_SELF'];
	              		echo "<form method='POST' action='$self'>";
	              		echo "<tr><td>".translate('name')."</td><td><input type='text' name='name' value='$name'/>
	              		</td></tr>";
	              		echo "<tr><td>".translate('username')."</td><td>$username<input type='hidden' name='user' value='$username'/>
	              		</td></tr>";
	              		echo "<tr><td>".translate('email')."</td><td><input type='text' name='email' value='$email'/>
	              		</td></tr>";
	                    echo "<tr><td>".translate('matric')."</td><td><input type='text' name='matric' value='$matric'/>
	                    </td></tr>";
	                    echo "<tr><td>".translate('school')."</td><td><input type='text' name='school' value='$school'/>
	                    </td></tr>";
	                    echo "<tr><td>".translate('student_quest')."</td><td><input type='checkbox' name='student' $trch/>
	                    </td></tr>";
	              		echo "<tr><td>".translate('country')."</td><td><input type='text' name='country' value='$country'/>
	              		</td></tr>";
	              		echo "<tr><td>".translate('reg_time')." </td><td>$time
	              		</td></tr>";
	              		echo "<tr><td>".translate('date_of_birth_dd')."</td><td><input type='text' name='dob' value='$dob'/>
	              		</td></tr>";
	              		echo "<tr><td>".translate('input_pass_to_c')."</td><td><input type='password' name='pass' value=''/>
	              		</td></tr>";
	              		echo "<input type= 'hidden' name='acction' value='editprof'/>";
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
			        	<input type="submit" class="btn btn-sm btn-primary" value="<?php echo translate('save_prof');?>"/>
			    	</form>
	        	</td>
	        	<td>
	        		<a href="profile.php"/><button class="btn btn-sm btn-warning"/><?php echo translate('cancel');?></button></a>
	        	</td>
	        	<td>
	        		<a href="chngepass.php"/><button class="btn btn-sm btn-default"/><?php echo translate('edit_pass');?></button></a>
	        	</td>
	        </tr></table>
	        <?php }?>
	        
        </div> <!-- coll-8 -->
        <div class='col-md-4 col-sm-5'>        
    
          <?php include 'single_quotes.php';?>
          <!-- /.panel -->
	        
        </div>     <!-- Bootstrap core JavaScript
================================================== -->     <!-- Placed at the
end of the document so the pages load faster -->     <script
src="../assets/js/jquery.js"></script>     <script
src="../assets/js/bootstrap.min.js"></script>     <script
src="../assets/js/docs.min.js"></script>   <script
src="../assets/js/k.js"></script>       <!-- IE10 viewport hack for
Surface/desktop Windows 8 bug -->     <script src="../../assets/js/ie10
-viewport-bug-workaround.js"></script>         </div>   </div>     </div>
</body> </html>
