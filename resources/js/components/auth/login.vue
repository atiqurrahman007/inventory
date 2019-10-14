<template>
	<div>

	<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" @submit.prevent = "Login">
                    <div class="form-group">
                      <input v-model="form.email" type="email" name="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                      <small class="text-danger" v-if="errors.email" style="color: red;">{{errors.email[0]}}</small>
                    </div>
                    <div class="form-group">
                      <input v-model="form.password" type="password" class="form-control form-control-user"  placeholder="Password">
                      <small class="text-danger" v-if="errors.password" style="color: red;">{{errors.password[0]}}</small>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <router-link to="register" class="small">Create an account!</router-link>
                 </div>
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
    name: "login",
    created(){
      if (User.logIn()) {
        this.$router.push({name:'dashboard'})
      }
    },
    data(){
      return{
        form:{
          email: '',
          password: ''
        },
        errors:{}
      }
    },
    methods:{
      Login(){
        axios.post('/api/auth/login', this.form)
        .then(response =>{
          User.responseAfterLogin(response)
          this.$router.push('/dashboard')
          Toast.fire({
                type: 'success',
                title: 'Signed in successfully'
              })
          
        })
        .catch(e =>{
          this.errors = e.response.data.errors
          Toast.fire({
                type: 'warning',
                title: 'Email or Password invilade !'
              })
        })
      }
    }
  }
</script>