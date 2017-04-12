$( function() {

    $('.redactor').redactor({
        minHeight  : 150,
        maxHeight: 300,
        fileUpload : 'uploadRedactor',
        buttons    : ['html','|','formatting','bold','italic','|','unorderedlist','orderedlist','outdent','indent','|','image','file','link','alignment']
    });

    $.fn.datepicker.dates['fr'] = {
        days: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        daysShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        daysMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        months: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
        monthsShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
        today: "Aujourd'hui",
        clear: "Clear"
    };

    $('.datePicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'fr'
    });

    $('body').on('click','.deleteAction',function(event){

        var $this  = $(this);
        var action = $this.data('action');
        var answer = confirm('Voulez-vous vraiment supprimer : '+ action +' ?');

        if (answer){
            return true;
        }
        return false;
    });

    // The url to the application
    var base_url = location.protocol + "//" + location.host+"/";

    // Selects in arrets
    var $select  = $( "#categorie" );
    // If the select exist on the page
    if($select){

        // Get passed params
        var domain    = $select.data('domain');
        var categorie = $select.data('categorie');

        // If we have a domain id fetch all children categories and populate select
        if(domain){
            $.ajax({
                dataType: 'json',
                success: function(data)
                {

                    $select.empty();
                    // array for options
                    var items = [];
                    // Loop over ajax data response
                    $.each(data, function(key, val) {
                        // if a slected categorie is passed in params put the corresponding option to selected
                        var selected = (categorie == key ? 'selected' : '');
                        items.push('<option '+selected+' value="' + key + '">' + val + '</option>');
                    });
                    // Join all html, append to select and show the select
                    var all = items.join('');
                    $select.append(all);
                },
                url: base_url + 'admin/lists/'+ domain
            });
        }
    }

    $('form input').keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });

    // By default hide the selects theme ans subtheme
    $("body").on("change", "#domain", function(){

        // Grab choosen categories
        var cat = $(this).val();
        //var _token = $("meta[name='token']").attr('content');

        if(cat)
        {
            $.ajax({
                dataType: 'json',
                success: function(data)
                {
                    $select.empty();
                    // array for options
                    var items = [];
                    items.push('<option value="">Choisir</option>');
                    // Loop over ajax data response
                    $.each(data, function(key, val) {
                        items.push('<option value="' + key + '">' + val + '</option>');
                    });
                    // Join all html, append to select and show the select
                    var all = items.join('');
                    $select.append(all);
                },
                url: base_url + 'admin/lists/'+ cat
            });
        }
    });

/*    var checked = $('input[name=groupe]:checked').val();
    console.log(checked);
    var status = (checked ? 'hide' : 'show');
    $('#collapsible').collapse(status);*/

    $('.collapseGroupe').on('change',function(){
        var checked = $(this).val();
        if(checked == 1){
            $('#collapsible').collapse('show');
        }
        if(checked == 0){
            $('#collapsible').collapse('hide');
        }
    });

    /*
        // Selects in arrets
        var $arrets  = $("#arrets-list");
        // If the select exist on the page
        if($arrets){

            var select = $select.data('select');

            $.ajax({
                dataType: 'json',
                success: function(data)
                {
                    $arrets.empty();
                    // array for options
                    var items = [];
                    // empty
                    items.push('<option value="">Choisir</option>');
                    // Loop over ajax data response
                    $.each(data, function(key, val) {
                        // if a slected categorie is passed in params put the corresponding option to selected
                        var selected = (select == key ? 'selected' : '');
                        items.push('<option '+selected+' value="' + key + '">' + val + '</option>');
                    });
                    // Join all html, append to select and show the select
                    var all = items.join('');
                    $arrets.append(all);
                },
                url : base_url + 'admin/api/arrets'
            });
        }*/


});