var SelectList = React.createClass({
        getInitialState: function() {

        return {
            type  : null,
            items : []
        };
    },

    onChange: function(e) {

        var type = e.target.value;

        this.setState({ type: e.target.value });

        this.componentSetState(type);

    },

    componentSetState: function(type) {

        $.get("admin/api/" + type , function(result) {
            if (this.isMounted()) {

                var all = [];
                // Loop over ajax data response
                $.each(result, function(key, val) {
                    // if a slected categorie is passed in params put the corresponding option to selected
                    // var selected = (select == key ? 'selected' : '');
                    all.push({value: parseInt(key), label: val});
                });

                this.setState({ items: all });

                $(".chosen-select").trigger("chosen:updated");
            }
        }.bind(this));

    },

    componentDidMount: function() {

        if(this.state.type)
        {
            this.componentSetState(type);
        }

        $(".chosen-select").chosen({
            width: "95%"
        });
    },

    render: function() {

        var displayItem = function(item) {
            return <option value={item.value}>{item.label}</option>;
        } ;

        return (

            <div>
                <label className="radio-inline">
                    <input checked={this.state.type == "arret" ? true: null} onChange={this.onChange} type="radio" name="type" value="arret" />&nbsp; Arrêt</label>
                <label className="radio-inline">
                    <input checked={this.state.type == "article" ? true: null} onChange={this.onChange} type="radio" name="type" value="article" />&nbsp; Article</label>
                <label className="radio-inline">
                    <input checked={this.state.type == "chronique" ? true: null} onChange={this.onChange} type="radio" name="type" value="chronique" />&nbsp; Chronique</label>
                <br/><br/>
                <select name="item_id" className="form-control chosen-select">
                    <option value="">Choix</option>
                    { this.state.items.map(displayItem) }
                </select>
            </div>
        );
    }

});


React.render(<SelectList />,document.getElementById('listitems'));
//React.render(<SelectList name="article" source="admin/api/articles" />, document.getElementById('listarticles'));
//React.render(<SelectList name="chronique" source="admin/api/chroniques" />, document.getElementById('listchroniques'));