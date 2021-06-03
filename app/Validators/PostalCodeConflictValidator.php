<?php 
namespace App\Validators; 

use App\Models\SalesArea;

class PostalCodeConflictValidator 
{
   

    public function tab_generator(int $begin , int $end) {
        $tab = array();
        for($x = $begin ; $x <=  $end ; $x++) {
	        $tab[] = $x;
        }
        return $tab;
    }

    public function  transform ($strcode){
        $tab_code = array();
        if(str_contains($strcode, '*')){
            $pos = strpos($strcode,'*');
            $begin = substr($strcode, 0, $pos).str_repeat ('0', 5-$pos);
            $end = substr($strcode, 0, $pos).str_repeat ('9', 5-$pos);
            $tab_code = $this->tab_generator((int)$begin, (int)$end);
        }
        else {
            $tab_code[] = (int)$strcode;
        }
        return $tab_code ;
    }

    public function compare ( $old ,  $new) {
        $old1 = $this->transform($old);
        $new1 = $this->transform($new);
        $intersection = array_intersect($old1, $new1);
        return  $intersection;
    }

    public function Validate($attribute, $value)
    {
        $areas_old = SalesArea::all();
        $conflics = array();

        foreach( $areas_old as $area){
            $old_codes = $area->postalCodes;
            foreach ($old_codes as $old){
                $conf = $this->compare($old->code, $value);
                $conflics = array_merge($conflics,$conf);
            }

            return  (count($conflics) == 0) ;

        }

    }
}