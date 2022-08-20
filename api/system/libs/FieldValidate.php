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

// $form = ['nombre' => 'chuy', 'correo'=>'correo@mail.com'];
// $valid = new FieldValidate($form);
// $valid->setFieldValidate('nombre', $valid->EMPTY_FIELD($val), 'falta nombre');
// $valid->setFieldValidate('nombre', function($val){return $val == 'chuy';}, 'no debe ser chuy');
// var_dump($valid->checkFormValid());
?>