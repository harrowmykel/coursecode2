<?php 
	session_start();

    include '../php/apiquery.php';
    include '../php/php-export-data-master/php-export-data.class.php';
	include '../php/adGen.php';
	include '../php/allneed.php';
	// include '../api/db_vr.php';
	include '../php/db.php';
	include '../php/fn.php';
	include '../php/translations.php';
	include '../php/trans/en.php';
	include '../php/trans/de.php';
	include '../php/trans/fr.php';

	$folder	= '../php/php-markdown-1.0.1n';
	require($folder.'/markdown.php');

	$newMess=getNewMsgs();


//52433
?>