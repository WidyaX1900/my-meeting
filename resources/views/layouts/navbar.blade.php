<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Hi, {{ Auth::user()->name }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <form action="/logout" method="post" class="my-auto">
                @csrf
                <a class="nav-link" onclick="this.closest('form').submit()" style="cursor: pointer">Logout</a>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>