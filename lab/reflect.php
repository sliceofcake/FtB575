<?
setcookie("ftb_reflect_test_cookie","hi_i_am_data_nice_to_meet_you",time()+3600); // expire in 1 hour
echo "headers\n";
print_r(getallheaders());
echo "\n\nCOOKIE\n";
print_r($_COOKIE);
echo "\n\nPOST\n";
print_r($_POST);
echo "\n\nGET\n";
print_r($_GET);
?>