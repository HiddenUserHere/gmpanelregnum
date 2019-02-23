<?php

class View
{
	public $data = array();
	
	/**
	 * Adiciona o valor de uma variável com um nome
	 * dentro da lista de dados.
	 * 
	 * @param string $nome
	 * @param mixed $valor
	 * @return void
	 */
	 public function set( $name, $value )
	 {
		 $this->data[$name] = $value;
	 }
	 
	 /**
	 * Faz a mesma coisa que o método set, mas
	 * usando referências, permitindo que as
	 * alterações na variável fora da classe
	 * sejam realizadas também no valor
	 * armazenado na lista de dados.
	 *
	 * @param string $nome
	 * @param mixed $valor
	 * @return void
	 */
	public function bind( $name, &$value ) 
	{
		$this->data[$name] = &$value;
	}
	
	/**
	 * Recupera um valor armazenado na lista
	 * de dados através de seu nome.
	 *
	 * @param string $nome
	 * @return mixed
	 */
	 public function get( $name='' ) 
	 {
		if ($name == '') {
			return $this->data;
		}
		else {
			if (isset($this->data[$name]) && ($this->data[$name] != '')) {
				return $this->data[$name];
			}
			else {
				return '';
			}
		}
	}
	
	/**
	 * Renderiza um arquivo de visão específico com
	 * as variáveis armazenadas internamente. Como 
	 * resultado, envia conteúdo HTML para o navegador
	 * do usuário.
	 *
	 * @param string $arquivo
	 * @return void
	 */
	 public function render( $file, $bShowMenu = TRUE ) 
	 {	 
		if ((file_exists("view/Menu.php")) && $bShowMenu) {
			include "view/Menu.php";
		}
		 
		foreach($this->get() as $key => $item) {
			$$key = $item;
		}

		if (file_exists("view/{$file}.php")) {
			include "view/{$file}.php";
		}
	}
}
?>