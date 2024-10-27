@include('layout.client.header')
{{-- <div id="notification" class="alert alert-success" style="position: fixed; display: none; top: 20px; right: 20px; z-index: 1000;">
</div> --}}

@if(session('message'))  
<div class="alert alert-info">  
    {{ session('message') }}  
</div>  
@endif  
@yield('content_client')
@include('layout.client.footer')
