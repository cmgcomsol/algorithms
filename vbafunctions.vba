rem function to split contents 
rem v =text or cell
rem s = character to split upton
rem l = position to return
Function splitter(v, s, l)
    result = Split(v, s)
    splitter = result(l)
End Function

