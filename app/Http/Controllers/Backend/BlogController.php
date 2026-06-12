<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('backend.pages.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name')->get();
        return view('backend.pages.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'categories' => 'required|array',
            'categories.*' => 'exists:blog_categories,id',
            'content' => 'required',
            'featured_image' => 'required|image|max:10240',
            'image_alt' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string|max:255',
            'created_at' => 'required|date',
            'faq_title' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string'
        ]);

        $data = $request->except(['featured_image', 'categories', 'slug', 'faqs']);
        $data['slug'] = Str::slug($request->slug ?: $request->title);
        $data['content'] = $this->processHtmlContent($request->content);
        
        $firstCategory = BlogCategory::find($request->categories[0]);
        $data['category'] = $firstCategory ? $firstCategory->name : null;

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $dir = public_path('uploads/blogs');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['featured_image'] = 'uploads/blogs/' . $filename;
        }

        $blog = Blog::create($data);
        $blog->categories()->sync($request->categories);
        
        // Save FAQs if present
        if ($request->filled('faqs')) {
            foreach ($request->faqs as $faqData) {
                if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                    $processedAnswer = $this->processHtmlContent($faqData['answer']);
                    $blog->faqs()->create([
                        'question' => $faqData['question'],
                        'answer' => $processedAnswer
                    ]);
                }
            }
        }
        
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::orderBy('name')->get();
        $blog->load('faqs');
        return view('backend.pages.blogs.create', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'categories' => 'required|array',
            'categories.*' => 'exists:blog_categories,id',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:10240',
            'image_alt' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'required|string|max:255',
            'created_at' => 'required|date',
            'faq_title' => 'nullable|string|max:255',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'required_with:faqs|string',
            'faqs.*.answer' => 'required_with:faqs|string'
        ]);

        $data = $request->except(['featured_image', 'categories', 'slug', 'faqs']);
        $data['slug'] = Str::slug($request->slug ?: $request->title);
        $data['content'] = $this->processHtmlContent($request->content);

        $firstCategory = BlogCategory::find($request->categories[0]);
        $data['category'] = $firstCategory ? $firstCategory->name : null;

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $dir = public_path('uploads/blogs');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $data['featured_image'] = 'uploads/blogs/' . $filename;
        }

        $blog->update($data);
        $blog->categories()->sync($request->categories);
        
        // Recreate FAQs
        $blog->faqs()->delete();
        if ($request->filled('faqs')) {
            foreach ($request->faqs as $faqData) {
                if (!empty($faqData['question']) && !empty($faqData['answer'])) {
                    $processedAnswer = $this->processHtmlContent($faqData['answer']);
                    $blog->faqs()->create([
                        'question' => $faqData['question'],
                        'answer' => $processedAnswer
                    ]);
                }
            }
        }
        
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $dir = public_path('uploads/blogs');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);
            $path = 'uploads/blogs/' . $filename;
            return response()->json([
                'location' => asset($path)
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    private function processHtmlContent($content)
    {
        if (empty($content)) {
            return $content;
        }

        // Strip data-mce-src attributes entirely since they are redundant and contain massive duplicate base64 data
        $content = preg_replace('/data-mce-src=(["\'])data:image\/[a-zA-Z0-9\+\-\.]+;base64,[^"\']*+\1/', '', $content);

        // Match base64 src attributes
        $pattern = '/src=(["\'])data:image\/([a-zA-Z0-9\+\-\.]+);base64,([^"\']*+)\1/';

        $processedImages = [];

        $content = preg_replace_callback($pattern, function ($matches) use (&$processedImages) {
            $quote = $matches[1];
            $extension = $matches[2];
            if ($extension === 'svg+xml') {
                $extension = 'svg';
            }
            $base64Data = $matches[3];
            
            // To avoid saving the same image twice (e.g. if it appears multiple times)
            $hash = md5($base64Data);
            if (isset($processedImages[$hash])) {
                return 'src=' . $quote . $processedImages[$hash] . $quote;
            }

            // Decode base64
            $decodedData = base64_decode($base64Data);
            if (!$decodedData) {
                return $matches[0];
            }
            
            // Generate a unique filename
            $filename = 'inline_' . uniqid() . '.' . $extension;
            $path = 'blogs/' . $filename;
            
            // Save to public uploads
            $dir = public_path('uploads/blogs');
            if (!\Illuminate\Support\Facades\File::isDirectory($dir)) {
                \Illuminate\Support\Facades\File::makeDirectory($dir, 0755, true);
            }
            file_put_contents($dir . '/' . $filename, $decodedData);
            
            // Get the public URL
            $imageUrl = asset('uploads/blogs/' . $filename);
            
            $processedImages[$hash] = $imageUrl;
            
            // Return replacement
            return 'src=' . $quote . $imageUrl . $quote;
        }, $content);

        return $content;
    }
}
