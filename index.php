<?php

//File .txt address
$file = "unsorted-names-list.txt";
//Declaring file object
$parts = new SplFileObject($file);
foreach ($parts as $line) {
    $lines[]=$line;
}
$json=json_encode($lines);
$names = json_decode($json);
//Function to short text file by names (first or last name)
function sortnames(&$array){
  $s = $r = array();
  foreach($array as $k => $v){
     $s[$k] = substr($v, (strrpos($v, ' ')+1));
  }
  asort($s, SORT_NATURAL | SORT_FLAG_CASE);
  foreach($s as $k => $v){
    $r[$k] = $array[$k];
  }
  $array = $r;
}
sortnames($names);
//Shows the results to screen 
$a=""; $no=1;
foreach($names as $k => $v){
  echo $v." <br>";
  if($no == 1){
	$a = $v."\r\n";	  
  }else{
	$a = $a."".$v;  
  }
  $no++;
}
//Save the result to .txt file
$fp = fopen("sorted-names-list.txt","wb");
fwrite($fp,$a);
fclose($fp);

?>