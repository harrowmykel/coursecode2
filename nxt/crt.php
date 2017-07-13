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
          <h1 class="page-header"><i class='icon icon-pencil'></i> <?php echo ucfirst(translate('assignments'));?></h1>

          <div class="row">
            <div class="col-md-8 col-sm-7">
              <?php 
                $ert=new apiQuery();
                $rtyt=isset($_GET['page']) ? $_GET['page'] : 1;
                $Response=$ert->teacherfile(getUser(), getPass(), $rtyt);
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
                $erru=$_SERVER['PHP_SELF']."?page=$rtyt";
                $errdhjvh=$_SERVER['PHP_SELF'];
              ?>
              <!-- link -->
              <div > 
                   <a href="crtnew.php?new"><button class="web_appp btn pull-right btn-sm btn-success btn-go btnn-go frfo bfjfg" id="go"><i class='icon icon-plus'></i> <?php echo translate('crt_new_ass');?></button></a>
              </div>

              <!-- link -->
              <!-- link -->

          <hr>
          <br>
              <a href="<?php echo $erru;?>" style="margin-bottom:15px;"><span class="btn btn-default btn-sm"><i class='icon icon-refresh'></i> <b><?php echo translate('refresh');?></b></span></a>
              <table class="table table-condensed table-striped table-hover table-bordered">
                <thead>
                  <tr>
                   <th><i class='fa fa-hashtag'></i></th>
                    <th><i class='fa fa-file-code-o'></i>  <?php echo translate('ass_code');?></th>
                    <th><i class='fa fa-clock-o'></i>  <?php echo translate('time_crtd');?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $prv=$rtyt-1;
                    if($erot){
                      for($i=0, $io=($prv*50)+1; $i<$numm; $i++, $io++){
                        $ass_code=$words[$i]->ass_code;
                        $time=formatThisForHr($words[$i]->time);
                        $deactivate=$words[$i]->deactivated_;

                    if ($deactivate>0){
                          echo "<tr class='warning'>
                              <td><b>$io</b></td>
                              <td><a href='crtview.php?link=$ass_code'>$ass_code</a></td>
                              <td>$time</td>
                            </tr>";
                        }else{
                          echo "<tr>
                              <td><b>$io</b></td>
                              <td><a href='crtview.php?link=$ass_code'>$ass_code</a></td>
                              <td>$time</td>
                            </tr>";
                        }
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
                            echo "<li class='active'><a href='".$errdhjvh."?page=$ie'>$ie</a></li>";
                          } else {
                            echo "<li><a href='".$errdhjvh."?page=$ie'>$ie</a></li>";  
                          }                   
                        }
                        if ($rtyt==$no_pages){
                          echo "<li class='disabled'><a href='".$errdhjvh."?page=5'>". translate('next')."</a></li>";
                        }else{
                          echo "<li><a href='".$errdhjvh."?page=$nxxt'>". translate('next')."</a></li>";                      
                        }
                    }        
                    echo "</ul>";
                }
        ?>
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
    <script src="../assets/js/k.js"></script> 
    <script src="../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    </div>
  </div>
  </div>
  </body>
</html>
