@extends('_layouts.head')

@section('title', 'aanpassen')

@section('head')
    <meta name="description" content="Evenement aanpassen">
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
@endsection

<body>
    <h2>evenement aanpassen</h2>
    <figure id="voorvertoning"><img src="elkaveee.jpg"></img></figure>
    <form action="edit-event" method="post" enctype="multipart/form-data">
        @csrf
        <input type="range" name="zoom" id="zoom" min="75" max="400" value="100">
        <input type="range" name="links-rechts" id="links-rechts" min="0" max="100" value="50">
        <input type="range" name="boven-onder" id="boven-onder" min="0" max="100" value="50">
        <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png">
        <input type="text" name="titel" id="titel" placeholder="titel">
        <input type="text" name="locatie-naam" id="locatie-naam" placeholder="naam van de locatie">
        <input type="date" name="datum" id="datum">
        <input type="time">
        <textarea name="beschrijving" id="beschrijving">beschrijving</textarea>

        <input type="url" name='locatie-url' id='locatie-url' placeholder="link naar maps">
        <input type="checkbox" name="publiek" id="publiek"><label for="publiek">publiek evenement</label>
        <input type="submit" value="opslaan">
    </form>
    @include('_partials.navigation')

    <script>
        let sliderZoom = document.querySelector('#zoom');
        let sliderHorizontaal = document.querySelector('#links-rechts');
        let sliderVerticaal = document.querySelector('#boven-onder');
        let fotokader = document.querySelector('#voorvertoning')
        let foto = document.querySelector('#voorvertoning img')

        let uploadButton = document.querySelector('input[type="file"]')
        uploadButton.addEventListener('change', (e)=>{
            const currFiles = e.target.files
            if(currFiles.length > 0){
                let src = URL.createObjectURL(currFiles[0])
                foto.src = src
            }
        })

        sliderZoom.addEventListener('input', (e) => {
            let scaleValue = (e.target.value / 100);
            foto.style.scale = scaleValue;
            foto.style.transform = "translate(-" + (50/scaleValue) + "%, -" + (50/scaleValue) + "%)"
        })

        let horizontaal = 50;
        let verticaal = 50;

        sliderVerticaal.addEventListener('input', (e) => {
            verticaal = e.target.value
            foto.style.top = verticaal + "%";
        })

        sliderHorizontaal.addEventListener('input', (e) => {
            horizontaal = e.target.value
            foto.style.left = horizontaal + "%";
        })

    </script>
</body>
</html>