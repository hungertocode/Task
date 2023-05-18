@if ($message = Session::get('success'))
    <div class="php-email-form">
        <div style="display:block" class="sent-message alert alert-success"> {{ session('success') }}</div>
    </div>
@endif
@if (session()->has('error'))
    <div class=" alert {{ session('error') ? 'alert-danger' : 'alert-success' }} alert_msg">
        {{ session('error') }}
    </div>
@endif
