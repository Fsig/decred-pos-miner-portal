<?php
//Remote Address
if(isset($_SERVER['REMOTE_ADDR'])) $ip_address = $_SERVER['REMOTE_ADDR']; else $ip_address = "";
	
//Limit the words
function string_limit_words($string, $word_limit){
   $words = explode(' ', $string);
   return implode(' ', array_slice($words, 0, $word_limit));
}

//Clean the title
function clean_title($title){
	$newtitle = string_limit_words($title, 10);
	$urltitle = preg_replace('/[^a-z0-9]/i',' ', $newtitle);
	$newurltitle = str_replace(" ","-",$newtitle);
	
	return strtolower($newurltitle);
}

//Restore Titles
function restore_title($title) {
	$newtitle = str_replace("-", " ",$title);
	
	return ucfirst($newtitle);
}

//Check if one string contains another
function contains($contains, $container){
    return strpos(strtolower($container), strtolower($contains)) !== false;
}

//Clean the passed input to remove any malicous code
function clean_input($input){
	$clean = strip_tags($input);
	$clean = preg_replace('/[^a-zA-Z0-9 .@-]/i',' ', $clean);
	return $clean;
}

//Backspace last character in string
function backspace($string){
	return substr($string, 0, -1);
}

//Multiple empty check
function mempty(){
    foreach(func_get_args() as $arg)
        if(empty($arg))
            continue;
        else
            return false;
    return true;
}
?>
