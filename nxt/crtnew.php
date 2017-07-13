<?php include 'beginn.php';
	$ddjhd=getPostString("assign_push");

	$f_location="";
	$t_file=false;
	$message="";
	if(!empty($ddjhd)){
		$t_file=true;
		$time__=time();
		$file_dump="b/".$time__."/";
		mkdire($file_dump);
		$bb=mkdire($file_dump.gnrtNewString(2, 6)."/");
		if (isset($_FILES['assign_fjf'])){
			$rname=$_FILES['assign_fjf']['name'];
			$f_location=$bb.$rname;

			while(is_file($f_location) && file_exists($f_location)){
			  $bb=mkdire($file_dump.gnrtNewString(2, 6)."/");
			  $f_location=$bb.$rname;
			}

			move_uploaded_file($_FILES['assign_fjf']['tmp_name'], $f_location);
		}
	}
	    
		$erto=new apiQuery();

		$pass="";
		$method="";
		$day="";
		$time="";
        $deact="";
        $title="";

		if (isset($_POST['acction'])){
			$act=$_POST['acction'];
			if ($act=="editprof"){
				$method=$_POST['method'];
				$day=$_POST['day'];
				$time=$_POST['time'];
				$deact=$day."-".$time;
      			$title=$_POST['titlel'];

      			if($t_file){
					$resp=$erto->createlock__(getUser(),  getPass(), $title, $method, $deact, $f_location);
      			}else{      				
					$resp=$erto->createlock(getUser(),  getPass(), $title, $method, $deact)->body;
      			}
      			
				if(isset($resp[0]->username)){
					$rtto=$resp[0]->ass_code;
					$message.="<div class='alert fade-in m-success'>
				            <button type='button' class='close' data-dismiss='alert'>&times;</button>
				            <strong>Done! Assignment Code is $rtto. <a href='assedit.php?link=$rtto'>".translate('edit_code')."</a> | <a href='crtview.php?link=$rtto'>".translate('visit_site')."</a> </strong>
				          </div>";
				}else{
					$errp=$resp[0]->error_more;
					$message.="<div class='alert fade-in m-warning'>
				            <button type='button' class='close' data-dismiss='alert'>&times;</button>
				            <strong>".translate('sorry error')."</strong> $errp
				          </div>";
				}
			}
		}

      	$erot=true;
	?>


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
          <h1 class="page-header"><i class="fa fa-magic"></i> <?php echo translate('crt_a_new_ass');?></h1>
          <div class="row">
            <div class='col-md-8 col-sm-7'>
          <div class='alert fade-in m-success'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong><?php echo translate('mrk_support');?> <a href='http://coursecode.com.ng/a/index.php?href=markdown'> <?php echo translate('learn_more');?></a><?php echo translate('ext_link');?></strong>
          </div>
	    	<?php if(!empty($message)){
	    		echo $message;}?>
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

	              		$self=$_SERVER['PHP_SELF'];
	              		echo "<form method='POST' enctype='multipart/form-data' action='$self'>";
	              		echo "<tr><td><i class='fa fa-calendar-check-o'></i> ".translate('sub date')."</td><td><input type='text' name='day' value='$day' class='form-control' placeholder='".translate('sub_date')."'/>
	              		</td></tr>";
                    echo "<tr><td><i class='fa fa-clock-o'></i>".translate('sub time')."</td><td><input type='text' name='time' value='$time' class='form-control' placeholder='".translate('sub_time')."'/>
                    </td></tr>";
                    echo "<tr><td><i class='fa fa-clock-o'></i> ".translate('ass_title')."</td><td><input type='text' name='titlel' value='$title' class='form-control' placeholder='".translate('ass_title')."'/>
                    </td></tr>";
	              		echo "<tr><td colspan=2><i class='fa fa-sticky-note-o'></i> ".translate('sub meth')."</td></tr><tr><td colspan=2><textarea type='text' name='method' class='form-control' placeholder='".translate('sub meth')."'>$method</textarea>
	              		</td></tr>";
                    echo "<tr><td colspan=2><input type='checkbox' name='assign_push' value='itle' placeholder='".translate('ass_title')."'/> ".translate('auto_mark_clck')."<input type='file' name='assign_fjf' placeholder='".translate('ass_title')."'/>
                    </td></tr>";
	              		echo "<input type= 'hidden' name='acction' value='editprof'/>";
	              	}else{
                      echo "<tr>
                              <td colspan=2>$error</td>
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
			        	<button type="submit" class="btn btn-sm btn-primary"><i class='fa fa-code'></i> <?php echo translate('get_ass_code');?></button>
			    	</form>
	        	</td>
	        </tr></table>
	        <?php }?>
        </div> <!-- coll-8 -->
        <div class='col-md-4 col-sm-5'>          
          <?php include 'single_quotes.php';?>
        </div> <!-- coll-8 -->
        </div> <!-- row -->

	        
        </div>     <!-- Bootstrap core JavaScript
================================================== -->     <!-- Placed at the
end of the document so the pages load faster -->     <script
src="../assets/js/jquery.js"></script>     <script
src="../assets/js/bootstrap.min.js"></script>     <script
src="../assets/js/k.js"></script>     <script
src="../assets/js/docs.min.js"></script>     <!-- IE10 viewport hack for
Surface/desktop Windows 8 bug -->     <script src="../../assets/js/ie10
-viewport-bug-workaround.js"></script>         </div>   </div>     </div>
</body> </html>
