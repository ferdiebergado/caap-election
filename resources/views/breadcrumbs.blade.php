  <nav class="float-right" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{-- <i class="s7 s7-home"></i> --}}
            <a href="{{ route('home')}}">Home </a>
            <i class="fa fa-angle-right"></i>
        </li>
        @for($i = 0; $i <= count(Request::segments()); $i++) 
        <li>
            <a href=""> {{ ucfirst(Request::segment($i)) }} </a> 
            @if($i < count(Request::segments()) & $i> 0) 
            {!!'<i class="fa fa-angle-right"></i>'!!} 
            @endif
        </li>
        @endfor
    </ol>
</nav>
