<?php include 'beginn.php';
          
  $rtyt=isset($_GET['page'])?$_GET['page']:1;
  $ouserl=getGetString('user');
  $errdhjvh=$_SERVER['PHP_SELF'];
  $erot=true;
  $prv=$rtyt;
  $nxxt=$rtyt+1;

  $words=array();
  $erto=new apiQuery();

  if(!empty(getPostString('mdg'))){
    //send msg here
    $rtyt_msg=getPostString('messgh');
    $are=$erto->sendMsg(getUser(), getPass(), getGetString('user'),$rtyt, $rtyt_msg);
    if(!empty($are->body[0]->error)){
      $error=$are->body[0]->error;
    }
  }

  $Response=$erto->getAllMessages(getUser(), getPass(), getGetString('user'), $rtyt);
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
          <h1 class="page-header"><?php echo translate('conversation');?>(<?php echo $ouserl;?>)</h1>
          <div class="row">
            <div class='col-md-8 col-sm-7'>
            <?php
            ?>
          <table class="table table-condensed table-striped table-hover table-bordered">
            <tbody>
              <?php           
                if(ucfirst($ouserl)==ucfirst(getUser())){                         
                  echo "<tr>
                          <td>".translate('cant_msg')."</td>
                        </tr>";
                }else{                         
                  echo "<tr>
                          <td><a href='messages_read.php?user=$ouserl' class='btn btn-sm btn-info'>".translate('refresh')."</a></td>
                        </tr>";
                }
                  if($erot){
                    $num=count($words);
                    for($i=$num; $i>0; $i--){
                      $key=$i-1;
                      $value=$words[$key];

                      $ouser=$value->auth_username;
                      $msg_=$value->message;
                      $fullname=$value->auth;
                      $ed_time=getDWM($value->timestamp);
                      $read=$value->read;
                      if($read=="w"){
                        echo "<tr class='warning'><td><a href='messages_read.php?user=$ouser'><h5><b>$fullname</b></h5></a>
                        <p style='margin-left:20px;'>$msg_"."... <span class='small'> $ed_time</span></p></td></tr>";
                      }else{
                        echo "<tr><td><a href='messages_read.php?user=$ouser'><h5><b>$fullname</b></h5></a>
                        <p style='margin-left:20px;'>$msg_"."... <span class='small'> $ed_time</span></p></td></tr>";
                      } 
                    }
                  }else{
                      echo "<tr>
                              <td>$error</td>
                            </tr>";
                  }

               ?>
                <tr>
                    <td>
                      <form method="post" action="messages_read.php?user=<?php echo $ouserl;?>">
                        <textarea type="text" name="messgh" style="width:100%"></textarea><br>
                        <input type="hidden" value="jj" name="mdg">
                        <input type="submit" name="send_r" value="<?php echo translate('send');?>" class=" btn pull-left btn-sm btn-primary bfjfg btn btn-sm btn-primary"/>
                      </form>
                    </td>
                </tr>
            </tbody>
          </table>
    <?php
    if($erot){
        echo "<ul class='pagination pagination-centered'>";
        if ($rtyt==1){
          echo "<li class='disabled'><a href='".$errdhjvh."?page=1&user=$ouserl'>".translate('prev')."</a></li>";
        }else{
          $prv=$rtyt-1;
          echo "<li><a href='".$errdhjvh."?page=$prv&user=$ouserl'>".translate('prev')."</a></li>"; 

        }

        if($no_pages>1){
            for($ie=1; $ie!=$no_pages; $ie++){
              if ($ie==$rtyt){
                echo "<li class='active'><a href='".$errdhjvh."?page=$ie&user=$ouserl'>$ie</a></li>";
              } else {
                echo "<li><a href='".$errdhjvh."?page=$ie&user=$ouserl'>$ie</a></li>";  
              }                   
            }
            if ($rtyt==$no_pages){
              echo "<li class='disabled'><a href='".$errdhjvh."?page=5&user=$ouserl'>".translate('next')."</a></li>";
            }else{
              echo "<li><a href='".$errdhjvh."?page=$nxxt&user=$ouserl'>".translate('next')."</a></li>";                      
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
