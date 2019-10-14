<template>
	<div>
		<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">
				<a href="#">Category</a>
			</li>
		</ol>	

    <div class="card o-hidden border-0 shadow-lg ">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-primary-900 mb-4">Add employee</h1>
              </div>
              <div class="card-header text-primary">
              	<i class="fas fa-chart-area"></i>
              	Employ Insert
              	<router-link  to="/employee" class="btn btn-sm btn-primary float-right">All employee list</router-link>
              </div>
              <form class="user" @submit.prevent="addEmployee" enctype="multipart/form-data">
                <div class="form-group mt-3 row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input v-model="form.name" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Employee Name">
                    <small class="text-danger" style="color: red;" v-if="errors.name">{{errors.name[0]}}</small>
                  </div>
                  <div class="col-sm-6">
                    <input v-model="form.email" type="email" class="form-control form-control-user" id="exampleLastName" placeholder="Email Address">
                    <small class="text-danger" style="color: red;" v-if="errors.email">{{errors.email[0]}}</small>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <textarea v-model="form.address" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Enter Address"></textarea>
                    <small class="text-danger" style="color: red;" v-if="errors.address">{{errors.address[0]}}</small>
                  </div>
                  <div class="col-sm-6">
                    <input v-model="form.salary" type="number" class="form-control form-control-user" id="exampleLastsalary" placeholder="Enter salary">
                    <small class="text-danger" style="color: red;" v-if="errors.salary">{{errors.salary[0]}}</small>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input v-model="form.join_date" type="date" class="form-control form-control-user" id="exampleInputPassword">
                    <small class="text-danger" style="color: red;" v-if="errors.join_date">{{errors.join_date[0]}}</small>
                  </div>
                  <div class="col-sm-6">
                    <input v-model="form.nid_number" type="number" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Enter NID number">
                    <small class="text-danger" style="color: red;" v-if="errors.nid_number">{{errors.nid_number[0]}}</small>
                  </div>
                </div>
                 
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="file" class="btn btn-primary" @change="onFileSelected">
                    
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <img :src="form.photo" height="100px" width="200px">
                  </div>
                  <div class="col-sm-3">
                   <div class="form-group">
				    <label for="exampleFormControlSelect1">Employee gander:</label>
				    <select v-model="form.gander" class="form-control" id="exampleFormControlSelect1">
				      <option disabled>Gender</option>
				      <option>Male</option>
				      <option>Femel</option>
				      
				    </select>
				    <small class="text-danger" style="color: red;" v-if="errors.gander">{{errors.gander[0]}}</small>
				  </div>
                  </div>
                </div>
                <div class="col-sm-6">
                    <input v-model="form.phone" type="number" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Enter NID number">
                    <small class="text-danger" style="color: red;" v-if="errors.phone">{{errors.phone[0]}}</small>
                  </div>
                <button type="submit" class="btn btn-primary btn-user text-right">
                  Save employee
                </button>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
	</div>
</template>

<script>
	export default {
		name:"add-employee",
		created(){
		      if (!User.logIn()) {
		        this.$router.push('/')
		      }
           },
		data(){
          return {
          	form:{
               name: '',
               email: '',
               phone: '',
               address: '',
               salary: '',
               nid_number: '',
               join_date: '',
               photo: '',
               gander: '',
          	},
          	errors:{},
          }
		},
		methods:{
            onFileSelected(event){
            	let file =  event.target.files[0];
             if (file.size > 1048770) {
             	Toast.fire({
                type: 'error',
                title: 'Upload image less then 1MB'
              })
             }else{
             	let reader = new FileReader();
             	reader.onload = event =>{
             		this.form.photo = event.target.result
             		console.log(event.target.result);
             	};
             	reader.readAsDataURL(file);
             }
            },
            addEmployee(){
                axios.post('/api/employee/', this.form)
                .then(response =>{
                	this.$router.push('/employee')
                	Toast.fire({
		                type: 'success',
		                title: 'Employee save success !'
		              })

                })
                .catch(e =>{
			          this.errors = e.response.data.errors
			          Toast.fire({
			                type: 'warning',
			                title: 'All field must be fill !'
			              })
			        })
                
                
            },
		}

	}
</script>