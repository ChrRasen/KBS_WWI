function autoRefresh() {
    if(window.location.href == "http://localhost/KBS_WWI/Frontend/WWI%20Website/header.php")
    {
        if (window.localStorage) {
            if (!localStorage.getItem('firstLoad')) {
                localStorage['firstLoad'] = true;
                window.location.reload();
            } else localStorage.removeItem('firstLoad');
        }
    }
};