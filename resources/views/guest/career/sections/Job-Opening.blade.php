<!-- Job Openings Section -->
<section class="openings-section" id="openings">
  <div class="container">
    <div class="section-header">
      <div class="section-tag">
        <i class="fas fa-briefcase"></i>
        Career Opportunities
      </div>
      <h2 class="section-title">Open Positions</h2>
      <p class="section-subtitle">Find your perfect role and apply today</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
      <div class="search-input-job">
        <i class="fas fa-search"></i>
        <input
          type="text"
          id="searchJob"
          placeholder="Search positions..."
          onkeyup="filterJobs()"
        />
      </div>

      <select class="filter-select" id="typeFilter" onchange="filterJobs()">
        <option value="all">All Types</option>
        <option value="full-time">Full Time</option>
        <option value="part-time">Part Time</option>
        <option value="contract">Contract</option>
        <option value="internship">Internship</option>
      </select>
    </div>

    <!-- Jobs List -->
    <div class="jobs-list" id="jobsList">
      @forelse($positions as $index => $position)
        <div
          class="job-item"
          data-department="{{ strtolower(str_replace(' ', '-', $position->department)) }}"
          data-location="{{ strtolower($position->location) }}"
          data-type="{{ strtolower(str_replace('_', '-', $position->employment_type)) }}"
        >
          <div class="job-item-header">
            <div class="job-title-section">
              <h3 class="job-title">{{ $position->title }}</h3>
              <div class="job-meta-badges">
                <span class="badge badge-department">
                  <i class="fas fa-building"></i> 
                  {{ $position->department }}
                </span>
                <span class="badge badge-type">
                  <i class="fas fa-clock"></i> 
                  {{ $position->employment_type }}
                </span>
                @if($position->location)
                <span class="badge badge-location">
                  <i class="fas fa-map-marker-alt"></i> 
                  {{ $position->location }}
                </span>
                @endif
              </div>
            </div>
            <button class="btn-apply" onclick="openModal({{ $index }}, '{{ $position->id }}', '{{ $position->title }}')">
              <span>Apply Now</span>
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>

          <div class="job-description-wrapper">
            <p class="job-description">{{ $position->description }}</p>
          </div>

          @if($position->tags)
            <div class="job-tags-wrapper">
              <div class="job-tags-label">
                <i class="fas fa-tags"></i>
                <span>Skills Required: </span>
              </div>
              <div class="job-tags">
                @foreach(is_array($position->tags) ? $position->tags : json_decode($position->tags, true) as $tag)
                  <span class="tag-item">{{ $tag }}</span>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      @empty
        <div class="no-results">
          <i class="fas fa-briefcase"></i>
          <p>No positions available at the moment. Please check back later! </p>
        </div>
      @endforelse
    </div>

    <!-- No Results -->
    <div class="no-results" id="noResults" style="display: none">
      <i class="fas fa-search"></i>
      <p>No positions found. Try adjusting your filters.</p>
    </div>
  </div>
</section>