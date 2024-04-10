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
    <div class="container">
        <h1>Chi tiết người dùng: {{$user['name']}}</h1>

        <div class="row">
            <table class="table">
                <tr>
                    <th>Trường dữ liệu</th>
                    <th>Giá trị</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <td> {{ $user['id'] }} </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $user['name']}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$user['email']}}</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td> {{$user['password'] }}</td>
                </tr>
                <tr>
                    <th>Avatar</th>
                    <td>
                        <img src="{{ $user['img'] }}" alt="" width="40px">
                    </td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>
