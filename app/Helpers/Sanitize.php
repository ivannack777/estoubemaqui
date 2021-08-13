<?php

namespace App\Helpers;



class Sanitize
{
	/**
		Sanitiza como string
		@var $this->string string que sera samotizada
		@var $modo string
		  inner: para limpar caracteres espaços em branco do inicio, final e interior da string
		  doubles: para limpar caracteres espaços em branco do inicio e final e espaços caractes duplicados no interior da string
		  celar: para limpar caracteres que não são letras ou numeros da string
		  regex: para limpar caracteres usando um regex customizado na string
		@var $regex string um regex customizado
	*/
	private $stringing;
	public function __construct($str){
		$this->string = $str;
	}

	public function string($modo=null, $regex=null){
		if(!empty($this->string)){
			$this->string = trim($this->string);
			switch ($modo) {
				case 'inner':
					$this->string = preg_replace('/[\s\t\r\n]+/', '', $this->string);
					break;
				case 'doubles':
					$this->string = preg_replace('/[\s\t\r\n]+/', ' ', $this->string);
					break;
				case 'clear':
					$this->string = preg_replace('/[^\d\w]+/', '', $this->string);
					break;
				case 'regex':
					if($regex) $this->string = preg_replace($regex, '', $this->string);
					else $this->string = false;
					break;
				default:
					$this->string = trim($this->string);
					break;
			}
		}
		self::transcode();
		return $this->string;
	}

	public function transcode($space=false){
		$m = ['á','ã','à','ä','â', 'é','ẽ','è','ë','ê', 'í','ĩ','ì','ï','î', 'ó','õ','ò','ö','ô', 'ú','ũ','ù','ü','û'];
		$r = ['a','a','a','a','a', 'e','e','e','e','e', 'i','i','i','i','i', 'o','o','o','o','o', 'u','u','u','u','u'];
		if($space){
			array_push($m,' ');
			array_push($r,'-');
		}
		return $this->string = str_replace($m, $r, $this->string);
	}

	public function tolow(){
		return strtolower($this->string);
	}
	public function toup(){
		return strtoupper($this->string);
	}
	

	public function name($modo=null){
		if(!empty($this->string)){
			$this->string = trim($this->string);
			$this->string = preg_replace('/[\s\t\r\n]+/', ' ', $this->string);
			switch ($modo) {
				case 'ucfirst':
					$this->string = strtolower($this->string);
					$this->string = ucfirst($this->string);
					break;
				case 'ucwords':
					$this->string = strtolower($this->string);
					$this->string = ucwords($this->string);
					$this->string = str_replace(' E ', ' e ', $this->string);
					$this->string = str_replace(' Da ', ' da ', $this->string);
					$this->string = str_replace(' Das ', ' das ', $this->string);
					$this->string = str_replace(' De ', ' de ', $this->string);
					$this->string = str_replace(' Do ', ' do ', $this->string);
					$this->string = str_replace(' Dos ', ' dos ', $this->string);
					$this->string = str_replace(' Of ', ' of ', $this->string);
					$this->string = str_replace(' Von ', ' von ', $this->string);
					$this->string = str_replace(' Del ', ' del ', $this->string);
					break;
				default:
					$this->string = $this->string;
					break;
			}
		}
		return $this->string;
	}

	public function date(){
		if(!empty($this->string)){
			$this->string = preg_replace('/[^\d]+/', '-', $this->string);
			// $this->string = str_replace(['/','.',' '], '-', $this->string);
		}
		return $this->string;
	}

	public function email(){
		if(!empty($this->string)){
			$this->string = preg_replace('/\s+/', '', $this->string);
		}
		return $this->string;
	}

	public function phone(){
		if(!empty($this->string)){
			$this->string = preg_replace('/[^0-9+]+/', '', $this->string);
		}
		return $this->string;
	}

	public function integer(){
		$this->string = preg_replace('/[^0-9]+/', '', $this->string);
		if(!empty($this->string)){
			return intval($this->string);
		}
		return null;
	}

	public function number($modo=null, $regex=null){
		if(!empty($this->string)){
			switch ($modo) {
				case 'inner':
					$this->string = trim($this->string);
					$this->string = preg_replace('/[\s\t\r\n]+/', ' ', $this->string);
					break;
				case 'outer':
					$this->string = trim($this->string);
					break;
				case 'clear':
					$this->string = preg_replace('/[^\d\w]+/', '', $this->string);
					break;
				case 'regex':
					if($regex) $this->string = preg_replace($regex, '', $this->string);
					else $this->string = false;
					break;
				default:
					$this->string = trim($this->string);
					break;
			}
		}
		return $this->string;
	}

	public function decimal($round=false, $toString=false){
		if(!empty($this->string)){
			$this->string = str_replace(',', '.', $this->string);
			$this->string = preg_replace('/[^0-9.]+/', '', $this->string);
			if($round && is_numeric($round)){
				$this->string = round($this->string, intval($round) );
			}
			elseif($round === true){
				$this->string = round($this->string);
			}

			if($toString){
				$this->string = (string)$this->string;
			}

		}

		return $this->string;
	}

	public function array($array, $method, $param1=null, $param2=null){

		if(is_array($array)){
			foreach ($array as $key => $value) {
				if($param1) $retornoArr[$key] = $this->$method($value, $param1);
				elseif($param2) $retornoArr[$key] = $this->$method($value, $param1, $param2);
				else $retornoArr[$key] = $this->$method($value);

			}
			return $retornoArr;
		}
		return $array;
	}

}
