<?php

namespace App\Http\Controllers\Template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Libraries\Assets;
use App\Http\Libraries\Convert;
use App\Http\Libraries\Render;

use App\Http\Models\AnimationGroupTemplate;
use App\Http\Models\AnimationTemplate;
use App\Http\Models\AnimationActionTemplate;

use App\Http\Models\AnimationType;
use App\Http\Models\AnimationActionType;
use App\Http\Models\AnimationOption;

use App\Http\Models\ViewGroupTemplate;

use Redirect, Session, Validator;

class AnimationController extends \App\Http\Controllers\HomeController
{
    // animation function and create function --> animation-template
    public function createAnimationTemplate()
    {
        if ($this->request->isMethod('post')) {
            $rules = array(
                'animation_group_id' => 'required|string|min:4|max:50|unique:animation_groups_templ,animation_group_id'
            );

            $validator = Validator::make($this->request->all(), $rules);

            if ($validator->passes()) {
                $animation = new AnimationGroupTemplate;
                $animation->animation_group_id = $this->request->animation_group_id;
                $animation->start_delay_time = 0;
                $animation->duration = 0;

                if ($animation->save()) {
                    return redirect('template/animation/manage/' . $animation->id);
                }
            } else {
                return redirect('template/animation')->withInput()->with('modal', '#animationtemplate_modal')->with('error', $validator->errors());
            }
        } else {
            return redirect('template/animation');
        }
    }

    // update animation_group
    public function saveAnimationTemplate()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $data = Convert::to_pairs($_POST['data']);

            $rules = array(
                'animation_group_id' => 'required|string|min:4|max:50|unique:animation_groups_templ,animation_group_id,' . $id,
                'start_delay_time' => 'required|numeric',
                'duration' => 'required|numeric'
            );

            $validator = Validator::make($data, $rules);

            if ($validator->passes()) {
                $animation = AnimationGroupTemplate::findOrFail($id);

                $animation->animation_group_id = $data['animation_group_id'];
                $animation->start_delay_time = $data['start_delay_time'];
                $animation->duration = $data['duration'];
                $animation->options = null;

                if (!empty($data['options']) && $data['options'] != "[]") {
                    $animation->options = $data['options'];
                }

                if ($animation->save()) {
                    $script = '$("iframe").attr("src", "' . url('preview2/' . $animation->id . '/animation') . '");';

                    $response = array('status' => 200, 'desc' => 'ok', 'content' => $script, 'test' => $data['options']);
                }
            } else {
                $response = array('status' => 200, 'desc' => 'errors', 'content' => $validator->errors());
            }
        }

        return $response;
    }

    public function deleteAnimationTemplate()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];

            $animation = AnimationGroupTemplate::findOrFail($id);

            if ($animation->delete()) {
                $this->request->session()->flash('success', 'Animation Template : ' . $animation->animation_group_id . ' Successfully Removed');
                $response = array('status' => 200, 'desc' => 'ok', 'content' => 'remove successfully');
            }
        }

        return $response;
    }

    // manage a template
    public function manageAnimationTemplate($id = '')
    {
        if (empty($id)) {
            return redirect('template/animation');
        }

        $this->data['css'] = Assets::add($this->data['css'], 'css', ['select2', 'colorpicker2']);
        $this->data['js'] = Assets::add($this->data['js'], 'js', ['select2', 'jquery-ui', 'spin', 'notify', 'colorpicker2']);

        $data = AnimationGroupTemplate::findOrFail($id);
        $animopt = AnimationOption::all();
        $type[] = AnimationType::all();
        $type[] = AnimationActionType::all();
        $option = AnimationOption::all();

        $template = ViewGroupTemplate::all();

        $opt_list = '';


        //dd(count($data->animation));
        if (!empty($data->options) && isset($data->options)) {
            $opt_exist = $data->options;
        } else {
            $opt_exist = "[]";
        }

        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'template._form_animation', ['opt_exist' => $opt_exist, 'data' => $data, 'types' => $type, 'options' => $option, 'list' => $opt_list, 'templates' => $template]);
    }

    # add a animations (create)
    public function addAnimation()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $data = Convert::to_pairs($_POST['data']);

            $agroup = AnimationGroupTemplate::findOrFail($id);
            $animation = new AnimationTemplate;

            $animation->animation_group_id = $id;
            $animation->shuffler_level = json_encode([0, 1], JSON_NUMERIC_CHECK);
            $animation->animation_type_id = $data['animation_type'];

            if ($animation->save()) {
                $script = 'console.log("hore");';
                $script .= '$("[name=btn_add_action]").attr("id", ' . $animation->id . ');';

                $response = array('status' => 200, 'desc' => 'ok', 'content' => $script);
            }
        }

        return $response;
    }

    # save a animations (update)
    public function saveAnimation()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $data = Convert::to_pairs($_POST['data']);

            $agroup = AnimationGroupTemplate::findOrFail($id);
            $animation = $agroup->animation->first();

            $animation->animation_group_id = $id;
            $animation->shuffler_level = json_encode([0, 1], JSON_NUMERIC_CHECK);
            $animation->animation_type_id = $data['animation_type'];

            if ($animation->save()) {
                $script = 'console.log("hore");';

                $response = array('status' => 200, 'desc' => 'ok', 'content' => $script);
            }
        }

        return $response;
    }

    private function attributeContent($id)
    {
        $animation = AnimationActionTemplate::findOrFail($id);

        $content = '<div class="col-xs-12 content-attribute" style="display:none">';
        $content .= '<div class="form-group">';
        $content .= '<label class="col-sm-4 control-label">' . $animation->type->name . '</label>';
        $content .= '<div class="col-sm-6">';
        $content .= '<input class="form-control" type="text" name="' . $animation->type->name . '" id="' . $animation->id . '" value="' . json_decode($animation->values)[0] . '" required>';
        $content .= '</div>';
        $content .= '<div class="col-sm-2">';
        $content .= '<p class="form-control-static text-right" id="options"><a href="#" name="btn_delete_attributes" id="' . $animation->id . '"><i class="fa fa-close"></i></a></p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<hr style="border-color:#cecece!important" />';
        $content .= '</div>';

        return $content;
    }

    // add an actions
    public function addAction()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $data = Convert::to_pairs($_POST['data']);

            $rules = array(
                'animation_action_type_id' => 'required|exist:animation_action_types,id',
                'values' => 'required|numeric'
            );

            $validator = Validator::make($data, $rules);

            $animation = new AnimationActionTemplate;

            $animation->animation_id = $id;
            $animation->shuffler_level = json_encode([0, 1], JSON_NUMERIC_CHECK);
            $animation->animation_action_type_id = $data['animation_action_type_id'];

            foreach ($data['values'] as $val) {
                $v[] = strtolower($val) == 'true' ? true : (strtolower($val) == 'false' ? false : $val);
            }

            $animation->values = json_encode($v, JSON_NUMERIC_CHECK);

            if ($animation->save()) {
                $animation = AnimationActionTemplate::findOrFail($animation->id);
                $script = '$("iframe").attr("src", "' . url('preview2/' . $animation->animation->animation_group_id) . '/animation");';
                $script .= 'console.log("hore");';
                $script .= "$('#action_type_list').hide('display');";
                $script .= "$('.animation_list .well').show('display');";
                $attr_content = $this->attributeContent($animation->id);
                $script .= "$('$attr_content').insertBefore('#form_attribute #action_type_list');";
                $script .= "$('.content-attribute:not(:eq(0))').show('display');";
                $script .= "clear_all_input('action_type_list');";

                $response = array('status' => 200, 'desc' => 'ok', 'content' => $script);
            }
        }

        return $response;
    }

    # save an actions (update)
    public function saveAction()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $data = Convert::to_pairs($_POST['data']);

            $action = AnimationActionTemplate::findOrFail($id);

            foreach ($data['values'] as $val) {
                $v[] = strtolower($val) == 'true' ? true : (strtolower($val) == 'false' ? false : $val);
            }

            $action->values = json_encode($v, JSON_NUMERIC_CHECK);

            if ($action->save()) {
                $script = '$("iframe").attr("src", $("iframe").attr("src"));';
                $script .= 'console.log("hore save action success");';

                $response = array('status' => 200, 'desc' => 'ok', 'content' => $script);
            }
        }

        return $response;
    }

    public function deleteAction()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];

            $animation = AnimationActionTemplate::findOrFail($id);

            if ($animation->delete()) {
                $script = 'that.remove();';
                $script .= '$("iframe").attr("src", $("iframe").attr("src"));';

                $response = array('status' => 200, 'desc' => 'ok', 'content' => $script);
            }
        }

        return $response;
    }
    public function searchTemplate($name = ''){
        $response = array('status'=>500, 'desc'=>'failure');

        $vg = AnimationGroupTemplate::paginate(9);

        if($name){
            $vg = AnimationGroupTemplate::where('animation_group_id', 'like', '%'.$name.'%')->paginate(9);
        }

        $data['template'] = $vg;

        $content = view('template._template_list', ['data' => $data])->render();

        if($this->request->ajax()){
            $response = array('status'=>200, 'desc'=>'ok', 'content'=>$content);
        }else{
            $data['list'] = $content;

            return view('layout/main')->with('data', $this->data)
                ->nest('content', 'template.animation', array('data' => $data));
        }

        return $response;
    }
}
