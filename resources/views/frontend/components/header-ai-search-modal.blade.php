{{-- Global AI Search modal — opened from header on all pages --}}
<div class="modal fade" id="aiSearchModal" tabindex="-1" aria-labelledby="aiSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ai-search-modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title ai-search-modal-title" id="aiSearchModalLabel">AI Search</h5>
                    <p class="ai-search-modal-sub mb-0">Search by text or upload a product image</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <div class="ai-search-bar-wrapper ai-search-style-clean" id="headerAiSearchBar">
                    <div class="ai-search-row">
                        <div class="ai-search-input-wrap">
                            <input type="text" class="form-control ai-search-input" id="headerAiSearchQuery" placeholder="Search for chairs, desks, meeting tables..." autocomplete="off" aria-autocomplete="list" aria-controls="headerAiSearchSuggestions" aria-expanded="false" />
                            <label class="ai-search-camera-btn mb-0" title="Upload image">
                                <i class="fa-solid fa-camera"></i>
                                <input type="file" id="headerAiSearchImageInput" accept="image/jpeg,image/png,image/webp" hidden />
                            </label>
                            <button type="button" class="btn btn-primary ai-search-submit" id="headerAiSearchTextBtn">
                                <i class="fas fa-magnifying-glass"></i>
                            </button>
                            <ul class="ai-search-suggestions d-none" id="headerAiSearchSuggestions" role="listbox" aria-label="Search suggestions"></ul>
                        </div>
                    </div>
                    <p class="ai-search-modal-hint">Products appear first, then related content across the site.</p>
                </div>
            </div>
        </div>
    </div>
</div>
