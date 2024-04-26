@props(['list' => []])

<div class="mt-3 ms-5">
  <a
      href="{{route('dashboard')}}"
      class="text-decoration-none text-black"
  >
      <i class="fa-solid fa-house"></i>
  </a>
  @foreach ($list as $item)
    @if ($item['link'])
      <a href="{{$item['link']}}">{{$item['name']}}</a>
    @else
      <span>{{$item['name']}}</span>
    @endif
  @endforeach
</div>
