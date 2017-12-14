<?php 

namespace App\Http\Libraries;

class Convert {

	// convert serializeArray form javascript to array [key] => value
	public static function to_pairs($data = array()){
		$newdata = [];
        foreach($data as $key){
        	$last_two_characters = substr( $key['name'], -2 );

            preg_match_all("/\[(\d+)\]/", $key['name'], $matches); // handle flow index type = random

        	if($last_two_characters == '[]'){
                // handle flow index type = random
                if(!empty($matches[0])){
                    $len = -2 - 2 - strlen($matches[1][0]);
                    $newName = substr( $key['name'], 0, $len );

                    $newdata[$newName][$matches[1][0]][] = $key['value'];

                // handle input type = multi value
                }else{
        		    $newName = substr( $key['name'], 0, -2 );
        		    $newdata[$newName][] = $key['value'];
                }
                
        	}else{
            	$newdata[$key['name']] = $key['value'];
        	}
        }

        return $newdata;
	}

    public static function fix_flow_index($index, $data = array()){
        $collect = collect($data);

        if($collect->contains($index)){
            $max = $collect->max();
            $max_index = $collect->search($max);

            $collect->forget($max_index);
        }else{
            $collect = $collect->map(function($value, $key) use ($index){ if($value > $index) return $value - 1; else return $value; });
        }

        return $collect->values()->all();
    }
}