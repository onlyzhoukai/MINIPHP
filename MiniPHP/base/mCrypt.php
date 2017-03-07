<?php
class mCrypt{
	static private $k1 = array(74,220,106,118,181,92,115,188,208,46,244,113,117,109,223,233,93,8,227,66,0,167,197,129,71,171,249,145,100,125,139,64,112,55,224,38,211,217,42,130,40,57,47,144,121,25,206,39,120,23,33,122,169,102,162,242,221,164,254,45,246,225,114,73,146,43,90,237,161,133,194,80,37,252,34,168,7,123,201,248,155,231,148,235,116,142,62,41,85,198,95,36,111,141,143,5,226,202,76,58,79,175,83,124,207,245,228,81,94,107,13,158,110,11,214,166,18,138,48,67,160,4,218,156,26,131,35,29,229,187,253,135,173,179,22,243,200,222,88,30,140,191,216,32,136,119,51,87,84,54,77,69,126,75,199,177,89,17,189,72,163,196,185,134,219,9,203,97,19,230,24,132,209,239,255,61,44,215,14,210,241,182,3,154,170,193,99,21,53,159,16,2,250,60,183,153,186,52,86,68,236,178,180,213,1,184,56,251,91,12,212,149,20,147,65,174,238,150,6,59,128,172,15,234,82,152,78,137,165,127,104,190,204,240,105,205,108,50,10,176,232,98,96,70,157,151,247,192,27,63,49,28,103,101,31,195);
	static private $k2 = array(20,204,191,182,121,95,218,76,17,165,238,113,209,110,178,222,190,157,116,168,212,187,134,49,170,45,124,248,251,127,139,254,143,50,74,126,91,72,35,47,40,87,38,65,176,59,9,42,118,250,237,146,197,188,149,33,206,41,99,219,193,175,86,249,31,214,19,119,199,151,243,24,159,63,0,153,98,150,226,100,71,107,224,102,148,88,198,147,138,156,66,208,5,16,108,90,242,167,241,186,28,253,53,252,230,234,2,109,236,13,112,92,32,11,62,6,84,12,3,145,48,44,51,77,103,29,152,229,220,23,39,125,171,69,163,131,144,227,117,30,140,93,85,94,43,27,64,213,82,211,217,245,225,195,183,80,123,244,111,189,120,68,54,160,57,228,115,21,75,52,184,25,221,132,215,101,239,155,201,133,202,4,181,194,205,162,196,129,7,158,231,141,247,185,70,255,161,22,89,154,136,78,97,166,232,235,46,104,8,172,179,36,210,203,114,177,142,37,122,164,1,56,137,14,34,61,96,18,106,128,169,81,240,15,223,83,200,67,216,173,233,180,55,135,10,105,60,246,79,26,192,207,73,130,58,174);
	static public function encode($s,&$r=""){
		for($i=0;$i<strlen($s);$i++){
			$r .= chr(self::$k1[255-ord($s{$i})]);
		}
		return self::_base64_encode($r);
	}
	static public function decode($s,&$r=""){
		$s = self::_base64_decode($s);
		for($i=0;$i<strlen($s);$i++){
			$r .= chr(255-self::$k2[ord($s{$i})]);
		}
		return $r;
	}
    static private function _base64_encode($s) {
        $res = base64_encode($s);
        return str_replace(array('+','/','='),array('_','-',''),$res);$res;
    }
    static private function _base64_decode($s) {
        $res = str_replace(array('_','-'),array('+','/'),$s).substr('===', 0, strlen($s) % 4);
        return base64_decode($res);
    }
	static public function key(){
		$a = array();
		for($i=0;$i<256;$i++){
			$a[] = $i;
		}
		shuffle($a);
		$b = array_flip($a);
		ksort($b);
		return array("k1"=>implode(",",$a),"k2"=>implode(",",$b));
	}
}