<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $productTypes = \App\Models\ProductType::withCount('products')->get();
        return view('frontend.pages.about', compact('productTypes'));
    }

    public function allProducts(Request $request)
    {
        $query = \App\Models\Product::query()->with(['brand', 'productType']);

        // Filters
        if ($request->filled('product_type')) {
            $query->whereHas('productType', function($q) use ($request) {
                $q->where('slug', $request->product_type);
            });
        }
        if ($request->filled('industry')) {
            $query->whereHas('industries', function($q) use ($request) {
                $q->where('slug', $request->industry);
            });
        }
        if ($request->filled('brand')) {
            $query->whereHas('brand', function($q) use ($request) {
                $q->where('slug', $request->brand);
            });
        }
        if ($request->filled('space')) {
            $query->whereHas('spaces', function($q) use ($request) {
                $q->where('slug', $request->space);
            });
        }

        $products = $query->paginate(9);

        // Sidebar data
        $productTypes = \App\Models\ProductType::orderBy('name')->get();
        $industries = \App\Models\Industry::orderBy('name')->get();
        $spaces = \App\Models\Space::orderBy('name')->get();
        $brands = \App\Models\Brand::orderBy('name')->get();
        $colors = \App\Models\Color::orderBy('name')->get();
        $materials = \App\Models\Material::orderBy('name')->get();

        return view('frontend.pages.all-products', compact(
            'products', 'productTypes', 'industries', 'spaces', 'brands', 'colors', 'materials'
        ));
    }

    public function careers()
    {
        $vacancies = $this->getVacancies();
        return view('frontend.pages.careers', compact('vacancies'));
    }

    public function caseStudies()
    {
        return view('frontend.pages.case-studies');
    }

    public function caseStudyDetail()
    {
        $products = \App\Models\Product::latest()->take(3)->get();
        return view('frontend.pages.case-study-detail', compact('products'));
    }

    public function conferenceRoomTables()
    {
        return $this->spaceProducts('conference-rooms', 'furniture');
    }

    public function conferenceRooms()
    {
        return $this->spaceDetail('conference-rooms');
    }

    public function spaceDetail($slug)
    {
        $space = \App\Models\Space::where('slug', $slug)->firstOrFail();

        // Fetch product types that have products belonging to this space
        $productTypes = \App\Models\ProductType::with(['products' => function($q) use ($space) {
            $q->whereHas('spaces', function($sq) use ($space) {
                $sq->where('spaces.id', $space->id);
            })->latest()->take(8);
        }])->whereHas('products', function($q) use ($space) {
            $q->whereHas('spaces', function($sq) use ($space) {
                $sq->where('spaces.id', $space->id);
            });
        })->get();

        $context = 'space';

        return view('frontend.pages.conference-rooms', compact('space', 'productTypes', 'context'));
    }

    public function industryDetail($slug)
    {
        $industry = \App\Models\Industry::where('slug', $slug)->firstOrFail();

        // Fetch up to 6 products belonging to this industry
        $products = \App\Models\Product::whereHas('industries', function($q) use ($industry) {
            $q->where('industries.id', $industry->id);
        })->latest()->take(6)->get();

        // If no products specific to this industry, fallback to latest products
        if ($products->isEmpty()) {
            $products = \App\Models\Product::latest()->take(6)->get();
        }

        $brands = \App\Models\Brand::orderBy('name')->get();

        // Get another industry for the CTA banner
        $nextIndustry = \App\Models\Industry::where('id', '!=', $industry->id)->inRandomOrder()->first();

        return view('frontend.pages.hospitality', compact('industry', 'products', 'brands', 'nextIndustry'));
    }

    public function industryCategories($slug)
    {
        $industry = \App\Models\Industry::where('slug', $slug)->firstOrFail();

        // Fetch product types that have products belonging to this industry
        $productTypes = \App\Models\ProductType::with(['products' => function($q) use ($industry) {
            $q->whereHas('industries', function($iq) use ($industry) {
                $iq->where('industries.id', $industry->id);
            })->latest()->take(8);
        }])->whereHas('products', function($q) use ($industry) {
            $q->whereHas('industries', function($iq) use ($industry) {
                $iq->where('industries.id', $industry->id);
            });
        })->get();

        // Map industry to $space object for view compatibility
        $space = (object)[
            'name' => $industry->name,
            'slug' => $industry->slug,
            'id' => $industry->id
        ];

        $context = 'industry';

        return view('frontend.pages.conference-rooms', compact('space', 'productTypes', 'context'));
    }

    public function spaceProducts($space_slug, $type_slug)
    {
        $space = \App\Models\Space::where('slug', $space_slug)->firstOrFail();
        $productType = \App\Models\ProductType::where('slug', $type_slug)->firstOrFail();

        // Fetch products belonging to this space and this product type
        $products = \App\Models\Product::whereHas('spaces', function($q) use ($space) {
            $q->where('spaces.id', $space->id);
        })->whereHas('productType', function($q) use ($productType) {
            $q->where('product_types.id', $productType->id);
        })->latest()->get();

        $productTypes = \App\Models\ProductType::orderBy('name')->get();
        $colors = \App\Models\Color::orderBy('name')->get();
        $materials = \App\Models\Material::orderBy('name')->get();

        $context = 'space';

        return view('frontend.pages.conference-room-tables', compact('space', 'products', 'productTypes', 'colors', 'materials', 'context', 'productType'));
    }

    public function industryProducts($industry_slug, $type_slug)
    {
        $industry = \App\Models\Industry::where('slug', $industry_slug)->firstOrFail();
        $productType = \App\Models\ProductType::where('slug', $type_slug)->firstOrFail();

        // Fetch products belonging to this industry and this product type
        $products = \App\Models\Product::whereHas('industries', function($q) use ($industry) {
            $q->where('industries.id', $industry->id);
        })->whereHas('productType', function($q) use ($productType) {
            $q->where('product_types.id', $productType->id);
        })->latest()->get();

        $productTypes = \App\Models\ProductType::orderBy('name')->get();
        $colors = \App\Models\Color::orderBy('name')->get();
        $materials = \App\Models\Material::orderBy('name')->get();

        // Map industry to $space object for view compatibility
        $space = (object)[
            'name' => $industry->name,
            'slug' => $industry->slug,
            'id' => $industry->id
        ];

        $context = 'industry';

        return view('frontend.pages.conference-room-tables', compact('space', 'products', 'productTypes', 'colors', 'materials', 'context', 'productType'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function csr()
    {
        return view('frontend.pages.csr');
    }

    public function esg()
    {
        return view('frontend.pages.esg');
    }

    public function hospitality($slug = 'hospitality')
    {
        $industry = \App\Models\Industry::where('slug', $slug)->first();
        
        if (!$industry) {
            // Fallback: try to find any industry, or create a mock if none exist
            $industry = \App\Models\Industry::first();
        }

        if (!$industry) {
            $industry = new \App\Models\Industry();
            $industry->name = 'Hospitality';
            $industry->slug = 'hospitality';
            $industry->id = 0; // dummy id
        }

        // Fetch products belonging to this industry
        $products = collect();
        if ($industry->id > 0) {
            $products = \App\Models\Product::whereHas('industries', function($q) use ($industry) {
                $q->where('industries.id', $industry->id);
            })->latest()->take(6)->get();
        }

        // If no products specific to this industry, fallback to latest products
        if ($products->isEmpty()) {
            $products = \App\Models\Product::latest()->take(6)->get();
        }

        $brands = \App\Models\Brand::orderBy('name')->get();

        // Get another industry for the CTA banner
        $nextIndustry = null;
        if ($industry->id > 0) {
            $nextIndustry = \App\Models\Industry::where('id', '!=', $industry->id)->inRandomOrder()->first();
        }
        if (!$nextIndustry) {
            // fallback next industry if there's only one or none
            $nextIndustry = \App\Models\Industry::where('slug', '!=', 'hospitality')->first();
        }

        return view('frontend.pages.hospitality', compact('industry', 'products', 'brands', 'nextIndustry'));
    }

    public function idealWorkspace()
    {
        return view('frontend.pages.ideal-workspace');
    }

    public function initiatives()
    {
        return view('frontend.pages.initiatives');
    }

    public function jobAci($slug = null)
    {
        $vacancies = $this->getVacancies();
        $slug = $slug ?? 'aci-internship';
        $vacancy = $vacancies[$slug] ?? $vacancies['aci-internship'];
        return view('frontend.pages.job-aci', compact('vacancy', 'vacancies'));
    }

    public function jobApply()
    {
        return view('frontend.pages.job-apply');
    }

    public function thankYou()
    {
        return view('frontend.pages.thank-you');
    }

    public function postFeedback(\Illuminate\Http\Request $request)
    {
        $booking = \App\Models\Booking::find($request->booking);
        $type = $booking ? $booking->type : 'visit';

        return view('frontend.pages.post-feedback', compact('booking', 'type'));
    }

    public function makeEnquiry($slug = null)
    {
        $vacancies = $this->getVacancies();
        $slug = $slug ?? 'aci-internship';
        $vacancy = $vacancies[$slug] ?? $vacancies['aci-internship'];
        return view('frontend.pages.make-enquiry', compact('vacancy'));
    }

    public function moodboardDetail()
    {
        return view('frontend.pages.moodboard-detail');
    }

    public function moodboards()
    {
        $moodboards = \App\Models\Moodboard::where('status', 1)->get();
        return view('frontend.pages.moodboards', compact('moodboards'));
    }

    public function productDetail($slug = null)
    {
        $product = null;
        $relatedProducts = collect();
        if ($slug) {
            $product = \App\Models\Product::where('slug', $slug)->first();
            if ($product) {
                $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)
                                    ->take(3)->get();
            }
        }
        return view('frontend.pages.product-detail', compact('product', 'relatedProducts'));
    }

    public function productsType()
    {
        $productTypes = \App\Models\ProductType::withCount('products')->get();
        $industries = \App\Models\Industry::orderBy('name')->get();
        return view('frontend.pages.products-type', compact('productTypes', 'industries'));
    }

    public function resourceDetail($slug)
    {
        $blog = \App\Models\Blog::with('categories')->where('slug', $slug)->firstOrFail();
        
        // Fetch relevant blogs sharing categories
        $categoryIds = $blog->categories->pluck('id')->toArray();
        $relevantBlogs = \App\Models\Blog::with('categories')
            ->where('id', '!=', $blog->id)
            ->whereHas('categories', function($q) use ($categoryIds) {
                $q->whereIn('blog_categories.id', $categoryIds);
            })
            ->latest()
            ->take(3)
            ->get();

        if ($relevantBlogs->count() < 3) {
            $additionalBlogs = \App\Models\Blog::with('categories')
                ->where('id', '!=', $blog->id)
                ->whereNotIn('id', $relevantBlogs->pluck('id')->toArray())
                ->latest()
                ->take(3 - $relevantBlogs->count())
                ->get();
            $relevantBlogs = $relevantBlogs->merge($additionalBlogs);
        }

        // Fetch slider blogs
        $sliderBlogs = \App\Models\Blog::with('categories')
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.pages.resource-detail', compact('blog', 'relevantBlogs', 'sliderBlogs'));
    }

    public function resources(Request $request)
    {
        $query = \App\Models\Blog::query()->with('categories');

        if ($request->filled('category') && $request->category != 'All') {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('slug', $request->category)->orWhere('name', $request->category);
            });
        }

        $blogs = $query->latest()->paginate(9);
        $categories = \App\Models\BlogCategory::orderBy('name')->get();

        return view('frontend.pages.resources', compact('blogs', 'categories'));
    }

    public function serviceDetail()
    {
        return view('frontend.pages.service-detail');
    }

    public function serviceListing()
    {
        return view('frontend.pages.service-listing');
    }

    public function services()
    {
        $moodboards = \App\Models\Moodboard::where('status', 1)->get();
        return view('frontend.pages.services', compact('moodboards'));
    }

    public function shopBySpace()
    {
        return $this->renderShopBy('space');
    }

    public function shopByIndustry()
    {
        return $this->renderShopBy('industry');
    }

    public function shopByBrands()
    {
        return $this->renderShopBy('brand');
    }

    protected function renderShopBy($type)
    {
        $items = collect();
        if ($type === 'industry') {
            $items = \App\Models\Industry::orderBy('name')->get();
        } elseif ($type === 'brand') {
            $items = \App\Models\Brand::orderBy('name')->get();
        } else {
            $items = \App\Models\Space::orderBy('name')->get();
        }

        $productTypes = \App\Models\ProductType::orderBy('name')->get();

        return view('frontend.pages.shop-by-space', compact('type', 'items', 'productTypes'));
    }

    public function sustainability()
    {
        return view('frontend.pages.sustainability');
    }

    public function teamMember()
    {
        return view('frontend.pages.team-member');
    }

    public function userDashboard()
    {
        return view('frontend.pages.user-dashboard');
    }

    public function userProfile()
    {
        return view('frontend.pages.user-profile');
    }

    public function userBoardDetail()
    {
        return view('frontend.pages.user-board-detail');
    }

    public function searchResults(Request $request)
    {
        $query = $request->input('q', '');
        $products = collect();
        $featuredProducts = \App\Models\Product::where('is_featured', true)->latest()->take(3)->get();

        if ($query) {
            $products = \App\Models\Product::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->paginate(9);
        }

        $productTypes = \App\Models\ProductType::orderBy('name')->get();
        $industries = \App\Models\Industry::orderBy('name')->get();
        $spaces = \App\Models\Space::orderBy('name')->get();
        $brands = \App\Models\Brand::orderBy('name')->get();
        $colors = \App\Models\Color::orderBy('name')->get();
        $materials = \App\Models\Material::orderBy('name')->get();

        return view('frontend.pages.search-results', compact(
            'query', 'products', 'featuredProducts',
            'productTypes', 'industries', 'spaces', 'brands', 'colors', 'materials'
        ));
    }

    public function brandDetail($slug)
    {
        $brand = \App\Models\Brand::where('slug', $slug)->firstOrFail();

        // Fetch product types that have products belonging to this brand
        $productTypes = \App\Models\ProductType::with(['products' => function($q) use ($brand) {
            $q->where('brand_id', $brand->id)->latest()->take(8);
        }])->whereHas('products', function($q) use ($brand) {
            $q->where('brand_id', $brand->id);
        })->get();

        // Map brand to $space object for view compatibility
        $space = (object)[
            'name' => $brand->name,
            'slug' => $brand->slug,
            'id' => $brand->id
        ];

        $context = 'brand';

        return view('frontend.pages.conference-rooms', compact('space', 'productTypes', 'context'));
    }

    public function brandProducts($brand_slug, $type_slug)
    {
        $brand = \App\Models\Brand::where('slug', $brand_slug)->firstOrFail();
        $productType = \App\Models\ProductType::where('slug', $type_slug)->firstOrFail();

        // Fetch products belonging to this brand and this product type
        $products = \App\Models\Product::where('brand_id', $brand->id)
            ->whereHas('productType', function($q) use ($productType) {
                $q->where('product_types.id', $productType->id);
            })->latest()->get();

        $productTypes = \App\Models\ProductType::orderBy('name')->get();
        $colors = \App\Models\Color::orderBy('name')->get();
        $materials = \App\Models\Material::orderBy('name')->get();

        // Map brand to $space object for view compatibility
        $space = (object)[
            'name' => $brand->name,
            'slug' => $brand->slug,
            'id' => $brand->id
        ];

        $context = 'brand';

        return view('frontend.pages.conference-room-tables', compact('space', 'products', 'productTypes', 'colors', 'materials', 'context', 'productType'));
    }

    public function productTypeDetail($slug)
    {
        $productType = \App\Models\ProductType::where('slug', $slug)->firstOrFail();

        // Fetch Spaces with products belonging to this product type
        $spaces = \App\Models\Space::with(['products' => function($q) use ($productType) {
            $q->where('product_type_id', $productType->id)->latest()->take(8);
        }])->whereHas('products', function($q) use ($productType) {
            $q->where('product_type_id', $productType->id);
        })->get();

        // Map product type to $space object for view compatibility
        $space = (object)[
            'name' => $productType->name,
            'slug' => $productType->slug,
            'id' => $productType->id
        ];

        // Pass spaces as $productTypes to reuse the sliders loop
        $productTypes = $spaces;
        $context = 'product';

        return view('frontend.pages.conference-rooms', compact('space', 'productTypes', 'context'));
    }

    public function productTypeSpace($product_type_slug, $space_slug)
    {
        $productTypeModel = \App\Models\ProductType::where('slug', $product_type_slug)->firstOrFail();
        $spaceModel = \App\Models\Space::where('slug', $space_slug)->firstOrFail();

        $products = \App\Models\Product::where('product_type_id', $productTypeModel->id)
            ->whereHas('spaces', function($q) use ($spaceModel) {
                $q->where('spaces.id', $spaceModel->id);
            })->latest()->get();

        $productTypes = \App\Models\ProductType::orderBy('name')->get();
        $colors = \App\Models\Color::orderBy('name')->get();
        $materials = \App\Models\Material::orderBy('name')->get();

        $space = (object)[
            'name' => $productTypeModel->name,
            'slug' => $productTypeModel->slug,
            'id' => $productTypeModel->id
        ];

        $context = 'product';
        $productType = $spaceModel;

        return view('frontend.pages.conference-room-tables', compact('space', 'products', 'productTypes', 'colors', 'materials', 'context', 'productType'));
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function termsConditions()
    {
        return view('frontend.pages.terms-conditions');
    }

    // Fallback
    public function show($page)
    {
        if (view()->exists("frontend.pages.{$page}")) {
            return view("frontend.pages.{$page}");
        }
        abort(404);
    }

    private function getVacancies()
    {
        return [
            'aci-internship' => [
                'title' => 'ACI (Internship)',
                'slug' => 'aci-internship',
                'date' => '09.09.2021',
                'description' => 'Adipiscing nulla nunc, ultricies tortor. Ut purus massa, eget vel, fermentum lacus nullam.',
                'long_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'profile' => [
                    'Graduate or a Diploma in business administration, sales or related course.',
                    'Selling experience of at least 2 years preferably in high end segment in retail, hospitality or brands.',
                    'Excellent communication (including spoken and written English).',
                    'Strong selling skills & customer oriented.',
                    'Confident, friendly & engaging personality.',
                    'Well-mannered and polite.',
                    'Immaculately groomed & physically fit.',
                    'Good numerical ability and IT skills.'
                ]
            ],
            'associate-consultant' => [
                'title' => 'Associate Consultant',
                'slug' => 'associate-consultant',
                'date' => '09.09.2021',
                'description' => 'Adipiscing nulla nunc, ultricies tortor. Ut purus massa, eget vel, fermentum lacus nullam.',
                'long_description' => 'We are seeking an Associate Consultant to join our dynamic workplace solutions team. You will work closely with senior consultants to deliver workspace planning and client advisory projects.',
                'profile' => [
                    'Bachelor\'s degree in architecture, design, or related business field.',
                    '1-2 years of client-facing experience in design or corporate consulting.',
                    'Proficiency in CAD/Revit or other planning software is a plus.',
                    'Strong analytical and presentation skills.'
                ]
            ],
            'sa-internship' => [
                'title' => 'SA (Internship)',
                'slug' => 'sa-internship',
                'date' => '09.09.2021',
                'description' => 'Adipiscing nulla nunc, ultricies tortor. Ut purus massa, eget vel, fermentum lacus nullam.',
                'long_description' => 'Join us as a Sales Associate Intern! This role offers hands-on experience in corporate sales, client management, and commercial design representation.',
                'profile' => [
                    'Currently pursuing or recently graduated with a degree in business, marketing, or design.',
                    'Energetic, eager to learn, and passionate about sales.',
                    'Good verbal and written communication skills.'
                ]
            ],
            'customer-care' => [
                'title' => 'Customer Care',
                'slug' => 'customer-care',
                'date' => '09.09.2021',
                'description' => 'Adipiscing nulla nunc, ultricies tortor. Ut purus massa, eget vel, fermentum lacus nullam.',
                'long_description' => 'Our Customer Care team is the heart of our post-sales success. In this role, you will assist corporate clients with delivery updates, queries, and complaints.',
                'profile' => [
                    'At least 1 year of experience in customer service or support.',
                    'Outstanding listening and problem-solving skills.',
                    'High level of emotional intelligence and patience.'
                ]
            ],
            'sales-associate' => [
                'title' => 'Sales Associate',
                'slug' => 'sales-associate',
                'date' => '09.09.2021',
                'description' => 'Adipiscing nulla nunc, ultricies tortor. Ut purus massa, eget vel, fermentum lacus nullam.',
                'long_description' => 'We are looking for a result-driven Sales Associate to manage client portfolios, present our high-end furniture range, and drive growth.',
                'profile' => [
                    'Minimum 2 years of sales experience, preferably in high-end B2B furniture or retail.',
                    'Proven track record of meeting and exceeding sales targets.',
                    'Strong networking and relationship-building capabilities.'
                ]
            ],
            'hr-associate' => [
                'title' => 'HR Associate',
                'slug' => 'hr-associate',
                'date' => '09.09.2021',
                'description' => 'Adipiscing nulla nunc, ultricies tortor. Ut purus massa, eget vel, fermentum lacus nullam.',
                'long_description' => 'The HR Associate will support end-to-end recruitment, onboarding, training, and employee engagement activities.',
                'profile' => [
                    'Degree in Human Resources Management or equivalent.',
                    '1-2 years of working experience in HR operations.',
                    'Familiar with local labor laws and regulations.'
                ]
            ]
        ];
    }
}
