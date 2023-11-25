<template>
   <div class="col-12 col-lg-9">
      <div class="card">
         <div class="card-body">
            <div class="table-responsive mt-3">
               <vuetable ref="vuetable" :show-sort-icons="true" :api-mode="false" class="table table-striped table-hover table-sm mb-0" :data="getListDataFolders" data-path="getListDataFolders" :multi-sort="true" :fields="fields"
                    >

                  <template slot="url" slot-scope="props">

                     <div class="datable-image-container">
                        <figure>
                           <img class="datable-image" :src="props.rowData.url" />
                        </figure>
                        <button class="overlay-button">
                           Enlarge &nbsp;
                           <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M344 0H488c13.3 0 24 10.7 24 24V168c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-39-39-87 87c-9.4 9.4-24.6 9.4-33.9 0l-32-32c-9.4-9.4-9.4-24.6 0-33.9l87-87L327 41c-6.9-6.9-8.9-17.2-5.2-26.2S334.3 0 344 0zM168 512H24c-13.3 0-24-10.7-24-24V344c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2l39 39 87-87c9.4-9.4 24.6-9.4 33.9 0l32 32c9.4 9.4 9.4 24.6 0 33.9l-87 87 39 39c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8z"/></svg></button>
                     </div>

                  </template>   

                  <!-- Thêm template cho cột selected -->
                  <template slot="selected" class="text-content-table" slot-scope="props">
                    
                     <input type="checkbox" class="text-content-table" v-model="props.rowData.selected" />

                  </template> 

               </vuetable>
            </div>
         </div>
      </div>
   </div>
</template>
<script type="text/javascript">

   export default {

      name:'Home',

      data:function(){

         return  { 
            selectAll: false,

            fields: [
               {
                  name: '__checkbox',   // <----
                  titleClass: 'center aligned',
                  dataClass: 'center row-content aligned'
               },
               {
                  name: 'url',   // <----
                  title: 'Select all',
                  titleClass: 'text-left',
                  dataClass: 'center aligned'
               },
               {
                  name: 'name',  
                  title: 'Name',
                  titleClass: 'text-center',
                  dataClass: 'center text-center row-content aligned',
                  sortField: 'name',
               },
               {
                  name: 'dimmension', 
                  title: 'Dimmension',
                  titleClass: 'text-center',
                  dataClass: 'center text-center row-content aligned',
                  sortField: 'dimmension',
               },
               {
                  name: 'size', 
                  title: 'Size',
                  titleClass: 'text-center',
                  dataClass: 'center text-center row-content aligned',
                  sortField: 'size',
               },
            ]
         }
      },
   	methods:{
         
         handleDefaultItem(){

             this.$store.dispatch('defaultItemDataFolder');

         }
   	},
   	created(){

         this.handleDefaultItem();
   	},      
   	mounted() {


   	},
   	computed: {

   		getListDataFolders(){ 
           	return this.$store.getters.getListDataFolder;
       	},

         getSearchFolders(){ 
            return this.$store.getters.getSearchFolder;
         },
   	},
   }
</script>

<style scoped>

body {
  min-height: 100vh;
  min-height: -webkit-fill-available;
}

html {
  height: -webkit-fill-available;
}

main {
  display: flex;
  flex-wrap: nowrap;
  height: 100vh;
  height: -webkit-fill-available;
  max-height: 100vh;
  overflow-x: auto;
  overflow-y: hidden;
}

body{
	margin-top:20px;
	background-color: #f7f7ff;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0);
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.fm-file-box {
    font-size: 25px;
    background: #e9ecef;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: .25rem;
}
.ms-2 {
    margin-left: .5rem!important;
}
 .text-content-table {
    display: flex;
    align-items: center;
    justify-content: center;
  }
.fm-menu .list-group a {
    font-size: 16px;
    color: #5f5f5f;
    display: flex;
    align-items: center;
}
.list-group-flush>.list-group-item {
    border-width: 0 0 1px;
}
.list-group-item+.list-group-item {
    border-top-width: 0;
}
.py-1 {
    padding-top: .25rem!important;
    padding-bottom: .25rem!important;
}
.list-group-item {
    position: relative;
    display: block;
    padding: .5rem 1rem;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, .125);
}

.radius-15 {
    border-radius: 15px;
}
.fm-icon-box {
    font-size: 32px;
    background: #ffffff;
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: .25rem;
}
.font-24 {
    font-size: 24px;
}
.ms-auto {
    margin-left: auto!important;
}
.font-30 {
    font-size: 30px;
}
.user-groups img {
    margin-left: -14px;
    border: 1px solid #e4e4e4;
    padding: 2px;
    cursor: pointer;
}

.rounded-circle {
    border-radius: 50%!important;
}

.text-secondary {
    color: #b3b7bb !important;
}
 
.img-card-file{
	width: 200px;
	height: 100px;
}
.text-content-table{
	margin-top: 25%;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(255 255 255 / 5%);
}

.b-example-divider {
  flex-shrink: 0;
  width: 1.5rem;
  height: 100vh;
  background-color: rgba(0, 0, 0, .1);
  border: solid rgba(0, 0, 0, .15);
  border-width: 1px 0;
  box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}
.datable-image-container {
  position: relative;
  display: inline-block;
}
.datable-image-container:hover .datable-image {
   background-color: rgba(0, 0, 0, 0.3);
   transition: background-color 0.3s ease; 
}
.datable-image-container {
   transition: .5s ease;
   position: relative;
   display: inline-block;
}

.datable-image {
   width: 250px; 
   height: 100px;
   transition: .5s ease;
   border-radius: 10px;
   transition: opacity 0.3s ease, background-color 0.3s ease; 
   box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}

.overlay-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgb(255 255 255 / 19%);
  border: 1px solid #ccc;
  padding: 10px;
  display: none; 
  transition: opacity 0.3s ease; 
}

.datable-image-container:hover .overlay-button {
   border-radius: 25px;
   color: white;
   cursor: pointer;
   width: 120px;
   display: block;
}
.overlay-button > svg{
       fill: #fefafa;
}

.datable-image-container figure:hover img {
    opacity: .5;
}
.datable-image-container figure {
    background: #3b15fb;
}
figure {
   border-radius: 10px;
   margin: 0;
   padding: 0;
}
.datable-image-container figure img {
    opacity: 1;
    -webkit-transition: .3s ease-in-out;
    transition: .3s ease-in-out;
}
.datable-image-container:hover .overlay-button {
  display: block;
}
.datable-image-container:hover .datable-image {
  opacity: 0.3;
  transition: opacity 0.3s ease;
}

.datable-image-container:hover .datable-image-container:hover .overlay-button {
  opacity: 1;
  transition: opacity 0.3s ease;
}

</style>
