<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Video Conference App</title>
    @vite(['resources/js/app.js', 'resources/bootstrap/css/bootstrap.min.css'])
</head>

<body>
    <div class="container mt-4">
        <h1>Create an Account</h1>
        <form action="/save" method="post" class="col-6 border rounded p-3 mt-4">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name..." value="{{ old('name') }}">
                @error('name')
                    <div class="mt-1">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                @error('email')
                    <div class="mt-1">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <div class="mt-1">
                        <small class="text-danger">{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <span>Already have an account? <a href="/login">Log In</a></span>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>

</html>
