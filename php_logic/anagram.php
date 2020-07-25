<?php

echo checkAnagram("anagram","nagaram")."---<br/>";
echo checkAnagram("anagram","nagram")."---<br/>";

echo isAnagram("anagram","nagaram")."---<br/>";
echo isAnagram("anagram","nagram")."---<br/>";


function isAnagram($sourceString,$targetString){
    return count_chars(strtolower($sourceString), 1)
            == count_chars(strtolower($targetString), 1); 
}


function checkAnagram($sourceString,$targetString){
    
    $sourceString = strtolower($sourceString);
    $targetString = strtolower($targetString);
    
    if(!strlen(trim($sourceString))){
        return false;
    }
    if(!strlen(trim($targetString))){
        return false;
    }
    
    if(strlen($sourceString) != strlen($targetString)) {
        return false;
    }
    
    $t1 = array();
    $t2 = array();
    
    
    for($i=0; $i< strlen($sourceString); $i++ ){        
        $t1[$sourceString[$i]]++;
    }
    
    for($i=0; $i< strlen($targetString); $i++ ){
        $t2[$targetString[$i]]++;
    }
    
    ksort($t1);
    ksort($t2);
    
    if(count($t1) != count($t2)) {
        return false;
    }
    
    for($i=0 ; $i<count($t1); $i++){
        if ($t1[$sourceString[i]] != $t2[$sourceString[i]]) {
            return false;
        }
    }
    
    return true;
}


