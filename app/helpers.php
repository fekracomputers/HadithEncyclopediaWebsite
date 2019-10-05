<?php
/*
 * Helper function
 * Created By Mohamed Bauomey
 * */

 function slug_title($text){
        $_title = explode(' ' ,$text);
        $_title = implode('-',$_title);
        return $_title ;
 }
 function set_cookie($id){
    $minute = 60*60*24*360 ;
    $value = Cookie::get('books');
    if($value){
        if(!in_array($id ,$value)){
            array_push($value, $id);

            Cookie::queue('books', $value, $minute);
        }
    }else{
        $value[] = $id ;
        Cookie::queue('books', $value, $minute);
    }
}
 function set_hadith($id,$hd){
    $minute = 60*60*24*360 ;
    $value = Cookie::get('hadith');
    $num = count($value);
    if($num > 0){
        array_push($value,[$id => $hd]);
        Cookie::queue('hadith', $value, $minute);

    }else{
        $value[] = [$id => $hd] ;
        Cookie::queue('hadith', $value, $minute);
    }

 }
 function get_hadith($id){
    $hadith = Cookie::get('hadith');
    $num = count($hadith)-1;
    for($i =$num; $i > 0 ; $i--){
        foreach ($hadith[$i] as $row => $val){
            if($row == $id){
                return $val ;
            }
        }
    }
}
 function delete_cookie($id){
    $minute = 60*60*24*360 ;
     $books = Cookie::get('books');
     $val = [];
     foreach ($books as $row){
         if($row != $id){
             array_push($val,$row);
         }
     }
     Cookie::queue('books', $val, $minute);

 }
 function color_send($text){
   if(str_is('ثقة*',$text)){
       return $color = '#004f00';
   }elseif(str_is('صدوق*',$text)){
        return $color = "#009F00";
   }elseif (str_is('مقبول*',$text)){
       return $color = 'rgba(0, 190, 0, 0.57)' ;
   }elseif (str_is('ضعيف*',$text)){
       return $color = '#002BBE' ;
   }elseif(str_is('متهم*',$text) || str_is('بالكذب*',$text) || str_is('بالوضع*',$text)){
       return $color = '#BE000E' ;
   }elseif(str_is('متروك*',$text) || str_is('منكر*',$text)){
       return $color = '#BEB900' ;
   }elseif(str_is('صحابي*',$text)) {
       return $color = "#000";
   }elseif(str_is('مجهول*',$text)) {
       return $color = "#bebdbd";
   }
   else{
       return $color = '#3a8789' ;
   }
}
 function removeChar($text){

     $en = array("a", "b", "c", "d", "e", "f", "g", "h", "o" ,"'","or","and","--","-","/");
     $sec = strip_tags(str_replace($en , '',$text));
     return $sec ;
 }
 function removeSql($text){

     $en = array("'","--");
     $sec = strip_tags(str_replace($en , '',$text));
     return $sec ;
 }
 function removeHamz($text){
     $en = array("أ", "إ", "آ", "~");
     $sec = strip_tags(str_replace($en , 'ا',$text));
     return $sec ;

 }
 function removeTashkeel($text){
     $en = array("َ","ً","ُ","ٌ","ِ","ٍ","ْ","~","‘","ـ");
     $sec = str_replace($en , '',$text);
     return $sec ;
}
 function searchHadith($text){
     $en = array("+","-","/");
     $sec = str_replace($en , ' ',$text);
     $new = removeTashkeel(removeChar(removeHamz($sec)));
     return $new ;
 }
function check_type($text){
    if($text == 'book'){
        return ' كتاب - ' ;
    }elseif ($text == 'hadith'){
        return ' حديث - ' ;
    }elseif($text == 'author'){
        return ' المؤلف - ' ;
    }elseif($text =='narrators'){
        return ' الراوي - ' ;
    }else{
        return ' '.$text.' ' ;
    }
}
