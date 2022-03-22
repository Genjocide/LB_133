<?php

$login = '';
$profile = '';
$home = '';
$map = '';
$customer = '';

$display_login = '';
$display_logout = '';

if (isset($_SESSION['activ_user']))
{
    $display_login = 'style="display: none;"';
}
else
{
    $display_logout = 'style="display: none;"';
}

if ($title == 'Login')
{
    $login = 'active ';
}
elseif ($title == 'Dashboard')
{
    $profile = 'active';

}
elseif ($title == 'home')
{
    $home = 'active';
}
elseif ($title == 'Map')
{
    $map = 'active';
}
elseif ($title == 'Customer')
{
    $profile = 'active';
}
echo '
<nav class="navbar navbar-dark bg-dark navbar-expand-lg bg-dark" id="navbar">
  <div class="container-fluid flex-row-reverse">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-row-reverse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link '.$map.'" href="map.php">Map</a>
        </li>
        <li class="nav-item">
          <a class="nav-link '. $login . '" '. $display_login . ' href="dashboard.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link ' . $profile . '" '. $display_logout . ' href="dashboard.php">Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</nav>';