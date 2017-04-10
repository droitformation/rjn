$(function() {

    $.strRemove = function(theTarget, theString) {
        return $("<div/>").append(
            $(theTarget, theString).remove().end()
        ).html();
    };

    function linki(text){
        if (text) {
            text = text.replace(
                /((https?\:\/\/)|(www\.))(\S+)(\w{2,4})(:[0-9]+)?(\/|\/([\w#!:.;?+=&%@!\-\/]))?/gi,
                function(url){
                    var full_url = url;
                    if (!full_url.match('^https?:\/\/')) {
                        full_url = 'http://' + full_url;
                    }
                    return '<a target="_blank" href="' + full_url + '">' + url + '</a>';
                }
            );
        }
        return text;
    }

    var $citations = $("#citations");

    if($citations)
    {
       //var $anchors   = $("a[href^='#_']");
       var $anchors   = $("a[href^='#_']");

        $.each( $anchors, function( i, val ) {

           var href  = $(this).attr('href');

           if(href)
            {
                var link = href.replace("#", "");
                var num  = href.replace("#_ftn", "");

                if(link && num)
                {
                    var $content = $citations.find('a[name="' +link+ '"]').parent();
                    $content = $content.wrap('<p>').parent().html();
                    //var $content = $citations.find('a[name="' +link+ '"]').parent().html();
                    console.log($content);

                    if($content)
                    {
                         $content = $.strRemove("a", $content);
                         $content = linki($content);
                         $content = '<div>'+$content+'</div>';

                         $(this).attr('data-toggle', 'popover');
                         $(this).attr('data-content', $content);
                         $(this).attr('tabindex', 0);
                         $(this).attr('title', num);
                         $(this).addClass('sup');
                    }
                }
            }
        });
    }


/*    var $commentaires = $("#commentaires");

    if($commentaires)
    {
        var $anchors = $("#faits a[href^='#_']");

        $.each( $anchors, function( i, val ) {

            $(this).addClass('anchor');

        });
    }*/

    $('[data-toggle="popover"]').popover({
        html : true,
        placement: 'bottom'
    });

    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });


    $(".selectpicker").prepend("<option value='' selected='selected'>Choisir la Loi</option>");
    $('.selectpicker').chosen({ width:"95%"});
  // console.log($anchors);

});