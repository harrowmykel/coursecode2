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
          <h1 class="page-header"><?php echo ucfirst(translate('assignments'));?></h1>
          <div class="row">
            <div class="col-md-8 col-sm-7">

              <?php 
              
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

                $ert=new apiQuery();
                $rtyt=isset($_GET['page']) ? $_GET['page'] : 1;
                $Response=$ert->studentfile(getUser(), getPass(), $rtyt);
                
                $body=$Response->body;
                // var_dump{$body);
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
                $erru=$_SERVER['PHP_SELF']."?page=$rtyt";
              ?>

              
              <!-- link -->
              <div > 
                   <a href="subnew.php?new"><button class="web_appp btn pull-right btn-sm btn-success btn-go btnn-go frfo bfjfg" id="go"><i class="fa fa-plus"></i> <?php echo translate('subm_new_ass');?></button></a>
              </div>

              <!-- link -->
              <!-- link -->
              <a href="<?php echo $erru;?>" style="margin-bottom:15px;"><span class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Refresh</span></a>
              <table class="table table-condensed table-striped table-hover table-bordered">
                <thead>
                  <tr>
                   <th><i class="fa fa-hashtag"></i></th>
                    <th><i class="fa fa-code"></i> <?php echo translate('ass_code');?></th>
                    <th><i class="fa fa-clock-o"></i> <?php echo translate('time_submitted');?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $prv=$rtyt-1;
                    if($erot){
                      for($i=0, $io=($prv*50)+1; $i<$numm; $i++, $io++){
                        $ass_code=$words[$i]->ass_code;
                        $time=formatthisforHr($words[$i]->time);
                        echo "<tr>
                            <td>$io</td>
                            <td><a href='view.php?link=$ass_code'>$ass_code</a></td>
                            <td>$time</td>
                          </tr>";
                      
                      }
                    } else{
                      echo "<tr>
                              <td>1</td>
                              <td>$error</td>
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
                      echo "<li class='disabled'><a href='index.php?page=1'>". translate('prev')."</a></li>";
                    }else{
                      echo "<li><a href='index.php?page=$prv'>". translate('prev')."</a></li>"; 
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
                          echo "<li class='disabled'><a href='index.php?page=5'>". translate('next')."</a></li>";
                        }else{
                          echo "<li><a href='index.php?page=$nxxt'>". translate('next')."</a></li>";                      
                        }
                    }  
                    echo "</ul>";                    
                }
              ?>
            </div>
            <div class="col-md-4 col-sm-5">
              <?php
                  $arrayu=array("panel-green", "panel-yellow", "panel-info", "panel-red", "panel-default", "panel-warning");
                  $color=$arrayu[rand(0,5)];
              ?>
              <div class="panel <?php echo $color;?>">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-tasks fa-fw fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">                      
                                  <?php
                                      if($erot){
                                          echo $body[1]->total;
                                      }else{
                                          echo "0";
                                      }?>
                              </div>
                              <div><?php echo translate('total_subms');?></div>
                          </div>
                      </div>
                  </div><!-- /.panel-heading -->   
                  <div class="panel-footer">

                  </div>         
                </div><!-- /.panel -->
              
                <?php include 'single_quotes.php';?>
            </div>
          </div>
        </div>
    	</div><!-- large container -->


		  
		  
          
      
   

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/k.js"></script>
    <script type="text/javascript" src="../assets/js/nxt.js"></script>
    <script src="../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
		</div>
  </div>
	</div>
  </body>
</html>
