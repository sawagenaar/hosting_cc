
@if ($message = Session::get('success'))
<div x-data="{ show: true }"
  x-init="setTimeout(() => show = false, 4000)"
  x-show="show"
  class="alert alert-success">
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div x-data="{ show: true }"
  x-init="setTimeout(() => show = false, 4000)"
  x-show="show"
  class="alert alert-danger">
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div x-data="{ show: true }"
  x-init="setTimeout(() => show = false, 4000)"
  x-show="show"
  class="alert alert-warning">
  <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div x-data="{ show: true }"
  x-init="setTimeout(() => show = false, 4000)"
  x-show="show"
  class="alert alert-info">
  <strong>{{ $message }}</strong>
</div>
@endif

