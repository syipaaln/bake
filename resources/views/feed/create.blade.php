{{-- @extends('template')

@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Tambah Video</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-secondary" href="{{ route('vidio.index') }}"> Kembali</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Input gagal.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('vidio.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User:</strong>
                <input type="text" name="created_by" class="form-control" placeholder="User">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Video:</strong>
                <input type="file" name="video" class="form-control" placeholder="Video">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Caption:</strong>
                <input type="text" name="caption" class="form-control" placeholder="Caption">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </div>

</form>

@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feed Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center" style="margin-top: 40px;">New Feed</h2>
        <form action="{{ route('feed.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group">
                <strong>Video:</strong>
                <input type="file" name="video" class="form-control" placeholder="Video" accept="video/*">
            </div> --}}
            <div class="card">
                <div class="card-body">
                    <div id="drop-area" class="border rounded d-flex justify-content-center align-items-center"
                        style="height: 200px; cursor: pointer;">
                        <div class="text-center">
                            <i class="bi bi-cloud-arrow-up-fill text-primary" style="font-size: 48px;"></i>
                            <p class="mt-3">Drag and drop your image here or click to select a file.</p>
                        </div>
                    </div>
                    <input type="file" name="video" id="fileElem" accept="video/*" class="d-none" multiple>
                </div>
            </div>
            <div class="form-group">
                <strong>Caption:</strong>
                <textarea name="caption" class="form-control"></textarea>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>

    <script>
        let dropArea = document.getElementById("drop-area");

        ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        ["dragenter", "dragover"].forEach((eventName) => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ["dragleave", "drop"].forEach((eventName) => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        dropArea.addEventListener("drop", handleDrop, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropArea.classList.add("highlight");
        }

        function unhighlight(e) {
            dropArea.classList.remove("highlight");
        }

        function handleDrop(e) {
            let dt = e.dataTransfer;
            let files = dt.files;
            handleFiles(files);
        }

        function handleFiles(files) {
            [...files].forEach(uploadFile);
        }

        function uploadFile(file) {
            console.log("Uploading", file.name);
        }

        dropArea.addEventListener("click", () => {
            fileElem.click();
        });

        let fileElem = document.getElementById("fileElem");
            fileElem.addEventListener("change", function (e) {
            handleFiles(this.files);
        });
    </script>

</body>
</html>