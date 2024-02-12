@extends('template')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mt-5 mb-5">
            <div class="col-lg-12 d-flex justify-content-between align-videos-center">
                <div>
                    <h2>Data Video</h2>
                </div>
                <div>
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
            @foreach ($video as $video)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td class="text-center">
                    {{-- {{ $video->url }} --}}
                    {{-- <video src="{{ asset('/video/'.$video->url)}}" width="120px" type="video/mp4">Your browser does not support the video tag.</video> --}}
                    <video width="640" height="360" controls>
                        <source src="{{ asset('/video/'.$video->url)}}" type="video/mp4">
                        Your browser does not support the video tag.
                      </video>
                    {{-- <img src="{{ asset('/video/'.$video->url)}}" alt="Video" width="120px"> --}}
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
@endsection
                