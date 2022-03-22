Author:         Joudel Hirt

Date:           11.March 2022

Ordername:      Happyplace_LB_Joudel_Hirt

Description:    This is a Project for a place named Happy place including most of the stuff around PHP, HTML, and SQL with a bit of javascript.
                To find all of the files in this project, you have to open Happyplace_LB_Joudel_Hirt first.

Dictonary:      api.PHP                     -> api for map.html and the markers
                map.html                    -> including the map, openstreetmap and the markers
                map.php                     -> php coding around the map and
                dashboard_navi.php          -> including all the SESSIONS
                dashboard.php               -> including the formula as an admin with the admintool or as a user with restricted permissions
                footer.html                 -> including the author and the company name
                navigation.php              -> including the navbar and implementing all the navigation methods
                style.css                   -> stylesheet for the whole Project
    
Folder sql      happyplace.sql              -> Database of the whole Project inlcuding the tables: place, student and users
                happyplace_current.sql      -> Database of the current step in the project

Folder json                                 -> all the bootstrap files needed for the whole Project

Folder inc     .htaccess                    -> security measures for the database of the whole Project
                DbManagement.php            -> Managing everything around the database of the whole Project, including the security measurement

Folder img                                  -> all the Picture used for the whole Project

Folder headers  big_header.php              -> used for the flexible header style, just the size is different
                small_header.php            -> used for the flexible header style, just the size is different

Folder forms    admin_dashboard.php         -> admin dashboard with all the rights to add and revoke the permission of the user or another admin, including to edit student
                insert_student.php          -> form to add a new student to the database
                login_form.php              -> form to login as a user or as an admin 
                show_student_form.php       -> table to show all of the student who got registered
                show_user_form.php          -> form of the user without adminstrator rights 
                update_profil_form.php      -> form to delete oder edit the password of the user
                update_student_form.php     -> form to edit and delete a student
                udate_user_form.php         -> form for the administrator with all the function needed as an admin, editing your slave and adding new student included

Folder doc      locations.csv               -> used for the database with the coords

Folder css                                  -> all the styling bootstraps


Login as an administrator                   -> Username: Boss/admin@admin.ch
                                            -> Password: admin

Login as an User                            -> Username: User/user@user.ch
                                            -> Password: user