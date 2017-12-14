<?php
/**
 * Created by PhpStorm.
 * User: mobileteam
 * Date: 2/9/17
 * Time: 2:47 PM
 */

namespace App\Http\Controllers\Template;

use App\Http\Models\Asset;
use App\Http\Models\TemplTeacherResponse;
use App\Http\Models\TemplTeacherResponseContent;
use App\Http\Models\TemplTrGroup;
use App\Http\Models\TemplTeacherResponseType;
use App\Http\Models\TemplTRResponse;
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

use Redirect, Session, Validator, DB;
use Yajra\Datatables\Datatables;

class TRController extends \App\Http\Controllers\HomeController
{
    function tr_template()
    {
        $validation = TemplTrGroup::where('tr_group_name', 'Teacher Response Group 1')->first();
        if ($validation) {
            return redirect('template/tr-templ/');
        } else {
            $tr_group = new TemplTrGroup();
            $tr_group->tr_group_name = 'Teacher Response Group 1';
            $tr_group->created_at = date('Y-m-d H:i:s');
            $tr_group->updated_at = date('Y-m-d H:i:s');
            if ($tr_group->save()) {
                DB::table('templ_teacher_responses')->insert([
                    ['tr_id' => 'Teacher Response 1',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '00190.mp3',
                        'text' => 'Yes, that\u2019s right',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ], [
                        'tr_id' => 'Teacher Response 2',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '04780.mp3',
                        'text' => 'Yes, that\u2019s right',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ], [
                        'tr_id' => 'Teacher Response 3',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '00760.mp3',
                        'text' => 'Good Choice!',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ], [
                        'tr_id' => 'Teacher Response 4',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '06230.mp3',
                        'text' => 'Good Choice!',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ], [
                        'tr_id' => 'Teacher Response 5',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '00210.mp3',
                        'text' => 'Good!',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ], [
                        'tr_id' => 'Teacher Response 6',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '05950.mp3',
                        'text' => 'Good!',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 7',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '00100.mp3',
                        'text' => 'No, that\u2019s not correct.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 8',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '05850.mp3',
                        'text' => 'No, that\u2019s not it.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 9',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '00160.mp3',
                        'text' => 'Please try again.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 10',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '04750.mp3',
                        'text' => 'Please try again.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 11',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'incorrect1.mp3',
                        'text' => 'I\'m sorry but i don\'t understand, Could you say again please ?.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 12',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'incorrect2.mp3',
                        'text' => 'Could you say again please ?',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 13',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'incorrect3.mp3',
                        'text' => 'Please, say again.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 14',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'incorrect4.mp3',
                        'text' => 'Sorry, Could you say again ?',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 15',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'continue.mp3',
                        'text' => 'Let\'s continue',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 16',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'nointeraction1.mp3',
                        'text' => 'Please make a choise',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 17',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'nointeraction2.mp3',
                        'text' => 'Are you there?',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 18',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '00180.mp3',
                        'text' => 'That\'s enough for now.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 19',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '03100.mp3',
                        'text' => 'Excellent work!',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 20',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => '03110.mp3',
                        'text' => 'You did very well.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ], [
                        'tr_id' => 'Teacher Response 21',
                        'shuffler_level' => '[0,3]',
                        'is_auto_next' => '1',
                        'media' => 'the_correct_answer_is.mp3',
                        'text' => 'The correct answer is.',
                        'templ_tr_group_id' => $tr_group->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ]);
            }
            return redirect('template/tr-templ')->with('success', 'Teacher Response Group Name : ' . $tr_group->tr_group_name . ' Successfully Created');;
        }


    }

    public function assetAJ()
    {
        if ($this->request->ajax()) {
            $response = array('status' => 500, 'desc' => 'failure');

            $view = Asset::select('*')
                ->where('type', 'like', "audio%")
                ->get();

            if ($view) {
                $response = array('status' => 200, 'desc' => 'ok', 'content' => $view);
            }

            return $response;
        } else {
            return "What can i help you?";
        }
    }

    public function loadTeacherResponse($id)
    {
        return TemplTeacherResponse::where('templ_tr_group_id', $id)->get();
    }

    public function TResponse($id)
    {
        return Datatables::of(\App\Http\Models\TemplTRResponse::select('*')
            ->where('tr_group_id', '=', $id))
            ->make(true);
    }

    public function creategroup()
    {
        $rules = array(
            'tr_group_name' => 'required|string|min:1'
        );

        $validator = Validator::make($this->request->all(), $rules);
        if ($validator->passes()) {

            $view = new TemplTrGroup();
            $view->tr_group_name = $this->request->tr_group_name;

            if ($view->save()) {
                return redirect('template/tr-templ')->with('success', 'Teacher Response Group Name : ' . $view->tr_group_name . ' Successfully Created');
            }
        } else {
            return redirect('template/tr-templ')->withInput()->with('modal', '#modal_tr_group')->with('error', $validator->errors());
        }
    }


    public function create()
    {
        $rules = array(
            'media' => 'required|string|min:1'
        );

        $validator = Validator::make($this->request->all(), $rules);
        if ($validator->passes()) {
            $teacher_response_id = $this->request->id;
            $count = TemplTeacherResponse::all()->count();
            $view = new TemplTeacherResponse();
            if (isset($this->request->teacher_id) && !empty($this->request->teacher_id)) {
                $view->tr_id = $this->request->teacher_id;
            } else {
                $view->tr_id = "Teacher Response " . $count;
            }

            $view->shuffler_level = "[0,3]";
            $view->is_auto_next = 1;
            $view->media = $this->request->media;
            $view->text = $this->request->text;
            $view->id = $teacher_response_id;
            $view->templ_tr_group_id = $this->request->templ_tr_group_id;


            if ($view->save()) {
                $views = new TemplTeacherResponseContent();
                $views->teacher_response_id = $teacher_response_id;
                $views->shuffler_level = "[0,3]";
                $views->view_group_view_id = 0;
                $views->content_type_id = 0;

                if ($views->save()) {
                    return redirect('template/tr-templ')->with('success', 'Error Code : ' . $view->name . ' Successfully Created');
                }

            }
        } else {
            return redirect('template/tr-templ/form')->withInput()->with('form', '#form_teacher_response')->with('error', $validator->errors());
        }
    }

    public function createtr()
    {
//        return "ok";
        $rules = array(
            'tr_type' => 'required',
            'flow_type_id' => 'required',
            'random_items' => 'required',
            'tr_index' => 'required',
            'type_tr_response' => 'required',
            'templ_tr_group_id' => 'required'
        );

        $validator = Validator::make($this->request->all(), $rules);
        if ($validator->passes()) {
            $view = new TemplTRResponse();

            $tr = $this->request->tr_index;
            $trrs = [];
            foreach ($tr as $trr) {
                if (!empty($trr)) {
                    $trs = $trr;
                } else {
                    $trs = "[]";
                }
                $trrs [] = $trs;
            }
            $view->tr_type = $this->request->tr_type;
            $view->flow_type_id = $this->request->flow_type_id;
            $view->random_items = $this->request->random_items;
//            $view->tr_index = isset($this->request->tr_index) ? "[" . implode(',', $this->request->tr_index) . "]" : "[]";
            $view->tr_index = "[" . implode(',', $trrs) . "]";
            $view->type = $this->request->type_tr_response;
            $view->templ_tr_group_id = $this->request->templ_tr_group_id;
            $view->shuffler_level = "[0,3]";

            if ($view->save()) {
                return redirect('template/tr-templ')->with('success', $view->name . ' Successfully Created');
            }
        } else {
            return redirect('template/tr-templ/form')->withInput()->with('modal', '#modal_tr_response')->with('error', $validator->errors());
        }
    }

    public function edit_group()
    {

        $rules = array(
            'id' => 'required'
        );

        $validator = Validator::make($this->request->all(), $rules);
        if ($validator->passes()) {
            $view = TemplTrGroup::findOrFail($this->request->id);
            $view->tr_group_name = $this->request->tr_group_name;


            if ($view->save()) {
                return redirect('template/tr-templ')->with('success', 'Error Code : ' . $view->name . ' Successfully Created');
            }
        } else {
            return redirect('template/tr-templ/form')->withInput()->with('modal', '#modal_tr_response')->with('error', $validator->errors());
        }
    }

    public function edit_tr()
    {

        $rules = array(
            'tr_type' => 'required',
            'flow_type_id' => 'required',
            'random_items' => 'required',
            'tr_index' => 'required',
            'type_tr_response' => 'required',
            'templ_tr_group_id' => 'required'
        );

        $validator = Validator::make($this->request->all(), $rules);
        if ($validator->passes()) {
            $view = TemplTRResponse::findOrFail($this->request->id);
            $tr = $this->request->tr_index;
            $trrs = [];
            foreach ($tr as $trr) {
                if (!empty($trr)) {
                    $trs = $trr;
                } else {
                    $trs = "[]";
                }
                $trrs [] = $trs;
            }
            $view->tr_type = $this->request->tr_type;
            $view->flow_type_id = $this->request->flow_type_id;
            $view->random_items = $this->request->random_items;
            $view->tr_index = "[" . implode(',', $trrs) . "]";
            $view->type = $this->request->type_tr_response;
            $view->templ_tr_group_id = $this->request->templ_tr_group_id;
            $view->shuffler_level = "[0,3]";

            if ($view->save()) {
                return redirect('template/tr-templ')->with('success', 'Error Code : ' . $view->name . ' Successfully Created');
            }
        } else {
            return redirect('template/tr-templ/form')->withInput()->with('modal', '#modal_tr_response')->with('error', $validator->errors());
        }
    }

    public function edit_teacher_response()
    {

        $rules = array(
            'media' => 'required',
            'texts' => 'required',
            'id' => 'required'
        );

        $validator = Validator::make($this->request->all(), $rules);
        if ($validator->passes()) {
            $view = TemplTeacherResponse::findOrFail($this->request->id);
            $view->tr_id = $this->request->teacher_id;
            $view->media = $this->request->media;
            $view->text = $this->request->texts;

            if ($view->save()) {
                return redirect('template/tr-templ')->with('success', 'Error Code : ' . $view->name . ' Successfully Created');
            }
        } else {
            return redirect('template/tr-templ/form')->withInput()->with('modal', '#modal_tr_response')->with('error', $validator->errors());
        }
    }


    public function contentcreate($assetsID)
    {
        $view = new TemplTeacherResponseContent();
        $view->teacher_response_id = $assetsID;
        $view->shuffler_level = "[0,3]";
        // $view->view_group_view_id = 0;
        // $view->content_type_id = 0;
        // $view->content = "null";
        // $view->animation = "null";
        $view->save();
    }

    public function responsecreate()
    {
        $view = new TemplTeacherResponseType();
        $view->name = "null";
        $view->save();
    }

    public function deleteTeacherResponse()
    {

        if ($this->request->ajax()) {
            $id = $_REQUEST['id'];

            $view = TemplTeacherResponse::find($id);

            if ($view->delete()) {
                $views = DB::table('templ_teacher_response_contents')->where('teacher_response_id', $id)->delete();
                if ($views) {
                    $this->request->session()->flash('success', $view->name . ' Successfully Deleted');
//                    $response = array('status' => 200, 'desc' => 'ok', 'content' => $view);
                }
            }
        }
    }

    public function deleteTRResponse()
    {

        if ($this->request->ajax()) {
            $id = $_REQUEST['id'];

            $view = TemplTRResponse::find($id);

            if ($view->delete()) {
                $this->request->session()->flash('success', $view->name . ' Successfully Deleted');
            }
        }
    }

    public function deleteGrupTR()
    {
        if ($this->request->ajax()) {
            $id = $_REQUEST['id'];

            $view = TemplTrGroup::find($id);

            if ($view->delete()) {
                $this->request->session()->flash('success', $view->name . ' Successfully Deleted');
            }
        }
    }

    public function editTR($id)
    {
        if ($this->request->ajax()) {
            $response = array('status' => 500, 'desc' => 'failure');

            $view = TemplTRResponse::find($id);

            if ($view) {
                $response = array('status' => 200, 'desc' => 'ok', 'content' => $view);
            }

            return $response;
        }
    }

    public function editGroup($id)
    {
        if ($this->request->ajax()) {
            $response = array('status' => 500, 'desc' => 'failure');

            $view = TemplTrGroup::find($id);

            if ($view) {
                $response = array('status' => 200, 'desc' => 'ok', 'content' => $view);
            }

            return $response;
        }
    }

    public function editTeacherRespon($id)
    {
        if ($this->request->ajax()) {
            $response = array('status' => 500, 'desc' => 'failure');

            $view = TemplTeacherResponse::find($id);

            if ($view) {
                $response = array('status' => 200, 'desc' => 'ok', 'content' => $view);
            }

            return $response;
        }
    }

    public function cloneTeacherReponseTemp()
    {
        $response = array('status' => 500, 'desc' => 'failure', 'id' => $_POST['id']);

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $var_group = TemplTrGroup::findOrFail($id);

            $new_template = $var_group->replicate();
            $new_template->tr_group_name = "Clone " . $var_group->tr_group_name;

            if ($new_template->push()) {

                if (!EMPTY($var_group->teacherResponse)) {
                    foreach ($var_group->teacherResponse as $content):
                        $new_teacher_response = $content->replicate();
                        $new_teacher_response->templ_tr_group_id = $new_template->id;
                        $new_teacher_response->push();
                    endforeach;

                }
                if (!EMPTY($var_group->trResponse)) {
                    foreach ($var_group->trResponse as $content):
                        $new_trresponse = $content->replicate();
                        $new_trresponse->templ_tr_group_id = $new_template->id;
                        $new_trresponse->push();
                    endforeach;

                }
                $this->request->session()->flash('success', "Successfully in clone by name " . $new_template->tr_group_name);
                $response = array('status' => 200, 'desc' => 'ok', 'content' => $var_group->id);

            }

        }
        return $response;


    }


}
