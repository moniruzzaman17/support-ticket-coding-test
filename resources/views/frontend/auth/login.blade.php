<section class="login">
    <div class="container mt-4">
        <div class="row m-auto">
            <div class="col-12 col-md-6 d-flex align-items-center">
                <main class="login__main">
                  <div class="login__header">
                    <h2>Welcome to Netcoden Support Center!</h2>
                    <p><strong>Login</strong> by entering the information below</p>
                  </div>
                    <form action="" class="login-form">
                      <div class="login-form__row">
                        <div class="login-form__input-group">
                          <label for="email">Email address</label>
                          <input type="text" class="login-form__text-input" id="email" name="email">
                        </div>
                      </div>
                      <div class="login-form__row">
                        <div class="login-form__input-group">
                          <label for="password">Password</label>
                          <input type="password" class="login-form__text-input" id="password" name="password">
                        </div>
                      </div>
                      <div class="login-form__row login-form__row--far">
                        <div class="">
                          <input type="checkbox" name="remember" checked>
                          <label for="remember">Remember me</label>
                        </div>
                        <a href="#">Forgotten Password?</a>
                      </div>
                      <div class="login-form__row">
                        <input type="submit" value="Continue" class="login-form__submit">
                      </div>
                    </form>
                    <a href="{{ route('register') }}"><p>Don't have an account? Create one here.</p></a>
                </main>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center">
                <img src="{{ asset('images/banner.webp') }}" alt="" class="w-100">
            </div>
        </div>
    </div>
</section>