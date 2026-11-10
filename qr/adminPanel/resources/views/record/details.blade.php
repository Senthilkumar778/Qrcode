
<x-layout.default>
    @section('title')
        {{ $data['label'] }} Details
    @endsection

    @include('record.styles')

    <div class="panel">

        <div class="flex justify-between items-center my-3">
            <h5 class="font-semibold text-lg dark:text-white-light">
                {{ $data['label'] }} Details ({{ $data['code'] }})
            </h5>

            <div class="flex gap-2">
                <a href="{{ $data['editUrl'] }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="{{ $data['listUrl'] }}" class="btn btn-sm btn-secondary">Go Back</a>
            </div>
        </div>

        <div class="rec-banner">
            <div>
                <span class="rec-code">{{ $data['code'] }}</span>
                <span class="rec-badge">{{ $data['status'] }}</span>
            </div>
            <div class="rec-raised">
                Raised {{ $data['raisedAgo'] }} ({{ $data['raisedAt'] }})
            </div>
        </div>

        <div class="rec-grid">
            <div class="rec-card">
                <h6>Customer</h6>

                <div class="rec-row">
                    <span class="rec-label">Name</span>
                    <span class="rec-value">{{ $data['customer']['name'] }}</span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">Email</span>
                    <span class="rec-value">
                        @if(!empty($data['customer']['email']))
                            <a class="rec-link" href="mailto:{{ $data['customer']['email'] }}">
                                {{ $data['customer']['email'] }}
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">Phone</span>
                    <span class="rec-value">
                        @if(!empty($data['customer']['phone']))
                            <a class="rec-link" href="tel:{{ $data['customer']['phone'] }}">
                                {{ $data['customer']['phone'] }}
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">IP Address</span>
                    <span class="rec-value">{{ $data['customer']['ip'] ?? '-' }}</span>
                </div>
            </div>

            <div class="rec-card">
                <h6>{{ $data['label'] }}</h6>

                <div class="rec-row">
                    <span class="rec-label">Product</span>
                    <span class="rec-value">{{ $data['details']['product'] ?? '-' }}</span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">Subcategory</span>
                    <span class="rec-value">{{ $data['details']['subcategory'] ?? '-' }}</span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">Location</span>
                    <span class="rec-value">{{ $data['details']['location'] ?? '-' }}</span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">Region</span>
                    <span class="rec-value">{{ $data['details']['region'] ?? '-' }}</span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">Request Time</span>
                    <span class="rec-value">{{ $data['details']['requestTime'] ?? '-' }}</span>
                </div>

                <div class="rec-row">
                    <span class="rec-label">Last Updated</span>
                    <span class="rec-value">
                        {{ $data['details']['lastUpdated'] ?? '-' }}
                        @if(!empty($data['details']['updatedBy']))
                            &middot; by {{ $data['details']['updatedBy'] }}
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="rec-card">
            <h6>Issue Description</h6>

            @if(!empty($data['issue']))
                <div class="rec-text">{{ $data['issue'] }}</div>
            @else
                <div class="rec-muted">No description.</div>
            @endif
        </div>

        @if(!empty($data['remarks']))
            <div class="rec-card">
                <h6>Latest Remarks</h6>
                <div class="rec-text">{{ $data['remarks'] }}</div>
            </div>
        @endif

        <div class="rec-card">
            <h6>Attachments ({{ count($data['attachments'] ?? []) }})</h6>

            @if(!empty($data['attachments']))
                <div class="rec-files">
                    @foreach($data['attachments'] as $file)
                        @if(($file['type'] ?? '') === 'video')
                            <video
                                controls
                                preload="metadata"
                                src="{{ $file['url'] }}"
                            ></video>
                        @else
                            <a href="{{ $file['url'] }}" target="_blank" rel="noopener">
                                <img
                                    src="{{ $file['url'] }}"
                                    alt="{{ $file['name'] ?? 'Attachment' }}"
                                    loading="lazy"
                                >
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="rec-muted">No images or videos were attached.</div>
            @endif
        </div>

        <div class="rec-card">
            <h6>Status History ({{ count($data['history'] ?? []) }})</h6>

            @forelse($data['history'] ?? [] as $item)
                <div class="rec-tl-item">
                    <span class="rec-dot"></span>

                    <div>
                        <span class="rec-badge">{{ $item['status'] ?? '-' }}</span>

                        <span class="rec-tl-meta">
                            {{ $item['at'] ?? '-' }}
                            @if(!empty($item['by']))
                                &middot; by {{ $item['by'] }}
                            @endif
                            @if(!empty($item['interval']))
                                &middot; {{ $item['interval'] }}
                            @endif
                        </span>

                        @if(!empty($item['remarks']))
                            <div class="rec-tl-remarks">{{ $item['remarks'] }}</div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="rec-muted">No status changes yet.</div>
            @endforelse
        </div>

    </div>
</x-layout.default>
