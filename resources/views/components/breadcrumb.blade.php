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
      &nbsp;&nbsp;&nbsp;>&nbsp;<a href="{{$item['link']}}" class="text-black">{{$item['name']}}</a>
    @else
    &nbsp;&nbsp;&nbsp;>&nbsp;<span>{{$item['name']}}</span>
    @endif
  @endforeach
</div>
