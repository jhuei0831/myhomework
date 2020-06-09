<style>
    html,body{
        font-family: {{ $config->font_family }} !important;
        font-size: {{ $config->font_size }} !important;
        font-weight: {{ $config->font_weight }} !important;
        background-image: url('{{ asset("storage/uploads/images/$config->background")}}');
        background-color: #{{ $config->background_color }}
    }
    .navbar {
        background-color: transparent;
        background: transparent;
        border-color: transparent;
        box-shadow: none !important;
    }
    .nav-link{
        color: #{{ $config->navbar_wcolor }} !important;
        font-size: {{ $config->navbar_size }} !important;
        font-weight: {{ $config->font_weight }} !important; 
    }
    .nav-link:hover {
        color: #{{ $config->navbar_hcolor }} !important;
    }
</style>