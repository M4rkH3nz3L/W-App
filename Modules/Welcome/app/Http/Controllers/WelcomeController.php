<?php

namespace Modules\Welcome\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CMS\App\Models\Post;
use Modules\CMS\App\Models\Page;
use Modules\Shop\App\Models\Offer;
use Illuminate\Support\Facades\Config;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lekérjük a konfigurációs beállításokat
        $homepageType = Config::get('welcome.homepage.type');
        $pageId = Config::get('welcome.homepage.page_id');

        switch ($homepageType) {
            default:
            case 'Blog':
                $posts = Post::paginate(10);
                return view('welcome::index', ['posts' => $posts, 'homepageType' => $homepageType]);

            case 'Page':
                if ($pageId) {
                    $page = Page::find($pageId);
                    return view('welcome::index', ['page' => $page, 'homepageType' => $homepageType]);
                } else {
                    abort(404, 'Page ID not specified.');
                }

            case 'Shop':
                $offers = Offer::paginate(10);
                return view('welcome::index', ['offers' => $offers, 'homepageType' => $homepageType]);

        }
    }
}
