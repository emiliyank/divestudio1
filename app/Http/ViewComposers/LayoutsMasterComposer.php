<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\CmStaticPage;

class LayoutsMasterComposer
{
    protected $test;

    public function __construct(String $test)
    {
        // Dependencies automatically resolved by service container...
        $this->test = 'test string';
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $footer_static_pages = CmStaticPage::where('is_in_footer', 1)->whereNull('date_deleted')->get();
        echo "do we execute this code!?";
        print_r($footer_static_pages);
        $view->with('test', $this->test);
    }
}