@php
    $style = $style ?? 'clean';
@endphp

@if($style === 'homepage')
<div class="ai-search-bar-wrapper ai-search-style-homepage" id="aiSearchBar">
    <div class="ai-home-card">
        <div class="ai-home-card-inner">
            <div class="ai-home-intro">
                <span class="ai-home-badge">
                    <i class="fas fa-wand-magic-sparkles" aria-hidden="true"></i>
                    AI Search by The Total Office
                </span>
                <h2 class="ai-home-heading">Find workspace products in seconds</h2>
                <p class="ai-home-lead">Search by name, style, or space — or upload a photo and let AI match products from our catalogue.</p>
            </div>

            <div class="ai-home-search-panel">
                <div class="ai-home-input-wrap">
                    <i class="fas fa-search ai-home-field-icon" aria-hidden="true"></i>
                    <input
                        type="text"
                        class="ai-home-input"
                        id="aiSearchQuery"
                        placeholder="e.g. ergonomic chair, meeting table, reception sofa..."
                        value="{{ request('q', '') }}"
                        autocomplete="off"
                        aria-autocomplete="list"
                        aria-controls="aiSearchSuggestions"
                        aria-expanded="false"
                    />
                    <ul class="ai-search-suggestions d-none" id="aiSearchSuggestions" role="listbox" aria-label="Search suggestions"></ul>
                </div>
                <div class="ai-home-panel-actions">
                    <label class="ai-home-upload" title="Upload product image">
                        <i class="fa-solid fa-camera" aria-hidden="true"></i>
                        <span>Photo search</span>
                        <input type="file" id="aiSearchImageInput" accept="image/jpeg,image/png,image/webp" hidden />
                    </label>
                    <button type="button" class="ai-home-submit" id="aiSearchTextBtn">
                        <span>Search</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div class="ai-home-suggestions-row" aria-label="Popular searches">
                <span class="ai-home-suggestions-label">Try:</span>
                <button type="button" class="ai-home-quick" data-ai-quick="office chair">Office chair</button>
                <button type="button" class="ai-home-quick" data-ai-quick="conference table">Conference table</button>
                <button type="button" class="ai-home-quick" data-ai-quick="reception desk">Reception desk</button>
            </div>
        </div>
    </div>
    <div class="ai-search-dropzone d-none" id="aiSearchDropzone">
        <p>Drag and drop an image here, or use photo search.</p>
    </div>
    <div id="aiSearchPreview" class="ai-search-preview d-none"></div>
</div>
@elseif($style === 'original')
<div class="ai-search-bar-wrapper mb-4 ai-search-style-original" id="aiSearchBar">
    <div class="ai-search-branding">AI Search Engine by The Total Office</div>
    <p class="ai-search-subtext">Search by text or upload an image.</p>
    <div class="ai-search-row">
        <div class="ai-search-input-wrap-original">
            <input type="text" class="ai-search-input-original" id="aiSearchQuery" placeholder="Search for products..." value="{{ request('q', '') }}" autocomplete="off" aria-autocomplete="list" aria-controls="aiSearchSuggestions" aria-expanded="false" />
            <ul class="ai-search-suggestions d-none" id="aiSearchSuggestions" role="listbox" aria-label="Search suggestions"></ul>
        </div>
        <button type="button" class="ai-search-submit-original" id="aiSearchTextBtn">Search</button>
        <label class="ai-search-upload-original mb-0">
            <i class="fas fa-image"></i> Upload image
            <input type="file" id="aiSearchImageInput" accept="image/jpeg,image/png,image/webp" hidden />
        </label>
    </div>
    <div class="ai-search-dropzone d-none" id="aiSearchDropzone">
        <p>Drag and drop an image here, or use the upload button.</p>
    </div>
    <div id="aiSearchPreview" class="ai-search-preview d-none"></div>
</div>
@else
<div class="ai-search-bar-wrapper mb-4 ai-search-style-clean" id="aiSearchBar">
    <div class="ai-search-row">
        <div class="ai-search-input-wrap">
            <input type="text" class="form-control ai-search-input" id="aiSearchQuery" placeholder="Search for products..." value="{{ request('q', '') }}" autocomplete="off" aria-autocomplete="list" aria-controls="aiSearchSuggestions" aria-expanded="false" />
            
            <!-- Embedded Camera button for image upload -->
            <label class="ai-search-camera-btn mb-0" title="Upload image">
                <i class="fa-solid fa-camera"></i>
                <input type="file" id="aiSearchImageInput" accept="image/jpeg,image/png,image/webp" hidden />
            </label>

            <button type="button" class="btn btn-primary ai-search-submit" id="aiSearchTextBtn">
                <i class="fas fa-magnifying-glass"></i>
            </button>
            <ul class="ai-search-suggestions d-none" id="aiSearchSuggestions" role="listbox" aria-label="Search suggestions"></ul>
        </div>
    </div>
    <div class="ai-search-dropzone d-none" id="aiSearchDropzone">
        <p>Drag and drop an image here, or click the camera icon.</p>
    </div>
    <div id="aiSearchPreview" class="ai-search-preview d-none"></div>
</div>
@endif

<!-- Scene selection modal -->
<div class="modal fade" id="aiSceneModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select product in scene</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small">Please place the box over the product you want to search for.</p>
                <div class="ai-scene-canvas-wrap">
                    <canvas id="aiSceneCanvas"></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="aiSceneConfirm">Search this area</button>
            </div>
        </div>
    </div>
</div>
