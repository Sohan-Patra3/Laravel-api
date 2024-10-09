<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h3>Add Post</h3>
        <form id="addForm">
            <div class="mb-3">
                <input type="text" class="form-control" id="title" placeholder="Enter text">
            </div>

            <div class="mb-3">
                <textarea class="form-control" id="description" rows="3" placeholder="Enter detailed text"></textarea>
            </div>

            <div class="mb-3">
                <input class="form-control" type="file" id="image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let addForm = document.getElementById('addForm')

        // addForm.onsubmit = async (e) => {
        //     e.preventDefault();

        //     const token = localStorage.getItem('api_token');

        //     let title = document.getElementById('title').value
        //     let description = document.getElementById('description').value
        //     let image = document.getElementById('image').files[0]

        //     let formData = new FormData();
        //     formData.append('title', title)
        //     formData.append('description', description)
        //     formData.append('image', image)

        //     let response = await fetch('/api/posts', {
        //             method: 'POST',
        //             body: formData,
        //             headers: {
        //                 'Authorization': `Bearer ${token}`,
        //             }
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log(data);
        //             window.location.href = "/allposts";
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });
        // }

        addForm.onsubmit = async (e) => {
            e.preventDefault()

            const token = localStorage.getItem('api_token');

            let title = document.getElementById('title').value
            let description = document.getElementById('description').value
            let image = document.getElementById('image').files[0]

            let formData = new FormData()

            formData.append('title', title)
            formData.append('description', description)
            formData.append('image', image)

            await fetch('/api/posts', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    }
                }).then(response => response.json())
                .then(data => {
                    console.log(data);
                    window.location.href = '/allposts'
                })
        }
    </script>
</body>

</html>
