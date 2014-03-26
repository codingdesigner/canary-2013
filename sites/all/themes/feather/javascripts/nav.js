(function ($) {
  Drupal.behaviors.offsideNav = {
    attach: function (context, settings) {
      // VARS
      var nav_offside_active = false;
      $('body')
        .attr('data-nav-offside-active', nav_offside_active)
        .append('<div id="clear-pane"></div>');

      // SHOW/HIDE MENU
      var showMenu = function() {
        nav_offside_active = (nav_offside_active === false) ? true : false;
        $('body').attr('data-nav-offside-active', nav_offside_active);
      }

      // BUTTONS
      $('.menu-trigger').click(function(e) {
        e.preventDefault();
        showMenu();
      });
      $("#clear-pane").live('click', function(e){
        $('.menu-trigger').click();
      });

    }
  };
})(jQuery);
