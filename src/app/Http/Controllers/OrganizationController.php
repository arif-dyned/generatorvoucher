<?php

namespace App\Http\Controllers;

use App\Http\Models\CostCenter;
use App\Http\Models\Employee;
use App\Http\Models\Grade;
use App\Http\Models\Organization;
use App\Http\Models\OrganizationLevel;
use App\Http\Models\Position;
use App\Http\Models\SubGroup;
use App\Http\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Libraries\Convert;
use App\Http\Libraries\Render;
use DB,
    Redirect, File,
    Input,
    Validator;
use phpDocumentor\Reflection\Types\Null_;
use Yajra\Datatables\Facades\Datatables;

class OrganizationController extends HomeController
{
    public function Rules($data, $id = '')
    {
        $rules = [
            'organization_name' => 'required|string|max:255',
        ];

        $validate = Validator::make($data, $rules);

        return $validate;
    }

    public function get_sub_group_id($id)
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $or = SubGroup::where('partner_id', $id)->get();
            $response = $or;
        }
        return $response;
    }

    function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' . date('YMdHis');
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function saveOrganization()
    {

        $validator = $this->Rules($this->request->all());

        if ($validator->passes()) {
            $o_name = strtoupper(str_replace(' ', '_', $this->request->organization_name));
            if ($this->request->id != 0) {
                $save = Organization::findOrFail($this->request->id);

                $emplop = Voucher::where('organization_id', $this->request->id)->get();
                foreach ($emplop as $emp) {
                    Voucher::where('id', '=', $emp->id)
                        ->update([
                            'start_date' => $this->request->start_date,
                            'end_date' => $this->request->end_date,
                            'discont' => $this->request->discont,
                            'message' => $this->request->message
                        ]);
                }
            } else {
                $save = new Organization;
            }
            $save->organization_name = $o_name;
            $save->email = $this->request->email;
            $save->discont = $this->request->discont;
            $save->type_discont = 'percent';
            $save->start_date = $this->request->start_date;
            $save->end_date = $this->request->end_date;
            $save->message = $this->request->message;
            $save->partner_id = ($this->request->partner_id == 'NULL') ? null : $this->request->partner_id;
            $save->sub_group_id = $this->request->sub_group_id;
            $save->type_voucher = $this->request->type_voucher;
            $save->voucher_code = $this->request->voucher_code;
            $save->quota = $this->request->quota;

            if ($save->save()) {

                if ($this->request->type_voucher == 'all') {
                    $emplo = Voucher::where('organization_id', $this->request->id);
                    $emplo->update(['voucher_code' => $save->voucher_code]);
                } else {
                    $emplop = Voucher::where('organization_id', $this->request->id)->get();
                    foreach ($emplop as $emp) {
                        $voucher = $this->generateRandomString();
                        Voucher::where('id', '=', $emp->id)
                            ->update(['voucher_code' => $voucher]);
                    }
                }

                return redirect('organizations')->withInput()->with('success', 'create organization success, data will saved to database');
            }
        }
    }

    public function deleteOrganization()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $or = Organization::findOrFail($id);
            if ($or->delete()) {
                Voucher::where('organization_id', $id)->delete();
                $response = ['status' => 200, 'desc' => 'ok'];
            }

        }
        return $response;
    }

    public function uploadOrganization($id)
    {
        $response = array('status' => 500, 'desc' => 'errors');

        if ($this->request->ajax()) {
            $resExist = '';
            if (!file_exists(storage_path() . '/assets/')) {
                File::makeDirectory(storage_path() . '/assets/', 0777, true);
            }
            $destinationPath = "../storage/assets";
            $file = Input::file(0);
            if ($file) {

                $filename = $file->getClientOriginalName();

                $upload_success = $file->move($destinationPath, $filename);
                if ($upload_success) {
                    $loadExcel = "../storage/assets/assets.xls";
                    if (File::exists($loadExcel)) {

                        $load = \PHPExcel_IOFactory::load('../storage/assets/assets.xls');

                        $sheet = $load->getActiveSheet();
                        $sheets = $sheet->toArray(null, true, true, true, true, true, true, true, true);
                        $i = 1;

                        $organization = Organization::where('id', '=', $id)->first();
                        $discont = $organization->discont;
                        $startdate = $organization->start_date;
                        $enddate = $organization->end_date;
                        $typediscont = $organization->type_discont;
                        $message = $organization->message;
                        $type = $organization->type_voucher;
                        $quota = $organization->quota;
                        $voucher = Voucher::where('organization_id', $id)->count();

                        if ($type == 'multiple') {
                            $voucher_code = $organization->voucher_code;
                        }
                        foreach (array_slice($sheets, $i) as $k) {
                            if ($i < $quota) {
                                if ($type == 'single') {
                                    $voucher_code = $this->generateRandomString();
                                }
                                $checkingCostCenter = Voucher::where('email', $k["B"])->first();
                                if (!$checkingCostCenter) {
                                    $asset = new Voucher;

                                    $employee_email = strtolower($k["B"]);
                                    $asset->organization_id = $id;
                                    $asset->user_id = null;
                                    $asset->email = $employee_email;
                                    $asset->discont = $discont;
                                    $asset->start_date = $startdate;
                                    $asset->end_date = $enddate;
                                    $asset->message = $message;
                                    $asset->type_discont = $typediscont;
                                    $asset->status = 'have not been used';
                                    $asset->voucher_code = $voucher_code;

                                    if ($asset->save()) {
                                        $resSave[] = " Success Save for email $employee_email ";
                                    } else {
                                        $resExist[] = "Employee with email $employee_email  is exist";
                                    }
                                }
                            } else {
                                $responseEmpt[] = $k["B"] . "<br>";
                            }

                            $i++;
                        }

                        if ($i >= 2) {
                            $dir = '../storage/assets/';
                            File::deleteDirectory($dir, true);
                        }
                    }
                }
            }

            $text_is_Added = '';
            $text_is_Not_Found = '';
            $over_limit = '';
            if (!empty($resSave)) {
                foreach ($resSave as $respText) {
                    $text_is_Added .= $respText . '<br>';
                }
            }
            if (!empty($resExist)) {
                foreach ($resExist as $respText) {
                    $text_is_Not_Found .= $respText . '<br>';
                }
            }
            if (!empty($responseEmpt)) {
                $over_limit = 'Sorry, quota voucher is over limit, the list email which not saved<br>';
                foreach ($responseEmpt as $respText) {
                    $over_limit .= $respText . ' <br>';
                }
            }
            $this->request->session()->flash('success', $text_is_Added);
            $this->request->session()->flash('warning', $text_is_Not_Found);
            $this->request->session()->flash('error', $over_limit);

            $response = array('status' => 200, 'desc' => 'ok', 'message' => isset($responseEmpt) ? $responseEmpt : 'success');

        }

        return $response;
    }

    public function delete()
    {
        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $save = Organization::findOrFail($id);
            $save->status = 'disable';
            if ($save->save()) {

                $emplop = Voucher::where('organization_id', $id)->get();
                foreach ($emplop as $emp) {
                    Voucher::where('id', ' = ', $emp->id)
                        ->update(['status' => 'disable']);
                }
            }
        } else {
            return redirect()->back();
        }
    }

    public function deletes()
    {
        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $save = Organization::findOrFail($id);
            $save->status = 'enable';
            if ($save->save()) {
                $emplop = Voucher::where('organization_id', $id)->get();
                foreach ($emplop as $emp) {
                    Voucher::where('id', ' = ', $emp->id)
                        ->update(['status' => 'have not been used']);
                }
            }
        } else {
            return redirect()->back();
        }
    }
}
