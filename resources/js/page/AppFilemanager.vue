<template>
  <div>
     <div class="container">
      <div class="row">
         
         <NavBar/>
         <router-view></router-view>
      </div>
   </div>
    <!-- Các phần tử gốc khác nếu cần -->
    

    
  </div>
</template>

<script>

  import NavBar from '../layout/Navbar.vue';
  
  export default {

    name: 'AppFilemanager',
      
    components: {
        NavBar:NavBar
    },
 
};
</script>
