<?php

	function validation($field)
	{
		$field = htmlspecialchars($field, ENT_QUOTES);

		$field = trim($field);

		return $field;
	}

	function validateVariables(&$variable) 
	{
	    foreach($variable as &$value) 
	    {
	        if(!is_array($value)) 
	        {
	        	if(is_string($value))
	        	{
	        		$value = validation($value);
	        	}
	        }
	        else
	        { 
	        	validateVariables($value); 
	        }
	    }
	}

	function validationGlobal()
	{
		validateVariables($_POST);
	}