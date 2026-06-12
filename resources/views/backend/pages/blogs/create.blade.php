@extends('backend.layouts.app')

@section('title', isset($blog) ? 'Edit Blog' : 'Add Blog')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($blog) ? 'Edit Blog' : 'Add Blog' }}</h4>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ isset($blog) ? route('blogs.update', $blog->id) : route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($blog)) @method('PUT') @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="Leave blank to auto-generate" value="{{ old('slug', $blog->slug ?? '') }}">
                            <small class="text-muted">Slug represents the URL path (e.g., dynamic-url-here).</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Categories <span class="text-danger">*</span></label>
                            <select name="categories[]" class="form-select select2" multiple required data-placeholder="Select Categories">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (isset($blog) && $blog->categories->contains($cat->id)) || (is_array(old('categories')) && in_array($cat->id, old('categories'))) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Publish Date <span class="text-danger">*</span></label>
                            <input type="date" name="created_at" class="form-control" value="{{ old('created_at', isset($blog) ? $blog->created_at->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Featured Image <span class="text-danger">{{ isset($blog) ? '' : '*' }}</span></label>
                            <input type="file" name="featured_image" class="form-control" {{ isset($blog) ? '' : 'required' }}>
                            @if(isset($blog) && $blog->featured_image)
                                <img src="{{ $blog->featuredImageUrl() }}" width="80" class="mt-2">
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Image Alt Text <span class="text-danger">*</span></label>
                            <input type="text" name="image_alt" class="form-control" value="{{ old('image_alt', $blog->image_alt ?? '') }}" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Blog Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content-editor" class="form-control" rows="15">{{ old('content', $blog->content ?? '') }}</textarea>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">SEO Metadata</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title ?? '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                            <input type="text" name="meta_keywords" class="form-control" placeholder="comma, separated, keywords" value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Meta Description <span class="text-danger">*</span></label>
                            <textarea name="meta_description" class="form-control" rows="2" required>{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Frequently Asked Questions (FAQs)</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">FAQ Section Title</label>
                        <input type="text" name="faq_title" class="form-control" value="{{ old('faq_title', $blog->faq_title ?? '') }}" placeholder="e.g. Frequently Asked Questions (Defaults to: Frequently Asked Questions)">
                    </div>

                    <div id="faq-container" class="mb-4">
                        @if(isset($blog) && $blog->faqs->isNotEmpty())
                            @foreach($blog->faqs as $index => $faq)
                                <div class="card faq-row border mb-3" data-index="{{ $index }}">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                        <h6 class="mb-0 text-muted">FAQ Row</h6>
                                        <button type="button" class="btn btn-sm btn-danger remove-faq-btn" onclick="removeFaqRow(this)">Remove</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Question</label>
                                            <input type="text" name="faqs[{{ $index }}][question]" class="form-control" value="{{ $faq->question }}" placeholder="Enter Question" required>
                                        </div>
                                        <div>
                                            <label class="form-label fw-bold">Answer</label>
                                            <textarea name="faqs[{{ $index }}][answer]" id="faq-answer-{{ $index }}" class="form-control faq-answer-editor" rows="4" placeholder="Enter Answer" required>{{ $faq->answer }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-info mb-4" id="add-faq-btn">Add New FAQ</button>
                    <div class="clearfix"></div>

                    <button type="submit" class="btn btn-success mt-3">Save Blog</button>
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('backend_assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('backend_assets/libs/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Categories",
            allowClear: true
        });

        // Initialize TinyMCE for existing FAQ answers
        $('.faq-answer-editor').each(function() {
            let id = $(this).attr('id');
            initFaqEditor('#' + id);
        });
    });

    function ajaxImageUploadHandler(blobInfo, progress) {
        return new Promise((resolve, reject) => {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("blogs.upload") }}');
            
            var token = document.querySelector('meta[name="csrf-token"]');
            if (token) {
                xhr.setRequestHeader("X-CSRF-Token", token.content);
            }

            xhr.upload.onprogress = function (e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function() {
                var json;
                if (xhr.status === 403) {
                    reject('HTTP Error: ' + xhr.status, { remove: true });
                    return;
                }
                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                resolve(json.location);
            };

            xhr.onerror = function () {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        });
    }

    tinymce.init({
        selector: '#content-editor',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template help',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | print preview media | forecolor backcolor emoticons',
        height: 500,
        menubar: 'file edit view insert format tools table help',
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        },
        images_upload_handler: ajaxImageUploadHandler
    });

    // FAQ Repeater logic
    let faqIndex = {{ isset($blog) ? $blog->faqs->count() : 0 }};

    function initFaqEditor(selector) {
        tinymce.init({
            selector: selector,
            plugins: 'advlist autolink lists link image code help',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter | bullist numlist | link code',
            height: 200,
            menubar: false,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            },
            images_upload_handler: ajaxImageUploadHandler,
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    }

    $('#add-faq-btn').click(function() {
        let rowHtml = `
            <div class="card faq-row border mb-3" data-index="${faqIndex}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                    <h6 class="mb-0 text-muted">New FAQ Row</h6>
                    <button type="button" class="btn btn-sm btn-danger remove-faq-btn" onclick="removeFaqRow(this)">Remove</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Question</label>
                        <input type="text" name="faqs[${faqIndex}][question]" class="form-control" placeholder="Enter Question" required>
                    </div>
                    <div>
                        <label class="form-label fw-bold">Answer</label>
                        <textarea name="faqs[${faqIndex}][answer]" id="faq-answer-${faqIndex}" class="form-control" rows="4" placeholder="Enter Answer" required></textarea>
                    </div>
                </div>
            </div>
        `;
        $('#faq-container').append(rowHtml);
        initFaqEditor('#faq-answer-' + faqIndex);
        faqIndex++;
    });

    function removeFaqRow(button) {
        if (confirm('Are you sure you want to remove this FAQ row?')) {
            let row = $(button).closest('.faq-row');
            let textarea = row.find('textarea');
            let id = textarea.attr('id');
            if (id) {
                tinymce.remove('#' + id);
            }
            row.remove();
        }
    }
</script>
@endpush
