@if(isset($image))
    <img src="{{ route('imagecache', [$size, $image->path]) }}" alt="{{ $alt }}">
@else
    <img src="{{ route('imagecache', [$size, 'no_image_groot.jpg']) }}" alt="{{ $alt }}">
@endif
