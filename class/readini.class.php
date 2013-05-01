<?

class readini {

Function ReadIniValue ($IniFile, $IniKey, $IniVar) {

$this->Ini_Key = "[".strtolower($IniKey)."]";
$this->Ini_Variable = strtolower($IniVar);

$this->Ini_File = file($IniFile);

unset($this->Ini_Value);

for($Ini_Rec=0; $Ini_Rec<sizeof($this->Ini_File); $Ini_Rec++) {
	$this->Ini_Temp = trim($this->Ini_File[$Ini_Rec]); 
	$this->Ini_Tmp = strtolower($this->Ini_Temp);

	if ( substr_count($this->Ini_Tmp, "[") > 0 ) $this->Ini_Ready = 0;	

	if ( $this->Ini_Tmp == $this->Ini_Key ) $this->Ini_Ready = 1;
		

        If ( (substr_count($this->Ini_Tmp, "[") == 0) && ($this->Ini_Ready == 1) ) {
		if (substr_count($this->Ini_Tmp, $this->Ini_Variable . "=") > 0) {
	  	     $this->Ini_Value = substr($this->Ini_Temp, strlen($this->Ini_Variable . "="));
		     return $this->Ini_Value;
		}
	}
} 

	if ( !$this->Ini_Value ) {
		return "ERROR .: Key: [<b>".strtoupper($IniKey)."</b>] or Variable: <b>".strtoupper($IniVar)."</b>, does not exist in <b>".strtoupper($IniFile)."</b> file !"; 
	}

} // end function

} // end class

?>