<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Proba ajax</title>
</head>
<body>
    <h1 class="text-7xl">oli</h1>
    <button id="dale">Dalle</button>
    <span id="nombre"></span>
    <script>
        document.getElementById('dale').addEventListener('click', ()=>{
            fetch("{{ route('user') }}", {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // identify as AJAX
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
                .then(response => {
                    if(!response.ok) throw new Error('Non fui');
                    return response.json();
                })
                .then(data => {
                    //document.getElementById('nombre').textContent = data;
                    console.log(data)
                })
                .catch(err => {
                    alert(err)
                })
        });
    </script>
</body>
</html>

