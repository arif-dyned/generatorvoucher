<?php

namespace App\Http\Controllers\Template;

use App\Http\Models\ViewGroupViewAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Libraries\Assets;
use App\Http\Libraries\Convert;
use App\Http\Libraries\Render;

use App\Http\Models\AnimationGroupTemplate;

use App\Http\Models\Lesson;

use App\Http\Models\ViewGroup;

use App\Http\Models\ViewGroupTemplate;
use App\Http\Models\ViewGroupViewTemplate;
use App\Http\Models\ViewGroupViewAttributeTemplate;

use App\Http\Models\ViewType;
use App\Http\Models\ViewGroupViewAttributeType;

use Illuminate\Validation\Rule;

use Redirect, Session, Validator;

class ViewController extends \App\Http\Controllers\HomeController
{
    private $id;

	// view function and create function --> view-template
    public function createViewTemplate(){
        if ($this->request->isMethod('post')) {
	    	$rules = array(
	            'view_group_id' => 'required|string|min:4|max:50|unique:view_groups_templ,view_group_id'
	        );

	        $validator = Validator::make($this->request->all(), $rules);

	        if($validator->passes()){
		        $view = new ViewGroupTemplate;

		        $view->view_group_id = camel_case($this->request->view_group_id);

		        if($view->save()){
		        	return redirect('template/view/manage/'.$view->id);
		        }
		    }else{
		    	return redirect('template/view')->withInput()->with('modal', '#viewtemplate_modal')->with('error', $validator->errors());
		    }
		}else{
			return redirect('template/view');
		}
    }

    // update view_group
    public function saveViewTemplate(){
    	$response = array('status'=>500, 'desc'=>'failure');

    	if($this->request->ajax()){
    		$id = $_POST['id'];
    		$data = Convert::to_pairs($_POST['data']);

    		$rules = array(
	            'view_group_id' => 'required|string|min:4|max:50|unique:view_groups_templ,view_group_id,'.$id
	        );

    		$validator = Validator::make($data, $rules);

	        if($validator->passes()){
		        $view = ViewGroupTemplate::findOrFail($id);
		        $view->view_group_id = camel_case($data['view_group_id']);

		        if($view->save()){
                    $script = 'template_name = "'.$view->view_group_id.'";';
                    $script .= '$("#template_title").text("'.$view->view_group_id.'");';
                    $script .= '$("[name=view_group_id]").val("'.$view->view_group_id.'");';
                    $script .= 'remove_error("view");';

		        	$response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
		        }
		    }else{
		    	$response = array('status'=>200, 'desc'=>'errors', 'content' => $validator->errors());
		    }
    	}

    	return $response;
    }

    public function deleteViewTemplate(){
        $response = array('status'=>500, 'desc'=>'failure');

        if($this->request->ajax()){
            $id = $_POST['id'];

            $vg = ViewGroupTemplate::findOrFail($id);

            if($vg->delete()){
                $this->request->session()->flash('success', 'View Template : ' . $vg->view_group_id . ' Successfully Removed');
                $response = array('status'=>200, 'desc'=>'ok', 'content' => 'remove successfully');
            }
        }

        return $response;
    }

    public function cloneViewTemplate(){
        $response = array('status'=>500, 'desc'=>'failure');

        if($this->request->ajax()){
            $id = $_POST['id'];

            $vg = ViewGroupTemplate::findOrFail($id);

            $replica = $vg->replicate();

            $replica->view_group_id = camel_case('Clone ' . $vg->view_group_id);

            if($replica->push()){
                foreach($vg->view as $vgv){
                    $replica2 = $vgv->replicate();

                    $replica2->view_group_id = $replica->id;

                    if($replica2->push()){
                        foreach($vgv->attribute as $vgva){
                            $replica3 = $vgva->replicate();

                            $replica3->view_group_view_id = $replica2->id;

                            $replica3->push();
                        }
                    }
                }

                $this->request->session()->flash('success', 'View Template : ' . $vg->view_group_id . ' Successfully Cloned');
                $response = array('status'=>200, 'desc'=>'ok', 'content' => 'clone successfully');
            }
        }

        return $response;
    }

    public function searchTemplate($name = ''){
        $response = array('status'=>500, 'desc'=>'failure');

        $vg = ViewGroupTemplate::paginate(9);

        if($name){
            $vg = ViewGroupTemplate::where('view_group_id', 'like', '%'.$name.'%')->paginate(9);
        }

        $data['template'] = $vg;

        $content = view('template._template_list', ['data' => $data])->render();

        if($this->request->ajax()){
            
            $response = array('status'=>200, 'desc'=>'ok', 'content'=>$content);
        }else{
            $data['list'] = $content;

            return view('layout/main')->with('data', $this->data)
                ->nest('content', 'template.view', array('data' => $data));
        }

        return $response;
    }

    // manage a template
    public function manageViewTemplate($id = ''){
    	if(empty($id)){
    		return redirect('template/view');
    	}

    	$this->data['css'] = Assets::add($this->data['css'], 'css', ['bootstrap-select', 'colorpicker2']);
    	$this->data['js'] = Assets::add($this->data['js'], 'js', ['jquery-scrollto', 'spin', 'bootstrap-select', 'notify', 'colorpicker2', 'simple-pagination']);
    	$data = ViewGroupTemplate::findOrFail($id);
        $lelist = ViewGroup::where('view_group_id', $data->view_group_id)->get();
    	$view_type = ViewType::all();

		return view('layout/main')->with('data', $this->data)
                              	  ->nest('content', 'template._form_view', ['data' => $data, 'types' => $view_type, 'lesson' => $lelist]);
    }

    // get view data inside
    public function getView($id){
        $response = array('status'=>500, 'desc'=>'failure');

        if($this->request->ajax()){
            $view = ViewGroupViewTemplate::findOrFail($id);
            $view_group = ViewGroupViewTemplate::where('view_group_id', $view->view_group_id)
                ->where('id', '!=', $view->id)->get();
            $attributes = $view->attribute;
            $type = ViewType::where('id', 1)->orWhere('id', $view->view_type_id)->get();

            if($view){
                $script = Render::script_fill_input($view, 'views', false);
                $script .= "changeTab('properties-tab');";
                $script .= "$('#form_views').attr('data-view_id', ".$id.");";
                $script .= "$('[name=btn_delete_views]').attr('id', ".$id.").show('display');";
                $script .= "$('#form_attribute').find('[name=btn_add_attribute]').attr('id', ".$id.");";
                $script .= "show();";
                $script .= "$('.content-attribute:not(:eq(0))').remove();";
                $script .= "$('[name=selected_view] option[value=".$id."]').prop('selected', true);";

                // ------ Render View Attribute List ------ \\
                $content = '';

                foreach($type as $view_type):
                    $content .= '<optgroup label="'.$view_type->name.'">';
                        foreach($view_type->viewGroupViewAttributeType as $type):
                            $content .= '<option value="'.$type->id.'" data-type="'.$type->value_type.'">'.$type->name.'</option>';
                        endforeach;
                    $content .= '</optgroup>';
                endforeach;

                foreach($attributes as $attribute):
                    $attr_content = $this->attributeContent($attribute->id);
                    $script .= "$('$attr_content').insertBefore('#form_attribute #attribute_type_list');";
                    $script .= "$('.content-attribute:not(:eq(0))').show('display');";
                    $script .= "$('." . $attribute->type->name . "').append('<option value=\"screen\">screen</option>');";
                    if (sizeof($view_group) > 0):
                        foreach ($view_group as $vgs_view) {
                            $values = str_replace('[', '', $attribute->values);
                            $val = str_replace(']', '', $values);

                            $script .= "$(\"." . $attribute->type->name . "\").append(\"<option value='" . $vgs_view->view_id . "'>" . $vgs_view->view_id . "</option>\");";
                            $script .= "$(\"." . $attribute->type->name . "\").find('[value=" . $val . "]').prop('selected', true);";
                        }
                    endif;

                endforeach;

                $script .= "$('#attribute_type_list').find('[name=view_group_view_attribute_type_id]').html('".$content."');";
                $script .= "$('.selectpicker').selectpicker('refresh');";
                $script .= "$('.color').colorpicker();";
                $script .= "$('.view-attributes').empty();";


                $response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
            }
        }

        return $response;
    }

    // add a view (create)
    public function addView(){
    	$response = array('status'=>500, 'desc'=>'failure');

    	if($this->request->ajax()){
    		$id = $_POST['id'];
    		$data = Convert::to_pairs($_POST['data']);

    		$vgroup = ViewGroupTemplate::findOrFail($id);
    		$view = new ViewGroupViewTemplate;
    		$index = $vgroup->view->where('view_type_id', $data['view_type_id'])->count();
            $checker = $vgroup->view->where('view_id', $data['type'] . ($index + 1))->first();

    		$frame = ($data['type'] == 'UILabel' || $data['type'] == 'UIButton') ? [10,10,30,7] : [10,10,20,10];

    		$view->view_group_id = $id;
    		$view->view_id = sizeof($checker) == 0 ? $data['type'] . ($index + 1) : $data['type'] . ($index + 1) . ' - ' . ($index + 1);
    		$view->shuffler_level = json_encode([0,1], JSON_NUMERIC_CHECK);
    		$view->view_type_id = $data['view_type_id'];
    		$view->frame = json_encode($frame, JSON_NUMERIC_CHECK);
    		$view->subview_of = 'contentView';

    		if($view->save()){
    			$script = '$("iframe").attr("src", "'. url('preview2/'. $id) .'");';

    			$response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
    		}
    	}

    	return $response;
    }

    // save a view (update)
    public function saveView(){
    	$response = array('status'=>500, 'desc'=>'failure');

    	if($this->request->ajax()){
    		$id = $_POST['id'];
    		$data = Convert::to_pairs($_POST['data']);

            $view = ViewGroupViewTemplate::findOrFail($id);
            $this->id = $view->view_group_id;

            $rules = array(
                'view_id' => [
                    'required',
                    'string',
                    'min:4',
                    'max:255',
                    Rule::unique('view_group_views_templ')->where(function ($query) {
                        $query->where('view_group_id', $this->id);
                    })->ignore($id)
                ],
                'frame' => 'array',
                'subview_of' => 'required|not_in:0'
            );

            foreach(range(0, 3) as $index) {
                $rules['frame.' . $index] = 'required|numeric|min:0|max:200';
            }

            $validator = Validator::make($data, $rules);

            if($validator->passes()){

                $view->view_id = $data['view_id'];
                $view->frame = json_encode($data['frame'], JSON_NUMERIC_CHECK);
                $view->subview_of = $data['subview_of'];

                if($view->save()){
                    $script = 'console.log("hore");';

                    $response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
                }
            }else{
                $response = array('status'=>200, 'desc'=>'errors', 'content' => $validator->errors());
            }
    	}

    	return $response;
    }

    // remove a view (delete)
    public function deleteView(){
        $response = array('status'=>500, 'desc'=>'failure');

        if($this->request->ajax()){
            $id = $_POST['id'];

            $view = ViewGroupViewTemplate::findOrFail($id);

            if($view->delete()){
                $script = '$("iframe").attr("src", "'. url('preview2/'. $view->view_group_id) .'");';
                $script .= 'clear("views");';
                $script .= "changeTab('component-tab');";

                $response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
            }
        }

        return $response;
    }

    private function attributeContent($id){
    	$view = ViewGroupViewAttributeTemplate::findOrFail($id);
        $val = json_decode($view->values)[0] === true ? 'true' : (json_decode($view->values)[0] === false ? 'false' : json_decode($view->values)[0]);
        $type = ($view->type->value_type != 'square') || ($view->type->value_type != 'number') ? 'text' : $view->type->value_type;
        $val_type = $view->type->value_type;

    	$content = 		'<div class="col-xs-12 content-attribute" style="display:none">';
    	$content .=		'<div class="form-group">';
    	$content .=		'<label class="col-sm-4 control-label">'.$view->type->name.'</label>';
    	$content .=		'<div class="col-sm-6">';

        if ($view->type->value_type == 'boolean') {

            $content .= '<label class="radio-inline"><input type="radio" name="' . $view->type->name . '[]" value="true" view_id="' . $view->view_group_view_id . '" id="' . $view->id . '" ' . ($val == 'true' ? 'checked' : '') . ' style="margin-left:-20px"> True</label>&nbsp;&nbsp;';
            $content .= '<label class="radio-inline"><input type="radio" name="' . $view->type->name . '[]" value="false" view_id="' . $view->view_group_view_id . '" id="' . $view->id . '" ' . ($val == 'false' ? 'checked' : '') . ' style="margin-left:-20px"> False</label>&nbsp;&nbsp;';
        } elseif ($view->type->value_type == 'views') {
            $content .= '<select class="' . $view->type->name . '" view_id="' . $view->view_group_view_id . '" id="' . $view->id . '"></select>';
        } elseif ($view->type->value_type == 'image') {
            $content .= '<div class="input-group"><input placeholder="Box Model" type="text" class="form-control" name="' . $view->type->name . '[]" id="' . $view->id . '" value="' . $val . '" view_id="' . $view->view_group_view_id . '" readonly="">';
            $content .= '<span class="input-group-btn"><button class="btn bg-primary" name="btn-browse-asset" data-type="image" data-toggle="modal" data-target="#assets-modal" type="button" style="color:white!important"><i class="fa fa-folder-open-o" aria-hidden="true"></i></button></span></div>';
        } else {
            $content .= '<input class="form-control ' . $val_type . '" type="' . $type . '" name="' . $view->type->name . '" id="' . $view->id . '" value="' . $val . '" view_id="' . $view->view_group_view_id . '" required>';
        }
//    	$content .=		'<input class="form-control" type="text" name="'.$view->type->name.'" id="'.$view->id.'" value="'.$val.'" required>';
    	$content .=		'</div>';
    	$content .=		'<div class="col-sm-2">';
    	$content .=		'<p class="form-control-static text-right" id="options"><a href="#" name="btn_delete_attributes" id="'.$view->id.'"><i class="fa fa-close"></i></a></p>';
    	$content .=		'</div>';
    	$content .=		'</div>';
    	$content .=		'<hr style="border-color:#cecece!important" />';
    	$content .=		'</div>';

    	return $content;
    }

    // add an attribute
    public function addAttribute(){
    	$response = array('status'=>500, 'desc'=>'failure');

    	if($this->request->ajax()){
    		$id = $_POST['id'];
    		$data = Convert::to_pairs($_POST['data']);

    		$view = new ViewGroupViewAttributeTemplate;

    		$view->view_group_view_id = $id;
    		$view->shuffler_level = json_encode([0,1], JSON_NUMERIC_CHECK);
    		$view->view_group_view_attribute_type_id = $data['view_group_view_attribute_type_id'];

    		foreach($data['values'] as $val){
                $v[] = strtolower($val) == 'true' ? true : (strtolower($val) == 'false' ? false : $val);
            }

            $view->values = json_encode($v, JSON_NUMERIC_CHECK);

    		if($view->save()){
    			$view = ViewGroupViewAttributeTemplate::findOrFail($view->id);
                $view_group = ViewGroupViewTemplate::where('view_group_id', $view->view_group_id)
                    ->where('id', '!=', $view->id)->get();
                $script = '$("iframe").attr("src", "'. url('preview2/'. $view->view->view_group_id) .'");';
                $script .= '$("iframe").load(function(){';
                $script .= '$("iframe").contents().find(".page-control [id=\"'.$view->view->view_id.'\"]").addClass("UIActive");';
                $script .= 'console.log("inside iframe on load");';
                $script .= '$("iframe")[0].contentWindow.activate_drag_n_resize();';
    			$script .= '});';
    			$script .= "$('#attribute_type_list').hide('display');";
    			$script .= "$('.view_attribute_list .well').show('display');";

    			$attr_content = $this->attributeContent($view->id);

    			$script .= "$('$attr_content').insertBefore('#form_attribute #attribute_type_list');";
    			$script .= "$('.content-attribute:not(:eq(0))').show('display');";
                $script .= "clear_all_input('attribute_type_list');";
                $script .= "$('.selectpicker').val(1);";
                $script .= "$('.selectpicker').selectpicker('render');";
    			$script .= "$('#attr_value').html($('template#number').html());";

    			$script .= "$('.color').colorpicker();";

                $script .= "$('.view-attributes').append('<option value=\"screen\" id=\"" . $view->id . "\" view_id=\"" . $view->view_group_view_id . "\">screen</option>');";
                if (sizeof($view_group) > 0):
                    foreach ($view_group as $vgs_view) {
                        $script .= "$(\".view-attributes\").append(\"<option value='" . $vgs_view->view_id . "' id='" . $view->id . "' view_id='" . $view->view_group_view_id . "'>" . $vgs_view->view_id . "</option>\");";
                        $script .= "console.log('$vgs_view->view_id');";
                    }
                endif;

    			$response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
    		}
    	}

    	return $response;
    }

    public function updateAttribute(){
        $res = ['status' => 200, 'desc' => 'error'];

        if ($this->request->ajax()) {
            $id = $this->request->id;
            $value = $this->request->value;

            $attirubte = ViewGroupViewAttributeTemplate::findOrFail($id);

            $v = strtolower($value) == 'true' ? true : (strtolower($value) == 'false' ? false : $value);
            $attirubte->values = "[" . json_encode($v, JSON_NUMERIC_CHECK) . "]";

            if ($attirubte->save()) {
                $res = ['status' => 200, 'desc' => 'ok'];
            }
        }

        return $res;
    }

    // remove a view (delete)
    public function deleteAttribute(){
        $response = array('status'=>500, 'desc'=>'failure');

        if($this->request->ajax()){
            $id = $_POST['id'];

            $view = ViewGroupViewAttributeTemplate::findOrFail($id);

            if($view->delete()){
                $script = '$("iframe").attr("src", "'. url('preview2/'. $view->view->view_group_id) .'");';
                $script .= '$("iframe").load(function(){';
                $script .= '$("iframe").contents().find(".page-control [id=\"'.$view->view->view_id.'\"]").addClass("UIActive");';
                $script .= 'console.log("#'.$view->view->view_id.'");';
                $script .= '$("iframe")[0].contentWindow.activate_drag_n_resize();';
                $script .= '});';
                $script .= '$("#form_attribute [name=btn_delete_attributes]#'.$id.'").parents(".content-attribute").remove();';

                $response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
            }
        }

        return $response;
    }

    public function get_view_list($id, $resp = 'option'){
        $response = array('status'=>500, 'desc'=>'failure');

        if($this->request->ajax()){
            $view_group = ViewGroupTemplate::findOrFail($id);

            if($resp == 'json'){
                $response = array('status'=>200, 'desc'=>'ok', 'content' => $view_group->view);
            }else{
                $layout = '';
                $script = '';

                if($view_group->view){
                    foreach($view_group->view as $view){
                        $layout .= '<option value=\"'.$view->view_id.'\">'.$view->view_id.'</option>';
                    }

                    $script .= '$("#non_template_view").hide("display");';
                    $script .= '$("#template_view").show("display");';
                    $script .= '$("[name=view_id]").html("'.$layout.'");';
                }

                $response = array('status'=>200, 'desc'=>'ok', 'content' => $script);
            }
        }

        return $response;
    }
}
