<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\TenantDetail;
use Exception;
use DataTables;

class TenantController extends Controller
{
    // public function showTenants() {
    //     $tenants = Tenant::paginate(10);
    //     return view('tenant.list', [
    //         "tenants" => $tenants
    //     ]);
    // }

    public function showTenants(Request $request){
        if ($request->ajax()) {
            $tenants = Tenant::all();

            return Datatables::of($tenants)
                ->addIndexColumn()
                ->addColumn('action', function ($tenant) {
                    return '<a href="/tenant/edit/' . $tenant->id . '">Edit</a>';
                })
                ->editColumn('company_name', function ($tenant) {
                    return '<a href="/tenant/edit/' . $tenant->id . '">' . $tenant->company_name . '</a>';
                })
                ->addColumn('domain', function ($tenant) {
                    return '<a href="//' . (!empty($tenant->domains[0]->domain) ? $tenant->domains[0]->domain : '') . '" target="_blank">' . (!empty($tenant->domains[0]->domain) ? $tenant->domains[0]->domain : '') . '</a>';
                })
                ->rawColumns(['action', 'company_name', 'domain'])
                ->make(true);
        }
    
        return view('tenant.list');
    }
    public function createTenant() {
        return view('tenant.create');
    }


    public function showUpdateTenant(String $id) {
        $tenant = Tenant::find($id);
        [$user, $tenantDetail] = $tenant->run(function ($tenant) {
            $user = User::where('email', $tenant->user['email'])->first();
            $tenantDetail = TenantDetail::where('tenant_id', $tenant->id)->first();
            return [$user, $tenantDetail];
        });
        return view('tenant.update', [
            'tenant_id'=> $id,
            'tenant' => $tenant,
            'user' => $user,
            'tenantDetail' => $tenantDetail,
        ]);
    }

    public function updateTenant(Request $req, String $id) {
        try {
            $tenant = Tenant::find($id);
            $userData = User::where('email', $tenant->user['email'])->first();
            $postData = $req->validate([
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,'.$userData->id,
                'company_name' => 'required|min:3',
                'phone_number'=> 'required',
                'address' => 'required',
                'tracker_url' => 'max:100',
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'company_name.required' => 'Company name is required',
                'phone_number.required' => 'Phone number is required',
                'address.required' => "Address is required",
                'tracker_url.requires' => "Tracking Script required"
            ]);

            $tracker_url = !empty($postData['tracker_url']) ? ($postData['tracker_url']) : '';
            
            $userName = $postData['first_name'] . " " . $postData['last_name'];
            if($userData->email !== $postData['email'] || $userName !== $userData->name) {
                $userData->email = $postData['email'];
                $userData->name = $postData['first_name'] . " " . $postData['last_name'];
                $userData->save();
            }

            $tenant->run(function ($tenant) use ($postData, $userData, $userName, $tracker_url) {
                if($userData->email !== $postData['email'] || $userName !== $userData->name) {
                    $user = User::where('email', $tenant->user['email'])->first();
                    $user->name = $postData['first_name'] . " " . $postData['last_name'];
                    $user->email = $postData['email'];
                    $user->save();
                }
               // dd($tenant->id);
                $tentantDetail = TenantDetail::where('tenant_id', $tenant->id)->first();
                if($tentantDetail) {
                    $tentantDetail->company_name = $postData['company_name'];
                    // $tentantDetail->state = $postData['state'];
                    // $tentantDetail->country = $postData['country'];
                    $tentantDetail->amount = $postData['amount'];
                    $tentantDetail->address = $postData['address'];
                    $tentantDetail->phone_number = $postData['phone_number'];
                    $tentantDetail->first_name = $postData['first_name'];
                    $tentantDetail->last_name = $postData['last_name'];
                    $tentantDetail->tracker_url = $tracker_url;
                    $tentantDetail->save();
                } else {
                    TenantDetail::create([
                        'tenant_id' => $tenant->id,
                        'company_name' => $postData['company_name'],
                        // 'state' => $postData['state'],
                        // 'country' => $postData['country'],
                        'amount' => $postData['amount'],
                        'address' => $postData['address'],
                        'phone_number' => $postData['phone_number'],
                        'alternate_number' => '',
                        'first_name' => $postData['first_name'],
                        'last_name' => $postData['last_name'],
                        'tracker_url' => $tracker_url
                    ]);
                }
            });
            
            $tenant->update([
                'company_name' => $postData['company_name'],
                // 'state' => $postData['state'],
                // 'country' => $postData['country'],
                'amount' => $postData['amount'],
                'address' => $postData['address'],
                'phone_number' => $postData['phone_number'],
                'alternate_number' => '',
                'first_name' => $postData['first_name'],
                'last_name' => $postData['last_name'],
                'user' => $userData
            ]);
            return back()->with([
                'success' => $id.'.'.env('APP_HOST_NAME', 'localhost')." tenant has been updated!!"
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function saveTenant(Request $req) {
        try {
            $postData = $req->validate([
                'first_name' => 'required|min:3',
                'last_name' => 'required|min:3',
                'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
                'email' => 'required|email|unique:users',
                'company_name' => 'required|min:3|unique:tenants',
                'phone_number'=> 'required',
                'address' => 'required',
                'tracker_url' => 'max:100',
                'amount' => 'required',
                'credit' => 'required',
                'lead_cost' => 'required'
            ], [
                'name.required' => 'Name is required',
                'password.required' => 'Password is required',
                'email.required' => 'Email is required',
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'company_name.required' => 'Company name is required',
                'phone_number.required' => 'Phone number is required',
                'address.required' => "Address is required",
            ]);

            $tracker_url = !empty($postData['tracker_url']) ? ($postData['tracker_url']) : '';
          
            $postData['tenantId'] = $this->getTenentID($postData['company_name']);

            $tenantRole = Role::where('name', 'tenant')->first();
            $userData = [
                'name' => $postData['first_name'] . " " . $postData['last_name'],
                'email' => $postData['email'],
                'password' => bcrypt($postData['password']),
            ];
            $tenantUser = User::create($userData);
            $tenantUser->assignRole($tenantRole);
            
            $tenant = Tenant::create([
                "id" => "".$postData['tenantId'],                
            ]);

            $tenant->update([
                'company_name' => $postData['company_name'],
                // 'state' => $postData['state'],
                // 'country' => $postData['country'],
                'amount' => $postData['amount'],
                'address' => $postData['address'],
                'phone_number' => $postData['phone_number'],
                'alternate_number' => '',
                'first_name' => $postData['first_name'],
                'last_name' => $postData['last_name'],
                'tracker_url' => $tracker_url,
                'user' => $tenantUser
            ]);
            $tenant->domains()->create([
                'domain' => $postData['tenantId'].'.'.env('APP_HOST_NAME', 'localhost')
            ]);
            $tenant->run(function ($tenant) use ($userData, $postData, $tenantUser, $tracker_url) {
                User::create($userData);
                TenantDetail::create([
                    'tenant_id' => $tenant->id,
                    'company_name' => $postData['company_name'],
                    // 'state' => $postData['state'],
                    // 'country' => $postData['country'],
                    'amount' => $postData['amount'],
                    'credit' => $postData['credit'],
                    'lead_cost' => $postData['lead_cost'],
                    'address' => $postData['address'],
                    'phone_number' => $postData['phone_number'],
                    'alternate_number' => '',
                    'first_name' => $postData['first_name'],
                    'last_name' => $postData['last_name'],
                    'tracker_url' => $tracker_url,
                    'user' => $tenantUser
                ]);
            });
            return redirect()->route('showTenants')->with([
                'success' => $postData['tenantId'].'.'.env('APP_HOST_NAME', 'localhost')." tenant has been created!!"
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    protected function getTenentID(String $company_name) {
        $delimiter = '_';
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $company_name))))), $delimiter));
        return $slug;
    }

    public function viewCustomer() {
        return view('tenant.viewcustomer');
    }
}