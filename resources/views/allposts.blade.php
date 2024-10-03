<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <a href="/addpost" class="btn btn-primary btn-sm">Add Post</a>
        <button class="btn btn-danger btn-sm" id="logoutButton">Logout</button>
    </div>
    <div class="container mt-5">
        <div id="postContainer">

        </div>
    </div>

    {{-- single Data --}}
    <!-- Modal -->
    <div class="modal fade" id="singlePostModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="singlePostModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="singlePostModalLabel">Single Post</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('logoutButton').addEventListener('click', function() {
            const token = localStorage.getItem('api_token');

            fetch('/api/logout', {
                    method: 'POST',
                    headers: { // Corrected from 'header' to 'headers'
                        'Authorization': `Bearer ${token}`, // Capitalized 'Bearer' as well
                        'Content-Type': 'application/json' // Optional but recommended for POST requests
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    window.location.href = "/";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function loadData() {
            const token = localStorage.getItem('api_token');

            fetch('/api/posts', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.data);
                    let allpost = data.data
                    const postContainer = document.querySelector('#postContainer')

                    let tableData = `
                    <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>`

                    allpost.forEach(post => {
                        tableData += `
                        <tr>
                    <td><img src="/uploads/${post.image}" alt="Image" class="img-thumbnail" width="100">
                    </td>
                    <td>${post.title}</td>
                    <td>${post.description}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-post="${post.id}" data-bs-toggle="modal" data-bs-target="#singlePostModal">View</a>
                        <a href="#" class="btn btn-warning btn-sm"  data-bs-post="${post.id}"  data-toggle="modal" data-target="updatePostModal">Update</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                        `
                    });


                    tableData += `</table>`

                    postContainer.innerHTML = tableData;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        loadData()

        //Open single post modal

        let singleModal = document.querySelector('#singlePostModal')

        if (singleModal) {
            singleModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const id = button.getAttribute('data-bs-post')

                const token = localStorage.getItem('api_token')


                fetch(`/api/posts/${id}`, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.data);

                        const post = data.data[0]

                        const modalBody = document.querySelector('#singlePostModal .modal-body')

                        modalBody.innerHTML = "";
                        modalBody.innerHTML = `
                        Title : ${post.title}
                        <br>
                        Description : ${post.description}
                        <br>
                        <img width:"150px" src="/uploads/${post.image}"/>
                        `
                    })
            })
        }
    </script>

</body>

</html>
