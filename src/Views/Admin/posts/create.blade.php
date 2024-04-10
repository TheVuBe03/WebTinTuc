<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <ul class="nav nav-tabs" style="margin-bottom: 50px">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/admin/users">User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/categories">Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/posts">Post</a>
        </li>
    </ul>
    {{-- @php
     var_dump($data)   
    @endphp --}}
    <div class="container">
        <h1>Them mới bài viết</h1>
        <div class="row">
            <form action="" method="POST" enctype="multipart/form-data">
               
                    <div class="mb-3 mt-3">
                        <label for="category_id" class="form-label">Category:</label>                   
                        <select name="category_id" id="" class="form-control">
                            @foreach ($category as $cat)
                            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                            @endforeach
                        </select>                    
                    </div>
               
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="dá" placeholder="Enter title" name="title">
                </div>
                <div class="mb-3 mt-3">
                    <label for="excerpt" class="form-label">Excerpt:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter excerpt"
                        name="excerpt">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea name="content" id="" cols="20" rows="10" class="form-control" placeholder="Enter content"> </textarea>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Avatar:</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Galeries</label>
                    <input type="file" class="post_galleries[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>
