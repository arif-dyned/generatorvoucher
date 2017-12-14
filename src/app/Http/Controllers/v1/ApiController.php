<?php

namespace App\Http\Controllers\v1;

use App\Http\Models\StudyPlans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Models\StudyFlows;
use App\Http\Models\Studypath;
use App\Http\Models\CertificationPlan;
use App\Http\Models\Course;
use App\Http\Models\Lesson;

use Illuminate\Support\Facades\Storage;
use DB;

class ApiController extends Controller
{
	#
	# send checksum file (dsa_rule.json)
	# send download url
	public function get_dsa_rule(){
		$response = ['status' => 'failed', 'desc' => 'file not found'];

		if(file_exists(storage_path() . '/dsa_rule/dsa_rule.json')){
			$cheksum = sha1_file(storage_path() . '/dsa_rule/dsa_rule.json');
			$time = date('d-m-Y H:i:s', (int)Storage::lastModified('/dsa_rule/dsa_rule.json'));

			# response
			$response = ['status' => 'ok', 'sha1' => $cheksum, 'download_url' => secure_url('dsa_rule'), 'last_update' => $time];
		}
    	
    	return response()->json($response, 200, [], JSON_PRETTY_PRINT);
	}

	#
	# send checksum file (dsa_flow.json)
	# send download url
	public function get_dsa_flow(){
		$response = ['status' => 'failed', 'desc' => 'file not found'];

		if(file_exists(storage_path() . '/dsa_flow/dsa_flow.json')){
			$cheksum = sha1_file(storage_path() . '/dsa_flow/dsa_flow.json');
			$time = date('d-m-Y H:i:s', (int)Storage::lastModified('/dsa_flow/dsa_flow.json'));

			# response
			$response = ['status' => 'ok', 'sha1' => $cheksum, 'download_url' => secure_url('dsa_flow'), 'last_update' => $time];
		}
    	
    	return response()->json($response, 200, [], JSON_PRETTY_PRINT);
	}

	#
	# send checksum file (dsa_flow.json)
	# send download url
	public function get_mt_info(){
		$response = ['status' => 'failed', 'desc' => 'file not found'];

		if(file_exists(storage_path() . '/mastery_test_info/mt_info.json')){
			$cheksum = sha1_file(storage_path() . '/mastery_test_info/mt_info.json');
			$time = date('d-m-Y H:i:s', (int)Storage::lastModified('/mastery_test_info/mt_info.json'));

			# response
            $response = ['status' => 'ok', 'sha1' => $cheksum, 'download_url' => secure_url('mt_info'), 'last_update' => $time];
		}

    	return response()->json($response, 200, [], JSON_PRETTY_PRINT);
	}

	#
	# send checksum file ($study_path_name.json)
	# send download url
	public function get_study_path($name = 'list'){
		$response = ['status' => 'failed', 'desc' => 'file not found'];

		if(strtolower($name) == 'list'){
			$spath = Studypath::orderBy(DB::raw('LENGTH(study_path_name), study_path_name'))->get();

			$list = [];
			foreach ($spath as $study) {
				$cheksum = file_exists(storage_path() . '/studypath/'. $study->study_path_name) ? sha1_file(storage_path() . '/studypath/'. $study->study_path_name) : NULL;
				$time = file_exists(storage_path() . '/studypath/'. $study->study_path_name) ? date('d-m-Y H:i:s', (int)Storage::lastModified('/studypath/'. $study->study_path_name)) : '-';
				$new_study = ['study_path_name' => $study->study_path_name, 'sha1' => $cheksum, 'download_url' => secure_url('studypaths/' . $study->study_path_name), 'last_update' => $time];

				$list[] = $new_study;
			}

			$response = ['status' => 'ok', 'list' => $list];
		}else{
			if($name && file_exists(storage_path() . '/studypath/'. $name)){
				$cheksum = sha1_file(storage_path() . '/studypath/'. $name);
				$time = date('d-m-Y H:i:s', (int)Storage::lastModified('/studypath/'. $name));

				# response
		    	$response = ['status' => 'ok', 'sha1' => $cheksum, 'download_url' => secure_url('studypaths/' . $name), 'last_update' => $time];
			}
		}
    	
    	return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    #
    # send checksum file ($json_file_name.json)
    # send download url
    public function get_lesson($name = 'list'){
    	$response = ['status' => 'failed', 'desc' => 'file not found'];

    	if(strtolower($name) == 'list'){
    		$cps = CertificationPlan::all();

    		$num = 0;
    		foreach($cps as $cp){
    			$list[] = ['certification_plan' => $cp->name, 'code' => $cp->code];
    			# $list[] = collect($cp)->all();
    			$list[$num]['course'] = [];

    			$num2 = 0;
    			foreach($cp->course as $co){
    				$list[$num]['course'][] = ['course_name' => $co->name, 'code' => $co->code];
    				$list[$num]['course'][$num2]['unit'] = [];

    				$num3 = 0;
    				foreach($co->unit as $unit){
    					$list[$num]['course'][$num2]['unit'][] = ['unit_name' => $unit->name, 'code' => $unit->code];
    					$list[$num]['course'][$num2]['unit'][$num3]['lesson'] = [];

    					foreach($unit->lesson as $les){
    						# initiate acronym name
					        $course_name = explode(" ", $co->name);
					        $acronym = "";

					        foreach ($course_name as $word) {
					            $acronym .= $word[0];
					        }

					        $lesson_name = $les->lesson_name;
					        $lesson_filename = str_replace(' ', '', strtolower($co->code . '_' . $acronym . $unit->code . '_' . preg_replace("/[^A-Za-z0-9 ]/", '', $les->lesson_name)));

					        if($les->lesson_description){
					        	$lesson_name .= ' - ' . $les->lesson_description;
					        	$lesson_filename .= '_' . str_replace(' ', '', strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $les->lesson_description)));
					        }

					        $checksum = file_exists(storage_path() . '/zip/'. $lesson_filename . '.zip') ? sha1_file(storage_path() . '/zip/'. $lesson_filename . '.zip') : NULL;
					        $time = file_exists(storage_path() . '/zip/'. $lesson_filename . '.zip') ? date('d-m-Y H:i:s', (int)Storage::lastModified('/zip/'. $lesson_filename . '.zip')) : NULL;

    						$list[$num]['course'][$num2]['unit'][$num3]['lesson'][] = ['lesson_name' => $lesson_name, 'file_name' => $lesson_filename, 'sha1' => $checksum, 'download_url' => secure_url('zip/' . $lesson_filename . '.zip'), 'last_update' => $time];
    					}

    					$num3++;
    				}

    				$num2++;
    			}

    			$num++;
    		}

    		$response = ['status' => 'ok', 'list' => $list];
    	}else{
    		if($name && file_exists(storage_path() . '/zip/'. $name . '.zip')){

	    		$cheksum = sha1_file(storage_path() . '/zip/'. $name . '.zip');
	    		$time = date('d-m-Y H:i:s', (int)Storage::lastModified('/zip/'. $name . '.zip'));

	    		# response
	    		$response = ['status' => 'ok', 'sha1' => $cheksum, 'download_url' => secure_url('zip/' . $name . '.zip'), 'last_update' => $time];
	    	}
    	}

    	return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    #
    # send checksum file (dsa_flow.json)
    # send download url
    public function get_list_dsa_flow()
    {
        $response = ['status' => 'failed', 'desc' => 'file not found'];

        $study_plans = StudyPlans::all();
        foreach ($study_plans as $sp) {

            if (file_exists(storage_path() . '/dsa_flow/' . strtolower($sp->cert_plan) . '/dsa_flow.json')) {
                $cheksum = sha1_file(storage_path() . '/dsa_flow/' . strtolower($sp->cert_plan) . '/dsa_flow.json');
                $time = date('d-m-Y H:i:s', (int)Storage::lastModified('/dsa_flow/' . strtolower($sp->cert_plan) . '/dsa_flow.json'));

                # response
                $res[] = ['status' => 'ok', 'sha1' => $cheksum, 'download_url' => secure_url('dsa_flow/' . strtolower($sp->cert_plan)), 'last_update' => $time];
            }
            $response = $res;
        }

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    #
    # send checksum file (mt_info.json)
    # send download url
    public function get_list_mt_info()
    {
        $response = ['status' => 'failed', 'desc' => 'file not found'];

        $study_plans = StudyPlans::all();
        foreach ($study_plans as $sp) {

            if (file_exists(storage_path() . '/mastery_test_info/' . strtolower($sp->cert_plan) . '/mt_info.json')) {
                $cheksum = sha1_file(storage_path() . '/mastery_test_info/' . strtolower($sp->cert_plan) . '/mt_info.json');
                $time = date('d-m-Y H:i:s', (int)Storage::lastModified('/mastery_test_info/' . strtolower($sp->cert_plan) . '/mt_info.json'));

                # response
                $res[] = ['status' => 'ok', 'sha1' => $cheksum, 'download_url' => secure_url('mt_info/' . strtolower($sp->cert_plan)), 'last_update' => $time];
            }
            $response = $res;
        }

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }
}
