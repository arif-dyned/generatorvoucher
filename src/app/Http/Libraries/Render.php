<?php 


namespace App\Http\Libraries;

class Render {

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    | describe all function for rendering view or text
    |
    | $data['id'] ===> describe {model} id
    | $data[$name. 'id'] ===> describe {model} {model}_name
    | $data['content_table'] ===> describe rendered table
    |
    | $name ===> name of target table / modal / form
    | $child ====> if has child value is false or true
    |
    |
    */

    // render table
	public static function table($data = array(), $table_name){
		return view('DSA.data.table_'.$table_name, ['data' => $data]);
	}

    // render modal
    public static function modal($data = array(), $modal_name){
        return view('DSA.data.modal-'.$modal_name, ['data' => $data]);
    }

    // render tab
    public static function tab($data = array(), $tab_name){
        return view('DSA.tab-'.$tab_name, ['data' => $data]);
    }

    // render data
    public static function data($data = array(), $data_name){
        return view('DSA.data.data-'.$data_name, ['data' => $data]);
    }

    // render javascript for ajax create function
    public static function script_create($data = array(), $name, $child = false){
        // if dont has child -> append the new input id and name to <select> tag of related model
        if(!$child){
            $script = "$('form#list_".$name."').find('select#".$name."_id').append('<option value=\"".$data['id']."\">".$data[$name.'_id']."</option>'); $('#modal_".$name."').modal('hide'); $('form#list_".$name."').find('select#".$name."_id').find('[value=".$data['id']."]').prop('selected', 'selected'); show_button( '".$name."' );";
        // if has child -> append some new input to <table> tag of related model
        }else{
            $script = "if($('#table_".$name."').find('tbody tr:first td').length > 1){ $('#table_".$name."').find('tbody').append('".$data['content_table']."'); }else{ $('#table_".$name."').find('tbody').html('".$data['content_table']."'); }";
            $script .= "hide_form( '".$name."' );";
        }

        $script .= self::script_clear_input($name);

        return $script;
    }

    // render javascript for ajax update function
    public static function script_update($data = array(), $name, $child = false){
        // if dont has child -> change new input name to <select> tag of related model
        if(!$child){
            $script = "$('form#list_".$name."').find('select#".$name."_id option:selected').text('".$data[$name.'_id']."');$('#modal_".$name."').modal('hide'); ";
        }else{
            $script = "i = 0; $.each(".$data.", function(key, value){ if(i != 0){ $('#table_".$name."').find('tbody td[id=".$data->id."]').parent().children().eq(i + 1).text(value); } i++; });";
        }

        $script .= self::script_clear_input($name);

        return $script;
    }

    // render javascript for ajax delete function
    public static function script_delete($name, $child = '', $id = ''){
        // if dont has child -> remove selected <select> tag of related model
        if(!$child){
            $script = "$('form#list_".$name."').find('select#".$name."_id option:selected').remove();";
            $script .= self::script_show_blank_table($name);
        // if dont has child -> remove selected row of <table> tag of related model
        }else{
            $script = "$('#table_".$name."').find('tbody td[id=".$id."]').parent().remove();";
            $script .= "if($('#table_".$name."').find('tbody tr').length > 0){";
            $script .= "i=1; $('#table_".$name."').find('tbody tr').each(function(){ $(this).children().eq(0).text( i ); i+=1; });";
            $script .= "}else{";
            $script .= self::script_show_blank_table($name);
            $script .= "}";
        }

        return $script;
    }

    // render javascript for change button name to btn_create of related model <form>
    public static function script_button_to_create($name, $button_name = 'Create'){
        $script = "if($('form#form_".$name."').find('button').length > 0){";
        $script .= "$(\"form#form_".$name."\").find('button.btn-content-inv:not([name^=btn_add])').prop('data-id', '').attr('name', 'btn_create_".$name."').html('<i class=\"fa fa-plus\"></i> ".$button_name."');";
        $script .= "}else{";
        $script .= "$(\"#modal_".$name."\").find('button.btn-content').prop('data-id', '').attr('name', 'btn_create_".$name."').html('<i class=\"fa fa-plus\"></i> ".$button_name."');";
        $script .= "}";

        return $script;
    }

    // render javascript for change button name to btn_update of related model <form>
    public static function script_button_to_update($id, $name, $button_name = 'Edit'){
        $script = "if($('form#form_".$name."').find('button:not([name^=btn-add]):not([name^=btn-remove]):not([name^=btn-browse])').length > 0){";
        $script .= "$('form#form_".$name."').find('button.btn-content-inv:not([name^=btn_add])').attr('data-id', ".$id.").attr('name', 'btn_update_".$name."').html('<i class=\"fa fa-pencil\"></i> ".$button_name."');";
        $script .= "}else{";
        $script .= "$('#modal_".$name."').find('button.btn-content').attr('data-id', ".$id.").attr('name', 'btn_update_".$name."').html('<i class=\"fa fa-pencil\"></i> ".$button_name."');";
        $script .= "}";

        return $script;
    }

    // render javascript for set data id of btn_delete of related model <form>
    public static function script_button_to_delete($id, $name){
        $script = "$('form#list_".$name."').find('button.btn-content-dg').attr('data-id', ".$id.");";

        return $script;
    }

    // javascript for fill all input field of related model <form>
    public static function script_fill_input($data = array(), $name, $animate = true){
        $script =   " $.each( ".$data.", function( key, value ) { ";
        $script .=  "   var response = false;";
        $script .=  "   if(key == 'shuffler_level' || key == 'frame'|| key == 'sr_points'|| key == 'sr_delay'){ response=jQuery.parseJSON(value); console.log(response); }";
        $script .=  "   if($('form#form_".$name."').find('[name='+key+']').attr('type') == 'checkbox'){";
        $script .=  "       if(value){ $('form#form_".$name."').find('[name='+key+']').prop('checked', 'checked'); }";
        $script .=  "       else{ $('form#form_".$name."').find('[name='+key+']').prop('checked', false); }";

        $script .=  "   }else if($('form#form_".$name."').find('[name='+key+']').prop('tagName') == 'SELECT'){";
        $script .=  "       if(value){ $('form#form_".$name."').find('[name='+key+']').val(value);";
        $script .=  "       }else{ $('form#form_".$name."').find('[name='+key+'] option').eq(0).attr('selected', 'selected') }";

        $script .=  "   }else{";
        $script .=  "       if(response){ name = key; $.each(response, function(key, value){ $('form#form_".$name."').find('[name^='+name+']').eq(key).val(value); }); ";
        $script .=  "       }else{ $('form#form_".$name."').find('[name='+key+']').val(value); } }";

        if($animate){
            $script .= "    $('form#form_".$name."').find('[name='+key+'],[id='+key+'],[name=\"'+key+'[]\"]').animate({backgroundColor: '#75a2d6',}, 50 ).animate({backgroundColor: '#144d80',}, 250 ); $('form#form_".$name."').find('[name='+key+']:not([readonly]),[id='+key+'],[name=\"'+key+'[]\"]').animate({backgroundColor: '#fff',}, 500 ); $('form#form_".$name."').find('[name='+key+'][readonly]').animate({backgroundColor: '#eee',}, 500 ); ";
        }

        $script .= "});";

        return $script;
    }

    // javascript for clear all input field of related model <form>
    public static function script_clear_input($name){
        $script = "clear_all_input('".$name."');";

        return $script;
    }

    // javascript for show empty <table> of related model
    public static function script_show_blank_table($name){
        $script = "var td_length = $('#table_".$name."').find('thead th').length;";
        $script .= "$('#table_".$name."').find('tbody').html('<tr><td colspan=\''+td_length+'\' style=\'text-align:center\'><span>nothing data to shown</span></td></tr>');";

        return $script;
    }

    // javascript for show list encoded data (options column)
    public static function option_list($model, $column_name, $has_value = false){
        $layout = '';

        if(!EMPTY($model)){
            if(is_array($column_name)){
                $name = $column_name[1];
                $column_name = $column_name[0];
            }else{
                $name = 'name';
            }
            
            if(is_array($model)){
                $option = $model[1];
                $new_model = $model[0];
                $collection = collect($option);
            }else{
                $new_model = $model;
                $collection = [];
            }

            $data = json_decode($new_model->$column_name);

            //dd($data);

            if(isset($data)){
                foreach($data as $key => $value):
                    $layout .= '<div class=\"input-group\">';
                    if($has_value === TRUE){
                        $value = ($value) ? 'true' : 'false';
                        $layout .= '<input type=\"text\" class=\"form-control\" name=\"'.$column_name.'[]\" value=\"'. $key .'\" style=\"width: 70%;\" readonly>';
                        $layout .= '<input type=\"text\" class=\"form-control\" name=\"value[]\" value=\"'. $value .'\" style=\"width: 30%;\" readonly>';
                        $index = $collection->where($name, $key);
                    }else{
                        if(is_array($model)){
                            $index = $collection->where($name, $value);
                        }else{
                            $id = $value;
                        }

                        if($has_value == 'index'){
                            $value = $key;
                            $index = $collection->where($name, $key);
                        }

                        if($value === true){
                            $value = $id = 'true';
                        }elseif($value === false){
                            $value =  $id = 'false';
                        }

                        $layout .= '<input type=\"text\" class=\"form-control\" name=\"'.$column_name.'[]\" value=\"' . $value . '\" readonly>';
                    }

                    //dd($collection);

                    if(is_array($model)){
                        $key = key($index->all());
                        $index = $index->values();
                        $index = $index->all();

                        $id = $index[0]->id;
                    }
        
                    $layout .= '<input type=\"text\" class=\"form-control\" name=\"index[]\" value=\"'. $key .'\" style=\"display:none\">';
                    $layout .= '<span class=\"input-group-btn\">';
                    $layout .= '<button class=\"btn btn-default\" name=\"btn-remove-'.$column_name.'\" data-for=\"'.$column_name.'\" data-index=\"'.$id.'\" type=\"button\"><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></button>';
                    $layout .= '</span>';
                    $layout .= '</div>';
                endforeach;
            }else{
                return false;
            }
        }

        return $layout;
    }

    // javascript for show list encoded data (options column)
    public static function option_list2($model, $column_name, $has_value = false){
        $layout = '';

        if(!EMPTY($model)){
            if(is_array($column_name)){
                $name = $column_name[1];
                $column_name = $column_name[0];
            }else{
                $name = 'name';
            }
            
            if(is_array($model)){
                $option = $model[1];
                $new_model = $model[0];
                $collection = collect($option);
            }else{
                $new_model = $model;
                $collection = [];
            }

            $data = json_decode($new_model->$column_name);

            //dd($data);

            if(isset($data)){
                foreach($data as $key => $value):
                    $layout .= '<div class="input-group">';
                    if($has_value === TRUE){
                        $value = ($value) ? 'true' : 'false';
                        $layout .= '<input type="text" class="form-control" name="'.$column_name.'[]" value="'. $key .'" style="width: 70%;" readonly>';
                        $layout .= '<input type="text" class="form-control" name="value[]" value="'. $value .'" style="width: 30%;" readonly>';
                        $index = $collection->where($name, $key);
                    }else{
                        if(is_array($model)){
                            $index = $collection->where($name, $value);
                        }else{
                            $id = $value;
                        }

                        if($has_value == 'index'){
                            $value = $key;
                            $index = $collection->where($name, $key);
                        }

                        if($value === true){
                            $value = $id = 'true';
                        }elseif($value === false){
                            $value =  $id = 'false';
                        }

                        $layout .= '<input type="text" class="form-control" name="'.$column_name.'[]" value="' . $value . '" readonly>';
                    }

                    //dd($collection);

                    if(is_array($model)){
                        $key = key($index->all());
                        $index = $index->values();
                        $index = $index->all();

                        $id = $index[0]->id;
                    }
        
                    $layout .= '<input type="text" class="form-control" name="index[]" value=\"'. $key .'" style="display:none">';
                    $layout .= '<span class="input-group-btn">';
                    $layout .= '<button class="btn btn-default" name="btn-remove-'.$column_name.'" data-for="'.$column_name.'" data-index="'.$id.'" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button>';
                    $layout .= '</span>';
                    $layout .= '</div>';
                endforeach;
            }else{
                return false;
            }
        }

        return $layout;
    }

    // javascript for show list encoded data (options column) (duplicate)
    // public static function option_list($model, $option, $column_name, $has_value = false){
    //     $layout = '';

    //     if(!EMPTY($model)){
    //         if(is_array($column_name)){
    //             $name = $column_name[1];
    //             $column_name = $column_name[0];
    //         }else{
    //             $name = 'name';
    //         }
            
    //         $data = json_decode($model->$column_name);
    //         $collection = collect($option);

    //         foreach($data as $key => $value):
    //             $layout .= '<div class=\"input-group\">';
    
    //             if($has_value){
    //                 $layout .= '<input type=\"text\" class=\"form-control\" name=\"'.$column_name.'[]\" value=\"'. $key .'\" style=\"width: 70%;\" readonly>';
    //                 $layout .= '<input type=\"text\" class=\"form-control\" name=\"value[]\" value=\"'. $value .'\" style=\"width: 30%;\" readonly>';
    //                 $index = $collection->where($name, $key);
    //                 //$('#'+$(this).data('for')+'-checkbox').attr('checked', false);
    //             }else{
    //                 $layout .= '<input type=\"text\" class=\"form-control\" name=\"'.$column_name.'[]\" value=\"' . $value . '\" readonly>';
    //                 $index = $collection->where($name, $value);
    //             }
    //             $index = $index->values();
    //             $index = $index->all();
    
    //             $layout .= '<input type=\"text\" class=\"form-control\" name=\"index[]\" value=\"'. $index[0]->id .'\" style=\"display:none\">';
    //             $layout .= '<span class=\"input-group-btn\">';
    //             $layout .= '<button class=\"btn btn-default\" name=\"btn-remove-'.$column_name.'\" data-for=\"'.$column_name.'\" data-index=\"'.$index[0]->id.'\" type=\"button\"><i class=\"fa fa-minus\" aria-hidden=\"true\"></i></button>';
    //             $layout .= '</span>';
    //             $layout .= '</div>';
    //         endforeach;
    //     }

    //     return $layout;
    // }

}