<div class="alert alert-danger w-50 mx-auto">
  <ul class="mx-auto w-50">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>