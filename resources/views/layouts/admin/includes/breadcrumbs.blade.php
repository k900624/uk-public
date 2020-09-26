
@foreach($breadcrumbs as $route => $title)
    @php $breadcrumbsArr[] = ['route' => $route, 'title' => $title]; @endphp
@endforeach

<div class="l-breadcrumbs clearfix">
    <div class="breadcrumbs">
        <div class="breadcrumbs_inner">
            @php $last = array_pop($breadcrumbsArr) @endphp
            @foreach($breadcrumbsArr as $breadcrumb)
                <a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['title'] }}</a>
                <span class="separator"><i class="fa fa-caret-right"></i></span>
            @endforeach
            <span class="last">{{ $last['title'] }}</span>
        </div>
    </div>
</div>