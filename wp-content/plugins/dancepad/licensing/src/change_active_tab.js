/*Switch between tabs*/
document.addEventListener('DOMContentLoaded', function () {
    var navElements = document.querySelectorAll('.dancepad-dashboard__sidebar-item');
    var tabElements = document.querySelectorAll('.dancepad-dashboard__content-item');

    navElements.forEach(function(navElement) {
        navElement.addEventListener('click', function () {
            var dataTab = navElement.getAttribute('data-tab');
            document.getElementById('dan_active_tab').value = dataTab;
            
            jQuery.ajax({
                url: data_tab.ajaxurl,
                type: 'POST',
                data: {
                    action: 'get_data_from_active_tab_script',
                    dan_active_tab: dataTab
                },
            });

            tabElements.forEach(function(tabElement) {
                if(tabElement.getAttribute('data-tab') == navElement.getAttribute('data-tab')){
                    tabElement.classList.add('dancepad-dashboard__content-item--active');
                }else{
                    tabElement.classList.remove('dancepad-dashboard__content-item--active');
                }
            });

            navElements.forEach(function(navElementAux) {
                navElementAux.classList.remove('dancepad-dashboard__sidebar-item--active');
            });
            navElement.classList.add('dancepad-dashboard__sidebar-item--active');
        });
    });
});