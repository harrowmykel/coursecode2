<?php include 'beginn.php'; 
    $error="";

	$to_go=isset($_GET['to'])?$_GET['to']:"compress";
	$link=isset($_GET['link'])?$_GET['link']:"";
	$user=isset($_GET['user'])?$_GET['user']:getUser();
	$exte="?user=$user&link=$link&to=$to_go";
    $ert=new apiQuery();
  /*  $loc=$ert->getCompressed(getUser(), getPass(), $link)->body;
    var_dump($loc);*/

	if (!empty($link)){
		// echo $to_go." $user ".$link;		
	}       
    if($to_go=="compress"){
    	$love=translate('get_comp_file');
    }else{
    	$love=translate('get_spreadsheet');
    } 

    if(isset($_POST['sendtt'])){
        $user=$_POST['email'];
        $pass=$_POST['password'];   


        $ert=new apiQuery();

        $result=$ert->fetchprof($user, $pass);

        $body=$result->body;
        if (isset($body[0]->username)){
            save_to_db($body[0]->username, $pass);

            if (isset($_POST['rmb'])){
                saveCookie__($body[0]->username, $pass);
            }        
            if($to_go=="compress"){
                $loc_=$ert->getCompressed($user, $pass, $link);
                $loc=$loc_->body->url;
                $zip_file=$loc;  
            }else{
            	$loc_=$ert->getSpreadSheet($user, $pass, $link);
                $loc=$loc_->body->url;
                $zip_file=$loc;
            }    
            header("Location: $zip_file"); 
            exit(); 
            /*      

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($zip_file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($zip_file));
            readfile($zip_file);*/
        } else{
            $error= translate('inv_pass');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../assets/ico/favicon.png">

        <title>CourseCode | Downloads </title>

        <!-- Bootstrap core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

        <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="../assets/css/font-awesome.mn.css" rel="stylesheet">


        <!-- Custom styles for this template -->
        <link href="../assets/css/signin.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../assets/css/styles.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">CourseCode</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">         
                        <li class="active"><a href="index.php"><?php echo translate('home');?></a></li>
                        <li><a href="../signup.php"><?php echo translate('sign_up');?></a></li>
                        <li><a href="../tos.php"><?php echo translate('t_and_c');?></a></li>
                        <li><a class="logout" href="../contact.php"><?php echo translate('contact');?></a></li>
                    </ul>
                </div>
            </div>
        </div>


    <div class="container">
        <div class="big-gap"></div>

      <form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF']. $exte;?>" >
        <div class="form-signin-heading"><h4><?php echo translate('input_pass_go');?></h4></div>
        <?php 
            if($error!=""){
                echo "<div class='alert fade-in m-warning'>
                          <button type='button' class='close' data-dismiss='alert'>&times;</button>
                           <strong>".translate('sorry error')."</strong> $error
                        </div>";
            }

        ?>   
        <label for="inputEmail" class="sr-only"><?php echo translate('email_add');?></label>
        <input type="text" id="inputEmail" name="email" class="form-control" value="<?php echo $user;?>" placeholder="<?php echo translate('email_add');?>" required autofocus>
        <label for="inputPassword" class="sr-only"><?php echo translate('password');?></label>
        <input type="password" id="inputPassword" class="form-control" placeholder="<?php echo translate('password');?>" name="password" required>
        <input type="hidden" name="sendtt" value="bghsbdh">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me" name="rmb"> <?php echo translate('rmrb_me');?>
          </label>   
        <a href="signup.php" class="aa pull-right"><?php echo translate('frgt_pass');?></a>
        </div>

        <button class="btn btn-sm btn-primary btn-block" type="submit"><?php echo $love;?></button>        
        <h5 class=""><a href="../signup.php" class="aa"><?php echo translate('crt_a_new_acct');?></a></h5>        
        <h5 class=""><a href="../produkta/android.php" class="aa"><?php echo translate('try_app_beta');?></a></h5>
      </form>

    </div> <!-- /container -->

                   <!-- Bootstrap core JavaScript
================================================== -->     <!-- Placed at the
end of the document so the pages load faster -->     
<script src="../assets/js/jquery.js"></script>     
<script src="../assets/js/bootstrap.min.js"></script>     
<script src="../assets/js/docs.min.js"></script>     <!-- IE10 viewport hack for
Surface/desktop Windows 8 bug -->  
   <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> 
</body> </html>
