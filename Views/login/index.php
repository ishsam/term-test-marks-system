<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin</title>

<meta name="theme-color" content="#7952b3">


  </head>
  <body class="text-center">
    <div class="container" style="margin-top: 10em;">
      <div class="row row-cols-3">
        <div class="col">
        </div>
        <div class="col">
          <main class="form-signin">
            <form method="POST" action="login/run">
              <img class="mb-4" src="/resources/images/person-circle.svg" alt="" width="72" height="57">
              <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
          
              <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="login">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
              </div>
              <div class="mb-3">
              <div>No account yet? <a href="#">Register</a> Here</div>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
              <p class="mt-5 mb-3 text-muted">&copy; 2023 Student Term Test Marks System</p>
            </form>
          </main>
        </div>
        <div class="col">
        </div>
      </div>
    </div>
  </body>
</html>

