<?php

class Query_Services {

	public function Set_Parameter($query, $comodin, $valor)
	{
		return  str_replace($comodin,$valor, $query);	
	}
	
}
?>