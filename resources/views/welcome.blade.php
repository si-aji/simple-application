<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Application</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="bg-light min-vh-100 p-4" id="app">
            <h1>Hello World!</h1>

            @if(Session::get('message'))
            <!-- Content Message (Page header) -->
            <div class="alert alert-{{ Session::get('status') ?? 'info' }} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5>
                    @if(Session::get('message_icon'))
                    <i class="icon fas fa-{{ Session::get('message_icon') ?? 'info' }}"></i>
                    @endif {{ Session::get('status') ? ucwords(Session::get('status')) : 'Info' }}!</h5>
                {{ Session::get('message') }}
            </div>
            @endif

            <div class="mt-5">
                <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Image</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="customFile" accept=".jpg,.jpeg,.png">
                            <label class="custom-file-label" for="customFile">Choose file</label>

                            @error('image')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js" integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg==" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init()
        });
    </script>
</body>
</html>