<template>
    <div>

        <h4>Nouvelle matière</h4>
        <div class="well-form">
            <div class="row">
                <div class="col-md-12 dropdown-vue">
                    <label class="control-label">Matière</label>

                    <v-select :label="value" :v-model="newNote.matiere_id" :options="listMatieres" :onChange="what"></v-select>

                    <p class="margUp"><a @click="showAddMatiere" class="text-info addBtn">Pas dans la liste? Ajouter une matière</a></p>

                    <div class="input-group" v-if="addMatiere">
                        <input v-model="newmatiere" type="text" value="" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-success" @click="add" type="button">créer</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label class="control-label">Page</label>
                    <input class="form-control" v-model="newNote.page" name="page" type="text" v-bind:value="page">
                </div>
                <div class="col-md-4">
                    <label class="control-label">Volume</label>
                    <select name="volume_id" class="form-control" v-model="newNote.volume_id">
                        <option v-for="volume in volumes" v-bind:value="volume.id">{{ volume.year }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Cf. externe</label>
                    <input class="form-control" v-model="newNote.confer_externe " name="confer_externe " type="text">
                </div>
                <div class="col-md-6">
                    <label class="control-label">Cf. interne</label>
                    <input class="form-control" v-model="newNote.confer_interne " name="confer_interne " type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label">Contenu</label>
                    <textarea v-model="newNote.content" class="form-control" style="min-height:150px;"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label"></label>
                    <input class="form-control" v-model="newNote.domaine " name="domaine " type="text" placeholder="En matière...">
                </div>
            </div>
            <p class="text-right margUp"><button class="btn btn-info" @click="addNewNote" type="button">Ajouter</button></p>

        </div>

        <ul class="notes">
            <li class="note" v-for="note in listNotes">
                <div class="row">
                    <div class="col-md-10">
                        <p class="title_note"><strong>{{ note.matiere }}</strong></p>
                        {{ note.content }}
                        <p class="wrapper_attributes">
                            <span class="attributes">{{ note.domaine }}</span>
                            <span class="attributes">{{ note.confer_interne }}</span>
                            <span class="attributes">{{ note.confer_externe }}</span>
                        </p>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="button" @click="removeNote(note.id)" class="btn btn-danger btn-sm">x</button>
                    </div>
              </div>
            </li>
        </ul>

    </div>
</template>
<style>
    .well-form{
        background-color:#f5f5f5;
        padding:10px;
    }
    .margUp{
        margin-top:10px;
    }
    .attributes{
        display:block;
    }
    .wrapper_attributes{
        margin-top:5px;
    }
    .dropdown-vue {

    }
    .addBtn{
        cursor:pointer;
    }
    .notes{
        margin:15px 0 0 5px;
        padding:0;
        list-style:none;
    }
    .title_note{
        margin-bottom:5px;
    }
    .notes li{
        margin-top: 10px;
        margin-bottom: 5px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
     }
     .notes li:last-child{
        border-bottom: 0px;
     }
     .v-select input[type="search"], .v-select input[type="search"]:focus{
        background-color:#fff
     }
</style>
<script>

    import vSelect from "vue-select";
    export default{
        props: ['matieres','volumes','page','volume_id','notes'],
        computed: {},
        components: {
            'vSelect' : vSelect
        },
        data(){
            return{
               newNote:{
                    matiere_id: "",
                    content: '',
                    page: this.page,
                    domaine : "",
                    confer_externe : "",
                    confer_interne : "",
                    volume_id: this.volume_id,
                },
                listMatieres: [],
                listNotes: [],
                addMatiere: false,
                newmatiere: ''
            }
        },
        mounted: function () {
            this.getItems();
        },
        methods: {
            getItems: function(){
                this.listMatieres = this.matieres;
                this.listNotes = this.notes;
            },
            what: function(val){

                this.newNote.matiere_id = val.value;
                console.log(JSON.stringify(this.newNote));
            },
            showAddMatiere: function(){
                this.addMatiere = true;
            },
            add: function(){

                var self = this;

                axios.post('/admin/matiere', {
                    title: this.newmatiere,
                }).then(function (response) {
                     self.updateMatieres(response.data.matieres);
                })
                .catch(function (error) { console.log(error); });

            },
            updateMatieres: function(matieres){
                this.listMatieres = matieres;
            },
            updateNotes: function(notes){
                this.listNotes = notes;
            },
            addNewNote: function(){

                var self = this;

                axios.post('/admin/note', self.newNote).then(function (response) {
                    console.log(JSON.stringify(response.data.notes));
                     self.updateNotes(response.data.notes);
                })
                .catch(function (error) { console.log(error); });
            },
            removeNote: function(id){
                var self = this;

                axios.post('/admin/note/' + id, { '_method' : 'DELETE' }).then(function (response) {
                     self.updateNotes(response.data.notes);
                })
                .catch(function (error) { console.log(error); });
            },
        }
    }
</script>
