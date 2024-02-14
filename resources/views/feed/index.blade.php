{{-- @extends('template')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mt-5 mb-5">
            <div class="col-lg-12 d-flex justify-content-between align-videos-center">
                <div>
                    <h2>Data Video</h2>
                </div>
                <div>
                    <a class="btn btn-warning" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="btn btn-success" href="{{ route('vidio.create') }}">Tambah Video</a>
                </div>
            </div>
        </div>
        
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
    
        <table class="table table-bordered">
            <tr>
                <th width="20px" class="text-center">No</th>
                <th width="120px" class="text-center">Video</th>
                <th width="200px" class="text-center">caption</th>
                <th width="280px"class="text-center">Action</th>
            </tr>
            @foreach ($videos as $video)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td class="text-center">
                    <video width="640" height="360" controls>
                        <source src="{{ asset('/video/'.$video->video)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </td>
                <td class="text-center">{{ $video->caption }}</td>
                <td class="text-center">
                    <form action="{{ route('vidio.destroy',$video->id) }}" method="POST">
    
                        @csrf
                        @method('DELETE')
    
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Feed Video</title>
    <style>
        h2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2 class="text-center">Feed</h2>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @foreach ($feed as $feed)
            <div class="position-relative d-inline-block">
                {{-- <video width="640" height="360" controls class="card-img-top">
                    <source src="{{ asset('/videos/'.$video->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video> --}}
                {{-- @if ($videos->video)
                    <img src="{{ 'storage/app/'. $video->video }}" class="img-thumbnail" alt="">
                @else
                    <Span>No Picture</Span>
                @endif
                <img src="{{ asset('storage/' . $product->picture) }}" class="img-thumbnail" alt=""> --}}
                <video width="640" height="360" controls class="card-img-top">
                    <source src="{{ asset('storage/'.$feed->video)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="text-left">
                <div>{{ $feed->caption }}</div>
                <div>{{ $feed->created_at->format('d F Y') }}</div>
            </div>
            <form action="{{ route('feed.destroy',$feed->id) }}" method="POST">
    
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
            </form>
            <br>
        @endforeach
        <a class="btn btn-warning" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <a class="btn btn-success" href="{{ route('feed.create') }}">Add</a>
    </div>
</body>
</html>