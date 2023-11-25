<template>
	<li class="mb-1">
      <button
        class="btn w-100 btn-toggle align-items-center rounded collapsed"
        data-bs-toggle="collapse"
        :data-bs-target="'#folder-collapse-' + folder.id"
        @click="handleButtonClickListFile(folder.id)"
        aria-expanded="false">
        <i class="fa fa-folder"></i>
        <span class="ml-2">{{ folder.name }} <span class="badge bg-primary text-white">{{ folder.totalfile }}</span></span>
      </button>
      <div :id="'folder-collapse-' + folder.id" class="collapse w-100">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <Menu v-for="child in folder.children" :key="child.id" :folder="child">
          </Menu>
        </ul>
      </div>
	</li>
</template>
<script>
export default {

    name: "Menu",

    props: {

        folder: Object,
    },
    methods:{
      
        handleButtonClickListFile(folderId) {

        	if(!folderId) return;

        	this.$store.dispatch('findIdDataFolder',folderId);
        }
   	},
  	data() {
	    	return {};
  		},
	};
</script>
<style scoped>
	
.nav-flush .nav-link {
  border-radius: 0;
}
.list-unstyled {
    padding-left: 10px;
    list-style: none;
}

.scrollarea {
  overflow-y: auto;
}

.btn-toggle {
  display: inline-flex;
  align-items: center;
  padding: .25rem .5rem;
  font-weight: 600;
  color: rgba(0, 0, 0, .65);
  background-color: transparent;
  border: 0;
}
.btn-toggle:hover,
.btn-toggle:focus {
  color: rgba(0, 0, 0, .85);
  background-color: #d2f4ea;
}

.btn-toggle::before {
  width: 1.25em;
  line-height: 0;
  content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
  transition: transform .35s ease;
  transform-origin: .5em 50%;
}

.btn-toggle[aria-expanded="true"] {
  color: rgba(0, 0, 0, .85);
}
.btn-toggle[aria-expanded="true"]::before {
  transform: rotate(90deg);
}

.btn-toggle-nav a {
    margin-left: 2.25rem;
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.5rem;
    font-weight: 600;
    color: rgba(0, 0, 0, .65);
    background-color: transparent;
    border: 0;
    text-decoration: none;
}
.btn-toggle-nav a:hover,
.btn-toggle-nav a:focus {
  background-color: #d2f4ea;
}
</style>
