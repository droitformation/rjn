!function ($) {
  $(function(){

      // Footer position
      var bodyHeight = $("body").height();
      var vwptHeight = $(window).height();
      if (vwptHeight > bodyHeight) {
          $("footer#footer").css("position","absolute").css("bottom",0);
      }

      // Contact form validation
      $(".form-validation").validate();

      $(".chosen-select").chosen();

      $(".chosen-select").on('change', function(event, params) {
         $('#filterSelect').submit();
      });

      // Min-height for main content
      var $main_content = $('#main-content');
      var $footer       = $('#footer');
      var height = $footer.position().top - 105;

      //$main_content.css("min-height",height+"px");

      $('body').SearchHighlight({
          exact:"exact"
      });

      var $changeVolume = $('#changeVolume');

      $( $changeVolume ).on('change',function() {
          $(this).submit();
      });

      $('#login-trigger').click(function(){
          $(this).next('#login-content').toggle();
          $(this).toggleClass('active');
      });

  });
}(window.jQuery);