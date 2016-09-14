<?php

namespace Villato\Http\Controllers;
use Illuminate\Http\Request;
use Villato\Http\Requests\Admin\Cms\CreateCmsRequest;
use Villato\Http\Requests\Admin\Cms\UpdateCmsRequest;
use Villato\Cms;

class IndexController extends Controller
{

    /**
     * Returns Villato About Page
     *
     * @return \Illuminate\View\View
     */
    public function getAbout()
    {
        $cms = Cms::where('id', '=', 3);        
        return view('about', [
            'title' => 'Over',
            'cms' => $cms->first()
        ]);
    }

}
