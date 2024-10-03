<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" id="loginButton" class="btn btn-primary mt-3">Submit</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // $(document).ready(function() {
        //     $('#loginButton').on('click', function() {
        //         let email = $('#email').val();
        //         let password = $('#password').val();

        //         $.ajax({
        //             url: '/api/login',
        //             type: 'POST',
        //             contentType: 'application/json',
        //             data: JSON.stringify({
        //                 email: email,
        //                 password: password
        //             }),
        //             success: function(response) {
        //                 console.log(response);

        //                 localStorage.setItem('api_token', response.token);

        //                 window.location.href = '/allposts'
        //             },
        //             error: function(xhr, status, error) {
        //                 console.log('Error' + xhr.responseText);
        //             }
        //         })
        //     })
        // })

        $(document).ready(function() {
            $('#loginButton').on('click', function() {
                let email = $('#email').val()
                let password = $('#password').val()

                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: email,
                        password: password
                    }),
                    success: function(response) {
                        console.log(response);
                        localStorage.setItem('api_token', response.token)
                        window.location.href = '/allposts'
                    },
                    error: function(xhr, status, error) {
                        console.log('Error' + xhr.responseText);
                    }
                })
            })
        })
    </script>
</body>

</html>
