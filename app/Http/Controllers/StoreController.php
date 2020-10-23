<?php

namespace App\Http\Controllers;


use App\Item;
use App\User;
use App\Store;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['home', 'login', 'signup', 'storeSignup', 'storeLogin']);
		$this->middleware('guest')->only(['login', 'signup']);
	}


	public function home()
	{
		return view('welcome');
	}

    public function showStore($id)
    {
  		$store = DB::table('stores')->find($id);
		$items = Item::where('storeId', '=', $id)->get();

    	return view('stores.show', compact('store'), compact('items'));
    }

    public function login()
    {
    	return view('users.login');
    }

    public function signup()
    {
    	return view('users.signup');
    }

    public function storeSignup()
    {
    	$this->validate(request(), [
    		'firstName' => 'required',
    		'lastName' => 'required',
    		'email' => 'required|email',
    		'password' => 'required|confirmed',
    		'userType' => 'required',

    	]);

    	$user = User::create([
        	'firstName' => request('firstName'),
        	'lastName' => request('lastName'),
        	'email' => request('email'),
        	'password' => bcrypt(request('password')),
        	'userType' => request('userType'),
        	'storeId' => request('storeId'),
    ]);

    	auth()->login($user);

    	return redirect()->home();

    }
    
    public function logout()
    {
    	auth()->logout();

    	return redirect()->home();
    }

    public function storeLogin()
    {
    	if(! auth()->attempt(request(['email', 'password'])))
    	{
    		return back()->withErrors(['error' => 'Invalid login']);
    	}

    	return redirect()->home();
    }

    public function userPage()
    {
    	$user = Auth::user();
    	if($user->userType == 1){
    		$stores = Store::where('storeStatus', '=', false)->get();
    		return view('users.admin', compact('stores'));
    	}
        else if($user->userType == 2){
    		if($user->storeId == 0){
    			return view('stores.new');
    		}else{
    			$store = DB::table('stores')->find($user->storeId);
    			if($store->storeStatus == false){
    				return view('users.ownerPending');
    			}else{
    				$employees = User::where('storeId', '=', $store->id)->get();
    				return view('users.owner', compact('employees'));
    			}
    			
    		}
    	}
        else if($user->userType == 3){
    		if($user->storeId == 0){
    			return view('users.employeeNoStore');
    		}else{
    			return view('users.employee');
    		}
    	}
    }

    public function storeRequest()
    {
    	$this->validate(request(), [
    		'storeName' => 'required',
    		'storeAddress' => 'required',
    	]);

    	$user = Auth::user();
    	$store = Store::create(request(['storeName', 'storeAddress']));

    	DB::table('users')
            ->where('id', $user->id)
            ->update(['storeId' => $store->id]);

    	return redirect()->home();

    }

    public function addEmployee()
    {
    	$this->validate(request(), [
    		'id' => 'required',
    	]);
    	
    	$user = Auth::user();

    	if(User::where('id', '=', request('id'))->exists()){
    		$employee = DB::table('users')->find(request('id'));
    		echo $employee->userType;
    		if($employee->userType == 3 && $employee->storeId == 0){
    			DB::table('users')
    	        ->where('id', request('id'))
	            ->update(['storeId' => $user->storeId]);
    		}else{
    			return back()->withErrors(['This user cannot be added to your store']);
    		}
		}else{
			return back()->withErrors(['This user does not exist']);
		}

		return back();
    }

    public function removeEmployee($id)
    {
    	$user = Auth::user();

    	$employee = DB::table('users')->find($id);

    	if($user->storeId = $employee->storeId)
    	{
    		DB::table('users')
            ->where('id', $employee->id)
            ->update(['storeId' => 0]);
    	}
    	return back();
    }

    public function inventory()
    {
    	$user = Auth::user();
    	if($user->storeId == 0){
    		return back();
    	}
    	
    	$store = DB::table('stores')->find($user->storeId);
		$items = Item::where('storeId', '=', $user->storeId)->get();
    	
    	return view('stores.show', compact('store'), compact('items'));
    }

    public function removeStore($id)
    {
    	$user = Auth::user();

    	$store = DB::table('stores')->find($id);

    	if($user->userType = 1)
    	{
    		DB::table('stores')
            ->where('id', $store->id)
            ->delete();

            DB::table('users')
            ->where('storeId', $store->id)
            ->update(['storeId' => 0]);

            DB::table('items')
            ->where('storeId', $store->id)
            ->delete();
    	}
    	return back();
    }

    public function acceptStore($id)
    {
    	$user = Auth::user();

    	$store = DB::table('stores')->find($id);

    	if($user->userType = 1)
    	{
    		DB::table('stores')
            ->where('id', $store->id)
            ->update(['storeStatus' => true]);
    	}
    	return back();
    }

    public function manageStores()
    {
    	$user = Auth::user();
    	if($user->userType == 1){
    		$stores = Store::where('storeStatus', '=', true)->get();
    		return view('users.manageStores', compact('stores'));
    	}else{
    		return redirect()->home();
    	}

    }

    public function disableStore($id)
    {
    	$user = Auth::user();

    	$store = DB::table('stores')->find($id);

    	if($user->userType = 1)
    	{
    		DB::table('stores')
            ->where('id', $store->id)
            ->update(['storeStatus' => false]);
    	}
    	return back();
    }

    public function viewInventory($id)
    {
    	$user = Auth::user();
    	if($user->userType != 1){
    		return back();
    	}else{
    		$store = DB::table('stores')->find($id);
			$items = Item::where('storeId', '=', $id)->get();
    		return view('stores.show', compact('store'), compact('items'));
    	}
    }

    public function editItem($id)
    {
    	$item = DB::table('items')->find($id);
    	$user = Auth::user();
    	if($user->storeId == $item->storeId){
    		return view('stores.editInventory', compact('item'));
    	}else{
    		return redirect()->home();
    	}
    	
    	
    }

    public function saveItemEdits($id)
    {
    	$this->validate(request(), [
    		'itemName' => 'required',
    		'itemPrice' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 
    		//regex sourced from https://laracasts.com/discuss/channels/laravel/controller-validation-rule-for-mysql-decimal202?page=0
    		'itemQuantity' => 'required|numeric|integer',
    	]);

    	$item = DB::table('items')->find($id);
    	DB::table('items')
    	        ->where('id', $id)
	            ->update([	'itemName' => request('itemName'), 
	            			'itemPrice' => request('itemPrice'), 
	            			'itemQuantity' => request('itemQuantity')]);
		$user = Auth::user();
		$store = DB::table('stores')->find($user->storeId);
		$items = Item::where('storeId', '=', $user->storeId)->get();
    	return view('stores.show', compact('store'), compact('items'));
    }

    public function addItem()
    {
    	$user = Auth::user();
    	$this->validate(request(), [
    		'itemName' => 'required',
    		'itemPrice' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/', 
    		//regex sourced from https://laracasts.com/discuss/channels/laravel/controller-validation-rule-for-mysql-decimal202?page=0
    		'itemQuantity' => 'required|numeric|integer',
    	]);

    	$item = Item::create([
        	'itemName' => request('itemName'),
        	'itemPrice' => request('itemPrice'),
        	'itemQuantity' => request('itemQuantity'),
        	'storeId' => $user->storeId,
    	]);

    	return back();
    }

    public function removeItem($id)
    {
        $user = Auth::user();

        $item = DB::table('items')->find($id);

        if($user->storeId = $item->storeId)
        {
            DB::table('items')
            ->where('id', $item->id)
            ->delete();
        }
        return back();
    }

    public function editAddress()
    {
        $user = Auth::user();

        DB::table('stores')
        ->where('id', $user->storeId)
        ->update(['storeAddress' => request('id')]);

        return back();
    }
}