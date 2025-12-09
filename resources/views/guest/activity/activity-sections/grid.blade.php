<!-- Activities Grid Section -->
<section class="activities-grid-section">
    <div class="container">
        @if($activities->isEmpty())
            <div class="no-results-international">
                <div class="no-results-icon">
                    <i class="fas fa-search-minus"></i>
                </div>
                <h3>{{ __('messages.no_activity') }}</h3>
                <p>We couldn't find any activities at the moment. Please check back later.</p>
            </div>
        @else
            <div class="section-header-international" data-aos="fade-up">
                <div class="section-subtitle">Our Portfolio</div>
                <h2 class="section-title">Featured Activities & Events</h2>
                <p class="section-description">
                    Carefully curated experiences designed to inspire, connect, and empower our team
                </p>
            </div>

            <div class="activities-grid-international" id="activitiesGrid">
                @foreach ($activities as $item)
                    @php
                        // ✅ FIXED: Support Bahasa Indonesia & English
                        $statusLower = strtolower(trim($item->status ?? 'completed'));
                        
                        // Normalize status - support both languages
                        $statusClass = 'status-completed'; // default
                        $statusIcon = 'fa-check-circle';
                        $statusText = ucfirst($item->status ?? 'Completed');
                        
                        // Check for ONGOING / BERLANGSUNG
                        if (str_contains($statusLower, 'berlangsung') || str_contains($statusLower, 'ongoing')) {
                            $statusClass = 'status-ongoing';
                            $statusIcon = 'fa-spinner fa-spin';
                        }
                        // Check for UPCOMING / AKAN DATANG
                        elseif (str_contains($statusLower, 'akan datang') || str_contains($statusLower, 'upcoming')) {
                            $statusClass = 'status-upcoming';
                            $statusIcon = 'fa-calendar-plus';
                        }
                        // Check for CANCELLED / DIBATALKAN
                        elseif (str_contains($statusLower, 'dibatalkan') || str_contains($statusLower, 'cancelled') || str_contains($statusLower, 'canceled')) {
                            $statusClass = 'status-cancelled';
                            $statusIcon = 'fa-times-circle';
                        }
                        // Check for COMPLETED / SELESAI
                        elseif (str_contains($statusLower, 'selesai') || str_contains($statusLower, 'completed')) {
                            $statusClass = 'status-completed';
                            $statusIcon = 'fa-check-circle';
                        }
                    @endphp

                    <article class="activity-card-international" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="card-image-container">
                            <img
                                src="{{ asset($item->images) }}"
                                alt="{{ $item->title }}"
                                class="card-image-international"
                            />
                            <div class="card-image-overlay">
                                {{-- ✅ FIXED: Dynamic Status Badge with Distinct Colors --}}
                                <span class="status-badge {{ $statusClass }}">
                                    <i class="fas {{ $statusIcon }}"></i>
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>

                        <div class="card-content-international">
                            <div class="card-meta-header">
                                <div class="card-date">
                                    <i class="far fa-calendar"></i>
                                    <span>{{ optional($item->start_date)->format('M d, Y') ?? optional($item->date)->format('M d, Y') ?? '-' }}</span>
                                </div>
                                {{-- ✅ UPDATED: Dynamic Category --}}
                                <div class="card-category">{{ $item->category ?? __('messages.activity') }}</div>
                            </div>

                            <h3 class="card-title-international">
                                <a href="{{ route('activity.show', $item->slug) }}">{{ $item->title }}</a>
                            </h3>

                            <p class="card-excerpt">
                                {{ Str::limit($item->description, 120) }}
                            </p>

                            {{-- ✅ UPDATED: Dynamic Info Grid --}}
                            <div class="card-info-grid">
                                {{-- Date --}}
                                <div class="info-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{ optional($item->start_date)->format('M d, Y') ?? optional($item->date)->format('M d, Y') ?? '-' }}</span>
                                </div>
                                
                                {{-- Duration - Dynamic --}}
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $item->duration ?? 'Full Day' }}</span>
                                </div>
                                
                                {{-- Participants - Dynamic --}}
                                <div class="info-item">
                                    <i class="fas fa-users"></i>
                                    <span>{{ $item->participants ?? 'Umalo-Team' }}</span>
                                </div>
                                
                                {{-- Location - Dynamic (Only show if exists) --}}
                                @if($item->location)
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $item->location }}</span>
                                </div>
                                @endif
                            </div>

                            {{-- ✅ UPDATED: Dynamic Tags from Database --}}
                            @if($item->tags && is_array($item->tags) && count($item->tags) > 0)
                            <div class="card-tags-international">
                                @foreach($item->tags as $tag)
                                    <span class="tag-international">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @elseif($item->tags && is_string($item->tags))
                                {{-- Jika tags masih string JSON --}}
                                @php
                                    $tagsArray = json_decode($item->tags, true);
                                @endphp
                                @if($tagsArray && is_array($tagsArray) && count($tagsArray) > 0)
                                <div class="card-tags-international">
                                    @foreach($tagsArray as $tag)
                                        <span class="tag-international">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                @endif
                            @endif

                            <div class="card-footer-international">
                                <a href="{{ route('activity.show', $item->slug) }}" class="btn-view-details">
                                    <span>{{ __('messages.more_detail') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <button class="btn-icon-action" title="Share">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-international mt-5">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
</section>