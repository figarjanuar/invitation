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
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="row mt-5">
            <div class="col-12">
                <center>
                    <p>
                        Welcome to<br>
                        <b>HUNTBAZAAR</b> Invitation
                    </p>
                </center>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('submit') }}" method="POST">
                            <div class="mb-3">
                                <span id="timer"></span>
                            </div>
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="code" value="{{ $user->unq_code }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input disabled value="{{ $user->email }}" name="email" type="email" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input name="dob" type="date" class="form-control" id="dob">
                            </div>
                            <div class="mb-3">
                                <div>
                                    <label class="form-label">Gender</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="m">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="f">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Favorite Designers</label>
                                <select class="form-select" name="designers[]" multiple aria-label="multiple select example">
                                    @foreach ($designers as $designer)
                                        <option value="{{ $designer->id }}">{{ $designer->designer }}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <div>
                                <button id="submit-btn" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var countDownDate = new Date("{{ $expire }}").getTime();
    console.log(countDownDate);

    var x = setInterval(function() {
      var now = new Date().getTime();

      var distance = countDownDate - now;

      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById("timer").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "EXPIRED";
        var elem = document.getElementById("submit-btn");
        elem.parentNode.removeChild(elem);
      }
    }, 1000);
</script>
</html>
