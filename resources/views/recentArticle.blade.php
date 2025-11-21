<div class="sidebar__widget sidebar__widget-padding mb-75 wow fadeInUp grey-bg" data-wow-delay=".4s">
    <div class="sidebar__widget-title mb-25">
        <h4>{{ __('landing.recent_article') }}</h4>
    </div>
    <div class="sidebar__widget-content">
        <div class="rc-post">
            <ul>
                {{-- Recent articles will be loaded here by jQuery --}}
            </ul>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        const currentArticleSlug = '{{ $article->slug }}';
        let readArticles = JSON.parse(localStorage.getItem('read_articles')) || [];

        $.ajax({
            url: "{{ route('article.recent', ['locale' => app()->getLocale()]) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                read_articles: readArticles
            },
            success: function(response) {
                const recentArticlesContainer = $('.rc-post ul');
                recentArticlesContainer.empty();

                response.forEach(function(article) {
                    const articleUrl = "{{ url(app()->getLocale().'/article') }}/" + article.slug;
                    const thumbnailUrl = "{{ Storage::url('') }}" + article.thumbnail;

                    // Format date 'd M' (e.g., 21 Nov)
                    const publishedDate = new Date(article.published_at);
                    const day = publishedDate.getDate();
                    const month = publishedDate.toLocaleString('default', { month: 'short' });
                    const formattedDate = `${day} ${month}`;

                    const articleHtml = `
                        <li class="d-flex align-items-center mb-20">
                            <div class="rc-thumb mr-15">
                                <a href="${articleUrl}">
                                    <img src="${thumbnailUrl}" alt="rc-post" style="width: 70px; height: 70px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="rc-text">
                                <h6><a href="${articleUrl}">${article.title}</a></h6>
                                <span class="rc-meta"><i class="fal fa-clock"></i> ${formattedDate}</span>
                            </div>
                        </li>
                    `;
                    recentArticlesContainer.append(articleHtml);
                });
            }
        });
    });
</script>
@endpush
