<div id="carouselExampleIndicators" class="carousel slide home_main_slider" data-bs-ride="carousel">
  @if (isset($sliders) && $sliders->isNotEmpty())
    @if ($sliders->count() > 1)
      <div class="carousel-indicators">
        @foreach ($sliders as $slider)
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="{{ $loop->index }}"
            class="{{ $loop->first ? 'active' : '' }}"
            @if ($loop->first) aria-current="true" @endif
            aria-label="Slide {{ $loop->iteration }}">
          </button>
        @endforeach
      </div>
    @endif

<div class="carousel-inner">
    @foreach ($sliders as $slider)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <a
                href="{{ !empty($slider->redirection_url) ? $slider->redirection_url : '#' }}"
                class="banner-link"
                @if (empty($slider->redirection_url))
                    onclick="return false;"
                @endif
            >
                <img
                    src="{{ asset('uploads/banners/' . $slider->media_url) }}"
                    alt="{{ $slider->title ?: $slider->description ?: 'Homepage banner ' . $loop->iteration }}"
                >
            </a>
        </div>
    @endforeach
</div>

    @if ($sliders->count() > 1)
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    @endif
  @else
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/image/new-slider1.jpg') }}" alt="slide 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/image/new-slider2.jpg') }}" alt="slide 2">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/image/slide_ring4.png') }}" alt="slide 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  @endif
  <style>
      .home_main_slider .carousel-item img {
    display: block;
    width: 100%;
    height: auto;
}

.home_main_slider .carousel-item .banner-link {
    display: block;
    position: relative;
    z-index: 1;
    cursor: pointer;
}

/* Keep carousel arrows clickable */
.home_main_slider .carousel-control-prev,
.home_main_slider .carousel-control-next {
    z-index: 5;
}
  </style>
</div>
