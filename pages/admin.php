    <div class="container mt-5">
        <h2>Submit Form {{ var_dump($request); }}</h2>
        <form action="/" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name {{ echo 'czesc'; }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>