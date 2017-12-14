<?php


namespace App\Http\Controllers;

use App\Http\Models\Voucher;
use App\Http\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Libraries\Convert;
use App\Http\Libraries\Render;
use DB,
    Redirect, File,
    Input,
    Validator;
use Yajra\Datatables\Facades\Datatables;

class VoucherController extends HomeController
{
    public function form_add_organizationa($id)
    {
        $organization = Organization::findOrfail($id);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'employee/formemployee', ['organization' => $organization]);
    }

    public function form_edit_organization($id)
    {
        $data = Voucher::findOrFail($id);
        $organization = Organization::findOrfail($data->organization_id);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'employee/formemployeedit', ['data' => $data, 'organization' => $organization]);
    }

    public function form_detail_organization()
    {
        $this->data['css'] = Assets::add($this->data['css'], 'css', ['circle']);
        return view('layout/main')->with('data', $this->data)
            ->nest('content', 'employee/master');
    }

    public function Rules($data, $id = '')
    {
        $rules = [
            'email' => 'required|string|max:255',
        ];

        $validate = Validator::make($data, $rules);

        return $validate;
    }

    function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function saveEmployee()
    {

        $validator = $this->Rules($this->request->all());

        if ($validator->passes()) {
//            $o_name = strtolower(str_replace(' ', '_', $this->request->organization_name));
            if ($this->request->id != 0) {
                $save = Voucher::findOrFail($this->request->id);
            } else {
                $save = new Voucher;
                $save->status = 'have not been used';
            }

            $save->organization_id = $this->request->organization_id;
            $save->user_id = $this->request->user_id;
            $save->email = $this->request->email;
            $save->discont = $this->request->discont;
            $save->type_discont = 'percent';
            $save->start_date = $this->request->start_date;
            $save->end_date = $this->request->end_date;
            $save->message = $this->request->message;
            $save->voucher_code = $this->request->voucher_code;

            $count_organization = Organization::findOrFail($this->request->organization_id)->quota;
            $count_voucher = Voucher::where('organization_id', $this->request->organization_id)->count();

            if ($count_organization < $count_voucher) {
                return redirect('organizations/detail/' . $this->request->organization_id)->withInput()->with('error', 'Sorry, quota voucher is over limit');
            } else {
                if ($save->save()) {
                    return redirect('organizations/detail/' . $this->request->organization_id)->withInput()->with('success', 'Success, data will saved to database');
                }
            }
        } else {
            return redirect('organizations/detail/' . $this->request->organization_id)->withInput()->with('error', 'Error, Voucher code is duplicate');
        }
    }

    public function deleteOrganization()
    {
        $response = array('status' => 500, 'desc' => 'failure');

        if ($this->request->ajax()) {
            $id = $_POST['id'];
            $or = Voucher::findOrFail($id);
            if ($or->delete()) {
                $response = ['status' => 200, 'desc' => 'ok'];
            }

        }
        return $response;
    }

    public function delete()
    {
        if ($this->request->ajax()) {
            $id = $_POST['id'];

            $asset = Voucher::findOrFail($id);

            if (is_array($id)) {
                $count = 0;
                foreach ($asset as $as):
                    $save = Voucher::findOrFail($as->id);
                    $save->status = "disable";
                    $save->save();
                    $count++;
                endforeach;

                $this->request->session()->flash('success', 'Successfully Change ' . $count . ' Items.');
            } else {
                $save = Voucher::findOrFail($id);
                $save->status = "disable";
                if ($save->save()) {
                    $this->request->session()->flash('success', 'Successfully Changed.');
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

            $asset = Voucher::findOrFail($id);

            if (is_array($id)) {
                $count = 0;
                foreach ($asset as $as):
                    $save = Voucher::findOrFail($as->id);
                    $save->status = "have not been used";
                    $save->save();
                    $count++;
                endforeach;

                $this->request->session()->flash('success', 'Successfully Change ' . $count . ' Items.');
            } else {
                $save = Voucher::findOrFail($id);
                $save->status = "have not been used";
                if ($save->save()) {
                    $this->request->session()->flash('success', 'Successfully Changed.');
                }
            }
        } else {
            return redirect()->back();
        }
    }
}

