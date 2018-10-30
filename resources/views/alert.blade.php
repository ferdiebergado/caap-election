<div class="container-fluid">
    
    @if (session('status'))
    <div id="divAlertSuccess" class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><span><i class="fa fa-check"></i></span> Success</h4>
        <h6>{{ session('status') }}</h6>
    </div>
    @endif
        
    @if (session('error'))
    <div id="divErrors" class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><span><i class="fa fa-ban"></i></span> Error</h4>
        <h6 id="errorMsg">{!! session('error') !!}</h6>
    </div>
    @endif
    
</div>
