<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid ">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand m-4" href="#">XML</a>
              <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">v</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                  </li>
                </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
        </nav>

        <div class="container">
            <h1 class="display-4 text-center m-3 p-2">listado </h1>
            <form action="{{ route('xml.upload') }}" method="post"  enctype="multipart/form-data">

                @csrf

                <div class="d-flex justify-content-end m-3">      
                    <input class="p-2" type="file" name="xml_file">                         
                    <button type="submit" style="background: rgb(74, 155, 236)" class="btn p-2">subir Archivo</button>
                    <a href="{{ route('xml.download') }}" class="btn btn-primary p-2">Descargar XML</a>

                </div>
            
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- tipo tabla la informacion --}}
                <table class="table table-bordered border-danger">
                    <thead class="table-danger table-bordered border-danger ">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombres completos</th>
                            <th scope="col">email</th>
                            <th scope="col">descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($persona as $index => $personass)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $personass->nombre }}</td>
                                <td>{{ $personass->correo }}</td>
                                <td>{{ $personass->descripcion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                    
                </table>

                <br> 
            
                {{-- en tipo cartas las personas --}}
                <div class="d-flex grid gap-3 " >
                    @foreach($persona as $index => $personass)
                        <div class="card p-2 g-col-6 flex-fill " style="width: 18rem; background: rgba(192, 192, 199, 0.258) ">
                            <img src="{{ asset('img/anomimo.png') }}" class="card-img-top" alt="" style="height: 20rem">
                            <div class="card-body">
                                
                                <h5 class="card-title">{{ $personass->nombre }}</h5>
                                <p class="card-text">{{ $personass->descripcion }}</p>
                                <a href="#" class="">{{ $personass->correo }}</a>
                            </div>
                        </div>
                    @endforeach 
                </div>
                             
                    
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>

</html>
