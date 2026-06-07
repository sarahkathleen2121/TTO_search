window.TtoAiSearch = window.TtoAiSearch || {};

(function (ns) {
    const base = '/api/search';

    function csrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    async function parseJson(response) {
        const data = await response.json();
        if (!response.ok) {
            throw new Error(data.message || data.detail || 'Request failed');
        }
        return data;
    }

    ns.searchText = async function (payload) {
        const response = await fetch(`${base}/text`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': csrfToken(),
            },
            body: JSON.stringify(payload),
        });
        return parseJson(response);
    };

    ns.searchImage = async function (file, params) {
        const form = new FormData();
        form.append('image', file);
        if (params.sort) form.append('sort', params.sort);
        if (params.page) form.append('page', params.page);
        if (params.limit) form.append('limit', params.limit);
        if (params.filters) form.append('filters', JSON.stringify(params.filters));

        const response = await fetch(`${base}/image`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'X-CSRF-TOKEN': csrfToken(),
            },
            body: form,
        });
        return parseJson(response);
    };

    ns.searchScene = async function (file, coords, params) {
        const form = new FormData();
        form.append('image', file);
        form.append('x', coords.x);
        form.append('y', coords.y);
        form.append('width', coords.width);
        form.append('height', coords.height);
        if (params.sort) form.append('sort', params.sort);
        if (params.page) form.append('page', params.page);
        if (params.limit) form.append('limit', params.limit);
        if (params.filters) form.append('filters', JSON.stringify(params.filters));

        const response = await fetch(`${base}/scene`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'X-CSRF-TOKEN': csrfToken(),
            },
            body: form,
        });
        return parseJson(response);
    };

    ns.getSuggestions = async function (query, limit = 8) {
        const params = new URLSearchParams({ q: query, limit: String(limit) });
        const response = await fetch(`${base}/suggestions?${params}`, {
            headers: { Accept: 'application/json' },
        });
        return parseJson(response);
    };

    ns.getFilters = async function () {
        const response = await fetch(`${base}/filters`, {
            headers: { Accept: 'application/json' },
        });
        return parseJson(response);
    };
})(window.TtoAiSearch);
