<!-- Filter Section - Improved & Non-Sticky -->
<section class="filter-section-international">
    <div class="container">
        <div class="filter-wrapper">
            <div class="filter-header-section">
                <div class="filter-title-group">
                    <h2>Explore Activities</h2>
                    <p>Sort by and discover events that matter to you</p>
                </div>
            </div>

            <div class="filter-controls">
                <div class="search-container-international">
                    <i class="fas fa-search search-icon"></i>
                    <input
                        type="text"
                        id="searchActivities"
                        class="search-input-international"
                        placeholder="Search by title, location, or category..."
                    />
                    <button class="clear-search" id="clearSearch" style="display: none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="filter-bottom-section">
                <div class="sort-container">
                    <label for="sort-by" class="sort-label">
                        {{ __('messages.sort_by') }}:
                    </label>
                    <select id="sort-by" class="sort-select">
                        <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>{{ __('messages.newest') }}</option>
                        <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>{{ __('messages.latest') }}</option>
                    </select>
                </div>

                <div class="showing-info-international">
                    <i class="fas fa-list"></i>
                    <p>Showing {{ $activities->firstItem() }} - {{ $activities->lastItem() }} of {{ $activities->total() }}</p>
                </div>
            </div>
        </div>
    </div>
</section>