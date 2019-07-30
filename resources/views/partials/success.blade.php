@if (Session::has('success'))
    <div class="alert alert-success">
    	<strong>{{ Session::get('success') }}</strong>
    </div>
@endif