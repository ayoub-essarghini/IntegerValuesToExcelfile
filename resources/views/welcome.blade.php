<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Integer combin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">



</head>

<body class="p-5 bg-light">


    <form id="myForm" action="{{ route('find.combination') }}" method="POST">
        @csrf
        <div class="row col-12 justify-content-center">
            <div class="row col-12 col-md-6 col-lg-6 col-xl-6">
                <h2 class="text-center mb-4" style="color: grey">Exporter uniquement les valeurs entières</h2>

                <input type="number" min="0" name="min" class="form-control mt-3" placeholder="min"
                    required>


                <input type="number" min="0" name="max" class="form-control mt-3" placeholder="max"
                    required>


                <input type="number" name="b" step="0.001" min="0" class="form-control mt-3"
                    placeholder="b" required>


                <input type="number" name="x" step="0.001" min="0" class="form-control mt-3"
                    placeholder="x" required>

                <button id="myBtn" type="submit" class="col-4 col-lg-2 btn  mt-4"
                    style="background: #2b72cf; color: white">Soumettre</button>


            </div>
        </div>
    </form>
    <div class="row col-12 d-flex justify-content-center">
        <div class="row col-12 col-md-6 col-lg-6 col-xl-6 mt-5 bg-light" style="overflow: auto; height:auto ; max-height: 450px">
            @if (count($files) == 0)
                <div class="download-file d-flex justify-content-center align-items-center">
                    <h4> Aucun fichiers trouvé</h4>
                </div>
            @else
                @foreach ($files as $file)
                    <div class="download-file mt-2">
                        <div class="d-flex">
                            <img src="{{ asset('assets/img/xls-file.png') }}" alt="">
                            <div class="row">
                                <small class="mx-3" style="color: grey">{{ $file->date_create}}</small>
                                <h6 class="mx-3">Fichier{{ $file->filename }}</h6>
                                <small class="mx-3 size">{{ $file->size }} Ko</small>
                            </div>

                        </div>
                        <div class=" d-flex justify-content-center p-2">

                            <a class="btn-down " href="{{ asset('storage/uploads/' . $file->filename) }}" download><span
                                    class="material-symbols-outlined">
                                    download
                                </span></a>
                            <a class="delete mx-1" href="{{ route('delete.file', $file->id) }}"><span
                                    class="material-symbols-outlined">
                                    delete
                                </span></a>
                        </div>
                    </div>
                @endforeach
            @endif




        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         function disableButton() {
    const submitButton = document.getElementById('submitButton');
    submitButton.disabled = true;
  }

        document.querySelectorAll('.delete').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior


                const href = this.getAttribute('href');


                Swal.fire({
                    title: 'Êtes-vous sûr?',
                    text: "Vous êtes sur le point de effacer ce fichier.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Annuler',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to the link's href
                        window.location.href = href;
                    }
                });
            });
        });

        // Check if session variable 'success' is present
        @if (session('success'))
            // If 'success' is present, display the button

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>
</body>

</html>
