<div class="col-md-6">
    <div class="mb-3">
        <h5 class="card-title"> {{$title ?? 'Pages'}} <span class="text-muted fw-normal ms-2">{{ $count ?? ''}}</span></h5>
    </div>
</div>

<div class="col-md-6">
    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
        {{-- <div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="apps-contacts-list.html" data-bs-toggle="tooltip" data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="apps-contacts-grid.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Grid"><i class="bx bx-grid-alt"></i></a>
                </li>
            </ul>
        </div> --}}
        <div>
            {!! $slot !!}
        </div>
        
        {{-- <div class="dropdown">
            <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-horizontal-rounded"></i>
            </a>
          
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div> --}}
    </div>

</div>