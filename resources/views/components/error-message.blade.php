<div class="alert alert-danger w-50 mx-auto">
  <ul>
      @foreach ($errors->all() as $error)
          <li class="text-center">{{ $error }}</li>
      @endforeach
  </ul>
</div>