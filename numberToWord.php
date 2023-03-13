<?php


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
    return $digit[$m] . " HUNDRED " . $digit[intval($number % 100)];
}

function ThousandWords($number,$digit){
	
    if($number == 0 ){
        return "" ;
    }
   
    $m = intval($number / 1000);
    return $digit[$m] . " THOUSAND " . HundredWords(intval($number % 1000),$digit);
}

function LakhWords($number,$digit){
	
    if($number == 0 ){
        return "";
    }
   
    $m = intval($number / 100000);
    
    return $digit[$m] . " LAKH " . ThousandWords(intval($number % 100000),$digit);
}

function CroreWords($number,$digit){

    if($number == 0 ){
        return "";        
    }
   
    $m = intval($number / 10000000);
    return $digit[$m] . " CRORE " . LakhWords(intval($number % 10000000),$digit);
}

function NumToWords($number){
    // will convert numbers to indian numbers in words upto 1 crore
   	
	$digit=[];

	$digit[0] = "";
	$digit[1] = "ONE";
	$digit[2] = "TWO";
	$digit[3] = "THREE";
	$digit[4] = "FOUR";
	$digit[5] = "FIVE";
	$digit[6] = "SIX";
	$digit[7] = "SEVEN";
	$digit[8] = "EIGHT";
	$digit[9] = "NINE";
	$digit[10] = "TEN";
	$digit[11] = "ELEVEN";
	$digit[12] = "TWELVE";
	$digit[13] = "THIRTEEN";
	$digit[14] = "FOURTEEN";
	$digit[15] = "FIFTEEN";
	$digit[16] = "SIXTEEN";
	$digit[17] = "SEVENTEEN";
	$digit[18] = "EIGHTEEN";
	$digit[19] = "NINETEEN";
	$digit[20] = "TWENTY";
	$digit[21] = "TWENTY ONE";
	$digit[22] = "TWENTY TWO";
	$digit[23] = "TWENTY THREE";
	$digit[24] = "TWENTY FOUR";
	$digit[25] = "TWENTY FIVE";
	$digit[26] = "TWENTY SIX";
	$digit[27] = "TWENTY SEVEN";
	$digit[28] = "TWENTY EIGHT";
	$digit[29] = "TWENTY NINE";
	$digit[30] = "THIRTY";
	$digit[31] = "THIRTY ONE";
	$digit[32] = "THIRTY TWO";
	$digit[33] = "THIRTY THREE";
	$digit[34] = "THIRTY FOUR";
	$digit[35] = "THIRTY FIVE";
	$digit[36] = "THIRTY SIX";
	$digit[37] = "THIRTY SEVEN";
	$digit[38] = "THIRTY EIGHT";
	$digit[39] = "THIRTY NINE";
	$digit[40] = "FORTY";
	$digit[41] = "FORTY ONE";
	$digit[42] = "FORTY TWO";
	$digit[43] = "FORTY THREE";
	$digit[44] = "FORTY FOUR";
	$digit[45] = "FORTY FIVE";
	$digit[46] = "FORTY SIX";
	$digit[47] = "FORTY SEVEN";
	$digit[48] = "FORTY EIGHT";
	$digit[49] = "FORTY NINE";
	$digit[50] = "FIFTY";
	$digit[51] = "FIFTY ONE";
	$digit[52] = "FIFTY TWO";
	$digit[53] = "FIFTY THREE";
	$digit[54] = "FIFTY FOUR";
	$digit[55] = "FIFTY FIVE";
	$digit[56] = "FIFTY SIX";
	$digit[57] = "FIFTY SEVEN";
	$digit[58] = "FIFTY EIGHT";
	$digit[59] = "FIFTY NINE";
	$digit[60] = "SIXTY";
	$digit[61] = "SIXTY ONE";
	$digit[62] = "SIXTY TWO";
	$digit[63] = "SIXTY THREE";
	$digit[64] = "SIXTY FOUR";
	$digit[65] = "SIXTY FIVE";
	$digit[66] = "SIXTY SIX";
	$digit[67] = "SIXTY SEVEN";
	$digit[68] = "SIXTY EIGHT";
	$digit[69] = "SIXTY NINE";
	$digit[70] = "SEVENTY";
	$digit[71] = "SEVENTY ONE";
	$digit[72] = "SEVENTY TWO";
	$digit[73] = "SEVENTY THREE";
	$digit[74] = "SEVENTY FOUR";;
	$digit[75] = "SEVENTY FIVE";
	$digit[76] = "SEVENTY SIX";
	$digit[77] = "SEVENTY SEVEN";
	$digit[78] = "SEVENTY EIGHT";
	$digit[79] = "SEVENTY NINE";
	$digit[80] = "EIGHTY";
	$digit[81] = "EIGHTY ONE";
	$digit[82] = "EIGHTY TWO";
	$digit[83] = "EIGHTY THREE";
	$digit[84] = "EIGHTY FOUR";
	$digit[85] = "EIGHTY FIVE";
	$digit[86] = "EIGHTY SIX";
	$digit[87] = "EIGHTY SEVEN";
	$digit[88] = "EIGHTY EIGHT";
	$digit[89] = "EIGHTY NINE";
	$digit[90] = "NINETY";
	$digit[91] = "NINETY ONE";
	$digit[92] = "NINETY TWO";
	$digit[93] = "NINETY THREE";
	$digit[94] = "NINETY FOUR";
	$digit[95] = "NINETY FIVE";
	$digit[96] = "NINETY SIX";
	$digit[97] = "NINETY SEVEN";
	$digit[98] = "NINETY EIGHT";
	$digit[99] = "NINETY-NINE";
    
 
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


ConvertNumToWords();

?>
