<?php

class Vrijeme {

		private $grad;
		private $temp;
		private $vrijeme;
		
        function __construct($g){
		

		$xmlDoc=new DOMDocument();
		$xmlDoc->load("http://vrijeme.hr/hrvatska_n.xml");
			
		$x=$xmlDoc->getElementsByTagName('Grad');
		//lookup all links from the xml file if length of q>0
			for($i=0; $i<($x->length); $i++) {
				$y=$x->item($i)->getElementsByTagName('GradIme');
				if ($y->item(0)->nodeType==1) {
				//find a link matching the search text
					if (!strcasecmp($y->item(0)->childNodes->item(0)->nodeValue, $g)) {
						$z=$x->item($i)->getElementsByTagName('Podatci');
						$zz=$z->item(0)->getElementsByTagName('Temp');	
						$this->temp = $zz->item(0)->childNodes->item(0)->nodeValue;
						$zg=$z->item(0)->getElementsByTagName('Vrijeme');	
						$this->vrijeme = $zg->item(0)->childNodes->item(0)->nodeValue;

					}
				}
			}
			
				$this->grad = $g;
			
		}
		
        function __toString () {
			$ret = "Grad: " . $this->grad . "<br/>" . "Temperatura: " . $this->temp . "<br/>";
			return $ret;
		}
		 function __set($name, $value) {
			$this->$name = $value;
		}
		 function __get($name) {
			return $this->$name;
		}
        
    }


			
//get the q parameter from URL
$q=$_GET["q"];
$response = new Vrijeme($q);
$response = $response . "Vrijeme: " . $response->vrijeme; //provjera za __get

echo $response; 

?>

