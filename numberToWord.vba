Global digit(99) As String
  
Function DigitWords(number)
    If number = 0 Then
        DigitWords = ""
        Exit Function
    End If
    DigitWords = digit(number)
End Function

Function HundredWords(number)
    If number = 0 Then
        HundredWords = ""
        Exit Function
    End If
    
    Let m = Int(number / 100)
    HundredWords = digit(m) + " HUNDRED " + digit(number Mod 100)
End Function

Function ThousandWords(number)
    If number = 0 Then
        ThousandWords = ""
        Exit Function
    End If
    
    Let m = Int(number / 1000)
    ThousandWords = digit(m) + " THOUSAND " + HundredWords(number Mod 1000)
End Function

Function LakhWords(number)
    If number = 0 Then
        LakhWords = ""
        Exit Function
    End If
    
    Let m = Int(number / 100000)
    LakhWords = digit(m) + " LAKH " + ThousandWords(number Mod 100000)
End Function

Function CroreWords(number)
    If number = 0 Then
        CroreWords = ""
        Exit Function
    End If
    
    Let m = Int(number / 10000000)
    CroreWords = digit(m) + " CRORE " + LakhWords(number Mod 10000000)
End Function

Function NumToWords(number)
    Rem will convert numbers to indian numbers in words upto 1 crore
    
    digit(0) = ""
    digit(1) = "ONE"
    digit(2) = "TWO"
    digit(3) = "THREE"
    digit(4) = "FOUR"
    digit(5) = "FIVE"
    digit(6) = "SIX"
    digit(7) = "SEVEN"
    digit(8) = "EIGHT"
    digit(9) = "NINE"
    digit(10) = "TEN"
    digit(11) = "ELEVEN"
    digit(12) = "TWELVE"
    digit(13) = "THIRTEEN"
    digit(14) = "FOURTEEN"
    digit(15) = "FIFTEEN"
    digit(16) = "SIXTEEN"
    digit(17) = "SEVENTEEN"
    digit(18) = "EIGHTEEN"
    digit(19) = "NINETEEN"
    digit(20) = "TWENTY"
    digit(21) = "TWENTY ONE"
    digit(22) = "TWENTY TWO"
    digit(23) = "TWENTY THREE"
    digit(24) = "TWENTY FOUR"
    digit(25) = "TWENTY FIVE"
    digit(26) = "TWENTY SIX"
    digit(27) = "TWENTY SEVEN"
    digit(28) = "TWENTY EIGHT"
    digit(29) = "TWENTY NINE"
    digit(30) = "THIRTY"
    digit(31) = "THIRTY ONE"
    digit(32) = "THIRTY TWO"
    digit(33) = "THIRTY THREE"
    digit(34) = "THIRTY FOUR"
    digit(35) = "THIRTY FIVE"
    digit(36) = "THIRTY SIX"
    digit(37) = "THIRTY SEVEN"
    digit(38) = "THIRTY EIGHT"
    digit(39) = "THIRTY NINE"
    digit(40) = "FORTY"
    digit(41) = "FORTY ONE"
    digit(42) = "FORTY TWO"
    digit(43) = "FORTY THREE"
    digit(44) = "FORTY FOUR"
    digit(45) = "FORTY FIVE"
    digit(46) = "FORTY SIX"
    digit(47) = "FORTY SEVEN"
    digit(48) = "FORTY EIGHT"
    digit(49) = "FORTY NINE"
    digit(50) = "FIFTY"
    digit(51) = "FIFTY ONE"
    digit(52) = "FIFTY TWO"
    digit(53) = "FIFTY THREE"
    digit(54) = "FIFTY FOUR"
    digit(55) = "FIFTY FIVE"
    digit(56) = "FIFTY SIX"
    digit(57) = "FIFTY SEVEN"
    digit(58) = "FIFTY EIGHT"
    digit(59) = "FIFTY NINE"
    digit(60) = "SIXTY"
    digit(61) = "SIXTY ONE"
    digit(62) = "SIXTY TWO"
    digit(63) = "SIXTY THREE"
    digit(64) = "SIXTY FOUR"
    digit(65) = "SIXTY FIVE"
    digit(66) = "SIXTY SIX"
    digit(67) = "SIXTY SEVEN"
    digit(68) = "SIXTY EIGHT"
    digit(69) = "SIXTY NINE"
    digit(70) = "SEVENTY"
    digit(71) = "SEVENTY ONE"
    digit(72) = "SEVENTY TWO"
    digit(73) = "SEVENTY THREE"
    digit(74) = "SEVENTY FOUR"
    digit(75) = "SEVENTY FIVE"
    digit(76) = "SEVENTY SIX"
    digit(77) = "SEVENTY SEVEN"
    digit(78) = "SEVENTY EIGHT"
    digit(79) = "SEVENTY NINE"
    digit(80) = "EIGHTY"
    digit(81) = "EIGHTY ONE"
    digit(82) = "EIGHTY TWO"
    digit(83) = "EIGHTY THREE"
    digit(84) = "EIGHTY FOUR"
    digit(85) = "EIGHTY FIVE"
    digit(86) = "EIGHTY SIX"
    digit(87) = "EIGHTY SEVEN"
    digit(88) = "EIGHTY EIGHT"
    digit(89) = "EIGHTY NINE"
    digit(90) = "NINETY"
    digit(91) = "NINETY ONE"
    digit(92) = "NINETY TWO"
    digit(93) = "NINETY THREE"
    digit(94) = "NINETY FOUR"
    digit(95) = "NINETY FIVE"
    digit(96) = "NINETY SIX"
    digit(97) = "NINETY SEVEN"
    digit(98) = "NINETY EIGHT"
    digit(99) = "NINETY-NINE"
    Rem digit(100) = "HUNDRED"
 
    If (number < 100) Then
        NumToWords = DigitWords(number)
        Exit Function
    ElseIf number < 1000 Then
        NumToWords = HundredWords(number)
        Exit Function
    ElseIf number >= 1000 And number < 100000 Then
        NumToWords = ThousandWords(number)
        Exit Function
    ElseIf number >= 100000 And number < 10000000 Then
        NumToWords = LakhWords(number)
        Exit Function
    ElseIf number >= 10000000 And number < 1000000000 Then
        NumToWords = CroreWords(number)
        Exit Function
    End If
 
    NumToWords = "{OUT OF BAND}"
 
End Function
Sub ConvertNumToWords()
 MsgBox "Hello"
 MsgBox NumToWords(1)
 
End Sub
