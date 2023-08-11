<?php

namespace HINDI;


function DigitWords($number,$digit){
	
	if ($number == 0){			
        return "";
	}            
    return $digit[$number];
}
    
function HundredWords($number,$digit){
	
    if ($number == 0){		        
        return "";
    }
   
    $m = intval($number / 100);
    return $digit[$m] . " सौ " . $digit[intval($number % 100)];
}

function ThousandWords($number,$digit){
	
    if($number == 0 ){
        return "" ;
    }
   
    $m = intval($number / 1000);
    return $digit[$m] . " हजार " . HundredWords(intval($number % 1000),$digit);
}

function LakhWords($number,$digit){
	
    if($number == 0 ){
        return "";
    }
   
    $m = intval($number / 100000);
    
    return $digit[$m] . " लाख " . ThousandWords(intval($number % 100000),$digit);
}

function CroreWords($number,$digit){

    if($number == 0 ){
        return "";        
    }
   
    $m = intval($number / 10000000);
    return $digit[$m] . " करोड़ " . LakhWords(intval($number % 10000000),$digit);
}

function NumToWordsHindi($number){
    // will convert numbers to indian numbers in words upto 1 crore
   	
	$digit=[];

	$digit[0] = "";
		$digit[1] ='एक ';
	$digit[2] ='दो ';
	$digit[3] ='तीन ';
	$digit[4] ='चार ';
	$digit[5] ='पाञ्च ';
	$digit[6] ='छे ';
	$digit[7] ='सात ';
	$digit[8] ='आठ ';
	$digit[9] ='नौ ';
	$digit[10] ='दस ';
	$digit[11] ='ग्यारह ';
	$digit[12] ='बारह';
	$digit[13] ='तेरह ';
	$digit[14] ='चौदह ';
	$digit[15] ='पन्द्रह ';
	$digit[16] ='सोलह ';
	$digit[17] ='सत्रह ';
	$digit[18] ='अठारह ';
	$digit[19] ='उन्नीस ';
	$digit[20] ='बीस ';
	$digit[21] ='इक्कीस ';
	$digit[22] ='बाईस ';
	$digit[23] ='तेईस ';
	$digit[24] ='चौबीस ';
	$digit[25] ='पच्चीस ';
	$digit[26] ='छब्बीस ';
	$digit[27] ='सत्तइस ';
	$digit[28] ='अठ्ठाइस ';
	$digit[29] ='उन्तीस ';
	$digit[30] ='तीस ';
	$digit[31] ='इकतीस ';
	$digit[32] ='बत्तीस ';
	$digit[33] ='तेतीस ';
	$digit[34] ='चौतीस ';
	$digit[35] ='पैंतीस  ';
	$digit[36] ='छत्तीस ';
	$digit[37] ='सैंतीस ';
	$digit[38] ='अड़तीस ';
	$digit[39] ='उन्तालीस ';
	$digit[40] ='चालीस ';
	$digit[41] ='इकतालीस ';
	$digit[42] ='ब्यालीस ';
	$digit[43] ='तेतालीस ';
	$digit[44] ='चौवालीस ';
	$digit[45] ='पैंतालीस ';
	$digit[46] ='छियालीस ';
	$digit[47] ='सैतालीस ';
	$digit[48] ='अड़तालीस ';
	$digit[49] ='उनंचास ';
	$digit[50] ='पचास ';
	$digit[51] ='इक्यावन ';
	$digit[52] ='बावन ';
	$digit[53] ='तिरेपन ';
	$digit[54] ='चौअन ';
	$digit[55] ='पचपन ';
	$digit[56] ='छप्पन ';
	$digit[57] ='सत्तावन ';
	$digit[58] ='अठ्ठावन ';
	$digit[59] ='उनसठ ';
	$digit[60] ='साठ ';
	$digit[61] ='इकसठ';
	$digit[62] ='बासठ ';
	$digit[63] ='तिरसठ';
	$digit[64] ='चौंसठ ';
	$digit[65] ='पैंसठ ';
	$digit[66] ='छियासठ';
	$digit[67] ='सरसठ ';
	$digit[68] ='अरसठ ';
	$digit[69] ='उनहत्तर ';
	$digit[70] ='सत्तर ';
	$digit[71] ='इकहत्तर ';
	$digit[72] ='बहत्तर ';
	$digit[73] ='तिहत्तर ';
	$digit[74] ='चौहत्तर ';
	$digit[75] ='पिचत्तर ';
	$digit[76] ='छिहत्तर ';
	$digit[77] ='सतत्तर ';
	$digit[78] ='अठत्तर ';
	$digit[79] ='उनासी ';
	$digit[80] ='अस्सी ';
	$digit[81] ='इक्यासी ';
	$digit[82] ='ब्यासी ';
	$digit[83] ='तिरासी ';
	$digit[84] ='चौरासी ';
	$digit[85] ='पिचासी ';
	$digit[86] ='छियासी';
	$digit[87] ='सतासी ';
	$digit[88] ='अठासी ';
	$digit[89] ='नवासी ';
	$digit[90] ='नब्बे ';
	$digit[91] ='इक्यानवे ';
	$digit[92] ='बानवे ';
	$digit[93] ='तिरानवे ';
	$digit[94] ='चौरानवे ';
	$digit[95] ='पिञ्चानवे ';
	$digit[96] ='छियानवे ';
	$digit[97] ='सत्तानवे ';
	$digit[98] ='अठ्ठानवे ';
	$digit[99] ='निन्यानवे ';

    
 
    if($number < 100){
    	
        return DigitWords($number,$digit);
        
    }else if ($number < 1000 ){
        return HundredWords($number,$digit);
        
    }else if($number >= 1000 && $number < 100000 ){
        return ThousandWords($number,$digit);
        
    }else if($number >= 100000 && $number < 10000000 ){
        return LakhWords($number,$digit);
        
    }else if($number >= 10000000 && $number < 1000000000 ){
        return CroreWords($number,$digit);
        
    }else{
    	return "{OUT OF BAND}";	
    }
 
    
 
}


function ConvertNumToWords(){
	echo "Hello";
	echo "<br/>".NumToWords(1);
	echo "<br/>".NumToWords(12);
	echo "<br/>".NumToWords(123);
	echo "<br/>".NumToWords(1234);
	echo "<br/>".NumToWords(12345);
	echo "<br/>".NumToWords(123456);
	echo "<br/>".NumToWords(1234567);
	echo "<br/>".NumToWords(12345678);
	echo "<br/>".NumToWords(123456789);
	echo "<br/>".NumToWords(1234567890);
 
}


//ConvertNumToWords();

?>
