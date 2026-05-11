{{--
    Usage: @include('partials.page-hero', ['title' => 'Services', 'crumbs' => [['label'=>'Home','url'=>route('home')], ['label'=>'Services']]])
--}}
<section class="breadcrumb-wrapper bg-cover"
    style="background-image: url('{{ $bgImage ?? asset('assets/img/hero/breadcumb.jpg') }}');">
    <div class="border-shape">
        <img src="{{ asset('assets/img/hero/border-shape.png') }}" alt="shape">
    </div>
    <div class="line-shape">
        <img src="{{ asset('assets/img/hero/line-shape.png') }}" alt="shape">
    </div>
    <div class="container">
        <div class="page-heading">
            <h1>{{ $title }}</h1>
            <ul class="breadcrumb-items">
                @foreach($crumbs as $i => $crumb)
                    @if(!empty($crumb['url']))
                        <li><a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a></li>
                    @else
                        <li>{{ $crumb['label'] }}</li>
                    @endif
                    @if(!$loop->last)
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</section>
