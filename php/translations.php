<?php 

	/*THIs is a very large translation  array  that contains all translations;
	should i use numbers? translate[1]? or translate["create"]? or a fn? tarncslate(create)? i am lost yet i like oyin...wtf??am i writing? today is 4/2/2017.. should i break up or makeup? i am sure noone will see this so, fuck that shit. this is Aro wolfgang micheal. i want to make an habit of writing shit before every codes.. i want to change the world, yeah right..like Galvin Fucking Belson??.... :)*/


	function translate($word){
		global $translate_en;
		if(isset($translate_en[$word]))
		return $translate_en[$word];
		return "$word";
	}

	function translate_var($word, $array){
		global $translate_en;
		return str_from_array(translate($word), $array);
	}

    function str_from_array($string, $array){
        foreach ($array as $key => $value) {
            $string=str_replace("{{".$key."}}", "$value", $string);
        }
        return $string;
    }




 ?>