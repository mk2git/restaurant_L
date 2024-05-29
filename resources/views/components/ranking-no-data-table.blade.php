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
  <tbody class="text-align-center">
    <td colspan="4">まだデータがありません</td>
  </tbody>
</table>