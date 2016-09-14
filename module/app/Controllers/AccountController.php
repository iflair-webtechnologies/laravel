<?php

namespace Villato\Http\Controllers;


use Illuminate\Http\Request;
use Villato\Category;
use Villato\Http\Requests\User\Company\UpdateCompanyRequest;
use Villato\Http\Requests\User\News\CreateNewsRequest;
use Villato\Http\Requests\User\News\UpdateNewsRequest;
use Villato\Http\Requests\User\Offer\CreateOfferRequest;
use Villato\Http\Requests\User\Offer\UpdateOfferRequest;
use Villato\Http\Requests\User\Vacancy\CreateVacancyRequest;
use Villato\Http\Requests\User\Vacancy\UpdateVacancyRequest;
use Villato\Http\Requests\User\Advertisement\CreateAdvertisementRequest;
use Villato\Http\Requests\User\Advertisement\UpdateAdvertisementRequest;
use Villato\Image as Image;
use Villato\News;
use Villato\Offer;
use Villato\Company;
use Villato\Product;
use Villato\Advertisement;
use Villato\Categoryadvt;
use Villato\Region;
use Villato\Traits\ImageTrait;
use Villato\Vacancy;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Villato\General;
use DB;
use Cart;
use Session;
use Bs;
class AccountController extends Controller
{
    use ImageTrait;

    protected $company;

    /**
     * Set Company property to logged in user.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        if (!empty(Auth::user()->email) && Auth::user()->type == 'admin') {
            return redirect('/admin')->send();
        }else{
            //return redirect('/mijn-villato');
        }
        if ($request->user())
        {
            $this->company = $request->user();
            //echo "<pre>";print_r($this->company);exit;
            $this->company->load(['vacancies', 'offers', 'news', 'products']);
        }

    }

    /**
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        
        $regions = Region::all();
       // $categories = Category::with('products')->get();
         $categories = Category::all();
         //dd($this->company->category->implode('name', ', '));
         $usercategory = $this->company->category->implode('name', ', ');
         $userproduct = $this->company->products->implode('name', ', ');
         $userregions = $this->company->regions->implode('name', ', ');
        
        return view('account.index', [
            'title' => 'Mijn Villato - Villato',
            'company' => $this->company,
            'regions' => $regions,
            'images' => $this->company->images,
            'categories' => $categories,
            'userregions' => $userregions,
            'userproduct' => $userproduct,
            'usercategory' => $usercategory,

        ]);
    }
    public function passwordChange(){
        return view('account.password');
    }
    public function accountBalance(){
        return view('account.balance');
    }
    public function accountAdvertisement(){
        $Categoryadvt = Categoryadvt::with('advertisement')->get();
        $advt = Advertisement::join('image', 'image.imageable_id', '=', 'advertisement.id')->where('image.imageable_type', '=', 'Villato\Advertisement')->get();        
      // dd($Categoryadvt);
        
        return view('account.advertisement',['Categoryadvt' => $Categoryadvt,'advt'=>$advt]);
    }
    public function accountProductRegion(){

        $regions = Region::all();
        //$categories = Category::all();
       // $products = Product::all();  
        $totalamount = 0;
        $userproduct = Product::join('company_product', 'company_product.product_id', '=', 'product.id')
                ->where('company_product.company_id', '=', Auth::user()->id)
                ->orderBy('company_product.serviceflag','ASC' )
                ->get();
        
        $productarr = "";
        foreach ($userproduct as $key => $value) {
            if ($value->serviceflag == 'paid') {
                $productarr .= $value->id.',';        
            }
        }
        
        if (!empty($productarr)) {
                $categoryget = DB::select('select category_id from product_category_relation where product_id IN('.trim($productarr,',').')');
                foreach ($categoryget as $key => $value) {                   
                        $categoryarr[] = $value->category_id;    
                }
        $pricecount = Region::select(array('population','id'))->
                    join('category_region_relation', 'category_region_relation.region_id', '=', 'region.id')
                    ->whereIn('category_region_relation.category_id',$categoryarr)->distinct()        
                    ->get();       
            foreach ($pricecount as $key => $value) {
                    $totalamount += 1*($value->population/10000);              
                }

        }else{
            $totalamount = 0.00;

        }

        $userregions = Region::select('*')->join('company_region','region.id','=','company_region.region_id')->where('company_region.company_id', '=', Auth::user()->id)->where('region.active', '=','1')->distinct()->get();
        foreach ($userregions as $key => $value) {
            $Rarray[] = $value->id;
        }
        
        $categories = Category::select(array('category_id','name'))->join('category_region_relation','category_region_relation.category_id','=','category.id')->whereIn('category_region_relation.region_id',$Rarray)->distinct()->get();
        
        
        $usercategories = category::select('*')->join('company_category','company_category.category_id','=','category.id')->where('company_category.company_id', '=', Auth::user()->id)->get();

        foreach ($usercategories as $key => $value) {
            $Carray[] = $value->category_id;
        }     
        if(empty($Carray)){

            $Carray[] = "99999999999999999999999999999";
        }
     
        //dd($Carray);
        $products = Product::select(array('product_id','name'))->join('product_category_relation','product_category_relation.product_id','=','product.id')->whereIn('product_category_relation.category_id',$Carray)->distinct()->get();
        


        return view('account.productregion',['regions' => $regions,
                        'categories'=>$categories,
                        'products'=>$products,
                        'userproduct'=>$userproduct,
                        'userregions'=>$userregions,
                        'usercategories' =>$usercategories,
                        'totalamount' => number_format($totalamount, 2, ',', ' ')
            ]);
    }

    /**
     * Unsubscribe newsletter from Company
     *
     * @return \Illuminate\View\View
     */
    public function getNewsletterUnsubscribe()
    {
        $this->company->newsletter = 0;
        $this->company->save();

        return view('account.unsubscribe', [
            'title' => 'Nieuwsbrief Opzeggen - Villato',
            'company' => $this->company,
        ]);
    }

    /**
     * Update details for Company
     *
     * @param UpdateCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateCompany(UpdateCompanyRequest $request)
    {
        $this->company->fill($request->except(['region', 'image']));
        $this->company = $this->saveMultipleImages($this->company, $request->file('image'));        
        $this->company->save();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Update password for current Company
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdatePassword(Request $request)
    {
        $rules = [
            'password_current' => 'required|password',
            'password' => 'required|confirmed|min:8',
        ];

        $this->validate($request, $rules);

       // $this->company->password = bcrypt($request->input('password'));
         $this->company->password = $request->input('password');
        $this->company->save();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Get specific Offer item for Company
     *
     * @param Offer $offer
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOffer(Offer $offer)
    {
        $offer->setVisible(['id', 'title', 'description', 'content', 'image']);

        return response()->json($offer);
    }

    /**
     * Create Offer item for Company
     *
     * @param CreateOfferRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateOffer(CreateOfferRequest $request)
    {
        $offer = new Offer();
        $offer->fill($request->except(['image']));
        $offer->company()->associate($this->company);
        $offer->save();

        if ($request->hasFile('image')) {
            $image = $this->saveImage(New Image(), $request->file('image'));
            $offer->images()->save($image);
        }

        return response()->json([
            'success' => true,
            'message' => 'Uw Aanbieding is toegevoegd.',
            'html' => view('includes.account.item.offer', [
                'offer' => $offer
            ])->render()
        ]);
    }

    /**
     * Update Offer item for Company
     *
     * @param UpdateOfferRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateOffer(UpdateOfferRequest $request)
    {
        $offer = Offer::inCompany($this->company)->where('id', '=', $request->input('id'))->first();

        if ($offer) {
            $offer->fill($request->only(['title', 'description', 'content']));

            if ($request->hasFile('image')) {
                $image = $this->saveImage($offer->images->first(), $request->file('image'));
                $offer->images()->save($image);
            }

            $offer->save();

            return response()->json([
                'success' => true,
                'message' => 'Uw Aanbieding is bijgewerkt.',
                'title' => $offer->title
            ]);
        }

        abort(404);
    }

    /**
     * Delete Offer item for Company
     *
     * @param Offer $offer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postDeleteOffer(Offer $offer)
    {
        if ($offer->company->id == $this->company->id) {
            $offer->delete();
            return response()->json([
                'success' => true,
                'message' => 'Uw Aanbieding is verwijderd.',
            ]);
        }
    }
    /**
     * Delete Offer item for Company
     *
     * @param Offer $offer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postDeleteProduct(Product $product)
    {
       
       $this->company->products()->detach($product->id);
       return redirect('mijn-villato/productregion')->send();
    }

    /**
     * Delete Offer item for Company
     *
     * @param Offer $offer
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postDeleteCategory(Category $category)
    {
       $products = DB::select("SELECT product_category_relation.product_id FROM product_category_relation JOIN company_product ON company_product.product_id = product_category_relation.product_id WHERE category_id = ".$category->id." and company_product.company_id = ".$this->company->id." AND company_product.serviceflag = 'paid'");
       
       if (empty($products)) {
            $this->company->category()->detach($category->id);
            return redirect('mijn-villato/productregion')->send();
       }else{
        return redirect('mijn-villato/productregion')->withErrors([
                'error' => 'Please remove related product from '.$category->name,
            ]);


       }
    }

    public function postDeleteRegion(Region $region)
    {
       $categories = DB::select("SELECT category_region_relation.category_id FROM category_region_relation JOIN company_category ON company_category.category_id = category_region_relation.category_id WHERE category_region_relation.region_id = ".$region->id." and company_category.company_id = ".$this->company->id." AND company_category.serviceflag = 'paid'");
       
       if (empty($categories)) {
            $this->company->regions()->detach($region->id);
            return redirect('mijn-villato/productregion')->send();
       }else{
        return redirect('mijn-villato/productregion')->withErrors([
                'error' => 'Please remove related categories from '.$region->name,
            ]);
       }
    }

    /**
     * Get details for specific News item for Company
     *
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNews(News $news)
    {
        $news->setVisible(['id', 'title', 'description', 'content', 'image']);

        return response()->json($news);
    }

    /**
     * Create News item for Company
     *
     * @param CreateNewsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateNews(CreateNewsRequest $request)
    {
        $news = new News();
        $news->fill($request->only(['title', 'description', 'content']));
        $news->company()->associate($this->company);
        $news->save();

        if ($request->hasFile('image')) {
            $image = $this->saveImage(new Image(), $request->file('image'));
            $news->images()->save($image);
        }

        return response()->json([
            'success' => true,
            'message' => 'Uw Nieuwsbericht is aangemaakt.',
            'html' => view('includes.account.item.news', [
                'news' => $news
            ])->render()
        ]);
    }

    /**
     * Update News item for Company
     *
     * @param UpdateNewsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateNews(UpdateNewsRequest $request)
    {
        $news = News::inCompany($this->company)->where('id', '=', $request->input('id'))->first();

        if ($news) {
            $news->fill($request->only(['title', 'description', 'content']));

            if ($request->hasFile('image')) {
                $image = $this->saveImage($news->images->first(), $request->file('image'));
                $news->images()->save($image);
            }

            $news->save();

            return response()->json([
                'success' => true,
                'message' => 'Uw Nieuwsbericht is bijgewerkt.',
                'title' => $news->title
            ]);
        }

        abort(404);
    }

    /**
     * Delete News item for Company
     *
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postDeleteNews(News $news)
    {
        if ($news->company->id == $this->company->id) {
            $news->delete();

            return response()->json([
                'success' => true,
                'message' => 'Uw Nieuwsbericht is verwijderd.',
            ]);
        }
    }

    /**
     * get specific Vacancy details for Company
     *
     * @param Vacancy $vacancy
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVacancy(Vacancy $vacancy)
    {
        $vacancy->setVisible([
            'id',
            'title',
            'description',
            'function_description',
            'email',
            'education',
            'duration',
            'hours'
        ]);

        return response()->json($vacancy);
    }

    /**
     * Create new Vacancy for Company
     *
     * @param CreateVacancyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateVacancy(CreateVacancyRequest $request)
    {
        $vacancy = new Vacancy();
        $vacancy->fill($request->only([
            'title',
            'description',
            'function_description',
            'email',
            'education',
            'duration',
            'hours'
        ]));
        $vacancy->company()->associate($this->company);
        $vacancy->save();

        return response()->json([
            'success' => true,
            'message' => 'Uw Nieuwsbericht is aangemaakt.',
            'html' => view('includes.account.item.vacancy', [
                'vacancy' => $vacancy
            ])->render()
        ]);
    }

    /**
     * Update Vacancy for Company
     *
     * @param UpdateVacancyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateVacancy(UpdateVacancyRequest $request)
    {
        $vacancy = Vacancy::inCompany($this->company)->where('id', '=', $request->input('id'))->first();

        if ($vacancy) {
            $vacancy->fill($request->only([
                'title',
                'description',
                'function_description',
                'email',
                'education',
                'duration',
                'hours'
            ]));
            $vacancy->save();

            return response()->json([
                'success' => true,
                'message' => 'Uw Nieuwsbericht is bijgewerkt.',
                'title' => $vacancy->title
            ]);
        }

        abort(404);
    }

    /**
     * Delete Vacancy for Company
     *
     * @param Vacancy $vacancy
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postDeleteVacancy(Vacancy $vacancy)
    {
        if ($vacancy->company->id == $this->company->id) {
            $vacancy->delete();

            return response()->json([
                'success' => true,
                'message' => 'Uw Vacature is verwijderd.',
            ]);
        }
    }

    /**
     * Get Company Products
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts()
    {
        return response()->json($this->company->products);
    }

    /**
     * Update Company Products
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateProducts(Request $request)
    {
        $rules = [
            'product' => 'required|min:1'
        ];

        if ($request->has('product)')) {
            foreach ($request->input('product') as $key) {
                if ($request->has('product.' . $key)) {
                    $rules['product.' . $key] = 'integer|exists:product,id';
                }
            }
        }

        $this->validate($request, $rules);

        foreach ($this->company->products as $product) {
            $this->company->products()->detach($product->id);
        }

        foreach ($request->input('product') as $product) {
            $this->company->products()->attach($product, ['region_id' => $this->company->region->id]);
        }

        $this->company->save();

        return response()->json([
            'success' => true,
            'message' => 'Uw Producten zijn bijgewerkt.',
            'html' => view('includes.account.item.products', [
                'products' => $this->company->products()->get()
            ])->render()
        ]);
    }
    public function idealreturn(){
        echo "hi";
    }
    public function checkiDeal(){
        //echo  url().'/idealreturn';exit;

        $ideal = new Bs\IDeal\IDeal('https://ideal-test.postcode.nl/ideal');

        dd($ideal);
                
            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey('sk_test_bCDNgF4JJT7XSYkOaYZuInRN');
            //dd($gateway->fetchToken());exit;
            

            $formData = array('number' => '4242424242424242', 'expiryMonth' => '07', 'expiryYear' => '2020', 'cvv' => '123');
            $response = $gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => $formData))->send();

            if ($response->isSuccessful()) {
                // payment was successful: update database
               echo "<pre>"; print_r($response);
            } elseif ($response->isRedirect()) {
                // redirect to offsite payment gateway
                $response->redirect();
            } else {
                // payment failed: display message to customer
                echo $response->getMessage();
            }

    }
     public function checkiDealOld(){
        //echo  url().'/idealreturn';exit;
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('seller_1329211738_biz_api1.iflair.com');
        $gateway->setPassword('1329211764');
        $gateway->setTestMode(true);
        $gateway->setSignature('AfH8G9gjySKC2j4raiKYqivIoeWcAxiT0YyErn9CX1zrT6DRW4pLyHTp');
        $params = [
            'amount' => 150.00,
            'issuer' => 25,
            'name' => 'test',
            'quantity' => 2,
            'currency' => 'EUR',
            'description' => 'Purchase region',            
            'cancelUrl' => url().'/idealreturn'
        ];  
        $response = $gateway->purchase($params)->send();
       

        if ($response->isSuccessful()) {
            // payment was successful: update database
            print_r($response);
        } elseif ($response->isRedirect()) {
            // redirect to offsite payment gateway

            return $response->getRedirectResponse();
        } else {
            // payment failed: display message to customer           
            echo $response->getMessage();
        }

    }
    public function postUpdateAdvt(UpdateAdvertisementRequest $request)
    {
	    	$advertisement = new Advertisement;
	    	$post = $request->except(['category','advtid','_token','image','imgstatus']); 

         	$advertisement->where('id','=',$request->advtid)->update($post);
         	//echo $request->advtid;
         	$dbimage = Image::where('imageable_id', '=', $request->advtid)->where('imageable_type','=','Villato\Advertisement')->get();
         	// var_dump(count($dbimage));
         	// dd($dbimage);

         	if (count($dbimage) == 1 && $request->hasFile('image')) {
         				$image = $this->saveImage(new Image, $request->file('image'));
		            	$imagenew = new Image;
		            	$imagedata['path'] = $image->path;
		            	$imagedata['width'] = $image->width;
		            	$imagedata['height'] = $image->height;
		            	$imagedata['order'] = $image->order;
		            	$imagedata['imageable_type'] =  'Villato\Advertisement';
		            	$imagedata['updated_at'] = date('Y-m-d H:i:s');             	
		            	$imagenew->where('imageable_id','=',$request->advtid)->where('imageable_type','=','Villato\Advertisement')->update($imagedata);
         	}else if($request->hasFile('image') && $request->imgstatus == 'noimage' ){
         				$image = $this->saveImage(new Image, $request->file('image'));
		            	$imagenew = new Image;
		            	$imagedata['path'] = $image->path;
		            	$imagedata['width'] = $image->width;
		            	$imagedata['height'] = $image->height;
		            	$imagedata['order'] = $image->order;
		            	$imagedata['imageable_type'] =  'Villato\Advertisement';
		            	$imagedata['updated_at'] = date('Y-m-d H:i:s');             	
		            	$imagenew->where('imageable_id','=',$request->advtid)->where('imageable_type','=','Villato\Advertisement')->update($imagedata);

         	}else if(!$request->hasFile('image') && $request->imgstatus == 'noimage' ){
         			$imagenew = new Image;
         			$imagedata['path'] = "no_image.jpg";
         			$imagenew->where('imageable_id','=',$request->advtid)->where('imageable_type','=','Villato\Advertisement')->update($imagedata);
         	}

         	

        	return redirect('mijn-villato/accountadvt')->send();
    }
    /**
     * Store a newly created product in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function postCreateAdvt(CreateAdvertisementRequest $request)
    {
    	$advertisement = new Advertisement;
        $post = $request->except(['']);
        $advertisement->fill($post);
        $category = Categoryadvt::find($request->input('category'));
        $advertisement->categoryadvt()->associate($category);
        $advertisement->save();

        if($request->hasFile('image')) {
            $image = $this->saveImage(new Image, $request->file('image'));

            $advertisement->images()->save($image);
        }
         return redirect('mijn-villato/accountadvt')->send();
      //  return $this->redirectSuccess('admin.advertisement.index', 'Successfully created product!');
    }
    public function addRegion(Request $request){


        $regionid = $request->input('regionid');
        $response = array();
        $general = new General();        
        $general->set_table('company_region');
        $condition['region_id'] =  $regionid;
        $condition['company_id'] =  Auth::user()->id;
        $duplicate = $general->checkDuplicate($condition);       
        if ($duplicate == false) {
                $data['company_id'] = Auth::user()->id;
                $data['region_id'] = $regionid; 
                $data['serviceflag'] = 'paid';                       
                $general->saveRecord($data);
                $usercategories = "";
                $userregions = Region::select('*')->join('company_region','region.id','=','company_region.region_id')->where('company_region.company_id', '=', Auth::user()->id)->where('region.active', '=','1')->distinct()->get();
                foreach ($userregions as $key => $value) {
                    $Rarray[] = $value->id;
                }
               
                $categories = Category::select(array('category_id','name'))->join('category_region_relation','category_region_relation.category_id','=','category.id')->whereIn('category_region_relation.region_id',$Rarray)->distinct()->get();

                foreach ($categories as $key => $value) {
                    $usercategories .= '<option value='.$value->category_id.'>'.$value->name.'</option>';
                }
                $response['usercategories'] = $usercategories;
                $response['status'] = 'true';
        }else{
                $response['status'] = 'false';
                $response['msg'] = 'Region is already added !!';
        }
        return response()->json($response);

    }
     public function addCategory(Request $request){


        $categoryid = $request->input('categoryid');
        $response = array();
        $general = new General();
        $general->set_table('company_category');
        $condition['category_id'] =  $categoryid;
        $condition['company_id']  =  Auth::user()->id;
        $duplicate = $general->checkDuplicate($condition);
        $userproduct = "";
        if ($duplicate == false) {
                $data['company_id'] = Auth::user()->id;
                $data['category_id'] = $categoryid;
                $data['serviceflag'] = 'paid';                       
                $general->saveRecord($data);
     
            $usercategories = category::select('*')->join('company_category','company_category.category_id','=','category.id')->where('company_category.company_id', '=', Auth::user()->id)->get();

            foreach ($usercategories as $key => $value) {
                        $Carray[] = $value->id;
                    }
        
            $products = Product::select(array('product_id','name'))->join('product_category_relation','product_category_relation.product_id','=','product.id')->whereIn('product_category_relation.category_id',$Carray)->distinct()->get();

                foreach ($products as $key => $value) {
                    $userproduct .= '<option value='.$value->product_id.'>'.$value->name.'</option>';
                }
                $response['userproduct'] = $userproduct;
                $response['status'] = 'true';
        }else{
                $response['status'] = 'false';
                $response['msg'] = 'Category is already added !!';

        }
        return response()->json($response);
    }
  

    public function addProduct(Request $request){
    	//Cart::destroy();die();
        DB::enableQueryLog();
        $response = array();
        $product_id = (int)$request->input('productid');
        $product  = array('id' => $product_id,'name' => $request->input('productname'),
        'qty' => 1,'price' => 10.00);
        $i = 0;
        //Cart::clear();
        foreach (Cart::content() as $key => $value) {
                		 if ($value->id == $product_id) {
                		 	$i++;	
                		 }
                	}
                    if ($i == 0) {
		                    	Cart::add($product);
		                    	$response['status'] = 'true';
		                        return response()->json($response);             
                	} else{
								$response['status'] = 'false';
                                $response['msg'] = 'Product is already added !!';
                                return response()->json($response);	                				

                	}     

                	die();

        
                    
         
        $productcount = (int)$request->input('productcount');
        $productid = $request->input('productid');
        $response = array();
        $general = new General();
        $general->set_table('company_product');
        $condition['product_id'] =  $productid;
        $condition['company_id']  =  Auth::user()->id;
        $duplicate = $general->checkDuplicate($condition);
         
        if ($duplicate == false) {
                $data = array();
                $data['company_id'] = Auth::user()->id;
                $data['product_id'] = $productid;

                if($productcount >= 3 ) {
                                $data['serviceflag'] = 'paid';     
                            }else{                                
                                $data['serviceflag'] = 'free';
                                 $productcount++;    
                            }
                   $general->saveRecord($data);         
                
        //         dd(
        //     DB::getQueryLog()
        // ); 

                $totalamount = 0;
                $userproduct = Product::join('company_product', 'company_product.product_id', '=', 'product.id')
                ->where('company_product.company_id', '=', Auth::user()->id)
                ->where('company_product.serviceflag','=','paid' )
                ->get();
        
                $productarr = "";
                foreach ($userproduct as $key => $value) {
                        $productarr .= $value->id.','; 
                }            
        
        if (!empty($productarr)) {
                $categoryget = DB::select('select category_id from product_category_relation where product_id IN('.trim($productarr,',').')');
                foreach ($categoryget as $key => $value) {                   
                        $categoryarr[] = $value->category_id;    
                }

        $pricecount = Region::select(array('population','id'))->
                    join('category_region_relation', 'category_region_relation.region_id', '=', 'region.id')
                    ->whereIn('category_region_relation.category_id',$categoryarr)->distinct()        
                    ->get();
       
        foreach ($pricecount as $key => $value) {
                $totalamount += 1*($value->population/10000);              
            }

        }else{
            $totalamount = 0.00;

        }
                 $productstring = '';                 
                 if (!empty($userproduct)) {  
                    foreach ($userproduct as $key => $value) {                        
                           $productstring .= $value->name.', ';
                    }
                }
                //echo $paidcount;
                $append = count($userproduct).' producten (';  
                $productstring  = $append.''.rtrim($productstring, ', ').')';
                $response['totalamount'] = number_format($totalamount, 2, ',', ' '); 
                $response['productstring'] = $productstring;
                $response['productcount'] = $productcount;
                $response['status'] = 'true';
        }else{
                $response['status'] = 'false';
                $response['msg'] = 'Product is already added !!';

        }
        return response()->json($response);
    }

      public function addToCart(){  
                //dd(Session::all());    
               //Cart::destroy();
                	//dd(Cart::total());
      	      //Cart::remove("fd36606dadaebf1bcd49e3d9f79c090b");
      	//dd(Cart::search(array('id' => 282)));
                  dd(Cart::content());
            }
    
}
