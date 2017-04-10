
var $select_loi = $('#select_loi');
var $select_article = $('#select_article');
var $changeVolume = $('#changeVolume');

$(function() {

    $( $changeVolume ).on('change',function() {
        this.form.submit();
    });

     // $("#form_field").trigger("chosen:updated");
    // updateLois();

    /**
     * Search autocomplete
     * */
    var url = location.protocol + "//" + location.host+"/";

    $( "#matiere-search" ).autocomplete({
        source: url + "search/matieres",
        minLength: 3,
        select: function( event, ui ) {
            $('#matiere-search').val(ui.item.label);
            $('#matiere-id').val(ui.item.id);
        }
    });

    $( "#loi-search" ).autocomplete({
        source: url + "search/lois",
        minLength: 2,
        select: function( event, ui ) {
            $( "#loi-search" ).val( ui.item.sigle );
            $( "#loi-id" ).val( ui.item.idloi );
            return false;
        }
    }).autocomplete( "instance")._renderItem = function( ul, item )
        {
            return $( "<li>" ).append( "<a>" + item.sigle + "<span>" + item.label + "</span></a>" ).appendTo( ul );
        };

    $( "#loi-search" ).on( "autocompleteselect", function( event, ui ) {
        $('#loi-search').val(ui.item.sigle);
        $('#loi-id').val(ui.item.id);
    });

/*    var a = $('.search_input').autocomplete({
        serviceUrl: url + "search",
        minChars: 2,
        delimiter: /(,|;)\s*//*, // regex or character - pass null for single word autocomplete
        appendChars: ' ',
        params: { item: $(this).data('item') }, // additional parameters
        onSelect: function(value, data) {
            alert('You selected: ' + value + ', ' + data)
        }
    });*/

});

function updateLois(){

    $.get( url + "search/lois", function( data ) {

        if(data){

            console.log(data);

            $select_loi.empty();
            // array for options
            var items = [];
            // Loop over ajax data response
            $.each(data, function(key, values) {
                items.push('<optgroup label="'+ key +'">');
                $.each(values, function(id, loi) {
                    items.push('<option value="' + id.id + '">' + loi.sigle + '</option>');
                });
                items.push('</optgroup>');
            });
            // Join all html, append to select and show the select
            var all = items.join('');

            $select_loi.append(all);
        }

    });
}