<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RHB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb d-flex align-items-center justify-content-between">
                <div class="pull-left">
                    <h2>SIDEBAR MENU</h2>
                </div>
                <div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex">
            @foreach ($sidebars as $sidebar)
                <div class="p-2 d-flex align-items-center border" style="background-color: #C5CAE9; height: 38px;">
                    <div>{{ $sidebar->name }}</div>
                    @if (Auth::user()->hasRole('admin'))
                        <div class="ml-3">
                            <form action="{{ route('sidebars.destroy',$sidebar->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn">x</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @if (Auth::user()->hasRole('admin'))
            <div class="pull-right mt-4">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Sidebar Name:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Sidebar Name">
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3">Submit</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</body>
</html>
