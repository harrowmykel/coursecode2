<?php 
    include 'beginn.php';
    $link=isset($_GET['link']) ? urldecode($_GET['link']) : '';
    $act=isset($_GET['todo']) ? urldecode($_GET['todo']) : '';
    $message="";
    $ert=new apiQuery();

    if (!empty($act)){
        if ($act=='deactivate'){
            //deactivate
            $resp=$ert->deactivate(getUser(), getPass(), $link);;
            if(isset($resp->body[0]->success)){
                $rtto=ucfirst($resp->body[0]->success_more);
                $message= "<div class='alert fade-in m-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>".translate('done_more')."</strong>
                      </div>";
            }else{
                $message= "<div class='alert fade-in m-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>".translate('sorry error')."</strong>
                      </div>";
            }
        }else if ($act=='delete') {
            //delete
            $serv=$_SERVER['PHP_SELF'];
            $message= "<div class='alert fade-in m-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>".translate('del_this_link')." </strong>".translate('del_warning')."  
                        <p> 
                        <form method='POST' action=' $serv'.'?link=$link'; ?>
                            <input type= 'hidden' name='acction' value='confirm'/>
                            <input type='submit' class='btn btn-sm btn-danger' value='".translate('del')."'/>
                        </form></p>
                      </div>";
            
        } else if ($act=='confirm'){
            $resp=$ert->delete(getUser(), getPass(), $link);
            if(isset($resp->body[0]->success)){
                $message= "<div class='alert fade-in m-success'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>".translate('deltd')."</strong>
                      </div>";
            }else{
                $message= "<div class='alert fade-in m-warning'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>".translate('sorry error')."</strong>
                      </div>";
            }
        }  
    }

    $erto=new apiQuery();
    $Response=$erto->submittedfile(getUser(), getPass(), $link);
    $body=$Response->body;
    if (isset($body[0]->error)){
        $erot=false;
        $error=$body[0]->error_more;
    }else{
        $words=$body[0];
        $numm=count($words);
        $user=getUser();
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
          <h1 class='page-header'><?php echo $link ?></h1>	   
            <div class="row">
                <div class="col-lg-8">
                    <?php echo $message;
                        $arrayu=array("panel-green", "panel-yellow", "panel-info", "panel-default");
                        $color=$arrayu[rand(0,3)];
                    ?>
                    <div class="panel <?php echo $color;?>">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-fw fa-5x"></i>
                                </div>                                
                                <div class="col-xs-9">
                                    <div class="huge text-right"><?php echo $link; ?></div>
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-success btn-sm btn-lng dropdown-toggle" data-toggle="dropdown"><?php echo translate('more');?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <?php if($erot){
                                                        $deactivated=$words->deactivated_;
                                                        if($deactivated!=0){
                                                            $deact=translate('react');
                                                        }else{
                                                            $deact=translate('deact');
                                                        } 
                                                    }?>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF'].'?link='.$link.'&todo=deactivate'; ?>"><?php echo $deact?></a>
                                                </li>
                                                <li><a href="<?php echo $_SERVER['PHP_SELF'].'?link='.$link.'&todo=delete'; ?>"><?php echo translate('del');?></a>
                                                </li>
                                                <li><a href="<?php echo 'assedit.php?link='.$link.'&todo=deactivate'; ?>"><?php echo translate('edit');?></a>
                                                </li>
                                                <li class="divider"><hr></li>
                                                <li><a href="<?php echo 'go.php?user='.$user.'&link='.$link.'&to=compress'; ?>"><?php echo translate('get_comp_file');?></a>
                                                <li><a href="<?php echo 'go.php?user='.$user.'&link='.$link.'&to=excel'; ?>"><?php echo translate('get_spreadsheet');?></a>
                                                </li>
                                            </ul>
                                        </div>
	                                </div>
	                            </div>
	                        </div>
                        <!-- /.panel-heading --> 
                            <div class="panel-footer">
                                <b class="pull-left"> 
                                    <?php echo translate('title');?>                              
                                </b>
                                <div class="clearfix"></div>
                            </div>
                        <!-- /.panel-footer -->                        
                        <div class="panel-body">  
                            <?php
                                if($erot){                                    
                                    $method=$words->title_;
                                    echo $method;
                                }
                            ?> 
                        </div>
                        <!-- /.panel-body -->  
                        <div class="panel-footer">
                            <b class="pull-left"> 
                                <?php echo translate('desc');?>                              
                            </b>    
                            <div class="clearfix"></div>
                        </div>
                    <!-- /.panel-footer -->                        
                        <div class="panel-body">
                            <?php
                                if($erot){                                    
                                    $method=$words->method_;

                                    echo Markdown($method);
                                }
                            ?> 
                        </div>
                        <!-- /.panel-body --> 
                    </div>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <i class="fa fa-list-ul fa-fw"></i> <?php echo translate('subms');?> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body reduce_margin">
                            <table class='table table-condensed table-striped table-hover table-bordered'>
                                <thead>
                                 <tr>
                                     <th><?php echo translate('s_n');?>/th>
                                     <th><?php echo translate('name');?></th>
                                     <th><?php echo translate('f_name');?></th>
                                     <th><?php echo translate('f_type');?></th>
                                     <th><?php echo translate('f_size');?></th>
                                     <th><?php echo translate('f_upl_time');?></th>
                                     <th><?php echo translate('grade');?></th>
                                </tr>
                                </thead>
                                  <tbody>
                            <?php
                            if($erot){
                                $body1=$body[1];
                                for($i = 0; $i<count($body1); $i++) {
                                    $arr=$body1[$i][0];
                                    $ii=$i+1;       
                                    $rtjfjn=formatThisForHr($arr->file_mod);
                                    echo "<tr>";    
                                    echo "<td>$ii</td>";
                                    echo "<td>$arr->name</td>"; 
                                    echo "<td>$arr->file_name</td>";    
                                    echo "<td>$arr->file_type</td>";    
                                    echo "<td>$arr->file_size</td>";    
                                    echo "<td>$rtjfjn</td>";
                                    echo "<td>$arr->grade</td>";
                                }
                            }
                        ?>
                                    </tbody>
                                </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
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
                                                echo $body[2]->total;
                                            }else{
                                                echo "0";
                                            }?>
                                    </div>
                                    <div><?php echo translate('total_subms');?></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body reduce_margin">                           
                            <div class="list-group">
                                    <?php
                                        if($erot){
                                            $gen_url=$words->ass_code;
                                            $deactivated=$words->deactivated_;
                                            $method=$words->method_;
                                            $view=$body[2]->total;
                                            $time=formatThisForHr($words->time);
                                            $deactivatedtime=formatThisForHr($words->deactivated_time);
                                            $deactivationtime=formatThisForHr($words->deactivation_time);
                                            if($deactivated!=0){
                                                $deact=translate('react');
                                            }else{
                                                $deact=translate('deact');
                                            }
                                            $array_1=array(translate('ass_code'),
                                                            translate('total_subms'),
                                                            translate('time'), 
                                                            translate('sub_time'),
                                                            translate('deactd'),
                                                            translate('deact_time'));
                                            $array_2=array("$gen_url", "$view",
                                                            "$time", 
                                                            "$deactivationtime",
                                                            "$deactivated",
                                                            "$deactivatedtime");
                                            for($ioi=0; $ioi<count($array_2); $ioi++){
                                                echo "<div class='list-group-item'>
                                                            <i class='fa fa-comment fa-fw'></i>".$array_1[$ioi]."
                                                            <span class='pull-right text-muted small'><em>".$array_2[$ioi]."</em>
                                                            </span>
                                                      </div>";
                                            }
                                        }else{
                                            echo "<div href='#' class='list-group-item'>
                                                        <i class='fa fa-comment fa-fw'></i>1
                                                        <span class='pull-right text-muted small'><em>$error</em>
                                                        </span>
                                                    </div>";
                                        }
                                     ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                      
    
                    <?php include 'single_quotes.php';?>   <!-- /.panel --> 
                    </div>
                    <!-- /.panel .chat-panel -->'>
                </div>
                <!-- /.col-lg-4 -->
	        
        </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='../assets/js/jquery.js'></script>
    <script src='../assets/js/bootstrap.min.js'></script>
    <script src="../assets/js/k.js"></script> 

    <!-- Custom Theme JavaScript -->
    <script src='../assets/js/docs.min.js'></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src='../../assets/js/ie10-viewport-bug-workaround.js'></script>
		</div>
  </div>
	</div>
  </body>
</html>
