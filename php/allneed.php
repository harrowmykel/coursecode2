<?php
	define('TIMEOUT', 3600);//timeout for each upload b4 it is deleted
	define('JUST_NOW', 600);
	define('COOKIE_TIMEOUT', 3600*24*10*10);	//cookie
	define('APP_ID_AUTH', '325663653748jdfd');	//APP_ID
	define('URL_API', 'http://localhost/arosoftapi/coursecode');


	function deleteDir($dir){
	    $time=time();
	    $arr=scandir($dir);
	    foreach ($arr as $key => $value) {
	        if(($value!='..' && $value!='.')){
	            //if less than 1hr  ago.
	            $this__=$dir."/".$value;
	            // 
	            if (is_dir($this__)) {
	            	array_map('unlink', glob("$this__/*.*"));
	            	deleteDir($this__);
	            	rmdir($this__);
	            }else{
	            	@unlink($this__);
	            }
	        }
	    }
	}


	function deleteDir__($dir){
	    $time=time();
	    mkdire($dir);
	    $arr=scandir($dir);
	    foreach ($arr as $key => $value) {
	        if(intval($value)<($time-TIMEOUT) &&($value!='..' && $value!='.')){
	            //if less than 1hr  ago.
	            $this__=$dir."/".$value;
	            // 
	            if (is_dir($this__)) {
	            	array_map('unlink', glob("$this__/*.*"));
	            	deleteDir($this__);
	            	rmdir($this__);
	            }else{
	            	@unlink($this__);
	            }
	        }
	    }
	}
	
	function url_rewrite_query($req){

	  $gets="?";
	  foreach ($_GET as $key => $value) {
	    # code...
	    $gets.=$key.'='.$value.'&';
	  }
	  return $_SERVER['PHP_SELF'].$gets.$req;
	}

	function url_rewrite_query__($req){
		//adds a value to the already initiated get req;
		$url_get=$_SERVER['REQUEST_URI'];

	    $var_=explode("?", ($url_get));
	    $num=count($var_);
	    $var__=explode("&", ($url_get));
	    $num_=count($var__);
	    if((strlen($var_[$num-1]))<1){
	        $res=$url_get.$req;
	    }else
	    if((strlen($var__[$num_-1]))<1){
	        $res=$url_get.$req;
	    }else
		if(strpos($url_get, "?")>-1){
			$res=$url_get."&".$req;
		}else{
			$res=$url_get."?".$req;
		}
		return $res;
	}

	function setActiveLink($page){
		//generates class if this link= current page
		if(getActivePage()==$page){
			return " active";
		}
	}

	function getNewMsgs(){
		$apiq=new apiQuery();
		$body=$apiq->getTotalMsg(getUser(), getPass())->body;
		$num=(isset($body->result))?$body->result:"";
		return $num;
	}

	function isActiveLink($page){
		//generates true if this link= current page
		return (getActivePage()==$page)?true:false;
	}

	function setActiveClass($page){
		//generates class if this link= current page
		if(getActivePage()==$page){
			return "class='active'";
		}
	}

	function getActivePage(){
		// explode
		$arr=explode("/", $_SERVER['PHP_SELF']);
		$arr=explode(".", $arr[count($arr)-1]);
		return $arr[0];
	}

	function getPostString($vr){
		if (isset($_POST[$vr])){	
			return changeLessandgt($_POST[$vr]);
		}
		return "";
	}

	function changeLessandgt($string){
		// return $string;
		return htmlentities($string);
	}


	function getGetString($vr){
		if (isset($_GET[$vr])){
			return $_GET[$vr];
		}
		return "";
	}


    function teil($r){
    	return ceil($r);
    }

	function getDWM($TtimeStamp){
        //tobe returned
        if(empty($TtimeStamp)){
            return "";
        }
		
		$time_diff=time()-$TtimeStamp;

        $one_min=60;
        $one_hr=3600;
        $one_day=$one_hr*24;
        $one_week=$one_day*7;

        $numb=$time_diff/$one_day;
        $tbr="1 minutes";
        $to=$time_diff;

        if($numb>=1){
            //check for number of days
            if($numb>30){
                //show dd/mm
                $art=getdate($TtimeStamp);
                $min=$art['minutes'];
                $mon=$art['mon'];
                $dayy=$art['mday'];
                $tbr="".$dayy+'/'.$mon;
            }else if($numb>7){
                //show 1w
                $tbr=teil($numb) ." Weeks ago";
            }else{
                $tbr=teil($numb)." days ago";
            }
        }else{
            //show 1d
            $tbr="Yesterday ";
            $num_hr=$to/$one_hr;
            $num_min=$to/$one_min;

            if($num_hr>=1){
                $tbr=teil($num_hr)." hours ago";
            }else if($num_min>=1){
                //min
                $tbr=teil($num_min)." minutes ago";
            }else{
                //sec
                if(teil($to)<JUST_NOW)
                	$tbr="Just now";
                else
                	$tbr=teil($to)." seconds";
            }
        }
        return $tbr;
    }

	$dummy=base64_encode("DfEfhbh");

	function save_to_db($a, $b){
		$_SESSION['user']=encodePass($a);
		$_SESSION['pass']=encodePass($b);
	}

	function getUser(){
		global $dummy;
		return empty(getData('user'))?$dummy:getData('user');
	}

	function getLink($rt){
		$rty=ucfirst($rt);
		if(substr("$rty", 0, 4)=="Http"){$lek=$rt;}
		else {$lek= 'http://'.$rt;}

		return strtolower(urldecode($lek));
	}

	function getPass(){
		global $dummy;
		return empty(getData('pass'))?$dummy:getData('pass');
	}
	
    function createFile($rt, $art){
        $rtt=fopen("$rt", "a+");
        fwrite($rtt, $art);
    }

    function saveCookie__($name, $pass){
    	saveData('user', $name);
    	saveData('pass', $pass);
    }

	function external_link($ndj){
		return $ndj;
	}

	function errorify($vr){
		$retu="Error";
		switch ($vr) {
	        case 1474:
	          $retu="No username";
	          break;
	        case 2474:
	          $retu="No password";
	          break;
	        case 3474:
	          $retu="Invalid username or password";
	          break;
	        case 4474:
	          $retu= "No or invalid imageid";
	          break;
	        case 5474:
	          $retu= "Invalid appid";
	          break;
	        case 6474:
	          $retu= "Error editing profile";
	          break;
	        case 6475:
	          $retu= "Undefined Request";
	          break;
	        case 6476:
	          $retu= "Invalid Request";
	          break;
	        case 6477:
	          $retu= "Invalid File";
	          break;
	        case 6478:
	          $retu= "No File";
	          break;
	        case 6479:
	          $retu= "Empty Array";
	          break;
	        case 6480:
	          $retu= "Invalid Username";
	          break;
	        case 6481:
	          $retu= "Invalid Email";
	          break;
	        case 6482:
	          $retu= "Invalid Date Of Birth";
	          break;	          
	        case 6483:
	          $retu= "Invalid Username or Email";
	          break;
	    }
		return $retu;
	}

	function possessUri(){

		//returns last word
		$rt="";
		if (isset($_SERVER['REQUEST_URI'])){
			$Request=$_SERVER['REQUEST_URI'];
			$rt=getLastWord($Request, 0);
		}
		return $rt;
	}


	function formatThisTime($time){	
		if($time>0){ 	              			
			$time_array=getdate($time);
			return $time_array['mday']."-".$time_array['mon']."-".$time_array['year'];
		}else{
			return 0;
		}
	}

	function formatThisForDay($time){	
		if($time>0){ 	              			
			$time_array=getdate($time);
			
			return $time_array['mday']."-".$time_array['mon']."-".$time_array['year'];
		}else{
			return 0;
		}
	}

	function formatThisForTme($time){	
		if($time>0){ 	              			
			$time_array=getdate($time);
			
			return $time_array['hours']."-".$time_array['minutes'];
		}else{
			return 0;
		}
	}
	function formatThisForHr($time){	
		if($time>0){ 	              			
			$time_array=getdate($time);
			
			return $time_array['mday']."-".$time_array['mon']."-".$time_array['year']." at ".$time_array['hours'].":".$time_array['minutes'].":".$time_array['seconds'];
		}else{
			return 0;
		}
	}


	function getNewChar(){
	  $a=rand(1,3);
	  switch ($a){
	      case 1:              
	    $wrd=rand(48, 57);//numbers
	          break;
	      case 2:              
	    $wrd=rand(65, 90);//capital
	          break;
	      case 3:              
	    $wrd=rand(97, 122);//small
	          break;
	    }
	  return chr($wrd);
	}
	  
	function gnrtNewString($a,$b){
	    $wrd="";
	    $d=rand($a,$b);
	    for ($i=0; $i<$d; $i++){
	        $wrd.=getNewChar();
	    }
	    return $wrd;
	    // return str_replace("=", "", base64_encode($wrd));
	}

    function mkdire($lop){
    	if(is_dir($lop)){
    	}else{
    		mkdir($lop, 0777, true);
    	}
    	return $lop;
    }

    function saveData($name, $value){
		$_SESSION[$name]=encodePass($value);
		setCookieUp($name, $value, false);
	}

	function deleteData($name){
		$_SESSION[$name]="";
		deleteCookie($name);
	}

	function getData($name){
		$ref=(isset($_SESSION[$name]))?decodePass($_SESSION[$name]):"";
		$ref=(!empty($ref))?$ref:getCookie($name);
		return $ref;
	}

	function setCookieUp($name, $value, $time){		
		deleteCookie($name);
		$time=is_numeric($time)?time()+$time:time()+COOKIE_TIMEOUT;
		setcookie( $name, encodePass($value), $time, "/","", 0);
	}

	function getCookie($name){
		return (isset($_COOKIE[$name]))?decodePass($_COOKIE[$name]):"";
	}

	function deleteCookie($name){	
		setcookie( $name, "", 23, "/","", 0);
	}

	function encodePass($str){
		for ($i=0; $i < 6; $i++) { 
			$str=base64_encode($str);
		}
		return $str;
	}

	function decodePass($str){
		for ($i=0; $i < 6; $i++) { 
			$str=base64_decode($str);
		}
		return $str;
	}

?>