<?php
session_start();
require_once ('inc/DbManagement.php');
$db = new DbManagement();

if(isset($_POST['logout'])){
    session_destroy();
    header("Refresh:0;");
}

if (!isset($_SESSION['activ_user']))
{
    // header
    $title = 'Login';
    include('headers/small_header.php');

    // Content
    echo '<div class="container d-flex justify-content-center" id="main-container">';
    include ('forms/login_form.php');
    echo '</div>';
}
else
{
    // header
    $title = 'Dashboard';
    include('headers/small_header.php');

    // content
    echo '<div class="container" id="main-container">';
    include ('dashboard_nav.php');
    echo '<div class="row" id="toolboxes">';

    if (isset($_SESSION['show_dashboard']) and $_SESSION['show_dashboard'])
    {
        echo '<div class="col-lg-6">';

        // if admin, include admin_dashboard
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == true)
        {
            include('forms/admin_dashboard.php');
            echo '</div><div class="col-lg-6">';
        }

        // include normal dashboard
        include('forms/insert_student.php');
        echo '</div></div>';
    }
    elseif (isset($_SESSION['show_students']) && $_SESSION['show_students'])
    {
        if (isset($_SESSION['update_student']) && $_SESSION['update_student'])
        {
            include ('forms/update_student_form.php');
        }
        else{
            include('forms/show_student_form.php');
        }
    }
    elseif (isset($_SESSION['show_users']) && $_SESSION['show_users'])
    {
        if (isset($_SESSION['update_user']) && $_SESSION['update_user'])
        {
            include('forms/update_user_form.php');
        }
        else
        {
            include('forms/show_user_form.php');
        }
    }
    elseif (isset($_SESSION['update_profile']) && $_SESSION['update_profile'])
    {
        include ('./forms/update_profile_form.php');
    }

    echo '</div></div>';
}

// footer
include ('footer.html');

echo '</body></html>';
echo <<<js
    <script src="js/jquerry.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/nav_scroll.js"></script>
js;
$db = null;