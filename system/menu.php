<div class="nav-container">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Fun Run 2023</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="setting.php">Setting</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="result.php">Result</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="import.php">Import</a>
            </li>
          </ul>
        </ul>
      </div>
    </div>
  </nav>
</div>

<style>
  #navbar {
    display: flex;
    /* background-color: black; */
    transform: translateY(-100%);
    transition: transform .5s cubic-bezier(.4, 0, .2, 1);
  }



  .nav-container:hover #navbar {
    transform: translateY(0);
  }
</style>