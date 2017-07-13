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
          <h1 class="page-header"><?php echo translate('profile');?></h1>
          <div class="row">
            <div class='col-md-8 col-sm-7'>
	    	<?php 
	    		$erto=new apiQuery();
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
	              		$name=$words->name;
	              		$country=$words->country;
	              		$username=$words->username;
	              		$dob=formatThisForHr($words->dob);
                    $email=$words->email;
	              		$time=formatThisForHr($words->time);
                    $matric=$words->matric_no;
                    $school=$words->school;
                    $teacher=$words->teacher;
                    $trch="false";
                    if ($teacher==0){
                      $trch="true";
                    }


	              		echo "<tr><td>".translate('name')."</td><td>$name
	              		</td></tr>";
	              		echo "<tr><td>".translate('country')."</td><td>$country
	              		</td></tr>";
	              		echo "<tr><td>".translate('username')."</td><td>$username
	              		</td></tr>";
                    echo "<tr><td>".translate('email')."</td><td>$email
                    </td></tr>";
                    echo "<tr><td>".translate('matric')."</td><td>$matric
                    </td></tr>";
                    echo "<tr><td>".translate('school')."</td><td>$school
                    </td></tr>";
                    echo "<tr><td>".translate('student_quest')."</td><td>$trch
                    </td></tr>";
	              		echo "<tr><td>".translate('reg_time')."</td><td>$time
	              		</td></tr>";
	              		echo "<tr><td>".translate('date_of_birth_dd')."</td><td>$dob
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
	        		<a href="edit.php"/><button class="btn btn-sm btn-primary"/><?php echo translate('edit_prof');?></button></a>
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
