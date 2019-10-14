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

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Join date</th>
                      <th>NID</th>
                      <th>Salary</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Join date</th>
                      <th>NID</th>
                      <th>Salary</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr v-for = "(employee, index) in employees" :key="employee.id">
                      <td>{{employee.name}}</td>
                      <td>{{employee.email}}</td>
                      <td>{{employee.phone}}</td>
                      <td>{{employee.address}}</td>
                      <td>{{employee.join_date}}</td>
                      <td>{{employee.nid_number}}</td>
                      <td>{{employee.salary}}</td>
                      <td><img :src="employee.photo" width="50px" height="50px"></td>
                      <td>
                      	<button class="btn btn-primary btn-sm">Edit</button>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		name: "employee-index",
		created(){
			if (!User.logIn()) {
				this.$router.push('/')
			}
		},
		data(){
			return {
            employees:{}
			}
		},
		methods:{
             AllEmployee(){
             	axios.get('api/employee/')
             	.then(response =>{
             		this.employees = response.data
             	})
             	.catch(e=>{
             		console.log(e)
             	})
             }
		},
		mounted(){
			this.AllEmployee();
		},
	}
</script>