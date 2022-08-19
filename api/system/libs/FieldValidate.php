<?php 
	/**
	 * 
	 */
	class FieldValidate{
		var $form;
		var $validations = [];
		function __construct($form){
			$this->form = $form;
			foreach (array_keys($form) as $key) {
				$validations[$key] = [];
			}
		}

		function setFieldValidate($key, $validation, $value, $message){
			if(in_array($key, array_keys($validations))){
				array_push($validations[$key], [$validation, $value, $message]);
			}
			return $validations;
		}

		function checkFormValid(){
			$formValid = true;
			foreach($validations as $field_key => $field_value){
				foreach($field[$field_key] as $check){
					if(!$check[0]($value)){
						$formValid = false;
					}
				}
			}

			return $formValid;
		}
	}


	-----------------------
	class FieldValidate{
		var $form;
		var $validations = [];
		function __construct($form){
			$this->form = $form;
			foreach (array_keys($form) as $key) {
				$this->validations[$key] = [];
			}
		}

		function setFieldValidate($key, $validation, $message){
			if(in_array($key, array_keys($this->validations))){
				array_push($this->validations[$key], [$validation, $message]);
			}
		}

		function checkFormValid(){
			$formValid = true;
			$mensaje = '';
			foreach($this->validations as $field_key => $field_value){
				foreach($field_value as $check){
					if($check[0]($this->form[$field_key])){
						$formValid = false;
						$mensaje = $check[1];
					}
				}
				
			}

			return [$formValid, $mensaje];
		}
	}

$form = ['nombre' => 'chuy', 'correo'=>'correo@mail.com'];
$valid = new FieldValidate($form);
$valid->setFieldValidate('nombre', function($val){return $val == '';}, 'falta nombre');
$valid->setFieldValidate('nombre', function($val){return $val == 'chuy';}, 'no debe ser chuy');
var_dump($valid->checkFormValid());
?>