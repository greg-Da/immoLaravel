<div class="card">
    @if ($property->getPicture())
        <img src="{{$property->getPicture()->getImageUrl()}}" class="w-100" alt="">
    @endif
    <div class="card-body">
        <a href="{{route('property.show', ['slug' => $property->getSlug(), 'property' => $property])}}" class="card-title">{{ $property->title }}</a>
        <div class="d-flex justify-content-between w-100">
            <p class="card-text">{{ $property->surface }}m2 - {{ $property->city->name }}</p>
            <p class="card-text fw-bold">
                {{$property->getFormattedPrice()}}
            </p>
        </div>
    </div>
</div>