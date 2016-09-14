<?php

namespace Villato\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Villato\Company;
use Villato\Http\Controllers\Controller;
use Villato\Http\Requests\User\Company\CreateCompanyRequest;
use Villato\Region;
use Villato\Product;
use Villato\Category;
use Villato\General;
use Villato\Traits\ImageTrait;
use DB;
use Omnipay\Omnipay;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ImageTrait;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = '/';
        $this->loginPath = 'inloggen';
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'De combinatie van e-mailadres en wachtwoord is onjuist.';
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required',
            'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        /**
         * @todo REMOVE "attemptMd5Login()" WHEN ALL USERS HAVE BCRYPT PASSWORD
         */
        if (Auth::attempt($credentials, $request->has('remember')) || $this->attemptMd5Login($credentials,
                $request->has('remember'))
        ) {
           // echo "<pre>";var_dump($throttles);exit;
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }
        //echo $this->loginPath();exit;
        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * @todo Old method to process logins with md5 (REMOVE WHEN ALL USERS HAVE BCRYPT PASSWORD)
     *
     * @param $credentials
     * @param $remember
     * @return bool
     */
    public function attemptMd5Login($credentials, $remember)
    {
        if ($company = Company::where('password', '=', md5($credentials['password']))->first()) {
            Auth::login($company, $remember);
            $company->password = $credentials['password'];
            $company->save();

            return true;
        }
        //echo "<pre>";print_r($credentials);exit;
        return false;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $regions = Region::all();
        $products = Product::all();
        $category = Category::all();
        //dd($category);
        return view('auth.register', [
            'regions' => $regions,
            'products' => $products,
            'category' => $category


        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getDone(Request $request)
    {
        dd($request);
    }
    public function postRegister(CreateCompanyRequest $request)
    {
        //user region save done

         if(empty($request->input('region'))){
            return redirect('/registreren')
            ->withErrors([
                'regions' => 'region is verplicht.',
            ])->withInput();
         }
          if(empty($request->input('category'))){
            return redirect('/registreren')
            ->withErrors([
                'regions' => 'category is verplicht.',
            ])->withInput();
         }
          if(empty($request->input('product'))){
            return redirect('/registreren')
            ->withErrors([
                'regions' => 'product is verplicht.',
            ])->withInput();
         }

        $company = New Company();
        $company->fill($request->except(['image', 'region','category','product']));                
        $company->save();
        $companyid = DB::getPdo()->lastInsertId();
        $general = new General();
       
            //category saved
            foreach ($request->input('category') as $key => $category) {
                $datacategory[$key]['company_id'] = $companyid; 
                $datacategory[$key]['category_id'] = $category;

                if ($key < 1) {
                    $datacategory[$key]['serviceflag'] = 'free';    
                }else{
                    $datacategory[$key]['serviceflag'] = 'paid';
                }
                //$company->category()->attach($category, ['company_id' =>  DB::getPdo()->lastInsertId()]);
            }
            $general->set_table('company_category');
            $general->saveBatch($datacategory);

            //Product saved
            foreach ($request->input('product') as $key => $product) {
                $dataproduct[$key]['company_id'] = $companyid; 
                $dataproduct[$key]['product_id'] = $product;

                if ($key < 3) {
                    $dataproduct[$key]['serviceflag'] = 'free';    
                }else{
                    $dataproduct[$key]['serviceflag'] = 'paid';
                }
             }  
             $general->set_table('company_product');
             $general->saveBatch($dataproduct); 


              ////region saved         
            foreach ($request->input('region') as $key => $region) {
                    $dataregion[$key]['company_id'] = $companyid; 
                    $dataregion[$key]['region_id'] = $region;
                        if ($key == 0) {
                            $dataregion[$key]['serviceflag'] = 'free';    
                        }else{
                            $dataregion[$key]['serviceflag'] = 'paid';
                        }
               }
             $general->set_table('company_region');
             $general->saveBatch($dataregion);

            //image done
            if ($request->hasFile('image')) {
                $this->saveMultipleImages($company, $request->file('image'));
            }

        return redirect($this->redirectPath())->with([
            'message' => [
                'type' => 'success',
                'content' => 'Uw bent nu geregistreerd en kunt nu inloggen.'
            ]
        ]);
    }

    public function getProductsByCat(Request $request){
        $product = new Product();   
        $select = "";    
        //dd($request->input('catid')[0]);
		if(count($request->input('catid'))> 0 ){
			foreach ($request->input('catid') as $k => $v) {
				$record = $product->leftjoin('product_category_relation','product_category_relation.product_id','=','product.id')
				->where('product_category_relation.category_id','=',$v)->get();
				if (count($record) > 0) {
					foreach ($record as $key => $value) {
						$select .= '<option value='.$value->id.'>'.$value->name.'</option>';
					}    
				}
			}
        }
        die(json_encode($select));
        

    }

     public function getCategoryByRegion(Request $request){
        $category = new Category();   
        $select = "";    
		foreach ($request->input('regid') as $k => $v) {
			$record = $category->leftjoin('category_region_relation','category_region_relation.category_id','=','category.id')
			->where('category_region_relation.region_id','=',$v)->get();
			if (count($record) > 0) {
				foreach ($record as $key => $value) {
					$select .= '<option value='.$value->id.'>'.$value->name.'</option>';
				}    
			}
		}
      
        die(json_encode($select));
        

    }
}
