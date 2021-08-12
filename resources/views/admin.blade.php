<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger mt-5">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <form action="{{ route('addUser') }}" method="post" class="mt-5">
                    @csrf
                    <center>
                        <p>Send Invitation</p>
                    </center>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" type="sumbit" id="button-addon2">Send</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Code</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->unq_code }}</td>
                                    @if($user->invitation)
                                        <td>Accepted</td>
                                    @else
                                        <td>Sent</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
