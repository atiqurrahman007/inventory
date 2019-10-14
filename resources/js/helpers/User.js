import AppStorage from './AppStorage'
import Token from './Token'

class User{
	responseAfterLogin(response){
          const access_token = response.data.access_token
          const username = response.data.user
          if(Token.isValid(access_token)){
          	AppStorage.store(access_token,username);
          }
	}

	hasToken(){
		const storeToken = localStorage.getItem('token')
		if (storeToken) {
			return Token.isValid(storeToken)?true:false
		}
		false
	}

	logIn(){
		return this.hasToken();
	}
	logOut(){
		AppStorage.remove();
	}

	name(){
		if(this.logIn){
			return localStorage.getItem('user')
		}
	}

	id(){
		if (this.logIn) {
			const payload = Token.payload( localStorage.getItem('token'))
			return payload.sub
		}
		return false
	}

}

export default User = new User()