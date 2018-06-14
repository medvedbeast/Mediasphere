function OnLogoutClick()
{
    document.cookie = "user=; expires=Thu, 01-Jan-1970 00:00:01 GMT";
    window.location.href = "entrance.php?action=relogin&target=" + window.location.href;
}

