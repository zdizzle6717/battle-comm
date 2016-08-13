define(['jquery', 'pgui.shortcuts'], function () {
    $(function () {
        var $body = $('body');
        var $sidebar = $('.sidebar');
        var $sidebarNav = $sidebar.find('.nav').first();

        $body.on('click', '.toggle-sidebar,.sidebar-backdrop', function () {
            $body.toggleClass(window.outerWidth <= 992 ? 'sidebar-active' : 'sidebar-desktop-active');
        });

        $(window).on('resize', updateScrollbar);
        $sidebarNav.on('click', function () {
            setTimeout(updateScrollbar, 300);
        });

        updateScrollbar();

        function updateScrollbar() {
            $sidebar.toggleClass(
                'sidebar-scrollable',
                $sidebar.outerHeight() < $sidebarNav.outerHeight()
            );
        }
    });
});
