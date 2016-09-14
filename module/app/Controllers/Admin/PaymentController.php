<?php

namespace Villato\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Villato\Http\Requests\Admin\Cms\CreateCmsRequest;
// use Villato\Http\Requests\Admin\Cms\UpdateCmsRequest;
// use Villato\Cms;
// use yajra\Datatables\Datatables;

class PaymentController extends CrudController
{
	public function index()
    {
    	return view('admin.payment.transaction');
    }

    

}
