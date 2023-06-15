@if(session()->has('success'))
    <div class="container-fluid">
    <div class="row">
        <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong id="notification-text">{{ session('success') }}</strong>
        </div>
    </div>
    </div>
@endif
