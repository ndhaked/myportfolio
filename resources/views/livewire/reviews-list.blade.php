<?php

use App\Repositories\Contracts\ReviewRepositoryInterface;
use Livewire\Volt\Component;

new class extends Component
{
    public $reviews = [];

    public function boot(ReviewRepositoryInterface $reviewRepository): void
    {
        $this->reviews = $reviewRepository->active();
    }
}; ?>

<div x-data="{ videoOpen: false, videoId: '' }">
    <div class="row">
        @forelse ($reviews as $review)
            <div class="col-sm-4" wire:key="review-{{ $review->id }}">
                <div class="review-card">
                    @if ($review->youtube_video_id)
                        <div class="review-video-thumb" @click="videoId = '{{ $review->youtube_video_id }}'; videoOpen = true">
                            <img src="https://img.youtube.com/vi/{{ $review->youtube_video_id }}/hqdefault.jpg" alt="{{ $review->client_name }}">
                            <span class="review-play-icon"><i class="fa fa-play"></i></span>
                        </div>
                    @endif
                    <h5 class="review-client-name">{{ $review->client_name }}</h5>
                    <p class="review-client-role">{{ $review->client_role }}</p>
                    <p class="review-quote">"{{ $review->quote }}"</p>
                </div>
            </div>
        @empty
            <p class="text-center" style="width: 100%;">No reviews yet.</p>
        @endforelse
    </div>

    <div
        x-show="videoOpen"
        x-cloak
        @click="videoOpen = false"
        @keydown.escape.window="videoOpen = false"
        class="portfolio-lightbox"
    >
        <span class="portfolio-lightbox-close" @click="videoOpen = false">&times;</span>
        <div class="portfolio-lightbox-inner review-video-inner" @click.stop>
            <template x-if="videoOpen">
                <iframe :src="'https://www.youtube.com/embed/' + videoId + '?autoplay=1'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </template>
        </div>
    </div>

    <style>
        .review-card {
            margin-bottom: 30px;
        }
        .review-video-thumb {
            position: relative;
            cursor: pointer;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 16px;
        }
        .review-video-thumb img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.3s ease;
        }
        .review-video-thumb:hover img {
            transform: scale(1.05);
        }
        .review-play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: background 0.3s ease;
        }
        .review-video-thumb:hover .review-play-icon {
            background: #7b1fa2;
        }
        .review-client-name {
            margin-bottom: 2px;
        }
        .review-client-role {
            font-size: 13px;
            color: #999;
            margin-bottom: 10px;
        }
        .review-quote {
            font-style: italic;
        }
        .review-video-inner {
            width: 90vw;
            max-width: 800px;
        }
        .review-video-inner iframe {
            width: 100%;
            height: 450px;
            max-height: 70vh;
            border-radius: 6px;
            display: block;
        }
    </style>
</div>
