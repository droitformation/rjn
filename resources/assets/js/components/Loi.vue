<template>
    <div>

        <ul class="dispositions">
            <li v-if="!loading" v-for="disposition in listDispositions">
                <div class="row">
                    <div class="col-md-10">
                        {{ disposition.article }} {{ disposition.alinea }} {{ disposition.chiffre }} {{ disposition.lettre }} {{ disposition.loi }}
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="button" @click="removeDisposition(disposition.id)" class="btn btn-danger btn-xs">x</button>
                    </div>
                </div>
            </li>
            <li v-if="loading"><i class="fa fa-spinner"></i></li>
        </ul>

        <div class="terms">
            <div class="row">
                <div class="col-md-8 dropdown-vue">
                    <label class="control-label">Loi</label>
                    <v-select :label="value" v-model="selected" :options="listLois" :onChange="what"></v-select>
                </div>
                <div class="col-md-4">
                    <p class="margUp"><a @click="showAddLoi" class="text-info addBtn">Pas dans la liste?<br/> Ajouter une loi</a></p>
                </div>
            </div>
            <div style="margin-top:10px;margin-bottom:10px;" class="row" v-if="addLoi">
                <div class="col-md-2">
                    <input v-model="newLoi.sigle" type="text" value="" placeholder="sigle" class="form-control">
                </div>
                <div class="col-md-3">
                    <select name="droit" class="form-control" v-model="newLoi.droit">
                        <option value="1">Droit fédéral</option>
                        <option value="2">Droit cantonal</option>
                        <option value="3">Droit international</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                        <input v-model="newLoi.name" type="text" value="" placeholder="Nom" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-success" @click.prevent="addNewLoi" type="button">créer</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>
            <br/>

            <input v-model="newDisposition.page" name="page" type="hidden" v-bind:value="page">
            <input v-model="newDisposition.volume_id" name="volume_id" type="hidden" v-bind:value="volume_id">

            <div class="row">
                <div class="col-md-2">
                    <input class="form-control" v-model="newDisposition.article" name="article" type="text" placeholder="Article">
                </div>
                <div class="col-md-2">
                    <input class="form-control" v-model="newDisposition.alinea" name="alinea" type="text" placeholder="Alinea">
                </div>
                <div class="col-md-2">
                    <input class="form-control" v-model="newDisposition.chiffre" name="chiffre" type="text" placeholder="Chiffre">
                </div>
                <div class="col-md-2">
                    <input class="form-control" v-model="newDisposition.lettre" name="lettre" type="text" placeholder="Lettre">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-info" @click.prevent="addNewDisposition" type="button">Ajouter</button>
                </div>
            </div>

        </div>

    </div>
</template>
<style>
    .terms{
        padding:10px;
        margin:5px 0;
        background-color:#f5f5f5;
    }

    .dispositions{
        margin:15px 0 0 0;
        padding:0;
        list-style:none;
    }

    .dispositions li{
        margin-top: 5px;
        margin-bottom: 5px;
        border: 1px solid #ddd;
        padding: 5px;
     }
</style>
<script>
    import vSelect from "vue-select";
    export default{
        props: ['volumes','dispositions','page','volume_id','lois','droit'],
        computed: {},
        components: {
            'vSelect' : vSelect
        },
        data(){
            return{
                loading:false,
                newLoi:{
                    name:"",
                    sigle:"",
                    droit:1,
                },
                newDisposition:{
                    volume_id: this.volume_id,
                    page: this.page,
                    loi_id:null,
                    article:"",
                    alinea:"",
                    chiffre:"",
                    lettre:""
                },
                listLois: [],
                listDispositions: [],
                addLoi: false,
                selected: null,
            }
        },
        mounted: function () {
            this.getItems();
        },
        methods: {
            getItems: function(){
                this.listLois = this.lois;
                this.listDispositions = this.dispositions
            },
            what: function(val){
                this.newDisposition.loi_id = val.value;
                this.selected = val;
            },
            showAddLoi: function(){
                this.addLoi = true;
            },
            updateLois: function(lois){
                this.listLois = lois;
            },
            addNewLoi: function(){
                var self = this;

                console.log(JSON.stringify(self.newLoi));

                axios.post('/admin/loi', self.newLoi).then(function (response) {
                    console.log(JSON.stringify(response));
                    self.updateLois(response.data.lois);
                    self.addLoi = false;
                })
                .catch(function (error) { console.log(error); });
            },
            addNewDisposition: function(){
                var self = this;
                this.loading = true;
                console.log(JSON.stringify(self.newDisposition));
                axios.post('/admin/disposition/storeAjax', self.newDisposition).then(function (response) {

                     self.newDisposition = {
                        volume_id: self.volume_id,
                        page: self.page,
                        loi_id:null,
                        article:"",
                        alinea:"",
                        chiffre:"",
                        lettre:""
                     };

                     console.log(self.selected);
                     self.selected = null;
                     self.updateDispositions(response.data.dispositions);
                     self.loading = false;
                })
                .catch(function (error) { console.log(error); });
            },
            updateDispositions: function(dispositions){
                this.listDispositions = dispositions
            },
            removeDisposition: function(id){
                var self = this;
                this.loading = true;
                axios.post('/admin/disposition/' + id, { '_method' : 'DELETE' }).then(function (response) {
                     self.updateDispositions(response.data.dispositions);
                     self.loading = false;
                })
                .catch(function (error) { console.log(error); });
            },
        }
    }
</script>
