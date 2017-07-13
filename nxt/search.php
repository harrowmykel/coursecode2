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
          <h1 class="page-header"><?php echo translate('search');?></h1>

          <div class="row">
            <div class="col-xs-12 col-sm-12">
            	<?php 
            		$link=isset($_POST['search']) ? $_POST['search'] : "a";
            		$ert=new apiQuery();
            		$rtyt=isset($_GET['page']) ? $_GET['page'] : 1;
            		$Response=$ert->search_url(getUser(), getPass(), $link, $rtyt);
            		$body=$Response->body;
            		if (isset($body[0]->error)){
                  		$erot=false;
                  		$error=$body[0]->error_more;
                  //error
            		}else{
            			$words=$body[0];
            			$numm=count($words);
            			$erot=true;
            			$no_pages=$body[1]->no_pages;
            		}
            	?>
            	
	            <table class="table table-condensed table-striped table-hover table-bordered">
	              <thead>
	                <tr>
					         <th>#</th>
	                  <th>Short Link</th>
	                  <th>Views</th>
	                  <th>Last View</th>
	                </tr>
	              </thead>
	              <tbody>
	              	<?php
                    $prv=$rtyt-1;
		              	if($erot){
		              		for($i=0, $io=($prv*50)+1; $i<$numm; $i++, $io++){
		              			$gen=$words[$i]->gen_url;
		              			$view=$words[$i]->views;
                        $lastview=$words[$i]->lastview;
                        $deactivate=$words[$i]->deactivated;
		              			$genurl=urlencode($gen);
                        if ($deactivate>0){
                          echo "<tr class='warning'>
                              <td>$io</td>
                              <td><a href='view.php?link=$genurl'>$gen</a></td>
                              <td>$view</td>
                              <td>$lastview</td>
                            </tr>";
                        }else{
  		              			echo "<tr>
  					                  <td>$io</td>
  					                  <td><a href='view.php?link=$genurl'>$gen</a></td>
  					                  <td>$view</td>
  					                  <td>$lastview</td>
  					                </tr>";
                        }
		              		}
		              	}else{
	                      echo "<tr>
	                              <td>1</td>
	                              <td>$error</td>
	                              <td>--</td>
	                              <td>--</td>
	                            </tr>";
	                    }
		             ?>
	              </tbody>
	            </table>

	            <?php
	            	$nxxt=$rtyt+1;

	              if($erot){
	              		echo "<ul class='pagination pagination-centered'>";
                    if ($rtyt==1){
                      echo "<li class='disabled'><a href='index.php?page=1'>Prev</a></li>";
                    }else{
                      echo "<li><a href='index.php?page=$prv'>Prev</a></li>"; 
                    }

                    if($no_pages>1){
                        for($ie=1; $ie!=$no_pages; $ie++){
                          if ($ie==$rtyt){
                            echo "<li class='active'><a href='index.php?page=$ie'>$ie</a></li>";
                          } else {
                            echo "<li><a href='index.php?page=$ie'>$ie</a></li>";  
                          }                   
                        }
                        if ($rtyt==$no_pages){
                          echo "<li class='disabled'><a href='index.php?page=5'>Next</a></li></ul></div>";
                        }else{
                          echo "<li><a href='index.php?page=$nxxt'>Next</a></li></ul></div>";                      
                        }
                    }									       
						    }
				?>
          	</div>
          </div>
    	</div>


		  
		  
          
      
   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
		</div>
  </div>
	</div>
  </body>
</html>
