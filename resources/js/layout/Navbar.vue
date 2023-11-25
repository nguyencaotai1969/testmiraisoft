<template>
     <div class="col-12 col-lg-3">
        <div class="card">
           <div class="card-body">
              <div class="d-grid">
                 <div  class="btn btn-primary w-100">import documents</div>
              </div>
              <hr>
              <div class="mt-4">
                 <p class="mb-0 mt-2 d-flex justify-content-between">
                    <span class="text-secondary">Storage</span>
                    <span class="float-end text-primary">Change plan</span>
                 </p>

                  <!-- dung lượng còn -->
                 <div v-if="getSizeUsed.totalUsed < 100">
                 	<div class="progress mt-3" >
                    	<div class="progress-bar" role="progressbar":style="{ width: getSizeUsed.totalUsed + '%' }" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                 	</div>
                 	<p class="mb-0 text-primary font-weight-bold">{{ getSizeUsed.totalUsed }}% <span class="float-end text-secondary">used of {{ getSizeUsed.totalDisk }} GB</span></p>
                 </div>

                 <!-- hết dung lượng -->
                 <div  v-else>
                 	<div class="progress mt-3 text-danger" >
                    	<div class="progress-bar full-disk" role="progressbar":style="{ width: '100%' }" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                 	</div>
                 	   <p class="mb-0  text-danger font-weight-bold">100% Full Disk {{ getSizeUsed.totalDisk }} GB</p>
                  </div>
              </div>
              <hr>
              <div class="mt-4">
                 <p class="mb-0 mt-2 d-flex justify-content-between">
                    <span class="text-secondary">Search</span>
                 </p>
                 <div class="input-group mb-3" > 
                    <input placeholder="e.g image.png" maxlength="100" v-model="inputSearch" @input="handleInputSearch"  class="form-control input-search">
                    <span v-if="inputSearch.length <= 0" class="input-group-text icon-search"><i class="fa fa-search"></i></span>
                    <span v-else class="input-group-text icon-search btn" @click="clearInputSearch"><i class="fa fa-close"></i></span>
                 </div>
              </div>
              <hr>
              <div class="fm-menu">
                  <p class="mb-0 mt-2 d-flex justify-content-between">
                     <span class="text-secondary">Folders</span>
                     <span class="float-end text-primary">New folder</span>
                  </p>
                  <ul class="list-unstyled ps-0" >
                     <Menu v-for="folder in getMenuFolders" :key="folder.id" :folder="folder">
                     </Menu>
                  </ul>
              </div>
           </div>
        </div>
     </div>
</template>
<script>

  	export default {

	  	   name: "NavBar",

	      props:{

               
	      },
         data:function(){
            return  { 
               folders: [
               ],
               inputSearch:''   
            }
         },
         methods: {

            // clear data
            clearInputSearch(){

               this.inputSearch = '';
               this.$store.dispatch('defaultItemDataFolder');
            },

            //search input
            handleInputSearch() {

               this.$store.dispatch('searchDataFolder',this.inputSearch);
            },

       
         },

         created(){

         },   
         computed: {
           
      		getSizeUsed(){ 

	           	return this.$store.getters.getSizeUsed;
	       	},
            getMenuFolders(){ 

               return this.$store.getters.getMenuFolder;
            },
      	},
   }

</script>

<style scoped>
.progress{
	height:10px;
}
.input-search{
	border-right: none;
}
.icon-search{
    align-items: center;
    padding: 0.375rem 0.75rem;
    margin-bottom: 0;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #b2bbc3;
    text-align: center;
    white-space: nowrap;
    background-color: #ffffff;
    border: 1px solid #ced4da;
    border-radius: 0;
    border-left: 1px solid #ffffff00;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
.bi {
  vertical-align: -.125em;
  pointer-events: none;
  fill: currentColor;
}

.dropdown-toggle { outline: 0; }

.fw-semibold { font-weight: 600; }
.lh-tight { line-height: 1.25; }
.badge{
	font-size: 85%;
}
.full-disk{
	background-color: red;
}
</style>