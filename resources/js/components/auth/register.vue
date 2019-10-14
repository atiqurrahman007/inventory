<template>
	<div>

	<div class="">
	<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form @submit.prevent="Register()" class="user">
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <input v-model="form.name" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Enter your Name">
                    <small class="text-danger" v-if="errors.name" style="color: red;">{{errors.name[0]}}</small>
                  </div>
                </div>
                <div class="form-group">
                  <input v-model="form.email" type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                  <small class="text-danger" v-if="errors.email" style="color: red;">{{errors.email[0]}}</small>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input v-model="form.password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    <small class="text-danger" v-if="errors.password" style="color: red;">{{errors.password[0]}}</small>
                  </div>
                  <div class="col-sm-6">
                    <input v-model="form.password_confirmation" type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                    
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
                <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <router-link to="/" class="small">Already have an account? Login!</router-link>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
		</div>
	</div>
</template>
<script type="text/javascript">
  export default{
    name:"register",
    created(){
      if (User.logIn()) {
        this.$router.push({name:'dashboard'})
      }
    },
    data(){
       return{
        form:{
          name: '',
          email: '',
          password: '',
          confirm_password: ''
        },
        errors:{}
       }
    },
    methods:{
      Register(){
        axios.post('/api/auth/signup/', this.form)
          .then((response)=>{
            User.responseAfterLogin(response)
            this.$router.push('/dashboard')
            Toast.fire({
              type:'success',
              title: 'Registration Success! you are log in now'
            })
          })
          .catch(e =>{
          this.errors = e.response.data.errors
          Toast.fire({
                type: 'warning',
                title: 'All field must be fill !'
              })
        })
      }
    }

  }
</script>
