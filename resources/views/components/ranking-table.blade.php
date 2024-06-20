@props(['rankingName'])

<p {{ $attributes->merge(['class' => 'badge rounded-pill'])}}>{{$rankingName}}</p>

<table class="table table-hover table-borderless mx-auto text-center">
  <thead class="border-bottom">
    <tr>
      <th>順位</th>
      <th>料理名</th>
      <th>数量</th>
      <th>合計金額</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tableTopThreeOrdersQ as $table_top_three_order)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td class="custom-text-size">{{$table_top_three_order->menu->name}}</td>
        <td>{{$table_top_three_order->total_quantity}}</td>
        <td>
          &yen;{{number_format($table_top_three_order->total_quantity * $table_top_three_order->menu->price)}}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>